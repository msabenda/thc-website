<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THC | Member Registration</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
<style>
*{margin:0;padding:0;box-sizing:border-box;}

body{
    font-family:'Inter',sans-serif;
    background:linear-gradient(135deg, rgba(10,61,98,0.92), rgba(10,61,98,0.96)), 
               url('{{ asset('img/background.jpg') }}') center/cover fixed;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:2rem 1.5rem;
    color:#1e1e2a;
}

/* CARD */
.register-card{
    max-width:1080px;
    width:100%;
    background:white;
    border-radius:28px;
    box-shadow:0 50px 90px -20px rgba(0,0,0,0.4);
    display:grid;
    grid-template-columns:1.05fr 1.2fr;
    overflow:hidden;
    animation:fadeIn .6s ease;
}

@keyframes fadeIn{
    from{opacity:0;transform:translateY(20px);}
    to{opacity:1;transform:translateY(0);}
}

/* LEFT PANEL */
.brand-panel{
    background:linear-gradient(160deg,#0a3d62,#0f4f77);
    padding:3rem 2.5rem;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
}

.logo-container{
    display:flex;
    align-items:center;
    gap:1rem;
    margin-bottom:2rem;
}

.community-logo{
    width:72px;
    height:72px;
    border-radius:18px;
    background:white;
    padding:10px;
    box-shadow:0 10px 25px rgba(0,0,0,0.25);
}

.logo-text{
    color:white;
    font-weight:700;
    font-size:1.25rem;
}

/* Mission */
.mission-preview h3{
    font-size:.75rem;
    text-transform:uppercase;
    letter-spacing:2px;
    color:#cbe4f3;
    margin-bottom:.75rem;
}

.mission-statement{
    background:rgba(255,255,255,0.08);
    padding:1.4rem;
    border-radius:18px;
    line-height:1.7;
    font-size:.95rem;
    color:white;
    backdrop-filter:blur(8px);
}

/* Values */
.values-list{
    display:flex;
    flex-wrap:wrap;
    gap:.6rem;
    margin-top:.75rem;
}

.value-tag{
    background:rgba(255,255,255,0.12);
    border:1px solid rgba(255,255,255,0.25);
    padding:.5rem 1.1rem;
    border-radius:40px;
    color:white;
    font-size:.8rem;
    transition:.25s ease;
}

.value-tag:hover{
    background:white;
    color:#0a3d62;
    transform:translateY(-2px);
}

/* Fee Badge */
.fee-badge{
    margin-top:2rem;
    background:white;
    color:#0a3d62;
    padding:.9rem 1.5rem;
    border-radius:50px;
    font-weight:600;
    display:inline-flex;
    align-items:center;
    gap:.4rem;
    box-shadow:0 15px 35px rgba(0,0,0,0.25);
}

.fee-badge strong{font-size:1.3rem;}

/* RIGHT PANEL */
.form-panel{padding:3rem 2.5rem;}

.form-header h3{
    font-size:1.9rem;
    font-weight:700;
    color:#0a3d62;
}

.form-header p{
    color:#5f7d95;
    margin-top:.5rem;
}

/* Inputs */
.form-grid{
    display:flex;
    flex-direction:column;
    gap:1.5rem;
    margin-top:2rem;
}

.input-group label{
    font-size:.75rem;
    font-weight:600;
    text-transform:uppercase;
    letter-spacing:.05em;
    color:#1e3b4c;
    margin-bottom:.4rem;
    display:block;
}

.input-field, #phone{
    width:100%;
    padding:1rem 1.2rem;
    border:1.5px solid #e6eef4;
    border-radius:14px;
    font-size:.95rem;
    transition:.2s ease;
}

.input-field:focus, #phone:focus{
    border-color:#0a3d62;
    box-shadow:0 0 0 4px rgba(10,61,98,.08);
    outline:none;
}

/* Radio */
.radio-group{
    display:flex;
    gap:1.5rem;
    background:#f7fbff;
    padding:1rem;
    border-radius:16px;
    border:1px solid #e3eef5;
}

/* Upload Area */
.file-upload{
    border:2px dashed #c8dbe6;
    border-radius:20px;
    padding:1.8rem;
    background:#f9fcff;
    transition:.25s ease;
    cursor:pointer;
    text-align:center;
}

.file-upload:hover{
    border-color:#0a3d62;
    background:#eef6fb;
    transform:translateY(-2px);
}

.file-upload.dragover{
    border-color:#0a3d62;
    background:#e3f2fb;
    box-shadow:0 0 0 4px rgba(10,61,98,.08);
}

.file-upload.selected{
    border-color:#28a745;
    background:#f0fff4;
}

.upload-content{
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:.5rem;
}

.upload-icon{
    font-size:2rem;
    background:#e3eef5;
    padding:.9rem;
    border-radius:14px;
    transition:.2s ease;
}

.file-upload:hover .upload-icon{
    background:#0a3d62;
    color:white;
}

.file-upload.selected .upload-icon{
    background:#28a745;
    color:white;
}

.upload-text strong{
    font-size:.95rem;
    color:#0a3d62;
}

.upload-text span{
    font-size:.8rem;
    color:#6b8a9c;
}

.attached-info{
    margin-top:.6rem;
    font-size:.85rem;
    font-weight:600;
    color:#0a3d62;
}

/* Terms */
.terms-checkbox{
    display:flex;
    gap:.75rem;
    background:#f7fbff;
    padding:1rem;
    border-radius:16px;
    border:1px solid #e3eef5;
    font-size:.85rem;
}

/* Button */
.btn-register{
    background:#0a3d62;
    color:white;
    border:none;
    padding:1.1rem;
    border-radius:40px;
    font-weight:600;
    font-size:1rem;
    transition:.3s ease;
    cursor:pointer;
    box-shadow:0 10px 25px rgba(10,61,98,.25);
}

.btn-register:hover{
    background:#0f4f77;
    transform:translateY(-2px);
}

.btn-register.loading{
    opacity:.7;
    pointer-events:none;
}

/* Success */
.success-card{
    background:#f0fff4;
    border:1px solid #28a745;
    padding:2rem;
    border-radius:18px;
}

.error-message{
    color:#dc3545;
    font-size:.8rem;
    margin-top:.3rem;
}

.file-hint{
    font-size:.75rem;
    color:#8aa2b2;
    margin-top:.3rem;
}

@media(max-width:820px){
    .register-card{
        grid-template-columns:1fr;
        max-width:600px;
    }
}
</style>

</head>
<body>
    <div class="register-card">
        <div class="brand-panel">
            <div class="logo-container">
                <img src="{{ asset('img/logo.png') }}" alt="THC" class="community-logo">
                <div class="logo-text">Tanzania Houston<br>Community</div>
            </div>
            <div class="mission-preview">
                <h3>Our mission</h3>
                <div class="mission-statement">
                    <p>To promote and teach Swahili culture, creating a bridge that connects Tanzanian heritage with our community especially American-Tanzanian children nurturing their cultural roots.</p>
                </div>
                <div>
                    <h3 style="margin-bottom:0.5rem;">Values</h3>
                    <div class="values-list">
                        <span class="value-tag">Cultural Celebration</span>
                        <span class="value-tag">Inclusivity</span>
                        <span class="value-tag">Community Unity</span>
                        <span class="value-tag">Cultural Preservation</span>
                        <span class="value-tag">Education & Empowerment</span>
                    </div>
                </div>
                <div class="fee-badge">Registration fee • <strong>$25 USD</strong></div>
            </div>
            <div class="footer-credit">Non-profit · Houston, Texas</div>
        </div>

        <div class="form-panel">
            <div class="form-header">
                <h3>Become Actice member</h3>
                <p>Join us in preserving Tanzanian heritage</p>
            </div>

            @if(session('success'))
                <div class="success-card">
                    <h3>🎉 Thank you!</h3>
                    <p>{{ session('success') }}</p>
                    <p style="font-size:0.85rem; margin-top:1rem; opacity:0.9;">
                        We'll review your application within 48 hours.<br>
                        Check your email (including spam folder).
                    </p>
                </div>
            @else
                <form method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data" class="form-grid" id="join-form">
                    @csrf

                    <input type="text" name="website" style="display:none !important;" tabindex="-1" autocomplete="off">

                    <div class="input-group">
                        <label for="full_name">Full name</label>
                        <input type="text" name="full_name" id="full_name" class="input-field" placeholder="John Petro Doe" value="{{ old('full_name') }}" required autofocus>
                        @error('full_name') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="input-group">
                        <label for="phone">Phone number</label>
                        <div>
                            <input type="tel" id="phone" name="phone" placeholder="(201) 555-0123" value="{{ old('phone') }}" required>
                            <input type="hidden" name="phone_international" id="phone_international">
                        </div>
                        <div class="file-hint">US-based number only</div>
                        @error('phone_international') <div class="error-message">{{ $message }}</div> @enderror
                        @error('phone') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="input-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" id="email" class="input-field" placeholder="john@example.com" value="{{ old('email') }}" required>
                        @error('email') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="input-group">
                        <label>Registration fee ($25) already paid?</label>
                        <div class="radio-group">
                            <div class="radio-option">
                                <input type="radio" name="fee_paid" id="fee_yes" value="yes" required {{ old('fee_paid') == 'yes' ? 'checked' : '' }}>
                                <label for="fee_yes">Yes</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" name="fee_paid" id="fee_no" value="no" required {{ old('fee_paid') == 'no' ? 'checked' : '' }}>
                                <label for="fee_no">No, I will pay later</label>
                            </div>
                        </div>
                        @error('fee_paid') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="input-group">
                        <label for="receipt">Upload payment receipt</label>
                        <div class="file-upload" id="drop-area">
    <input 
        type="file" 
        name="receipt" 
        id="receipt" 
        accept="image/*,.pdf"
        style="position:absolute; opacity:0; pointer-events:none; width:0; height:0;"
    >

    <div class="upload-content">
        {{-- <div class="upload-icon">📎</div> --}}
        <div class="upload-text">
            <strong>Upload payment receipt</strong>
            <span id="receipt-label">Click to browse or drag & drop file</span>
        </div>
    </div>
</div>

                        <div class="file-hint">PNG, JPG or PDF. Max 5MB</div>
                        <div id="receipt-attached-info" class="attached-info" style="display:none;">
                            Attached: <span id="receipt-filename-display"></span>
                        </div>
                        @error('receipt') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="terms-checkbox">
                        <input type="checkbox" name="terms_accepted" id="terms" value="1" required {{ old('terms_accepted') ? 'checked' : '' }}>
                        <label for="terms">I agree with the <a href="#">Terms & Conditions</a> and the <a href="#">Privacy & Cookies Policy</a> of UENI and any applicable Terms and Conditions of Tanzania Houston Community.</label>
                        @error('terms_accepted') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn-register" id="submit-btn">
                        <span>Join the community</span><span>→</span>
                    </button>
                </form>
            @endif

            <div style="margin-top:1.5rem;text-align:center;font-size:0.7rem;color:#8aa2b2;border-top:1px solid #edf3f7;padding-top:1.25rem;">
                Tanzania Houston Community — cultural preservation • unity • empowerment
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
    <script>
const phoneInput = document.querySelector("#phone");
const phoneError = document.getElementById("phone-error");
const hiddenPhone = document.getElementById("phone_international");
const form = document.getElementById("join-form");
const submitBtn = document.getElementById("submit-btn");

let iti;

if (phoneInput) {
    iti = window.intlTelInput(phoneInput, {
        initialCountry: "us",
        separateDialCode: true,
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
        preferredCountries: ["us"],
        onlyCountries: ["us"],
        autoPlaceholder: "aggressive",
        nationalMode: false
    });

    const updateHidden = () => {
        if (iti.isValidNumber()) {
            hiddenPhone.value = iti.getNumber();
            if(phoneError) phoneError.style.display = 'none';
        } else {
            hiddenPhone.value = '';
        }
    };

    phoneInput.addEventListener('input', updateHidden);
    phoneInput.addEventListener('countrychange', updateHidden);

    form?.addEventListener('submit', function(e) {
        updateHidden();
        if (!iti.isValidNumber()) {
            e.preventDefault();
            if(phoneError) phoneError.style.display = 'block';
            phoneInput.focus();
            return false;
        }

        submitBtn.classList.add("loading");
        submitBtn.innerHTML = "Processing...";
    });
}

/* File Upload UI */
const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('receipt');
const receiptLabel = document.getElementById('receipt-label');
const attachedInfo = document.getElementById('receipt-attached-info');
const filenameDisplay = document.getElementById('receipt-filename-display');

if (dropArea && fileInput) {

    dropArea.addEventListener('click', () => fileInput.click());

    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.classList.add('dragover');
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('dragover');
    });

    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.classList.remove('dragover');
        fileInput.files = e.dataTransfer.files;
        fileInput.dispatchEvent(new Event('change'));
    });

    fileInput.addEventListener('change', function(e){
        const file = e.target.files[0];

        if(file){
            receiptLabel.textContent = file.name.length > 30 
                ? file.name.substring(0,27)+'...' 
                : file.name;

            filenameDisplay.textContent = file.name;
            attachedInfo.style.display = 'block';
            dropArea.classList.add('selected');
        } else {
            receiptLabel.textContent = "Click to browse or drag & drop file";
            attachedInfo.style.display = 'none';
            dropArea.classList.remove('selected');
        }
    });
}
</script>
</body>
</html>