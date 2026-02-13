<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Application</title>
<link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
<style>
/* Reset and base */
* {margin:0; padding:0; box-sizing:border-box;}
body {font-family:Arial, sans-serif; background:#f4f6f9; display:flex; min-height:100vh;}

/* Sidebar */
.sidebar {
    width:250px;
    background:#0a3d62;
    color:white;
    display:flex;
    flex-direction:column;
    flex-shrink:0;
    height:100vh;
}
.sidebar .logo {
    text-align:center;
    padding:20px;
    border-bottom:1px solid rgba(255,255,255,0.2);
}
.sidebar .logo img {width:120px;}
.sidebar nav a {
    padding:15px 20px;
    display:block;
    color:white;
    text-decoration:none;
    transition:0.2s;
}
.sidebar nav a:hover {background:#1e5aa8;}
.sidebar .profile {
    margin-top:auto;
    padding:15px 20px;
    font-size:0.9rem;
    border-top:1px solid rgba(255,255,255,0.2);
}

/* Main content */
.main {
    flex:1;
    padding:30px;
    overflow-x:auto;
}

/* Back button */
.back-btn {
    display:inline-block;
    margin-bottom:20px;
    padding:8px 15px;
    background:#0a3d62;
    color:white;
    text-decoration:none;
    border-radius:6px;
    transition:0.2s;
}
.back-btn:hover {background:#1e5aa8;}

/* Card container */
.card {
    background:white;
    border-radius:12px;
    padding:30px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    max-width:900px;
    margin:auto;
}
.card h2 {
    color:#0a3d62;
    margin-bottom:20px;
    font-size:1.75rem;
}

/* Form grid layout */
.form-grid {
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px 30px;
}
.form-grid-full {grid-column:span 2;}
.form-group {margin-bottom:15px;}
.form-group label {display:block; font-weight:bold; margin-bottom:5px; color:#1a2634;}
.form-group input,
.form-group select,
.form-group textarea {
    width:100%;
    padding:12px 15px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:14px;
    transition:all 0.2s;
}
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {outline:none; border-color:#2563eb; box-shadow:0 0 0 2px rgba(37,99,235,0.1);}
textarea {resize:none;}

/* Submit */
button.submit-btn {
    background:#0a3d62;
    color:white;
    padding:12px 25px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
    margin-top:15px;
}
button.submit-btn:hover {background:#1e5aa8;}

/* Responsive */
@media(max-width:768px){
    .form-grid {grid-template-columns:1fr;}
    .form-grid-full {grid-column:span 1;}
}
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="THC Logo">
    </div>
    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.applications.index') }}">Applications</a>
        <a href="#">Settings</a>
    </nav>
    <div class="profile">
        Logged in as: <strong>{{ auth()->user()?->name }}</strong>
    </div>
</div>

<!-- Main Content -->
<div class="main">

    <!-- Back button -->
    <a href="{{ route('admin.applications.index') }}" class="back-btn">← Back to Applications</a>

    <!-- Card / Form -->
    <div class="card">
        <h2>Edit Application</h2>

        <form method="POST" action="{{ route('admin.applications.update', $application) }}">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $application->full_name) }}" required>
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $application->phone) }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $application->email) }}" required>
                </div>

                <div class="form-group">
                    <label>Fee Paid</label>
                    <select name="fee_paid" required>
                        <option value="yes" {{ $application->fee_paid=='yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ $application->fee_paid=='no' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="pending" {{ $application->status=='pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $application->status=='approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $application->status=='rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <div class="form-group form-grid-full">
                    <label>Rejection Reason</label>
                    <textarea name="rejection_reason" rows="3">{{ old('rejection_reason', $application->rejection_reason) }}</textarea>
                </div>
            </div>

            <button type="submit" class="submit-btn">Update Application</button>
        </form>
    </div>

</div>
</body>
</html>
