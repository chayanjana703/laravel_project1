<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Login — AURA Marketplace</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Space+Grotesk:wght@600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            background: #f1f5f9;
            color: #0f172a;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 100px 20px 40px;
            overflow-x: hidden;
        }

        /* Subtle Ambient Glowing Spheres Background */
        .bg-glow-1 {
            position: fixed;
            top: -120px;
            left: -100px;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.12), transparent 70%);
            z-index: 0;
            pointer-events: none;
        }

        .bg-glow-2 {
            position: fixed;
            bottom: -100px;
            right: -100px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.15), transparent 70%);
            z-index: 0;
            pointer-events: none;
        }

        /* DYNAMIC ISLAND NAVBAR */
        .nav-container {
            position: fixed;
            top: 18px;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            justify-content: center;
            padding: 0 16px;
            pointer-events: none;
        }

        .navbar {
            pointer-events: auto;
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            color: #0f172a;
            border-radius: 28px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.12),
                0 0 0 1px rgba(15, 23, 42, 0.08);
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            width: 580px;
            padding: 8px 16px;
        }

        .nav-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 42px;
            cursor: pointer;
            user-select: none;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .brand-icon {
            width: 32px;
            height: 32px;
            background: #0f172a;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);
        }

        .brand-icon svg {
            width: 18px;
            height: 18px;
            fill: #ffffff;
        }

        .brand-name {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.05rem;
            letter-spacing: 0.5px;
            color: #0f172a;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-link {
            color: #64748b;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #2563eb;
        }

        /* -------------------------------------------------------------
           GLASSMORPHISM AUTH CONTAINER
        ------------------------------------------------------------- */
        .auth-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 32px;
            padding: 40px 36px;
            box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.12),
                0 0 0 1px rgba(15, 23, 42, 0.05);
            transition: transform 0.3s ease;
        }

        .auth-badge {
            align-self: center;
            background: #eff6ff;
            color: #1e40af;
            font-size: 0.72rem;
            font-weight: 800;
            padding: 6px 14px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            display: inline-block;
            margin-bottom: 14px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .auth-header h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.1rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .auth-header p {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Form Inputs */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            color: #334155;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-input {
            width: 100%;
            padding: 14px 14px 14px 44px;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            font-size: 0.92rem;
            font-weight: 600;
            color: #0f172a;
            outline: none;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .form-input:focus {
            background: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            font-size: 0.84rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #475569;
            font-weight: 600;
            cursor: pointer;
        }

        .remember-me input {
            accent-color: #2563eb;
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .forgot-link {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .forgot-link:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        /* Submit Button */
        .btn-auth-submit {
            width: 100%;
            padding: 16px;
            background: #0f172a;
            color: #ffffff;
            border: none;
            border-radius: 18px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(15, 23, 42, 0.15);
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-auth-submit:hover {
            background: #2563eb;
            box-shadow: 0 12px 24px rgba(37, 99, 235, 0.3);
            transform: translateY(-2px);
        }

        /* Divider & Social Logins */
        .divider-container {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 28px 0 20px;
        }

        .divider-line {
            flex-grow: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .divider-text {
            font-size: 0.78rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .social-login-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 24px;
        }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            padding: 12px;
            font-size: 0.85rem;
            font-weight: 700;
            color: #334155;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-social:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            transform: translateY(-1px);
        }

        /* Auth Footer Link */
        .auth-footer {
            text-align: center;
            font-size: 0.88rem;
            color: #64748b;
            font-weight: 500;
        }

        .auth-footer a {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
            margin-left: 4px;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #0f172a;
            color: #ffffff;
            padding: 12px 20px;
            border-radius: 14px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 2000;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        @media (max-width: 640px) {
            body {
                padding: 20px 16px 120px !important;
            }

            .nav-container {
                top: auto !important;
                bottom: 16px !important;
                padding: 0 12px;
            }

            .navbar {
                width: 100% !important;
                border-radius: 28px;
            }

            .auth-card {
                padding: 32px 20px;
                border-radius: 28px;
            }

            .social-login-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="bg-glow-1"></div>
    <div class="bg-glow-2"></div>

    <!-- DYNAMIC ISLAND NAVBAR -->
    <div class="nav-container">
        <nav class="navbar" id="dynamicNavbar">
            <div class="nav-header">
                <a href="index.blade.php" class="nav-left">
                    <div class="brand-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                        </svg>
                    </div>
                    <span class="brand-name">UnCart</span>
                </a>

                <div class="nav-links">
                    <a href="index.blade.php" class="nav-link">← Marketplace</a>
                    <a href="register.blade.php" class="nav-link">Register</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- LOGIN FORM CARD -->
    <div class="auth-card">
        <div style="text-align: center;">
            <span class="auth-badge">WELCOME BACK</span>
        </div>

        <div class="auth-header">
            <h1>Sign in to UnCart</h1>
            <p>Access your orders, wishlist & exclusive tech deals</p>
        </div>
        @if(session('error'))
            <div style="color:red; margin-bottom:15px;">
                {{ session('error') }}
            </div>
        @endif
        <form id="loginForm" action="{{ route('admin.login.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                            </path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </span>
                    <input type="email" id="email" name="email" class="form-input" placeholder="name@example.com"
                        required>
                </div>
                <span class="error-message" style="color: red;">@error('email') {{ $message }} @enderror</span>
            </div>
            

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </span>
                    <input type="password" id="password" name="password" class="form-input" placeholder="••••••••••••"
                        required>
                    
                </div>
                <span class="error-message" style="color: red;">@error('password') {{ $message }} @enderror</span>
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" checked> Remember me
                </label>
                <a href="#" class="forgot-link" onclick="showToast('Password reset link sent!')">Forgot Password?</a>
            </div>

            <button type="submit" class="btn-auth-submit">
                <span>Sign In to Account</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>
        </form>

        

        <div class="auth-footer">
            Don't have an account yet? <a href="{{ route('user.create') }}">Create Account</a>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="#38bdf8">
            <path
                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
        </svg>
        <span id="toastMsg">Submitted!</span>
    </div>

    <script>

        function showToast(msg) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMsg').innerText = msg;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3000);
        }
    </script>
</body>

</html>