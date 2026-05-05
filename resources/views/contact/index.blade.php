@extends('layouts.app')

@section('title', 'Contact Us - LUXIVO')

@section('content')

<style>
.contact-page {
    background: #000000;
    min-height: 100vh;
    padding: 60px 0;
}

.contact-page .page-header {
    text-align: center;
    margin-bottom: 60px;
}

.contact-page .page-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 900;
    background: linear-gradient(135deg, #ffffff, #D4AF37);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 12px;
}

.contact-page .page-header p {
    color: rgba(255,255,255,0.45);
    font-size: 0.9rem;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.gold-divider {
    width: 80px;
    height: 2px;
    background: linear-gradient(90deg, transparent, #D4AF37, transparent);
    margin: 20px auto 0;
}

/* ── Form Card ── */
.contact-form-card {
    background: #111111;
    border: 1px solid rgba(212,175,55,0.2);
    border-radius: 4px;
    overflow: hidden;
}

.contact-form-card .card-header {
    background: linear-gradient(135deg, #D4AF37, #c9a96e);
    padding: 18px 24px;
}

.contact-form-card .card-header h5 {
    color: #000000;
    font-weight: 700;
    font-size: 0.95rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin: 0;
}

.contact-form-card .card-body {
    background: #111111 !important;
    padding: 32px;
}

.contact-form-card .form-label {
    color: rgba(255,255,255,0.6);
    font-size: 0.8rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 8px;
}

.contact-form-card .form-control {
    background: #1a1a1a !important;
    border: 1px solid rgba(212,175,55,0.2) !important;
    border-radius: 2px !important;
    color: #ffffff !important;
    padding: 12px 16px !important;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.contact-form-card .form-control:focus {
    border-color: #D4AF37 !important;
    box-shadow: 0 0 0 1px rgba(212,175,55,0.3) !important;
    background: #1a1a1a !important;
    color: #ffffff !important;
}

.contact-form-card .form-control::placeholder {
    color: rgba(255,255,255,0.25) !important;
}

.text-danger { color: #ff6b7a !important; font-size: 0.8rem; }

.btn-send {
    background: #D4AF37;
    border: 2px solid #D4AF37;
    border-radius: 50px;
    color: #000000;
    font-size: 0.82rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    width: 100%;
    padding: 14px;
    transition: all 0.3s ease;
    cursor: pointer;
    margin-top: 8px;
}

.btn-send:hover {
    background: transparent;
    color: #D4AF37;
}

/* ── Info Cards ── */
.info-card {
    background: #111111;
    border: 1px solid rgba(212,175,55,0.2);
    border-radius: 4px;
    padding: 28px 24px;
    text-align: center;
    transition: all 0.3s ease;
    height: 100%;
}

.info-card:hover {
    border-color: rgba(212,175,55,0.5);
    box-shadow: 0 10px 30px rgba(0,0,0,0.5), 0 0 20px rgba(212,175,55,0.08);
    transform: translateY(-4px);
}

.info-card .icon-wrap {
    width: 64px;
    height: 64px;
    background: rgba(212,175,55,0.1);
    border: 1px solid rgba(212,175,55,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 18px;
}

.info-card .icon-wrap i {
    color: #D4AF37;
    font-size: 1.4rem;
}

.info-card h5 {
    color: #ffffff;
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 8px;
}

.info-card p {
    color: rgba(255,255,255,0.4);
    font-size: 0.82rem;
    letter-spacing: 0.5px;
    margin-bottom: 16px;
}

.btn-info-link {
    display: inline-block;
    background: transparent;
    border: 1px solid rgba(212,175,55,0.3);
    border-radius: 50px;
    color: #D4AF37;
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 8px 20px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-info-link:hover {
    background: #D4AF37;
    color: #000;
    border-color: #D4AF37;
}

.info-card address {
    color: rgba(255,255,255,0.5);
    font-size: 0.85rem;
    line-height: 1.8;
    font-style: normal;
    margin-bottom: 16px;
}

/* ── Map placeholder ── */
.map-placeholder {
    background: #111111;
    border: 1px solid rgba(212,175,55,0.2);
    border-radius: 4px;
    height: 220px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    margin-top: 20px;
    color: rgba(255,255,255,0.2);
}

.map-placeholder i {
    color: rgba(212,175,55,0.2);
    font-size: 2.5rem;
    margin-bottom: 12px;
}

.map-placeholder p {
    font-size: 0.8rem;
    letter-spacing: 1px;
    color: rgba(255,255,255,0.2);
    margin: 0;
}

/* Alert */
.alert-success {
    background: rgba(74,222,128,0.08) !important;
    border: 1px solid rgba(74,222,128,0.3) !important;
    color: #4ade80 !important;
    border-radius: 4px !important;
}
</style>

<div class="contact-page">
    <div class="container">

        <!-- Header -->
        <div class="page-header">
            <h1><i class="fas fa-envelope me-3" style="font-size:0.8em; color:#D4AF37; -webkit-text-fill-color:#D4AF37;"></i>Contact Us</h1>
            <p>Get in touch with our luxury team</p>
            <div class="gold-divider"></div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-5">

            <!-- ── Contact Form ── -->
            <div class="col-lg-8">
                <div class="contact-form-card">
                    <div class="card-header">
                        <h5><i class="fas fa-paper-plane me-2"></i>Send us a Message</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name') }}" required>
                                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="{{ old('email') }}" required>
                                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-12">
                                    <label for="subject" class="form-label">Subject *</label>
                                    <input type="text" class="form-control" id="subject" name="subject"
                                           value="{{ old('subject') }}" required>
                                    @error('subject') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message *</label>
                                    <textarea class="form-control" id="message" name="message" rows="6"
                                              placeholder="Tell us how we can help you..." required>{{ old('message') }}</textarea>
                                    @error('message') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn-send" id="submitBtn">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ── Contact Info ── -->
            <div class="col-lg-4">
                <div class="row g-4">

                    <!-- Phone -->
                    <div class="col-12">
                        <div class="info-card">
                            <div class="icon-wrap"><i class="fas fa-phone-alt"></i></div>
                            <h5>Phone</h5>
                            <p>Call us for immediate assistance</p>
                            <a href="tel:+1234567890" class="btn-info-link">
                                <i class="fas fa-phone me-2"></i>+1 (234) 567-8900
                            </a>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-12">
                        <div class="info-card">
                            <div class="icon-wrap"><i class="fas fa-envelope"></i></div>
                            <h5>Email</h5>
                            <p>Send us an email anytime</p>
                            <a href="mailto:info@luxivo.com" class="btn-info-link">
                                <i class="fas fa-envelope me-2"></i>info@luxivo.com
                            </a>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-12">
                        <div class="info-card">
                            <div class="icon-wrap"><i class="fas fa-map-marker-alt"></i></div>
                            <h5>Address</h5>
                            <p>Visit our showroom</p>
                            <address>
                                123 Luxury Avenue<br>
                                Fashion District<br>
                                Karachi, Pakistan
                            </address>
                            <a href="#" class="btn-info-link">
                                <i class="fas fa-directions me-2"></i>Get Directions
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Map Placeholder -->
                <div class="map-placeholder">
                    <i class="fas fa-map-marked-alt"></i>
                    <p>Map Coming Soon</p>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
        btn.disabled = true;
    });

    const textarea = document.getElementById('message');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });
});
</script>

@endsection