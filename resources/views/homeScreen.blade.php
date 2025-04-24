<style>
    /* Global Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #2c5364, #43203e);
        color: #f1f1f1;
        min-height: 100vh;
    }

    a {
        text-decoration: none;
    }

    header {
        background: #111;
        padding: 20px 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 6px rgba(0,0,0,0.3);
    }

    .logo img {
        width: 70px;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(255,255,255,0.2);
    }

    .btn-custom {
        margin: 0 8px;
        padding: 10px 25px;
        border: none;
        border-radius: 30px;
        font-size: 16px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255,255,255,0.3);
    }

    .btn-secondary {
        background: #444;
        color: #fff;
    }

    .btn-success {
        background: #28a745;
        color: #fff;
    }

    .welcome-container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        padding: 60px 10%;
        animation: fadeIn 1.2s ease-in-out;
    }

    .dept-info {
        flex: 1;
        padding: 30px;
        animation: slideInLeft 1.2s ease-in-out;
    }

    .dept-info h1 {
        font-size: 3rem;
        margin-bottom: 20px;
    }

    .dept-info p {
        font-size: 1.1rem;
        line-height: 1.8;
    }

    .dept-img {
        flex: 1;
        text-align: center;
        animation: slideInRight 1.2s ease-in-out;
    }

    .dept-img img {
        width: 85%;
        max-width: 450px;
        border-radius: 20px;
        box-shadow: 0px 8px 20px rgba(255, 255, 255, 0.2);
    }

    hr {
        width: 80%;
        margin: 50px auto;
        border: 1px solid #ddd;
        opacity: 0.3;
    }

    .chairman-section {
        text-align: center;
        padding: 50px 10%;
        background: rgba(255,255,255,0.05);
        border-radius: 15px;
        margin: 0 10%;
        animation: fadeInUp 1.2s ease-in-out;
    }

    .chairman-section h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    .chairman-section p {
        font-size: 1.1rem;
        line-height: 1.8;
    }

    .footer {
        background: #111;
        padding: 15px;
        text-align: center;
        font-size: 14px;
        color: #aaa;
        position: fixed;
        bottom: 0;
        width: 100%;
        box-shadow: 0 -2px 6px rgba(0,0,0,0.3);
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInUp {
        from { transform: translateY(40px); opacity: 0; }
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

    @media (max-width: 768px) {
        .welcome-container {
            flex-direction: column;
            padding: 40px 5%;
        }

        .dept-info, .dept-img {
            flex: unset;
            width: 100%;
            text-align: center;
        }

        .dept-info h1 {
            font-size: 2.2rem;
        }
    }
</style>

<!-- HEADER -->
<header>
    <div class="logo">
        <img src="{{ asset('images/logo.jpg') }}" alt="Department Logo">
    </div>
    <div>
        <a href="{{ route('login') }}" class="btn btn-secondary btn-custom">Login</a>
        <a href="{{ route('register') }}" class="btn btn-success btn-custom">Sign Up</a>
    </div>
</header>

<!-- WELCOME SECTION -->
<div class="welcome-container">
    <div class="dept-info">
        <h1>Welcome to Computer Science Department</h1>
        <p>
            The Computer Science Department is dedicated to excellence in teaching, learning, and research.
            Our mission is to provide students with a strong foundation in computing principles and practical applications
            to prepare them for success in both industry and academia.
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
    <h1>Meet Our Chairman</h1>
    <p>
        Dr. John Doe has been an inspirational leader, guiding our department towards groundbreaking research and
        a culture of innovation. Under his leadership, the department continues to reach new heights in computer science and information technology.
    </p>
</div>

<!-- FOOTER -->
{{-- <div class="footer">
    &copy; 2025 Department of CS & IT
</div> --}}
