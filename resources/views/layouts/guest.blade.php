<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Attendance Management System') }}</title>

    <!-- Fonts & Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #F3F4F6;
        }

        .header {
            background-color: black;
            padding: 33px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #1E40AF; /* Blue */
            font-weight: 700;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 85vh;
            padding: 20px;
        }

        .left-section {
            flex: 1;
            padding: 40px;
            color: #374151; /* Dark Gray */
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-right: 40px;
        }

        .left-section h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #1F2937; /* Dark Text */
        }

        .left-section span {
            color: #2563EB; /* Blue */
            font-weight: 600;
        }

        .login-form {
            background-color: white;
            margin-right: 30px;
            padding: 60px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 500px;
        }

        .input-row {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .input-field {
            flex: 1;
        }

        select, input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            outline: none;
            transition: 0.3s;
        }

        select:focus, input:focus {
            border-color: #2563EB;
            box-shadow: 0 0 5px rgba(37, 99, 235, 0.3);
        }

        button {
            width: 100%;
            background-color: #2563EB;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #1E40AF;
        }

        .forgot-password {
            margin-top: 10px;
            text-align: right;
            color: #2563EB;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Computer Science</h1>
    </div>
    <div class="container">
        <!-- Left Section -->
        <div class="left-section">
            <h2>Attendance <span>Management System</span></h2>
            {{-- <p>Efficiently track and manage attendance records for teachers, students, and staff advisors.</p> --}}
        </div>

        <!-- Right Section: Login Form -->
        <div class="login-form">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
