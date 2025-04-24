<x-guest-layout>
    <style>
        body {
            background: linear-gradient(135deg, #1f1c2c, #928DAB); /* Dark purple to light gray */
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Dropdown Selection -->
        <div class="input-row">
            <div class="input-field">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="teacher">Teacher</option>
                    <option value="cr">Cr</option>
                    <option value="batchadvisor">Batch Advisor</option>
                    <option value="semestercoordinator">Semester Coordinator</option>
                </select>
            </div>
        </div>

        <!-- Email and Password -->
        <div class="input-row">
            <div class="input-field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="input-field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" placeholder="Enter your password" required>
            </div>
        </div>

        <!-- Remember Me and Forgot Password -->
        <div class="input-row">
            <label for="remember_me" class="input-field">
                <input type="checkbox" name="remember" id="remember_me">
                <span>Remember Me</span>
            </label>
            <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
        </div>

        <!-- Submit Button -->
        <button type="submit">Log In</button>
    </form>
    <a href="{{ route('register') }}">
        <button type="button">Register</button>
    </a>
</x-guest-layout>
