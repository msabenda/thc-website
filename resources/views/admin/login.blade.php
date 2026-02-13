<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>THC Admin | Login</title>
<link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
/* Reset & body */
* {margin:0; padding:0; box-sizing:border-box;}
body {
    font-family:'Inter',sans-serif;
    background: linear-gradient(135deg, #0a3d62 0%, #0f4f77 100%), url('{{ asset('img/background.jpg') }}') center/cover fixed;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:2rem;
    color:#1e1e2a;
}

/* Container & card */
.login-container { width:100%; max-width:420px; }
.login-card {
    background: rgba(255,255,255,0.97);
    border-radius:28px;
    padding:2.5rem;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    border:1px solid #e9edf2;
}

/* Logo */
.logo-wrapper { text-align:center; margin-bottom:2rem; }
.logo {
    display:inline-block;
    background:white;
    padding:1rem 1.5rem;
    border-radius:16px;
    box-shadow:0 8px 25px rgba(0,0,0,0.15);
}
.logo img { height:80px; width:auto; display:block; }

/* Header */
.login-header { margin-bottom:2rem; text-align:center; }
.login-header h1 {
    font-size:1.8rem;
    font-weight:700;
    color:#0a3d62;
    margin-bottom:.3rem;
}
.login-header p { font-size:.95rem; color:#5f7d95; }

/* Form */
.form-group { margin-bottom:1.5rem; }
.form-label {
    display:block;
    font-size:.8rem;
    font-weight:600;
    text-transform:uppercase;
    letter-spacing:.05em;
    color:#1e3b4c;
    margin-bottom:.5rem;
}
.form-input {
    width:100%;
    padding:1rem 1.2rem;
    border:1.5px solid #e6eef4;
    border-radius:16px;
    font-size:.95rem;
    transition:0.25s ease;
}
.form-input:focus {
    border-color:#0a3d62;
    box-shadow:0 0 0 5px rgba(10,61,98,0.08);
    outline:none;
}
.form-input.error { border-color:#dc2626; }
.form-input::placeholder { color:#9aa6b2; }

.error-message {
    color:#dc2626;
    font-size:.8rem;
    margin-top:.3rem;
    font-weight:500;
}

/* Options row */
.form-options {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:1.75rem;
}
.remember-checkbox {
    display:flex; align-items:center; gap:.5rem;
}
.remember-checkbox input[type="checkbox"] {
    width:16px; height:16px;
    border:1.5px solid #d1d9e0;
    border-radius:4px;
    cursor:pointer;
    accent-color:#0a3d62;
}
.remember-checkbox label { font-size:.85rem; color:#3a4a58; cursor:pointer; }
.forgot-link {
    font-size:.85rem;
    color:#0a3d62;
    font-weight:600;
    text-decoration:none;
}
.forgot-link:hover { text-decoration:underline; }

/* Submit button */
.btn {
    width:100%;
    padding:1rem;
    background:#0a3d62;
    color:white;
    border:none;
    border-radius:40px;
    font-size:1rem;
    font-weight:600;
    cursor:pointer;
    transition: all 0.25s ease;
    box-shadow:0 8px 25px rgba(10,61,98,0.2);
}
.btn:hover { background:#0f4f77; transform:translateY(-2px); }
.btn:focus { outline:none; box-shadow:0 0 0 5px rgba(10,61,98,0.15); }

/* Error summary for other backend errors */
.error-summary {
    margin-top:1rem;
    padding:0.75rem;
    background:#fef2f2;
    border-radius:12px;
    border-left:3px solid #dc2626;
    font-size:.85rem;
    color:#dc2626;
    font-weight:500;
}

/* Security notice */
.security-text {
    margin-top:2rem;
    padding-top:1.25rem;
    border-top:1px solid #edf3f7;
    font-size:.75rem;
    color:#6b7a87;
    text-align:center;
}

/* Responsive */
@media(max-width:480px){
    .login-card { padding:2rem; }
    .form-options { flex-direction:column; gap:1rem; align-items:flex-start; }
}
</style>
</head>
<body>

<div class="login-container">
    <!-- Logo -->
    <div class="logo-wrapper">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="THC Logo">
        </div>
    </div>

    <!-- Login Card -->
    <div class="login-card">
        <div class="login-header">
            <h1>Admin Sign In</h1>
        </div>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label class="form-label" for="email">Email address</label>
                <input type="email" id="email" name="email" class="form-input @error('email') error @enderror" placeholder="example@gmail.com" value="{{ old('email') }}" required autofocus autocomplete="email">
                @error('email') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" class="form-input @error('password') error @enderror" placeholder="Enter your password" required autocomplete="current-password">
                @error('password') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <!-- Options -->
            <div class="form-options">
                <div class="remember-checkbox">
                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Remember me</label>
                </div>
                <a href="#" class="forgot-link">Forgot password?</a>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn">Sign in</button>

            <!-- Other backend errors -->
            @if($errors->any() && !$errors->has('email') && !$errors->has('password'))
                <div class="error-summary">{{ $errors->first() }}</div>
            @endif
        </form>

        <div class="security-text">
            Secured by enterprise-grade authentication
        </div>
    </div>
</div>

</body>
</html>
