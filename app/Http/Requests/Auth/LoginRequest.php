<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
            'role' => ['required', 'string', 'in:admin,teacher,cr,staff_advisor'],
        ];
    }


    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $role = $this->input('role');
        $email = $this->input('email');
        $password = $this->input('password');

        // Admin authentication uses the web guard
        if ($role === 'admin') {
            if (Auth::attempt(['email' => $email, 'password' => $password, 'role' => 'admin'], $this->boolean('remember'))) {
                RateLimiter::clear($this->throttleKey());
                return;
            }
        } 
        // CR authentication
        else if ($role === 'cr') {
            $credentials = [
                'cr_email' => $email,
                'password' => $password
            ];
            
            if (Auth::guard('cr')->attempt($credentials, $this->boolean('remember'))) {
                RateLimiter::clear($this->throttleKey());
                return;
            }
        }
        // Teacher authentication
        else if ($role === 'teacher') {
            $credentials = [
                'email' => $email,
                'password' => $password
            ];
            
            if (Auth::guard('teacher')->attempt($credentials, $this->boolean('remember'))) {
                RateLimiter::clear($this->throttleKey());
                return;
            }
        }
        // Default web authentication
        else {
            if (Auth::attempt(['email' => $email, 'password' => $password], $this->boolean('remember'))) {
                RateLimiter::clear($this->throttleKey());
                return;
            }
        }

        // Authentication failed
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
