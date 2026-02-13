<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THC Admin | Login</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;}
        body{
            font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif;
            background:#f5f7fa;
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:1.5rem;
        }
        .login-container{width:100%;max-width:400px;}
        .logo-wrapper{text-align:center;margin-bottom:2rem;}
        .logo{
            display:inline-block;
            background:white;
            padding:.75rem 1.5rem;
            border-radius:8px;
            box-shadow:0 2px 8px rgba(0,0,0,.05);
        }
        .logo img{height:50px;width:auto;display:block;}
        .login-card{
            background:white;
            border-radius:16px;
            padding:2rem;
            box-shadow:0 4px 20px rgba(0,0,0,0.02);
            border:1px solid #e9edf2;
        }
        .login-header{margin-bottom:1.75rem;}
        .login-header h1{
            font-size:1.5rem;
            font-weight:600;
            color:#1a2634;
            margin-bottom:.25rem;
        }
        .login-header p{
            font-size:.875rem;
            color:#5e6f7d;
        }
        .form-group{margin-bottom:1.25rem;}
        .form-label{
            display:block;
            font-size:.75rem;
            font-weight:600;
            text-transform:uppercase;
            letter-spacing:.03em;
            color:#3a4a58;
            margin-bottom:.5rem;
        }
        .form-input{
            width:100%;
            padding:.75rem 1rem;
            border:1.5px solid #e2e8f0;
            border-radius:10px;
            font-size:.9375rem;
            transition:all 0.2s;
            color:#1a2634;
        }
        .form-input:focus{
            border-color:#2563eb;
            box-shadow:0 0 0 3px rgba(37,99,235,0.1);
            outline:none;
        }
        .form-input::placeholder{color:#9aa6b2;}
        .form-input.error{border-color:#dc2626;}
        .error-message{
            color:#dc2626;
            font-size:.75rem;
            margin-top:.375rem;
            font-weight:500;
        }
        .form-options{
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-bottom:1.5rem;
        }
        .remember-checkbox{
            display:flex;
            align-items:center;
            gap:.5rem;
        }
        .remember-checkbox input[type="checkbox"]{
            width:16px;
            height:16px;
            border:1.5px solid #d1d9e0;
            border-radius:4px;
            cursor:pointer;
            accent-color:#2563eb;
        }
        .remember-checkbox label{
            font-size:.8125rem;
            color:#3a4a58;
            cursor:pointer;
        }
        .forgot-link{
            font-size:.8125rem;
            color:#2563eb;
            text-decoration:none;
            font-weight:500;
        }
        .forgot-link:hover{text-decoration:underline;}
        .btn{
            width:100%;
            padding:.75rem 1rem;
            background:#2563eb;
            color:white;
            border:none;
            border-radius:10px;
            font-size:.9375rem;
            font-weight:600;
            cursor:pointer;
            transition:background 0.2s;
        }
        .btn:hover{background:#1e40af;}
        .btn:focus{
            outline:none;
            box-shadow:0 0 0 3px rgba(37,99,235,0.2);
        }
        .security-text{
            margin-top:1.5rem;
            padding-top:1.25rem;
            border-top:1px solid #edf0f3;
            font-size:.75rem;
            color:#6b7a87;
            text-align:center;
        }
        @media(max-width:480px){
            .login-card{padding:1.5rem;}
            .form-options{
                flex-direction:column;
                gap:1rem;
                align-items:flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Logo Section -->
        <div class="logo-wrapper">
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="THC Logo">
            </div>
        </div>

        <!-- Login Card -->
        <div class="login-card">
            <div class="login-header">
                <h1>Admin Sign In</h1>
                <p>Enter your admin credentials to access the dashboard</p>
            </div>

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <!-- Email Field -->
                <div class="form-group">
                    <label class="form-label" for="email">Email address</label>
                    <input 
                        type="email" 
                        id="email"
                        name="email" 
                        class="form-input @error('email') error @enderror" 
                        placeholder="admin@thc.com" 
                        value="{{ old('email') }}"
                        required 
                        autofocus
                        autocomplete="email"
                    >
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input 
                        type="password" 
                        id="password"
                        name="password" 
                        class="form-input @error('password') error @enderror" 
                        placeholder="Enter your password" 
                        required
                        autocomplete="current-password"
                    >
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Options Row -->
                <div class="form-options">
                    <div class="remember-checkbox">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn">Sign in</button>

                <!-- Error Summary -->
                @if($errors->any() && !$errors->has('email') && !$errors->has('password'))
                    <div style="margin-top:1rem; padding:0.75rem; background:#fef2f2; border-radius:8px; border-left:3px solid #dc2626;">
                        <p style="color:#dc2626; font-size:0.75rem; font-weight:500;">
                            {{ $errors->first() }}
                        </p>
                    </div>
                @endif
            </form>

            <!-- Security Notice -->
            <div class="security-text">
                Secured by enterprise-grade authentication
            </div>
        </div>
    </div>
</body>
</html>
