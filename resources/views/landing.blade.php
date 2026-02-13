<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome | Tanzania Houston Community</title>
<link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
body{
    margin:0;
    padding:0;
    font-family:'Inter',sans-serif;
    background:linear-gradient(rgba(10,61,98,0.6), rgba(15,79,119,0.6)), 
               url('{{ asset('img/background.jpg') }}') center/cover no-repeat;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
}

.landing-container{
    text-align:center;
    max-width:700px;
    padding:2rem;
}

.landing-logo img{
    width:120px;
    height:auto;
    margin-bottom:1.5rem;
    border-radius:12px;
    box-shadow:0 8px 25px rgba(0,0,0,0.25);
}

.landing-container h1{
    font-size:3rem;
    font-weight:700;
    margin-bottom:1rem;
    line-height:1.2;
}

.landing-container p{
    font-size:1.2rem;
    margin-bottom:2rem;
    color:#cbe4f3;
}

.join-btn{
    padding:1rem 2.5rem;
    font-size:1.1rem;
    font-weight:600;
    color:white;
    background:#0a3d62;
    border:none;
    border-radius:50px;
    cursor:pointer;
    transition:0.3s;
    text-decoration:none;
    display:inline-block;
    box-shadow:0 8px 25px rgba(0,0,0,0.25);
}

.join-btn:hover{
    background:#0f4f77;
    transform:translateY(-3px);
}

@media(max-width:600px){
    .landing-container h1{
        font-size:2rem;
    }
    .landing-container p{
        font-size:1rem;
    }
    .join-btn{
        width:100%;
        font-size:1rem;
    }
}
</style>
</head>
<body>
    <div class="landing-container">
        <!-- Logo -->
        <div class="landing-logo">
            <img src="{{ asset('img/logo.png') }}" alt="THC Logo">
        </div>

        <h1>Welcome to Tanzania Houston Community</h1>
        <p>Connecting Tanzanian heritage with the community, celebrating culture, unity, and education.</p>
        <a href="{{ route('welcome') }}" class="join-btn">Join Membership</a>
    </div>
</body>
</html>
