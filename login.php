<?php
include 'config.php';
include 'auth_process.php';
?>

<!DOCTYPE html>
<html lang="en">
<!-- Head section remains the same -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register Form</title>
    <style>
        /* Previous styles remain the same */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f5f5f5;
        }

        .container {
            position: relative;
            width: 800px;
            height: 500px;
            background: #fff;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-radius: 20px;
        }

        /* Previous container and form styles remain the same */
        .form-container {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            display: flex;
            transition: 0.5s ease-in-out;
        }

        .login-container {
            transform: translateX(0);
        }

        .register-container {
            transform: translateX(100%);
            opacity: 0;
        }

        /* Updated color for blue background sections */
        .blue-bg {
            position: relative;
            width: 45%;
            height: 100%;
            background: #c0eb7b url('https://hebbkx1anhila5yf.public.blob.vercel-storage.com/free-background-daun-vector.jpg-Y8cXmv8ijKackMTb9CLsQUTT9J7VkP.jpeg') center center/cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            border-radius: 0 100px 100px 0;
        }

        /* Add an overlay to ensure text remains readable */
        .blue-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(192, 235, 123, 0.7); /* Semi-transparent overlay using the #c0eb7b color */
            border-radius: inherit;
        }

        /* Ensure content stays above the overlay */
        .blue-bg h1,
        .blue-bg p,
        .blue-bg button {
            position: relative;
            z-index: 1;
        }

        .blue-bg.right {
            border-radius: 100px 0 0 100px;
        }

        .white-bg {
            position: relative;
            width: 55%;
            height: 100%;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        /* Previous heading styles remain the same */
        h1 {
            font-size: 40px;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 32px;
            margin-bottom: 30px;
            color: #333;
        }

        .subtitle {
            font-size: 16px;
            margin-bottom: 20px;
            color: #666;
        }

        /* Updated hover color for white button */
        .white-button {
            background: white; /* Changed from transparent */
            border: 2px solid white;
            color: #c0eb7b; /* Changed to green initially since background is now white */
            padding: 10px 40px;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .white-button:hover {
            background: transparent; /* Changed hover state to be transparent */
            color: white; /* Changed hover state to be white text */
        }

        .form-group {
            width: 100%;
            max-width: 300px;
            margin-bottom: 20px;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: none;
            background: #f5f5f5;
            border-radius: 10px;
            font-size: 14px;
        }

        .form-group input::placeholder {
            color: #aaa;
        }

        /* Updated color for blue button */
        .blue-button {
            background: #c0eb7b; /* Changed from #6C8EFE to #c0eb7b */
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
            max-width: 300px;
            margin-bottom: 20px;
        }

        .blue-button:hover {
            background: #aed670; /* Adjusted hover color to be slightly darker */
        }

        .social-text {
            color: #666;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .social-icons {
            display: flex;
            gap: 15px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border: 1px solid #ddd;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: 0.3s;
        }

        .social-icon:hover {
            border-color: #c0eb7b; /* Changed from #6C8EFE to #c0eb7b */
            background: #f5f5f5;
        }

        .forgot-password {
            color: #666;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .forgot-password:hover {
            color: #c0eb7b; /* Changed from #6C8EFE to #c0eb7b */
        }

        /* Mobile responsive styles remain the same */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                height: auto;
                min-height: 500px;
            }

            .form-container {
                flex-direction: column;
            }

            .blue-bg {
                width: 100%;
                height: 150px;
                border-radius: 20px 20px 100px 100px;
                order: -1;
            }

            .blue-bg.right {
                border-radius: 20px 20px 100px 100px;
            }

            .white-bg {
                width: 100%;
                padding: 30px 20px;
            }

            .register-container .blue-bg {
                order: 1;
                border-radius: 100px 100px 20px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- HTML structure remains exactly the same -->
    <div class="container">
        <!-- Login Form -->
<div class="form-container login-container">
    <div class="blue-bg">
        <h1>Hello, Welcome!</h1>
        <p class="subtitle">Don't have an account?</p>
        <button class="white-button" onclick="toggleForm()">Register</button>
    </div>
    <div class="white-bg">
        <h2>Login</h2>
        <form method="POST" action="login.php" id="loginForm">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <a href="#" class="forgot-password">Forgot password?</a>
            <button type="submit" name="login" class="blue-button">Login</button>
        </form>
        <p class="social-text">or login with social platforms</p>
        <div class="social-icons">
            <div class="social-icon">G</div>
            <div class="social-icon">f</div>
            <div class="social-icon">G</div>
            <div class="social-icon">in</div>
        </div>
        <?php if ($loginMessage): ?>
            <div class="error-message"><?php echo $loginMessage; ?></div>
        <?php endif; ?>
    </div>
</div>

<!-- Register Form -->
<div class="form-container register-container">
    <div class="white-bg">
        <h2>Registration</h2>
        <form method="POST" action="login.php" id="registerForm">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
            </div>
            <button type="submit" name="register" class="blue-button">Register</button>
        </form>
        <p class="social-text">or register with social platforms</p>
        <div class="social-icons">
            <div class="social-icon">G</div>
            <div class="social-icon">f</div>
            <div class="social-icon">G</div>
            <div class="social-icon">in</div>
        </div>
        <?php if ($registerMessage): ?>
            <div class="error-message"><?php echo $registerMessage; ?></div>
        <?php endif; ?>
    </div>
    <div class="blue-bg right">
        <h1>Welcome Back!</h1>
        <p class="subtitle">Already have an account?</p>
        <button class="white-button" onclick="toggleForm()">Login</button>
    </div>
</div>
<script>
            function toggleForm() {
            const loginContainer = document.querySelector('.login-container');
            const registerContainer = document.querySelector('.register-container');
            
            if (loginContainer.style.transform === "translateX(-100%)") {
                loginContainer.style.transform = "translateX(0)";
                loginContainer.style.opacity = "1";
                registerContainer.style.transform = "translateX(100%)";
                registerContainer.style.opacity = "0";
            } else {
                loginContainer.style.transform = "translateX(-100%)";
                loginContainer.style.opacity = "0";
                registerContainer.style.transform = "translateX(0)";
                registerContainer.style.opacity = "1";
            }
        }

        <?php if ($loginMessage): ?>
            <div class="error-message" style="color: red; margin-top: 10px;"><?php echo $loginMessage; ?></div>
        <?php endif; ?>

        <?php if ($registerMessage): ?>
            <div class="error-message" style="color: red; margin-top: 10px;"><?php echo $registerMessage; ?></div>
        <?php endif; ?>


</script>
    
    
</body>
</html>

