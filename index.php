<?php
include('connectMySql.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="description" content="iSumbong - Cybersecurity Incident Reporting Platform">
    <meta name="author" content="PNP Anti-Cybercrime Group">

    <title>iSumbong - Incident Reporting System</title>
    <link rel="icon" type="image/x-icon" href="img/logo1.png"/>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .hero-section {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        /* Background Pattern */
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            opacity: 0.3;
            z-index: 1;
        }
        
        .hero-content {
            color: white;
            text-align: center;
            position: relative;
            z-index: 2;
        }
        
        .hero-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
        }
        
        .hero-logo img {
            margin-right: 1rem;
        }
        
        .hero-logo .brand-text {
            font-size: 2.5rem;
            font-weight: 800;
            color: #3498db;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .btn-custom {
            border-radius: 50px;
            padding: 15px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 10px;
        }
        
        .feature-card {
            border: 3px solid #1e3c72 !important;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .features-section {
            background: #f8f9fc;
        }
        
        .features-section h2 {
            color: #2c3e50;
        }
        
        .features-section .text-muted {
            color: #6c757d !important;
        }
        
        .about-section {
            background: #ffffff;
        }
        
        .about-section h2 {
            color: #2c3e50;
        }
        
        .about-section p {
            color: #495057;
        }
        
        .partnership-logos {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            margin: 2rem 0;
            flex-wrap: nowrap;
        }
        
        .logo-container {
            text-align: center;
            position: relative;
        }
        
        .logo-box {
            width: 160px;
            height: 160px;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 10px 35px rgba(44, 62, 80, 0.4);
            position: relative;
            overflow: hidden;
        }
        
        .logo-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 50%);
            z-index: 1;
        }
        
        .logo-box img {
            max-width: 90px;
            max-height: 90px;
            z-index: 2;
            position: relative;
        }
        
        .logo-label {
            font-size: 1rem;
            font-weight: 600;
            color: #2c3e50;
            line-height: 1.3;
        }
        
        /* Mobile-first responsive design - Proper sizing, not shrinking */
        @media (max-width: 575px) {
            .hero-section {
                padding: 2rem 0;
                min-height: 100vh;
            }
            
            .hero-logo .brand-text {
                font-size: 2.8rem !important;
                line-height: 1.2;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
            }
            
            .hero-logo img {
                width: 80px;
                height: 80px;
            }
            
            .display-3 {
                font-size: 3.2rem !important;
                line-height: 1.1;
                margin-bottom: 1.5rem !important;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.6);
            }
            
            .lead {
                font-size: 1.5rem !important;
                line-height: 1.4;
                margin-bottom: 2rem !important;
                text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
                font-weight: 500;
            }
            
            .btn-custom {
                padding: 18px 30px !important;
                font-size: 1.2rem !important;
                margin: 10px 0 !important;
                display: block;
                width: 100%;
                max-width: 350px;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 1.5rem !important;
                border-radius: 50px;
                font-weight: 700;
                min-height: 56px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            }
            
            .container-fluid {
                padding-left: 1.5rem !important;
                padding-right: 1.5rem !important;
            }
            
            .partnership-logos {
                flex-direction: row;
                gap: 1.2rem;
                justify-content: center;
                flex-wrap: wrap;
                margin-top: 2rem;
            }
            
            .logo-box {
                width: 120px;
                height: 120px;
            }
            
            .logo-box img {
                max-width: 75px;
                max-height: 75px;
            }
            
            .logo-label {
                font-size: 1rem !important;
                line-height: 1.3;
                font-weight: 600;
            }
            
            .step-number {
                width: 55px !important;
                height: 55px !important;
                font-size: 1.4rem !important;
            }
            
            .feature-card {
                margin-bottom: 2rem;
            }
            
            .card-body.p-4 {
                padding: 2rem !important;
            }
            
            .card-body.p-5 {
                padding: 2.5rem !important;
            }
            
            /* Enhanced typography for mobile readability */
            h2 {
                font-size: 2.5rem !important;
                line-height: 1.2;
                margin-bottom: 1.5rem !important;
            }
            
            h4 {
                font-size: 2rem !important;
                line-height: 1.3;
            }
            
            h5 {
                font-size: 1.6rem !important;
                line-height: 1.3;
            }
            
            .card-title {
                font-size: 1.7rem !important;
                margin-bottom: 1rem !important;
            }
            
            .card-text {
                font-size: 1.2rem !important;
                line-height: 1.6;
            }
            
            p {
                font-size: 1.2rem !important;
                line-height: 1.6;
            }
            
            .text-muted {
                font-size: 1.1rem !important;
            }
            
            /* Form improvements for mobile */
            .form-label {
                font-size: 1.2rem !important;
                font-weight: 600 !important;
                margin-bottom: 0.75rem !important;
            }
            
            .form-control {
                font-size: 1.2rem !important;
                padding: 1rem 1.2rem !important;
                border-radius: 10px !important;
                min-height: 50px;
            }
            
            .btn {
                font-size: 1.2rem !important;
                padding: 1rem 1.5rem !important;
                min-height: 50px;
                border-radius: 10px !important;
            }
            
            /* Alert improvements */
            .alert {
                font-size: 1.2rem !important;
                padding: 1.5rem !important;
                border-radius: 12px !important;
            }
                padding: 2rem !important;
            }
        }
        
        @media (min-width: 576px) and (max-width: 767px) {
            .hero-logo .brand-text {
                font-size: 2.2rem;
            }
            
            .display-3 {
                font-size: 2.5rem !important;
            }
            
            .btn-custom {
                padding: 14px 25px;
                margin: 8px;
            }
            
            .partnership-logos {
                flex-direction: row;
                gap: 1rem;
                justify-content: center;
                flex-wrap: nowrap;
            }
            
            .logo-box {
                width: 110px;
                height: 110px;
            }
            
            .logo-box img {
                max-width: 65px;
                max-height: 65px;
            }
            
            .logo-label {
                font-size: 0.85rem;
            }
        }
        
        @media (min-width: 768px) and (max-width: 991px) {
            .hero-logo .brand-text {
                font-size: 2.3rem;
            }
            
            .partnership-logos {
                flex-direction: row;
                gap: 1.5rem;
                justify-content: center;
                flex-wrap: nowrap;
            }
            
            .logo-box {
                width: 120px;
                height: 120px;
            }
            
            .logo-box img {
                max-width: 70px;
                max-height: 70px;
            }
            
            .btn-custom {
                margin: 8px;
                padding: 14px 25px;
            }
        }
        
        @media (min-width: 992px) and (max-width: 1199px) {
            .hero-logo .brand-text {
                font-size: 2.4rem;
            }
            
            .partnership-logos {
                gap: 2rem;
            }
            
            .logo-box {
                width: 140px;
                height: 140px;
            }
            
            .logo-box img {
                max-width: 80px;
                max-height: 80px;
            }
        }
        
        @media (min-width: 1200px) {
            .partnership-logos {
                gap: 2.5rem;
            }
            
            .logo-box {
                width: 150px;
                height: 150px;
            }
            
            .logo-box img {
                max-width: 85px;
                max-height: 85px;
            }
        }
        
        /* Form responsive enhancements */
        @media (max-width: 991px) {
            .col-lg-6.mb-3 {
                margin-bottom: 1rem !important;
            }
            
            .col-lg-3.col-md-6 {
                margin-bottom: 1rem;
            }
            
            .alert ol {
                text-align: center !important;
            }
        }
        
        /* Table and card responsive */
        @media (max-width: 768px) {
            .card {
                margin-bottom: 1rem;
            }
            
            .row {
                margin-left: 0;
                margin-right: 0;
            }
            
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
            
            .text-center h2 {
                font-size: 1.75rem;
            }
            
            .text-center h4 {
                font-size: 1.5rem;
            }
            
            .text-center h5 {
                font-size: 1.25rem;
            }
        }
        
        /* Utility classes for better mobile experience */
        @media (max-width: 575px) {
            .d-mobile-block {
                display: block !important;
            }
            
            .text-mobile-center {
                text-align: center !important;
            }
            
            .mb-mobile-3 {
                margin-bottom: 1rem !important;
            }
            
            .p-mobile-2 {
                padding: 0.5rem !important;
            }
        }
        
        /* Threat Information Cards Styling */
        .threat-info-card {
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
            border: 3px solid #1e3c72 !important;
        }
        
        .threat-info-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2) !important;
        }
        
        .threat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
        
        .threat-icon i {
            font-size: 1.5rem !important;
        }
        
        .threat-info-card .card-body {
            padding: 1.25rem !important;
        }
        
        .threat-info-card .card-title {
            font-size: 0.95rem !important;
            margin-bottom: 0.5rem !important;
        }
        
        .threat-info-card .card-text {
            font-size: 0.8rem !important;
            line-height: 1.4;
            margin-bottom: 0.5rem !important;
        }
        
        .threat-info-card .list-unstyled {
            font-size: 0.75rem !important;
            margin-bottom: 0.5rem !important;
        }
        
        .threat-info-card .list-unstyled li {
            margin-bottom: 0.2rem;
        }
        
        .threat-info-card:hover .threat-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        @media (max-width: 575px) {
            .threat-icon {
                width: 50px;
                height: 50px;
            }
            
            .threat-icon i {
                font-size: 1.3rem !important;
            }
            
            .threat-info-card .card-body {
                padding: 1rem !important;
            }
            
            .threat-info-card .card-title {
                font-size: 0.9rem !important;
            }
            
            .threat-info-card .card-text {
                font-size: 0.75rem !important;
            }
        }
        
        /* Enhanced button responsiveness */
        @media (max-width: 575px) {
            .hero-buttons {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }
            
            .hero-buttons .btn {
                width: 100%;
                max-width: 280px;
            }
        }
        
        /* Fix for very small devices */
        @media (max-width: 360px) {
            .hero-logo .brand-text {
                font-size: 1.6rem;
            }
            
            .hero-logo img {
                width: 50px;
                height: 50px;
                margin-right: 0.5rem;
            }
            
            .display-3 {
                font-size: 1.8rem !important;
            }
            
            .logo-box {
                width: 100px;
                height: 100px;
            }
            
            .logo-box img {
                max-width: 60px;
                max-height: 60px;
            }
            
            .step-number {
                width: 45px !important;
                height: 45px !important;
                font-size: 1.1rem !important;
            }
            
            .card-body.p-4 {
                padding: 1rem !important;
            }
        }
        
        /* Tutorial Gallery Styles */
        .tutorial-card {
            transition: all 0.3s ease;
            cursor: pointer;
            overflow: hidden;
        }
        
        .tutorial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2) !important;
        }
        
        .tutorial-image-container {
            position: relative;
            overflow: hidden;
            height: 200px;
            border-radius: 15px 15px 0 0;
        }
        
        .tutorial-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top;
            transition: transform 0.3s ease;
        }
        
        .tutorial-card:hover .tutorial-image {
            transform: scale(1.1);
        }
        
        .tutorial-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(0,0,0,0.7) 0%, transparent 50%);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 15px;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }
        
        .tutorial-card:hover .tutorial-overlay,
        .tutorial-image-container:hover .tutorial-overlay {
            opacity: 1;
        }
        
        .tutorial-image-container {
            cursor: pointer;
        }
        
        .tutorial-step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        
        .tutorial-zoom-icon {
            background: rgba(255,255,255,0.9);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            font-size: 1.1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        /* Modal styles for image gallery */
        .modal-dialog.modal-xl {
            max-width: 90%;
        }
        
        .tutorial-modal-image {
            max-width: 100%;
            max-height: 70vh;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        
        /* Responsive tutorial gallery */
        @media (max-width: 767px) {
            .tutorial-image-container {
                height: 180px;
            }
            
            .tutorial-overlay {
                padding: 10px;
            }
            
            .tutorial-step-number {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }
            
            .tutorial-zoom-icon {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }
        }
        
        @media (max-width: 575px) {
            .tutorial-image-container {
                height: 160px;
            }
            
            .tutorial-step-number {
                width: 30px;
                height: 30px;
                font-size: 0.9rem;
            }
            
            .tutorial-zoom-icon {
                width: 30px;
                height: 30px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container-fluid px-3 px-md-4">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8">
                    <div class="hero-content">
                        <div class="hero-logo">
                            <img src="img/logo1.png" alt="iReport Logo" class="img-fluid" style="width: 80px; height: 80px;">
                            <span class="brand-text">iSumbong</span>
                        </div>
                        <h1 class="display-3 font-weight-bold mb-3 mb-md-4">Welcome to iSumbong</h1>
                        <p class="lead mb-4 mb-md-5 px-2 px-md-0">Your trusted portal for Cybersecurity Incident Reporting and Awareness</p>
                        
                        <div class="hero-buttons">
                            <a href="login.php" class="btn btn-light btn-lg btn-custom">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login
                            </a>
                            <a href="register.php" class="btn btn-outline-light btn-lg btn-custom">
                                <i class="fas fa-user-plus mr-2"></i>Register
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cybercrime Awareness Gallery Slider Section -->
    <section class="py-5" style="background: #1a1a1a; position: relative; overflow: hidden;">
        <div class="container" style="position: relative; z-index: 2;">
            <div class="text-center mb-5">
                <h2 class="font-weight-bold text-white mb-3">
                    <i class="fas fa-shield-alt mr-2"></i>Cybercrime Awareness Campaign
                </h2>
                <p class="text-white" style="font-size: 1.1rem; opacity: 0.8;">Be vigilant and informed. Protect yourself from cyber threats.</p>
            </div>
            
            <!-- Image Slider -->
            <div class="poster-slider-container">
                <div class="poster-slider" id="posterSlider">
                    <!-- Slide 1 -->
                    <div class="poster-slide active">
                        <div class="poster-card">
                            <img src="img/gal1.png" alt="Babala sa Cybercrime" class="poster-image">
                        </div>
                    </div>
                    
                    <!-- Slide 2 -->
                    <div class="poster-slide">
                        <div class="poster-card">
                            <img src="img/gal2.png" alt="Mag-ingat sa Online Scam" class="poster-image">
                        </div>
                    </div>
                    
                    <!-- Slide 3 -->
                    <div class="poster-slide">
                        <div class="poster-card">
                            <img src="img/gal3.jpg" alt="Think Before You Click" class="poster-image">
                        </div>
                    </div>
                </div>
                
                <!-- Slider Controls -->
                <button class="slider-btn prev-btn" onclick="changeSlide(-1)">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="slider-btn next-btn" onclick="changeSlide(1)">
                    <i class="fas fa-chevron-right"></i>
                </button>
                
                <!-- Slider Dots -->
                <div class="slider-dots">
                    <span class="dot active" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>
            </div>
        </div>
        
        <style>
            .poster-slider-container {
                position: relative;
                max-width: 1000px;
                margin: 0 auto;
                padding: 0 60px;
            }
            
            .poster-slider {
                position: relative;
                width: 100%;
                overflow: hidden;
                border-radius: 12px;
            }
            
            .poster-slide {
                display: none;
                animation: fadeIn 0.6s ease-in-out;
            }
            
            .poster-slide.active {
                display: block;
            }
            
            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }
            
            .poster-card {
                background: transparent;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: none;
            }
            
            .poster-image {
                width: 100%;
                height: auto;
                display: block;
                object-fit: contain;
                border-radius: 12px;
                max-height: 600px;
            }
            
            .poster-caption {
                padding: 25px;
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                text-align: center;
            }
            
            .poster-caption h5 {
                font-size: 1.5rem;
                font-weight: 700;
                color: #2c3e50;
                margin-bottom: 10px;
            }
            
            .poster-caption p {
                font-size: 1rem;
                color: #5a6c7d;
                margin: 0;
                line-height: 1.6;
            }
            
            .slider-btn {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background: rgba(255, 255, 255, 0.15);
                color: white;
                border: 2px solid rgba(255, 255, 255, 0.3);
                width: 50px;
                height: 50px;
                border-radius: 50%;
                font-size: 1.2rem;
                cursor: pointer;
                transition: all 0.3s ease;
                z-index: 10;
                backdrop-filter: blur(5px);
            }
            
            .slider-btn:hover {
                background: rgba(255, 255, 255, 0.3);
                border-color: rgba(255, 255, 255, 0.5);
                transform: translateY(-50%) scale(1.1);
            }
            
            .prev-btn {
                left: 0;
            }
            
            .next-btn {
                right: 0;
            }
            
            .slider-dots {
                text-align: center;
                padding: 30px 0 10px;
            }
            
            .dot {
                height: 12px;
                width: 12px;
                margin: 0 6px;
                background-color: rgba(255, 255, 255, 0.4);
                border-radius: 50%;
                display: inline-block;
                cursor: pointer;
                transition: all 0.3s ease;
            }
            
            .dot:hover {
                background-color: rgba(255, 255, 255, 0.6);
            }
            
            .dot.active {
                background-color: #ffc107;
                width: 12px;
                height: 12px;
            }
            
            @media (max-width: 768px) {
                .poster-slider-container {
                    padding: 0 50px;
                }
                
                .poster-image {
                    max-height: 450px;
                    border-radius: 8px;
                }
                
                .slider-btn {
                    width: 40px;
                    height: 40px;
                    font-size: 1rem;
                }
                
                .dot {
                    height: 10px;
                    width: 10px;
                    margin: 0 5px;
                }
                
                .dot.active {
                    width: 10px;
                    height: 10px;
                }
            }
            
            @media (max-width: 576px) {
                .poster-slider-container {
                    padding: 0 40px;
                }
                
                .poster-image {
                    max-height: 350px;
                    border-radius: 6px;
                }
                
                .slider-btn {
                    width: 35px;
                    height: 35px;
                    font-size: 0.9rem;
                }
            }
        </style>
        
        <script>
            let currentSlideIndex = 1;
            let slideInterval;
            
            // Auto-play slider
            function startAutoPlay() {
                slideInterval = setInterval(() => {
                    changeSlide(1);
                }, 5000); // Change slide every 5 seconds
            }
            
            function stopAutoPlay() {
                clearInterval(slideInterval);
            }
            
            function changeSlide(direction) {
                stopAutoPlay();
                showSlide(currentSlideIndex += direction);
                startAutoPlay();
            }
            
            function currentSlide(n) {
                stopAutoPlay();
                showSlide(currentSlideIndex = n);
                startAutoPlay();
            }
            
            function showSlide(n) {
                const slides = document.getElementsByClassName('poster-slide');
                const dots = document.getElementsByClassName('dot');
                
                if (n > slides.length) {
                    currentSlideIndex = 1;
                }
                if (n < 1) {
                    currentSlideIndex = slides.length;
                }
                
                // Hide all slides
                for (let i = 0; i < slides.length; i++) {
                    slides[i].classList.remove('active');
                }
                
                // Remove active from all dots
                for (let i = 0; i < dots.length; i++) {
                    dots[i].classList.remove('active');
                }
                
                // Show current slide and activate dot
                slides[currentSlideIndex - 1].classList.add('active');
                dots[currentSlideIndex - 1].classList.add('active');
            }
            
            // Start auto-play when page loads
            document.addEventListener('DOMContentLoaded', function() {
                startAutoPlay();
            });
            
            // Pause on hover
            document.getElementById('posterSlider').addEventListener('mouseenter', stopAutoPlay);
            document.getElementById('posterSlider').addEventListener('mouseleave', startAutoPlay);
        </script>
    </section>

    <!-- Features Section -->
    <section class="py-4 py-md-5 features-section">
        <div class="container">
            <div class="row text-center mb-4 mb-md-5">
                <div class="col-12">
                    <h2 class="font-weight-bold">Key Features</h2>
                    <p class="text-muted">Comprehensive cybersecurity incident reporting and management</p>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-3 p-md-4">
                            <div class="mb-3">
                                <i class="fas fa-exclamation-triangle fa-3x text-danger"></i>
                            </div>
                            <h5 class="card-title">Report Incidents</h5>
                            <p class="card-text">Quickly and securely report cybersecurity incidents to the authorities.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-3 p-md-4">
                            <div class="mb-3">
                                <i class="fas fa-shield-alt fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title">Track Progress</h5>
                            <p class="card-text">Monitor the status and progress of your reported incidents.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-3 p-md-4">
                            <div class="mb-3">
                                <i class="fas fa-graduation-cap fa-3x text-success"></i>
                            </div>
                            <h5 class="card-title">Learn & Protect</h5>
                            <p class="card-text">Access educational resources about cybersecurity threats and protection.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Threats Information Section -->
    <section class="py-4 py-md-5" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fc 100%);">
        <div class="container">
            <div class="row text-center mb-4 mb-md-5">
                <div class="col-12">
                    <h2 class="font-weight-bold" style="color: #2c3e50;">Types of Threats You Can Report</h2>
                    <p class="text-muted">Comprehensive guide to cybersecurity incidents and threats</p>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <!-- Phishing Attack -->
                <div class="col-6 col-md-4 col-lg-4 mb-3">
                    <div class="card h-100 border-0 shadow threat-info-card" onclick="showThreatModal('phishing')" style="cursor: pointer;">
                        <div class="card-body text-center">
                            <div class="threat-icon mb-2 bg-danger">
                                <i class="fas fa-fish text-white"></i>
                            </div>
                            <h5 class="card-title font-weight-bold text-danger">Panlilinlang sa Internet (Phishing)</h5>
                            <p class="card-text">Mga manlolokong mensahe o email na naglalayong nakawin ang inyong personal na impormasyon, password, o datos pangkabuhayan.</p>
                            <ul class="list-unstyled text-left small mt-3">
                                <li><i class="fas fa-exclamation-circle text-danger mr-2"></i>Pekeng login page</li>
                                <li><i class="fas fa-exclamation-circle text-danger mr-2"></i>Kahina-hinalang link sa email</li>
                                <li><i class="fas fa-exclamation-circle text-danger mr-2"></i>Pagpapanggap na ibang tao</li>
                            </ul>
                            <div class="mt-3">
                                <small class="text-muted"><i class="fas fa-mouse-pointer mr-1"></i>I-click para sa detalyadong paliwanag</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Identity Theft -->
                <div class="col-6 col-md-4 col-lg-4 mb-3">
                    <div class="card h-100 border-0 shadow threat-info-card" onclick="showThreatModal('identity')" style="cursor: pointer;">
                        <div class="card-body text-center">
                            <div class="threat-icon mb-2 bg-info">
                                <i class="fas fa-user-secret text-white"></i>
                            </div>
                            <h5 class="card-title font-weight-bold text-info">Pagnanakaw ng Pagkakakilanlan (Identity Theft)</h5>
                            <p class="card-text">Ang di-awtorisadong paggamit ng personal na impormasyon ng isang tao upang magpanggap o pasukin ang kanilang mga account.</p>
                            <ul class="list-unstyled text-left small mt-3">
                                <li><i class="fas fa-exclamation-circle text-info mr-2"></i>Nakawin ang ID o dokumento</li>
                                <li><i class="fas fa-exclamation-circle text-info mr-2"></i>Hindi awtorisadong pag-access ng account</li>
                                <li><i class="fas fa-exclamation-circle text-info mr-2"></i>Pekeng profile</li>
                            </ul>
                            <div class="mt-3">
                                <small class="text-muted"><i class="fas fa-mouse-pointer mr-1"></i>I-click para sa detalyadong paliwanag</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Online Fraud -->
                <div class="col-6 col-md-4 col-lg-4 mb-3">
                    <div class="card h-100 border-0 shadow threat-info-card" onclick="showThreatModal('onlinefraud')" style="cursor: pointer;">
                        <div class="card-body text-center">
                            <div class="threat-icon mb-2 bg-success">
                                <i class="fas fa-money-bill-wave text-white"></i>
                            </div>
                            <h5 class="card-title font-weight-bold text-success">Pandaraya sa Internet (Online Fraud)</h5>
                            <p class="card-text">Mga mapanlinlang na gawain sa internet tulad ng panloloko sa pera, investment scam, at iba pang online scams.</p>
                            <ul class="list-unstyled text-left small mt-3">
                                <li><i class="fas fa-exclamation-circle text-success mr-2"></i>Pandaraya sa credit card at banking</li>
                                <li><i class="fas fa-exclamation-circle text-success mr-2"></i>Panloloko sa investment at online shopping</li>
                                <li><i class="fas fa-exclamation-circle text-success mr-2"></i>Romance scam at job offer scam</li>
                            </ul>
                            <div class="mt-3">
                                <small class="text-muted"><i class="fas fa-mouse-pointer mr-1"></i>I-click para sa detalyadong paliwanag</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Hacking/Unauthorized Access -->
                <div class="col-6 col-md-4 col-lg-4 mb-3">
                    <div class="card h-100 border-0 shadow threat-info-card" onclick="showThreatModal('unauthorized_access')" style="cursor: pointer;">
                        <div class="card-body text-center">
                            <div class="threat-icon mb-2" style="background: #6f42c1;">
                                <i class="fas fa-user-lock text-white"></i>
                            </div>
                            <h5 class="card-title font-weight-bold" style="color: #6f42c1;">Pagpasok Nang Walang Pahintulot (Unauthorized Access)</h5>
                            <p class="card-text">Ang iligal na pag-access sa mga computer system, network, o account nang walang awtorisasyon.</p>
                            <ul class="list-unstyled text-left small mt-3">
                                <li><i class="fas fa-exclamation-circle mr-2" style="color: #6f42c1;"></i>Pag-agaw ng account</li>
                                <li><i class="fas fa-exclamation-circle mr-2" style="color: #6f42c1;"></i>Hindi awtorisadong pagpasok sa network</li>
                                <li><i class="fas fa-exclamation-circle mr-2" style="color: #6f42c1;"></i>Pagsira sa system</li>
                            </ul>
                            <div class="mt-3">
                                <small class="text-muted"><i class="fas fa-mouse-pointer mr-1"></i>I-click para sa detalyadong paliwanag</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Cyberbullying/Harassment -->
                <div class="col-6 col-md-4 col-lg-4 mb-3">
                    <div class="card h-100 border-0 shadow threat-info-card" onclick="showThreatModal('cyberbullying')" style="cursor: pointer;">
                        <div class="card-body text-center">
                            <div class="threat-icon mb-2" style="background: #e83e8c;">
                                <i class="fas fa-bullhorn text-white"></i>
                            </div>
                            <h5 class="card-title font-weight-bold" style="color: #e83e8c;">Pang-aabuso sa Internet (Cyberbullying)</h5>
                            <p class="card-text">Pang-aapi, pagbabanta, o pananakot sa pamamagitan ng internet at social media.</p>
                            <ul class="list-unstyled text-left small mt-3">
                                <li><i class="fas fa-exclamation-circle mr-2" style="color: #e83e8c;"></i>Pagbabanta online</li>
                                <li><i class="fas fa-exclamation-circle mr-2" style="color: #e83e8c;"></i>Pag-uusig sa internet</li>
                                <li><i class="fas fa-exclamation-circle mr-2" style="color: #e83e8c;"></i>Pang-aapi sa digital</li>
                            </ul>
                            <div class="mt-3">
                                <small class="text-muted"><i class="fas fa-mouse-pointer mr-1"></i>I-click para sa detalyadong paliwanag</small>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Call to Action -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="alert text-center border-0" style="background: transparent; color: #333;">
                        <h5 class="mb-3" style="color: #333;">Don't Wait - Report Incidents Immediately</h5>
                        <p class="mb-3" style="color: #333;">If you've experienced any of these threats, report them now to help protect yourself and others in the community.</p>
                        <div>
                            <a href="register.php" class="btn btn-outline-primary btn-lg mr-2 mb-2">
                                <i class="fas fa-user-plus mr-2"></i>Register to Report
                            </a>
                            <a href="login.php" class="btn btn-outline-primary btn-lg mb-2">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login & Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tutorial Section -->
    <section class="py-4 py-md-5" style="background: linear-gradient(135deg, #f8f9fc 0%, #e3f2fd 100%);">
        <div class="container">
            <div class="row text-center mb-4 mb-md-5">
                <div class="col-12">
                    <h2 class="font-weight-bold" style="color: #2c3e50;">How to Use iSumbong</h2>
                    <p class="text-muted">Visual guide showing the actual system interface</p>
                </div>
            </div>
            
            <!-- Image Gallery -->
            <div class="row justify-content-center">
                <!-- Landing Page -->
                <div class="col-12 col-md-6 col-xl-3 mb-4">
                    <div class="card tutorial-card h-100 border-0 shadow-lg" style="background: white;">
                        <div class="tutorial-image-container" onclick="openImageModal('img/landing.png', 'Landing Page', 'Welcome to iSumbong - Your starting point for cybersecurity incident reporting')">
                            <img src="img/landing.png" alt="Landing Page" class="img-fluid tutorial-image">
                            <div class="tutorial-overlay">
                                <div class="tutorial-step-number bg-primary text-white">1</div>
                                <div class="tutorial-zoom-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center p-3">
                            <h5 class="card-title text-primary font-weight-bold">Landing Page</h5>
                            <p class="card-text small">Start here to access the iSumbong incident reporting system</p>
                        </div>
                    </div>
                </div>
                
                <!-- Register Page -->
                <div class="col-12 col-md-6 col-xl-3 mb-4">
                    <div class="card tutorial-card h-100 border-0 shadow-lg" style="background: white;">
                        <div class="tutorial-image-container" onclick="openImageModal('img/register.png', 'Register Account', 'Create your secure account by providing personal information and verifying your identity')">
                            <img src="img/register.png" alt="Register Account" class="img-fluid tutorial-image">
                            <div class="tutorial-overlay">
                                <div class="tutorial-step-number bg-success text-white">2</div>
                                <div class="tutorial-zoom-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center p-3">
                            <h5 class="card-title text-success font-weight-bold">Register Account</h5>
                            <p class="card-text small">Create your secure account with personal information and ID verification</p>
                        </div>
                    </div>
                </div>
                
                <!-- Login Page -->
                <div class="col-12 col-md-6 col-xl-3 mb-4">
                    <div class="card tutorial-card h-100 border-0 shadow-lg" style="background: white;">
                        <div class="tutorial-image-container" onclick="openImageModal('img/login.png', 'Login & Access', 'Sign in to your account to access the incident reporting dashboard')">
                            <img src="img/login.png" alt="Login Page" class="img-fluid tutorial-image">
                            <div class="tutorial-overlay">
                                <div class="tutorial-step-number bg-warning text-white">3</div>
                                <div class="tutorial-zoom-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center p-3">
                            <h5 class="card-title text-warning font-weight-bold">Login & Access</h5>
                            <p class="card-text small">Sign in to access your dashboard and view submitted reports</p>
                        </div>
                    </div>
                </div>
                
                <!-- Report Page -->
                <div class="col-12 col-md-6 col-xl-3 mb-4">
                    <div class="card tutorial-card h-100 border-0 shadow-lg" style="background: white;">
                        <div class="tutorial-image-container" onclick="openImageModal('img/report.png', 'Report Incident', 'Fill out the comprehensive incident report form with detailed information')">
                            <img src="img/report.png" alt="Report Incident" class="img-fluid tutorial-image">
                            <div class="tutorial-overlay">
                                <div class="tutorial-step-number bg-info text-white">4</div>
                                <div class="tutorial-zoom-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center p-3">
                            <h5 class="card-title text-info font-weight-bold">Report Incident</h5>
                            <p class="card-text small">Complete the detailed incident report form with evidence and information</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tutorial Instructions -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="alert alert-info text-center border-0" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(10px);">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Click on any image above to view it in full size and see detailed instructions</strong>
                    </div>
                </div>
            </div>
            
            <!-- Detailed Instructions -->
            <div class="row mt-4 mt-md-5">
                <div class="col-12">
                    <div class="card border-0" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(10px);">
                        <div class="card-body p-3 p-md-5">
                            <h4 class="text-center mb-4" style="color: #2c3e50;">
                                <i class="fas fa-info-circle mr-2"></i>Detailed Instructions
                            </h4>
                            
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                                    <h5 style="color: #2c3e50;"><i class="fas fa-clipboard-list mr-2 text-primary"></i>What to Include in Your Report</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success mr-2"></i>Detailed description of the incident</li>
                                        <li><i class="fas fa-check text-success mr-2"></i>Date and time when it occurred</li>
                                        <li><i class="fas fa-check text-success mr-2"></i>Type of cybersecurity threat (phishing, malware, etc.)</li>
                                        <li><i class="fas fa-check text-success mr-2"></i>Any evidence (screenshots, emails, logs)</li>
                                        <li><i class="fas fa-check text-success mr-2"></i>Impact assessment of the incident</li>
                                    </ul>
                                </div>
                                
                                <div class="col-12 col-lg-6">
                                    <h5 style="color: #2c3e50;"><i class="fas fa-shield-alt mr-2 text-success"></i>Security & Privacy</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-lock text-primary mr-2"></i>All reports are encrypted and secure</li>
                                        <li><i class="fas fa-lock text-primary mr-2"></i>Your identity is protected</li>
                                        <li><i class="fas fa-lock text-primary mr-2"></i>Only authorized PNP-ACG personnel can access reports</li>
                                        <li><i class="fas fa-lock text-primary mr-2"></i>Email notifications keep you updated</li>
                                        <li><i class="fas fa-lock text-primary mr-2"></i>24/7 monitoring and response</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="text-center mt-4">
                                <div class="alert alert-info border-0" style="background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);">
                                    <i class="fas fa-lightbulb mr-2"></i>
                                    <strong>Tip:</strong> The more detailed your report, the better we can assist you and prevent similar incidents.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Report Form Preview Section -->
    <section class="py-4 py-md-5" style="background: #f8f9fc;">
        <div class="container">
            <div class="row text-center mb-4 mb-md-5">
                <div class="col-12">
                    <h2 class="font-weight-bold" style="color: #2c3e50;">Report Form Preview</h2>
                    <p class="text-muted">See what information you'll need to provide when reporting an incident</p>
                    <div class="alert alert-warning d-inline-block">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Note:</strong> You must <a href="register.php" class="alert-link">register an account</a> to submit incident reports
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header text-white" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
                            <h4 class="mb-0"><i class="fas fa-file-alt mr-2"></i>Cybersecurity Incident Report Form</h4>
                        </div>
                        
                        <div class="card-body p-3 p-md-4">
                            <form>
                                <div class="row">
                                    <!-- Basic Information -->
                                    <div class="col-12 mb-3 mb-md-4">
                                        <h5 class="text-primary border-bottom pb-2">
                                            <i class="fas fa-info-circle mr-2"></i>Basic Information
                                        </h5>
                                    </div>
                                    
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Incident Title *</label>
                                        <input type="text" class="form-control" placeholder="Brief title describing the incident" disabled>
                                    </div>
                                    
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Category *</label>
                                        <select class="form-control" disabled>
                                            <option>Phishing Attack</option>
                                            <option>Malware/Virus</option>
                                            <option>Data Breach</option>
                                            <option>Identity Theft</option>
                                            <option>Financial Fraud</option>
                                            <option>Social Engineering</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Date of Incident *</label>
                                        <input type="date" class="form-control" disabled>
                                    </div>
                                    
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Severity Level *</label>
                                        <select class="form-control" disabled>
                                            <option>Low - Minor inconvenience</option>
                                            <option>Medium - Moderate impact</option>
                                            <option>High - Significant damage</option>
                                            <option>Critical - Severe consequences</option>
                                        </select>
                                    </div>
                                    
                                    <!-- Reporter Information -->
                                    <div class="col-12 mb-3 mb-md-4 mt-2 mt-md-3">
                                        <h5 class="text-primary border-bottom pb-2">
                                            <i class="fas fa-user mr-2"></i>Reporter Information
                                        </h5>
                                    </div>
                                    
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Full Name *</label>
                                        <input type="text" class="form-control" placeholder="Your complete name" disabled>
                                    </div>
                                    
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Email Address *</label>
                                        <input type="email" class="form-control" placeholder="your.email@example.com" disabled>
                                    </div>
                                    
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Phone Number</label>
                                        <input type="tel" class="form-control" placeholder="+63 9XX XXX XXXX" disabled>
                                    </div>
                                    
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Organization/Company</label>
                                        <input type="text" class="form-control" placeholder="Your workplace or organization" disabled>
                                    </div>
                                    
                                    <!-- Incident Details -->
                                    <div class="col-12 mb-3 mb-md-4 mt-2 mt-md-3">
                                        <h5 class="text-primary border-bottom pb-2">
                                            <i class="fas fa-clipboard-list mr-2"></i>Incident Details
                                        </h5>
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <label class="form-label font-weight-bold">Detailed Description *</label>
                                        <textarea class="form-control" rows="4" placeholder="Provide a comprehensive description of what happened, when it occurred, and any relevant details..." disabled></textarea>
                                    </div>
                                    
                                    <!-- Evidence Collection -->
                                    <div class="col-12 mb-3 mb-md-4 mt-2 mt-md-3">
                                        <h5 class="text-primary border-bottom pb-2">
                                            <i class="fas fa-file-alt mr-2"></i>Evidence Collection
                                        </h5>
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <label class="form-label font-weight-bold">Available Evidence (check all that apply)</label>
                                        <div class="row">
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" disabled>
                                                    <label class="form-check-label">Screenshots</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" disabled>
                                                    <label class="form-check-label">Email Evidence</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" disabled>
                                                    <label class="form-check-label">System Logs</label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" disabled>
                                                    <label class="form-check-label">Other Files</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <label class="form-label font-weight-bold">File Attachments</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" multiple disabled>
                                            <label class="custom-file-label">Upload supporting documents, screenshots, or evidence files</label>
                                        </div>
                                        <small class="text-muted">Supported formats: PDF, DOC, JPG, PNG, ZIP (Max 10MB per file)</small>
                                    </div>
                                    
                                    <!-- Additional Information -->
                                    <div class="col-12 mb-3 mb-md-4 mt-2 mt-md-3">
                                        <h5 class="text-primary border-bottom pb-2">
                                            <i class="fas fa-plus-circle mr-2"></i>Additional Information
                                        </h5>
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <label class="form-label font-weight-bold">Actions Taken</label>
                                        <textarea class="form-control" rows="3" placeholder="Describe any actions you've already taken in response to this incident..." disabled></textarea>
                                    </div>
                                    
                                    <div class="col-12 mb-3 mb-md-4">
                                        <label class="form-label font-weight-bold">Additional Comments</label>
                                        <textarea class="form-control" rows="3" placeholder="Any other relevant information or special circumstances..." disabled></textarea>
                                    </div>
                                    
                                    <!-- Submit Section -->
                                    <div class="col-12 text-center">
                                        <div class="alert alert-info">
                                            <i class="fas fa-lock mr-2"></i>
                                            <strong>To submit this report, you need to:</strong>
                                            <ol class="mt-2 mb-0 text-left d-inline-block">
                                                <li>Create an account by clicking "Register" above</li>
                                                <li>Verify your identity with a valid ID</li>
                                                <li>Log in to access the reporting dashboard</li>
                                            </ol>
                                        </div>
                                        
                                        <div class="mt-3">
                                            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3">
                                                <a href="register.php" class="btn btn-primary btn-lg mb-2 mb-md-0 mr-md-3">
                                                    <i class="fas fa-user-plus mr-2"></i>Register Now
                                                </a>
                                                <a href="login.php" class="btn btn-outline-primary btn-lg">
                                                    <i class="fas fa-sign-in-alt mr-2"></i>Already Have Account?
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Preparation Tips -->
            <div class="row mt-4 mt-md-5">
                <div class="col-12">
                    <div class="card border-0 shadow">
                        <div class="card-header text-white" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
                            <h5 class="mb-0"><i class="fas fa-lightbulb mr-2"></i>Preparation Tips</h5>
                        </div>
                        <div class="card-body p-3 p-md-4">
                            <div class="row">
                                <div class="col-12 col-md-4 mb-3 mb-md-0">
                                    <h6 class="text-primary"><i class="fas fa-camera mr-2"></i>Gather Evidence</h6>
                                    <ul class="list-unstyled small">
                                        <li>• Take screenshots of suspicious emails or websites</li>
                                        <li>• Save any error messages or suspicious files</li>
                                        <li>• Document the timeline of events</li>
                                    </ul>
                                </div>
                                <div class="col-12 col-md-4 mb-3 mb-md-0">
                                    <h6 class="text-success"><i class="fas fa-shield-alt mr-2"></i>Secure Your System</h6>
                                    <ul class="list-unstyled small">
                                        <li>• Disconnect from the internet if compromised</li>
                                        <li>• Run antivirus scans</li>
                                        <li>• Change passwords on affected accounts</li>
                                    </ul>
                                </div>
                                <div class="col-12 col-md-4">
                                    <h6 class="text-warning"><i class="fas fa-clock mr-2"></i>Act Quickly</h6>
                                    <ul class="list-unstyled small">
                                        <li>• Report incidents as soon as possible</li>
                                        <li>• Preserve evidence before it's lost</li>
                                        <li>• Contact your bank if financial data is involved</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-4 py-md-5 about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 mb-4 mb-lg-0 text-center text-lg-left">
                    <h2 class="font-weight-bold mb-4">About iSumbong</h2>
                    <p class="lead">iSumbong is a comprehensive cybersecurity incident reporting platform.</p>
                    <p>Our platform enables citizens to report cybersecurity incidents quickly and securely, while providing educational resources to help protect against cyber threats.</p>
                </div>
                <div class="col-12 col-lg-6 text-center">
                    <div class="partnership-logos">
                        <div class="logo-container">
                            <div class="logo-box">
                                <img src="img/pnp.png" alt="PNP Logo" class="img-fluid">
                            </div>
                            <div class="logo-label">
                                Philippine<br>National Police
                            </div>
                        </div>
                        
                        <div class="logo-container">
                            <div class="logo-box">
                                <img src="img/logo1.png" alt="iREPORT Logo" class="img-fluid">
                            </div>
                            <div class="logo-label">
                                Secure Reporting<br>Platform
                            </div>
                        </div>
                        
                        <div class="logo-container">
                            <div class="logo-box">
                                <img src="img/pnp-acg-logo-new.png" alt="PNP ACG Logo" class="img-fluid">
                            </div>
                            <div class="logo-label">
                                Philippine National Police<br>Anti-Cybercrime Group
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Tutorial Step</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Tutorial Image" class="tutorial-modal-image">
                    <div class="mt-3">
                        <p id="modalDescription" class="lead"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Threat Information Modal -->
    <div class="modal fade" id="threatModal" tabindex="-1" role="dialog" aria-labelledby="threatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" id="threatModalHeader" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
                    <h4 class="modal-title" id="threatModalLabel"></h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="threatModalBody" style="text-align: left;">
                    <!-- Content will be dynamically loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="register.php" class="btn btn-primary" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); border: none;">
                        <i class="fas fa-flag mr-2"></i>Report Incident
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>&copy; 2025 iSumbong. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Tutorial Gallery JavaScript -->
    <script>
        // Function to open image modal
        function openImageModal(imageSrc, imageTitle, imageDescription) {
            $('#modalImage').attr('src', imageSrc);
            $('#imageModalLabel').text(imageTitle);
            $('#modalDescription').text(imageDescription);
            $('#imageModal').modal('show');
        }
        
        // Function to show threat information modal
        function showThreatModal(threatType) {
            const threats = {
                phishing: {
                    title: '<i class="fas fa-fish mr-2"></i>Panlilinlang sa Internet (Phishing)',
                    content: `
                        <h5 class="text-danger mb-3">Ano ang Phishing?</h5>
                        <p>Ang <strong>phishing</strong> ay isang uri ng panloloko sa internet kung saan ang mga kriminal ay nagpapanggap na kilalang kumpanya o tao upang nakawin ang inyong mga personal na impormasyon tulad ng password, credit card number, o bank account details.</p>
                        
                        <div class="alert alert-info mt-3 mb-3">
                            <h6 class="font-weight-bold mb-2"><i class="fas fa-info-circle mr-2"></i>Pagkakaiba ng "Phishing" at "Fishing"</h6>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <p class="mb-1"><strong><i class="fas fa-fish mr-2"></i>Fishing (Pangingisda)</strong></p>
                                    <p class="small mb-0">Ito ang aktwal na pangingisda - ang paghuli ng isda gamit ang pamingwit o lambat sa dagat, ilog, o lawa. Isang lehitimong aktibidad para sa pagkain at kabuhayan.</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1"><strong><i class="fas fa-exclamation-triangle text-danger mr-2"></i>Phishing (Cyber Attack)</strong></p>
                                    <p class="small mb-0">Ito ang <strong>panloloko sa internet</strong> na ginagamit ang "pain" (bait/pakinabang) tulad ng pekeng email para "hulihin" ang mga biktima at nakawin ang kanilang impormasyon. Isang <strong>kriminal na gawain</strong>.</p>
                                </div>
                            </div>
                            <hr class="my-2">
                            <p class="small mb-0"><i class="fas fa-lightbulb text-warning mr-2"></i><strong>Bakit "Phishing"?</strong> Ang salitang ito ay nanggaling sa "fishing" dahil parang pangingisda rin - gumagamit ang mga scammer ng "pain" (bait) upang "hulihin" ang mga biktima at nakawin ang kanilang personal na impormasyon!</p>
                        </div>
                        
                        <h5 class="text-danger mt-4 mb-3">Paano Nangyayari ang Phishing?</h5>
                        <div class="alert alert-light border-left border-danger" style="border-left-width: 4px !important;">
                            <p><strong>1. Pekeng Email o Mensahe</strong><br>
                            Makakatanggap kayo ng email o text message na mukhang galing sa bangko, online shopping site, o gobyerno. Sasabihin nila na may problema sa inyong account at kailangan ninyong mag-log in kaagad.</p>
                            
                            <p><strong>2. Pekeng Website</strong><br>
                            Kapag nag-click kayo sa link sa email, dadalhin kayo sa pekeng website na halos kamukha ng tunay. Kapag nag-type kayo ng username at password dito, makukuha nila ito.</p>
                            
                            <p><strong>3. Pagnanakaw ng Impormasyon</strong><br>
                            Gagamitin nila ang inyong username at password para pasukin ang inyong tunay na account at nakawin ang inyong pera o personal na datos.</p>
                        </div>
                        
                        <h5 class="text-danger mt-4 mb-3">Mga Halimbawa ng Phishing:</h5>
                        <ul>
                            <li><i class="fas fa-envelope text-danger mr-2"></i>Email mula sa "bangko" na nagsasabing i-verify ang account</li>
                            <li><i class="fas fa-shopping-cart text-danger mr-2"></i>Mensahe tungkol sa nanalo sa raffle na hindi naman kayo sumali</li>
                            <li><i class="fas fa-exclamation-triangle text-danger mr-2"></i>Text message na nagsasabing suspended ang SIM card</li>
                            <li><i class="fas fa-gift text-danger mr-2"></i>Fake na ayuda o tulong mula sa gobyerno</li>
                        </ul>
                        
                        <h5 class="text-danger mt-4 mb-3">Paano Maiwasan ang Phishing?</h5>
                        <div class="alert alert-success">
                            <p class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i><strong>Huwag basta-basta mag-click</strong> ng mga link sa email o text message</p>
                            <p class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i><strong>Tingnan mabuti ang email address</strong> ng nagpadala - baka peke</p>
                            <p class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i><strong>I-type mismo</strong> ang website address sa browser kaysa mag-click ng link</p>
                            <p class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i><strong>Huwag magbigay</strong> ng password, OTP, o personal na impormasyon</p>
                            <p class="mb-0"><i class="fas fa-check-circle text-success mr-2"></i><strong>Tawagan ang kumpanya</strong> kung hindi kayo sigurado kung totoo ang mensahe</p>
                        </div>
                        
                        <div class="alert alert-warning mt-3">
                            <i class="fas fa-exclamation-triangle mr-2"></i><strong>Tandaan:</strong> Ang mga lehitimong kumpanya ay hindi humihingi ng password o OTP sa pamamagitan ng email o text message!
                        </div>
                    `
                },
                identity: {
                    title: '<i class="fas fa-user-secret mr-2"></i>Pagnanakaw ng Pagkakakilanlan (Identity Theft)',
                    content: `
                        <h5 class="text-info mb-3">Ano ang Identity Theft?</h5>
                        <p>Ang <strong>identity theft</strong> o pagnanakaw ng pagkakakilanlan ay nangyayari kapag may taong gumamit ng inyong personal na impormasyon (pangalan, birthday, ID number, o mga dokumento) nang walang pahintulot para sa kanilang sariling kapakinabangan.</p>
                        
                        <h5 class="text-info mt-4 mb-3">Paano Nangyayari?</h5>
                        <div class="alert alert-light border-left border-info" style="border-left-width: 4px !important;">
                            <p><strong>1. Pagnanakaw ng Dokumento</strong><br>
                            Kinukuha nila ang inyong ID, birth certificate, o iba pang mahalagang papel. Puwede rin nilang kunin ang larawan ng inyong ID na naka-post sa social media.</p>
                            
                            <p><strong>2. Pag-hack ng Account</strong><br>
                            Pinasok nila ang inyong email, social media, o online account para makuha ang personal na impormasyon.</p>
                            
                            <p><strong>3. Paggamit sa Pangalan Ninyo</strong><br>
                            Gagawa sila ng pekeng account, mag-apply ng loan, o gumawa ng krimen gamit ang inyong identity.</p>
                        </div>
                        
                        <h5 class="text-info mt-4 mb-3">Mga Palatandaan na Biktima Kayo:</h5>
                        <ul>
                            <li><i class="fas fa-credit-card text-info mr-2"></i>May nakikitang transaksyon na hindi ninyo ginawa</li>
                            <li><i class="fas fa-file-invoice text-info mr-2"></i>Tumatanggap ng bill o singil na hindi ninyo alam</li>
                            <li><i class="fas fa-user-times text-info mr-2"></i>Hindi makapag-log in sa sariling account</li>
                            <li><i class="fas fa-phone text-info mr-2"></i>May tumatawag tungkol sa utang na hindi ninyo naman ginawa</li>
                            <li><i class="fas fa-users text-info mr-2"></i>May pekeng account na gumagamit ng inyong pangalan at larawan</li>
                        </ul>
                        
                        <h5 class="text-info mt-4 mb-3">Paano Maprotektahan ang Sarili?</h5>
                        <div class="alert alert-success">
                            <p class="mb-2"><i class="fas fa-lock text-success mr-2"></i><strong>Ingatan ang mga ID at dokumento</strong> - huwag basta ipakita o ipahiram</p>
                            <p class="mb-2"><i class="fas fa-shield-alt text-success mr-2"></i><strong>Huwag mag-post</strong> ng litrato ng ID sa social media</p>
                            <p class="mb-2"><i class="fas fa-key text-success mr-2"></i><strong>Gumamit ng malakas na password</strong> at huwag ibahagi kahit kanino</p>
                            <p class="mb-2"><i class="fas fa-user-lock text-success mr-2"></i><strong>I-private ang social media</strong> at mag-ingat sa mga shineshare</p>
                            <p class="mb-0"><i class="fas fa-eye text-success mr-2"></i><strong>Regular na suriin</strong> ang bank account at credit card statement</p>
                        </div>
                        
                        <div class="alert alert-danger mt-3">
                            <i class="fas fa-exclamation-circle mr-2"></i><strong>Kapag Nakuha ang Identity</strong> Agad iulat sa bangko, PNP Anti-Cybercrime Group, at sa mga kumpanyang apektado!
                        </div>
                    `
                },
                onlinefraud: {
                    title: '<i class="fas fa-money-bill-wave mr-2"></i>Pandaraya sa Internet (Online Fraud)',
                    content: `
                        <h5 class="text-success mb-3">Ano ang Online Fraud?</h5>
                        <p>Ang <strong>online fraud</strong> o pandaraya sa internet ay mga panloloko na naglalayong nakawin ang inyong pera sa pamamagitan ng credit card, debit card, online banking, investment scam, at iba pang mapanlinlang na pamamaraan sa internet.</p>
                        
                        <h5 class="text-success mt-4 mb-3">Mga Uri ng Online Fraud:</h5>
                        <div class="alert alert-light border-left border-success" style="border-left-width: 4px !important;">
                            <p><strong>1. Credit Card at Banking Fraud</strong><br>
                            Ginagamit ng iba ang inyong credit card number o online banking details para mag-shopping online o nakawin ang pera sa account nang hindi kayo nakakaalam.</p>
                            
                            <p><strong>2. Investment Scam</strong><br>
                            Nag-aalok ng "mataas na kita" o "siguradong yaman" na pang-uto lang. Kapag nagbigay kayo ng pera, mawawala na sila.</p>
                            
                            <p><strong>3. Pekeng Loan Offer</strong><br>
                            Nag-aalok ng mabilis na loan, pero kakailanganin munang magbayad ng "processing fee" o "insurance". Pagkatapos, wala na ang pera at walang loan na matatanggap.</p>
                            
                            <p><strong>4. Panloloko sa Online Shopping</strong><br>
                            Nag-order kayo ng produkto at nagbayad na, pero hindi dumating ang item o peke naman ang natanggap. Puwede ring mawala na lang ang seller pagkatapos ninyong magbayad.</p>
                            
                            <p><strong>5. Romance Scam (Panloloko sa Pag-ibig)</strong><br>
                            May makikilala kayong online na sobrang sweet at mabait. Pagkatapos ng ilang araw o linggo, hihiram ng pera para sa emergency. Pagkatapos ninyo magpadala, mawawala na sila.</p>
                            
                            <p><strong>6. Job Offer Scam (Pekeng Trabaho)</strong><br>
                            Nag-offer ng "home-based" o "easy money" na trabaho. Kakailanganin munang magbayad ng registration fee o training fee, pero walang trabahong matanggap.</p>
                            
                            <p><strong>7. Pyramiding o "Easy Money" Scheme</strong><br>
                            Mag-invest raw ng pera at kikita ng malaki. Kailangan magrecruitng bagong members. Sa huli, yung nasa taas lang ang kikita, yung nasa baba ay talo.</p>
                        </div>
                        
                        <h5 class="text-success mt-4 mb-3">Paano Ginagawa ng Mga Scammer?</h5>
                        <ul>
                            <li><i class="fas fa-mobile-alt text-success mr-2"></i>Humihingi ng OTP (One-Time PIN) na dapat sekreto - kayo lang nakakaalam</li>
                            <li><i class="fas fa-link text-success mr-2"></i>Nagpapadala ng link na may virus para makuha ang bank details</li>
                            <li><i class="fas fa-phone-alt text-success mr-2"></i>Tumatawag at nagpapanggap na taga-bangko para hingin ang card details</li>
                            <li><i class="fas fa-qrcode text-success mr-2"></i>Pekeng QR code para sa payment na pupunta sa kanila ang pera</li>
                            <li><i class="fas fa-clock text-success mr-2"></i>"Limited time offer" - pinapapressure kayong magmadali</li>
                            <li><i class="fas fa-gift text-success mr-2"></i>Fake na raffle o premyo na kailangan muna magbayad ng "tax"</li>
                        </ul>
                        
                        <h5 class="text-success mt-4 mb-3">Mga Palatandaan ng Scam:</h5>
                        <ul>
                            <li><i class="fas fa-money-bill-wave text-warning mr-2"></i><strong>"Mataas na kita, walang effort"</strong> - masyadong maganda para maging totoo</li>
                            <li><i class="fas fa-hand-holding-usd text-warning mr-2"></i><strong>Humihingi ng pera una</strong> bago makakuha ng serbisyo</li>
                            <li><i class="fas fa-user-secret text-warning mr-2"></i><strong>Walang physical address</strong> o contact details ng negosyo</li>
                            <li><i class="fas fa-star text-warning mr-2"></i><strong>Puro positive reviews</strong> na mukhang peke o manufactured</li>
                        </ul>
                        
                        <h5 class="text-success mt-4 mb-3">Paano Maprotektahan ang Sarili?</h5>
                        <div class="alert alert-warning">
                            <p class="mb-2"><i class="fas fa-ban text-warning mr-2"></i><strong>Huwag KAILANMAN ibigay</strong> ang OTP, CVV, o PIN sa kahit sino</p>
                            <p class="mb-2"><i class="fas fa-search text-warning mr-2"></i><strong>Mag-research muna</strong> - i-Google ang pangalan ng seller o kumpanya</p>
                            <p class="mb-2"><i class="fas fa-shield-alt text-warning mr-2"></i><strong>Gumamit ng secure payment method</strong> na may buyer protection</p>
                            <p class="mb-2"><i class="fas fa-handshake text-warning mr-2"></i><strong>Meet-up o COD</strong> kung puwede para makita muna ang item</p>
                            <p class="mb-2"><i class="fas fa-mobile text-warning mr-2"></i><strong>I-activate ang SMS/email notification</strong> para aware kayo sa transactions</p>
                            <p class="mb-2"><i class="fas fa-brain text-warning mr-2"></i><strong>Kung masyadong maganda ang alok</strong>, baka scam yan</p>
                            <p class="mb-0"><i class="fas fa-laptop text-warning mr-2"></i><strong>Gumamit ng secure WiFi</strong> kapag mag-online banking - iwasan ang public WiFi</p>
                        </div>
                        
                        <div class="alert alert-danger mt-3">
                            <i class="fas fa-bell mr-2"></i><strong>Naloko Na o Nawalan ng Pera?</strong> Agad tumawag sa bangko para i-block ang card at account. I-save ang lahat ng ebidensya (screenshot, receipts, conversation) at ireport sa PNP Anti-Cybercrime Group!
                        </div>
                    `
                },
                unauthorized_access: {
                    title: '<i class="fas fa-user-lock mr-2"></i>Pagpasok Nang Walang Pahintulot (Unauthorized Access)',
                    content: `
                        <h5 class="mb-3" style="color: #6f42c1;">Ano ang Unauthorized Access?</h5>
                        <p>Ang <strong>unauthorized access</strong> ay ang iligal na pagpasok sa inyong computer, cellphone, account, o network nang walang pahintulot. Ginagawa ito upang nakawin ang impormasyon, pera, o para sirain ang inyong device.</p>
                        
                        <h5 class="mt-4 mb-3" style="color: #6f42c1;">Paano Nangyayari ang Unauthorized Access?</h5>
                        <div class="alert alert-light" style="border-left: 4px solid #6f42c1;">
                            <p><strong>1. Mahina ang Password</strong><br>
                            Kung simple lang ang password (tulad ng "123456" o birthday), madali itong hulaan ng hacker.</p>
                            
                            <p><strong>2. Virus o Malware</strong><br>
                            Pag nag-download kayo ng suspicious na file o app, puwede itong mag-install ng virus na magbibigay ng access sa hacker.</p>
                            
                            <p><strong>3. Public WiFi</strong><br>
                            Ang mga hacker ay puwedeng makita ang inyong online activity kapag gumamit kayo ng public WiFi sa mall o kape.</p>
                            
                            <p><strong>4. Outdated Software</strong><br>
                            Ang lumang version ng apps o operating system ay may mga butas sa security na maaaring pasukin.</p>
                        </div>
                        
                        <h5 class="mt-4 mb-3" style="color: #6f42c1;">Mga Senyales na Na-hack Kayo:</h5>
                        <ul>
                            <li><i class="fas fa-exclamation-triangle mr-2" style="color: #6f42c1;"></i>Biglang kumagal ang computer o cellphone</li>
                            <li><i class="fas fa-lock-open mr-2" style="color: #6f42c1;"></i>Hindi kayo makapag-log in sa sariling account</li>
                            <li><i class="fas fa-paper-plane mr-2" style="color: #6f42c1;"></i>May mga message o post na hindi ninyo ginawa</li>
                            <li><i class="fas fa-envelope mr-2" style="color: #6f42c1;"></i>Nag-iba ang password o email address ng account</li>
                            <li><i class="fas fa-bell mr-2" style="color: #6f42c1;"></i>Tumatanggap ng notification tungkol sa device na hindi ninyo alam</li>
                        </ul>
                        
                        <h5 class="mt-4 mb-3" style="color: #6f42c1;">Paano Maiwasan ang Unauthorized Access?</h5>
                        <div class="alert alert-success">
                            <p class="mb-2"><i class="fas fa-key text-success mr-2"></i><strong>Gumamit ng malakas na password</strong> - combination ng letters, numbers, at symbols</p>
                            <p class="mb-2"><i class="fas fa-mobile-alt text-success mr-2"></i><strong>I-on ang Two-Factor Authentication</strong> (2FA) para dagdag proteksyon</p>
                            <p class="mb-2"><i class="fas fa-sync text-success mr-2"></i><strong>I-update ang apps at operating system</strong> regularly</p>
                            <p class="mb-2"><i class="fas fa-shield-virus text-success mr-2"></i><strong>Mag-install ng anti-virus</strong> sa computer at cellphone</p>
                            <p class="mb-2"><i class="fas fa-wifi text-success mr-2"></i><strong>Iwasan ang public WiFi</strong> kapag mag-log in sa sensitive accounts</p>
                            <p class="mb-0"><i class="fas fa-download text-success mr-2"></i><strong>Mag-ingat sa pag-download</strong> - galing lang sa trusted sources</p>
                        </div>
                        
                        <div class="alert alert-danger mt-3">
                            <i class="fas fa-first-aid mr-2"></i><strong>Kapag Na-hack Na:</strong> Agad palitan ang lahat ng password, i-log out sa lahat ng device, at ireport sa PNP Anti-Cybercrime Group!
                        </div>
                    `
                },
                cyberbullying: {
                    title: '<i class="fas fa-bullhorn mr-2"></i>Pang-aabuso sa Internet (Cyberbullying)',
                    content: `
                        <h5 class="mb-3" style="color: #e83e8c;">Ano ang Cyberbullying?</h5>
                        <p>Ang <strong>cyberbullying</strong> o pang-aabuso sa internet ay ang pag-api, pananakot, pagpapahiya, o pag-insulto sa isang tao gamit ang internet o social media. Ito ay isang krimen at may parusa sa batas.</p>
                        
                        <h5 class="mt-4 mb-3" style="color: #e83e8c;">Mga Halimbawa ng Cyberbullying:</h5>
                        <div class="alert alert-light" style="border-left: 4px solid #e83e8c;">
                            <p><strong>1. Pagbabanta Online</strong><br>
                            Pagpapadala ng mga mensahe na nakakatakot o nangbabanta ng pisikal na karahasan.</p>
                            
                            <p><strong>2. Pag-uusig sa Internet (Cyberstalking)</strong><br>
                            Sunod-sunod na mensahe, pag-comment, o pag-tag sa tao na ayaw nang makipag-usap.</p>
                            
                            <p><strong>3. Pagpapahiya o Pag-insulto</strong><br>
                            Pag-post ng nakakahiyang litrato, video, o impormasyon para pagpahiyain ang tao.</p>
                            
                            <p><strong>4. Pag-spread ng Kasinungalingan</strong><br>
                            Paggawa ng fake news o tsismis tungkol sa isang tao para sirain ang reputasyon.</p>
                            
                            <p><strong>5. Pag-hack at Paggamit ng Account</strong><br>
                            Pagpasok sa account ng iba para mag-post ng nakakahiyang bagay.</p>
                        </div>
                        
                        <h5 class="mt-4 mb-3" style="color: #e83e8c;">Epekto ng Cyberbullying:</h5>
                        <ul>
                            <li><i class="fas fa-sad-tear mr-2" style="color: #e83e8c;"></i>Pagkadepres, pagkabalisa, at pangamba</li>
                            <li><i class="fas fa-heart-broken mr-2" style="color: #e83e8c;"></i>Pagkawala ng tiwala sa sarili</li>
                            <li><i class="fas fa-user-times mr-2" style="color: #e83e8c;"></i>Pag-iwas sa social media at mga kaibigan</li>
                            <li><i class="fas fa-head-side-virus mr-2" style="color: #e83e8c;"></i>Stress at problema sa mental health</li>
                            <li><i class="fas fa-exclamation-circle mr-2" style="color: #e83e8c;"></i>Sa malubhang kaso, puwedeng mauwi sa self-harm</li>
                        </ul>
                        
                        <h5 class="mt-4 mb-3" style="color: #e83e8c;">Ano ang Gagawin Kung Biktima Kayo?</h5>
                        <div class="alert alert-warning">
                            <p class="mb-2"><i class="fas fa-save text-warning mr-2"></i><strong>I-save ang ebidensya</strong> - screenshot ng mga mensahe, comment, at post</p>
                            <p class="mb-2"><i class="fas fa-ban text-warning mr-2"></i><strong>I-block ang tao</strong> na nang-aapi sa inyo</p>
                            <p class="mb-2"><i class="fas fa-flag text-warning mr-2"></i><strong>I-report</strong> sa social media platform at PNP</p>
                            <p class="mb-2"><i class="fas fa-comments text-warning mr-2"></i><strong>Magsabi sa mga magulang</strong>, guro, o taong pinagkakatiwalaan</p>
                            <p class="mb-0"><i class="fas fa-reply text-warning mr-2"></i><strong>Huwag sumagot</strong> o makipag-away pa - mas lalala lang</p>
                        </div>
                        
                        <h5 class="mt-4 mb-3" style="color: #e83e8c;">Paano Maiwasan ang Cyberbullying?</h5>
                        <div class="alert alert-success">
                            <p class="mb-2"><i class="fas fa-lock text-success mr-2"></i><strong>I-private ang social media</strong> accounts</p>
                            <p class="mb-2"><i class="fas fa-user-slash text-success mr-2"></i><strong>Huwag magpost</strong> ng masyadong personal na impormasyon</p>
                            <p class="mb-2"><i class="fas fa-users-slash text-success mr-2"></i><strong>Mag-ingat sa pag-accept</strong> ng friend request mula sa hindi kilala</p>
                            <p class="mb-0"><i class="fas fa-thumbs-up text-success mr-2"></i><strong>Maging mabuti online</strong> - huwag maging bully sa iba</p>
                        </div>
                        
                        <div class="alert alert-danger mt-3">
                            <i class="fas fa-gavel mr-2"></i><strong>Alalahanin:</strong> Ang cyberbullying ay may parusa sa Anti-Cybercrime Law. Puwedeng makasuhan at makulong ang gumawa nito!
                        </div>
                    `
                }
            };
            
            const threat = threats[threatType];
            if (threat) {
                $('#threatModalLabel').html(threat.title);
                $('#threatModalBody').html(threat.content);
                $('#threatModal').modal('show');
            }
        }
        
        $(document).ready(function() {
            // Add cursor pointer to tutorial cards
            $('.tutorial-image-container').css('cursor', 'pointer');
            
            // Add hover effect for tutorial cards
            $('.tutorial-card').on('mouseenter', function() {
                $(this).find('.tutorial-overlay').css('opacity', '1');
            }).on('mouseleave', function() {
                $(this).find('.tutorial-overlay').css('opacity', '0');
            });
            
            // Smooth scrolling for any anchor links
            $('a[href^="#"]').on('click', function(event) {
                var target = $(this.getAttribute('href'));
                if (target.length) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top
                    }, 1000);
                }
            });
            
            // Add loading animation for images
            $('.tutorial-image').on('load', function() {
                $(this).closest('.tutorial-card').addClass('loaded');
            });
            
            // Ensure modal is properly initialized
            $('#imageModal').on('shown.bs.modal', function() {
                $(this).find('.modal-dialog').addClass('modal-dialog-centered');
            });
        });
    </script>

</body>
</html>
