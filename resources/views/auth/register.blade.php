<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - LUXIVO</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #000000;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: radial-gradient(ellipse at 20% 50%, rgba(212, 175, 55, 0.05) 0%, transparent 60%),
                        radial-gradient(ellipse at 80% 20%, rgba(212, 175, 55, 0.03) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .auth-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .auth-card {
            background: #111111;
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 4px;
            box-shadow: 0 0 60px rgba(0, 0, 0, 0.8), 0 0 30px rgba(212, 175, 55, 0.05);
            animation: fadeInUp 0.8s ease-out;
            max-width: 500px;
            width: 100%;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Logo Section ── */
        .logo-section {
            text-align: center;
            padding: 40px 40px 30px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.15);
        }

        .logo-section .logo {
            font-size: 2.2rem;
            font-weight: 700;
            color: #D4AF37;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        .logo-section .logo i {
            margin-right: 12px;
            font-size: 1.8rem;
        }

        .gold-divider {
            width: 40px;
            height: 1px;
            background: #D4AF37;
            margin: 0 auto 12px;
        }

        .logo-section .subtitle {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
            font-weight: 400;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* ── Form Section ── */
        .form-section {
            padding: 35px 40px 40px;
        }

        .form-floating {
            margin-bottom: 20px;
        }

        .form-floating .form-control {
            background: #1a1a1a;
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 2px;
            color: #ffffff;
            padding: 14px 16px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            height: 58px;
        }

        .form-floating .form-control:focus {
            background: #1a1a1a;
            border-color: #D4AF37;
            box-shadow: 0 0 0 1px rgba(212, 175, 55, 0.3);
            color: #ffffff;
        }

        .form-floating .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .form-floating label {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.85rem;
            letter-spacing: 1px;
        }

        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: #D4AF37;
            opacity: 1;
        }

        /* ── Checkbox ── */
        .form-check {
            margin-bottom: 28px;
        }

        .form-check-input {
            background-color: #1a1a1a;
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 2px;
        }

        .form-check-input:checked {
            background-color: #D4AF37;
            border-color: #D4AF37;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
        }

        .form-check-label {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .form-check-label a {
            color: #D4AF37;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .form-check-label a:hover {
            color: #c9a96e;
            text-decoration: underline;
        }

        /* ── Register Button ── */
        .btn-register {
            background: #D4AF37;
            border: 2px solid #D4AF37;
            border-radius: 50px;
            padding: 14px 24px;
            font-weight: 600;
            font-size: 0.85rem;
            color: #000000;
            width: 100%;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
        }

        .btn-register:hover {
            background: transparent;
            color: #D4AF37;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.25);
        }

        /* ── Auth Links ── */
        .auth-links {
            text-align: center;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid rgba(212, 175, 55, 0.1);
        }

        .auth-links a {
            color: #D4AF37;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .auth-links a:hover {
            color: #c9a96e;
            text-decoration: underline;
        }

        .text-muted-gold {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.85rem;
        }

        /* ── Alert ── */
        .alert {
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: #ff6b7a;
            border-radius: 2px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .invalid-feedback {
            color: #ff6b7a;
            font-size: 0.82rem;
            margin-top: 5px;
        }

        @media (max-width: 576px) {
            .auth-card { max-width: none; }
            .form-section { padding: 25px 25px 30px; }
            .logo-section { padding: 30px 25px 25px; }
        }
    </style>
</head>
<body>

    <div class="auth-wrapper">
        <div class="auth-card">

            <!-- Logo Section -->
            <div class="logo-section">
                <div class="logo">
                    <i class="fas fa-crown"></i>
                    LUXIVO
                </div>
                <div class="gold-divider mt-3"></div>
                <div class="subtitle">Create Account</div>
            </div>

            <!-- Form Section -->
            <div class="form-section">

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Full Name -->
                    <div class="form-floating">
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name"
                               placeholder="Full Name"
                               value="{{ old('name') }}" required>
                        <label for="name">
                            <i class="fas fa-user me-2"></i>Full Name
                        </label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-floating">
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email"
                               placeholder="Email Address"
                               value="{{ old('email') }}" required>
                        <label for="email">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="form-floating">
                        <input type="tel"
                               class="form-control @error('phone') is-invalid @enderror"
                               id="phone" name="phone"
                               placeholder="Phone Number"
                               value="{{ old('phone') }}" required>
                        <label for="phone">
                            <i class="fas fa-phone me-2"></i>Phone Number
                        </label>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-floating">
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password"
                               placeholder="Password" required>
                        <label for="password">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-floating">
                        <input type="password"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               id="password_confirmation" name="password_confirmation"
                               placeholder="Confirm Password" required>
                        <label for="password_confirmation">
                            <i class="fas fa-lock me-2"></i>Confirm Password
                        </label>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Terms -->
                    <div class="form-check">
                        <input class="form-check-input @error('terms') is-invalid @enderror"
                               type="checkbox" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms">
                            I agree to the <a href="#">Terms & Conditions</a>
                        </label>
                        @error('terms')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="btn-register">
                        <i class="fas fa-user-plus me-2"></i>Create Account
                    </button>
                </form>

                <!-- Links -->
                <div class="auth-links">
                    <div>
                        <span class="text-muted-gold">Already have an account?</span>
                        <a href="{{ route('login') }}" class="ms-1">Login</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>