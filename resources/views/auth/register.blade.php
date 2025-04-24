<x-guest-layout>
    <style>
        body {
          background: linear-gradient(135deg, #1f1c2c, #928DAB);
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-size: cover;
          font-family: 'Poppins', sans-serif;
        }

        input, select, textarea {
          background-color: #fff !important;
          color: #333 !important;
          border: 1px solid #ccc;
          padding: 12px;
          border-radius: 8px;
          font-size: 1rem;
          outline: none;
        }

        input:focus, select:focus, textarea:focus {
          border-color: #6666ff;
          box-shadow: 0 0 0 3px rgba(102, 102, 255, 0.2);
        }
      </style>


    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Role Dropdown -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select name="role" id="role" class="block mt-1 w-full" required>
                <option value="admin" selected>Admin</option>
                {{-- <option value="student">Student</option>
                <option value="staff_advisor">Staff Advisor</option> --}}
            </select>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Login Link + Register Button -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
