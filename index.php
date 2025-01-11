
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('Good ambient in d56ec984-1c2d-45f5-9225-f5c5997690cd 1.png') no-repeat center center/cover;
        }

        .login-container {
            background-color: #fff;
            border-radius: 50px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            display: flex;
            overflow: hidden;
            width: 80%;
            max-width: 900px;
        }

        .form-section {
            padding: 3rem;
            width: 60%;
        }

        .image-section {
            width: 40%;
            background: url('DIFFERENT TYPES 614ea513-9253-4151-b14f-f55e6f594ad7 1.png') no-repeat center center/cover;
        }

        .form-header {
            margin-bottom: 1.5rem;
        }

        .form-header h1 {
            font-size: 2rem;
            font-weight: 600;
        }

        .form-header p {
            color: #6c757d;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 8px;
            font-weight: 500;
            width: 100%;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-login img {
            width: 30px;
            height: 30px;
            cursor: pointer;
        }

        .register-link {
            margin-top: 1rem;
            font-size: 0.9rem;
            text-align: center;
        }

        .contact-email {
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: #6c757d;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="form-section">
            <div class="form-header">
                <img src="logo.png" alt="Logo" class="mb-3">
                <h1>Log in</h1>
                <p>Welcome back! Please enter your details</p>
            </div>
            <form id="loginForm">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email / username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember</label>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            <p class="register-link">
                Don't have an account? <a href="register.php">Register Now</a>
            </p>
        </div>
        <div class="image-section"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function() {
    $('#loginForm').submit(function(e) {
        e.preventDefault();

        const formData = {
            email: $('#email').val(),
            password: $('#password').val(),
            action: 'login'
        };

        $.ajax({
            url: 'login_user.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Redirect based on the response
                    window.location.href = response.redirect;
                } else {
                    alert(response.message || 'Login failed. Please check your credentials.');
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    });
});

    </script>

</body>

</html>