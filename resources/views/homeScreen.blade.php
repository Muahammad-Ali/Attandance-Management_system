
<style>
    /* Custom Styles */
    body {
        font-family: 'Arial', sans-serif;
        background: linear-gradient(to right, #f8f8f8, #43203e, #2c5364);
        color: white;
        text-align: center;
    }

    .welcome-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 50px;
        animation: fadeIn 1.5s ease-in-out;
    }

    .dept-info {
        flex: 1;
        padding: 20px;
        text-align: left;
        animation: slideInLeft 1.5s ease-in-out;
    }

    .dept-img {
        flex: 1;
        text-align: center;
        animation: slideInRight 1.5s ease-in-out;
    }

    .dept-img img {
        width: 80%;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.2);
    }

    .btn-custom {
        margin: 10px;
        padding: 10px 25px;
        font-size: 18px;
        border-radius: 25px;
        transition: 0.3s;
    }

    .btn-custom:hover {
        transform: scale(1.1);
    }

    hr {
        width: 80%;
        margin: 40px auto;
        border: 2px solid white;
    }

    .chairman-section {
        text-align: center;
        padding: 20px;
        animation: fadeInUp 1.5s ease-in-out;
    }

    .footer {
        background: #111;
        padding: 10px;
        color: white;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInUp {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    @keyframes slideInLeft {
        from { transform: translateX(-100px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    @keyframes slideInRight {
        from { transform: translateX(100px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
</style>

<!-- HEADER -->
<header class="d-flex justify-content-between align-items-center p-3 bg-dark">
    <div class="logo">
        <img src="{{ asset('images/logo.jpg') }}" alt="Department Logo" width="80">
    </div>
    <div>
        <a href="{{ route('login') }}" class=" btn btn-secondary btn-custom ">Login</a>
        <a href="{{ route('register') }}" class="btn btn-success btn-custom ">Sign Up</a>
    </div>
</header>

<!-- WELCOME SECTION -->
<div class="welcome-container">
    <div class="dept-info">
        <h1 class="display-4">Welcome to Computer Science Department</h1>
        <p class="lead">
            The Computer Science Department is dedicated to excellence in teaching, learning, and research.
            Our mission is to provide students with a strong foundation in computing principles and practical applications
            to prepare them for industry and academia.
        </p>
    </div>
    <div class="dept-img">
        <img src="{{ asset('images/dep.jpeg') }}" alt="CS Department Image">
    </div>
</div>

<!-- DIVIDER -->
<hr>

<!-- INTRODUCTION TO CHAIRMAN -->
<div class="chairman-section">
    <h1>Introduction to Chairman</h1>
    <p class="lead">
        Our Chairman, Dr. John Doe, has been leading the department with a vision for innovation and excellence.
        Under his leadership, the department has achieved numerous milestones in research and development.
    </p>
</div>

<!-- FOOTER -->
<div class="footer">
    @2025 Department of CS & IT
</div>

