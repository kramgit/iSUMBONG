<?php
include '../../connectMySql.php';
include '../../loginverification.php';
include '../../includes/theme_system.php';
if(logged_in()){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cybersecurity Threats - Learn about common cyber threats">
    <meta name="author" content="">

    <title>Threats - iReport</title>
    <link rel="icon" type="image/x-icon" href="../../img/logo1.png" />

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="../../js/sweetalert2.all.js"></script>
    <?php echo getThemeMeta(); ?>
    <?php echo getThemeIncludes('../../'); ?>
    
    <style>
        /* Custom Threats Page Styles */
        .threats-hero {
            animation: fadeIn 1s ease-in-out;
        }
        
        /* Video Container Responsive Styles */
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            max-width: 100%;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 0.5rem;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .threat-card {
            transition: all 0.3s ease;
        }
        
        .threat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
        }
        
        .threat-icon {
            transition: all 0.3s ease;
        }
        
        .threat-card:hover .threat-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        .protection-tip {
            transition: all 0.3s ease;
        }
        
        .protection-tip:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
        }
        
        .tip-icon {
            transition: all 0.3s ease;
        }
        
        .protection-tip:hover .tip-icon {
            transform: scale(1.1);
        }
        
        .btn {
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
        }
        
        /* Hero buttons animation */
        .hero-buttons .btn {
            animation: slideUp 1s ease-in-out 0.5s both;
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Responsive Design for Threats Page */
        @media (max-width: 1200px) {
            .container {
                max-width: 100%;
                padding-left: 20px;
                padding-right: 20px;
            }
            
            .display-3 {
                font-size: 3rem !important;
            }
            
            .threats-hero {
                min-height: 55vh !important;
            }
            
            .threat-card, .protection-tip {
                padding: 1.5rem !important;
            }
        }
        
        @media (max-width: 992px) {
            .threats-hero {
                min-height: 60vh !important;
                text-align: center;
            }
            
            .display-3 {
                font-size: 2.5rem !important;
            }
            
            .lead {
                font-size: 1.2rem !important;
            }
            
            .hero-buttons .btn {
                margin-bottom: 1rem;
                display: inline-block;
                width: auto;
            }
            
            .col-lg-4, .col-lg-3 {
                margin-bottom: 2rem;
            }
            
            .threat-card, .protection-tip {
                padding: 1.5rem !important;
            }
            
            .threat-icon {
                width: 60px !important;
                height: 60px !important;
            }
            
            .threat-icon i {
                font-size: 1.5rem !important;
            }
        }
        
        @media (max-width: 768px) {
            .threats-hero {
                min-height: 70vh !important;
                padding: 2rem 0;
            }
            
            .display-3 {
                font-size: 2.2rem !important;
            }
            
            .lead {
                font-size: 1.1rem !important;
            }
            
            .hero-buttons .btn {
                margin-bottom: 1rem;
                display: block;
                width: 100%;
                margin-right: 0 !important;
            }
            
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
            
            .py-5 {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }
            
            .threat-card, .protection-tip {
                padding: 1.2rem !important;
                margin-bottom: 1.5rem !important;
            }
            
            .threat-icon {
                width: 50px !important;
                height: 50px !important;
            }
            
            .threat-icon i {
                font-size: 1.3rem !important;
            }
            
            .tip-icon {
                width: 50px !important;
                height: 50px !important;
            }
            
            .tip-icon i {
                font-size: 1rem !important;
            }
            
            h4 {
                font-size: 1.3rem !important;
            }
            
            h5 {
                font-size: 1.1rem !important;
            }
            
            h2 {
                font-size: 1.8rem !important;
            }
            
            .btn-sm {
                padding: 0.4rem 0.8rem;
                font-size: 0.85rem;
            }
            
            .col-lg-4, .col-md-6 {
                margin-bottom: 1.5rem;
            }
            
            .col-lg-3, .col-md-6 {
                margin-bottom: 1.5rem;
            }
        }
        
        @media (max-width: 576px) {
            .threats-hero {
                min-height: 80vh !important;
                padding: 1.5rem 0;
            }
            
            .display-3 {
                font-size: 2rem !important;
            }
            
            .lead {
                font-size: 1rem !important;
            }
            
            .container {
                padding-left: 10px;
                padding-right: 10px;
            }
            
            .py-5 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
            }
            
            .threat-card, .protection-tip {
                padding: 1rem !important;
                margin-bottom: 1rem !important;
            }
            
            .threat-icon {
                width: 45px !important;
                height: 45px !important;
            }
            
            .threat-icon i {
                font-size: 1.2rem !important;
            }
            
            .tip-icon {
                width: 45px !important;
                height: 45px !important;
            }
            
            .tip-icon i {
                font-size: 0.9rem !important;
            }
            
            h4 {
                font-size: 1.2rem !important;
            }
            
            h5 {
                font-size: 1rem !important;
            }
            
            h2 {
                font-size: 1.6rem !important;
            }
            
            .btn-sm {
                padding: 0.3rem 0.6rem;
                font-size: 0.8rem;
            }
            
            .hero-buttons .btn {
                font-size: 0.85rem;
                padding: 0.7rem 1.2rem;
            }
            
            p.text-muted {
                font-size: 0.9rem;
            }
            
            .small {
                font-size: 0.8rem !important;
            }
        }
        
        @media (max-width: 400px) {
            .display-3 {
                font-size: 1.8rem !important;
            }
            
            .container {
                padding-left: 8px;
                padding-right: 8px;
            }
            
            .threat-card, .protection-tip {
                padding: 0.8rem !important;
            }
            
            .threat-icon {
                width: 40px !important;
                height: 40px !important;
            }
            
            .threat-icon i {
                font-size: 1rem !important;
            }
            
            .tip-icon {
                width: 40px !important;
                height: 40px !important;
            }
            
            .tip-icon i {
                font-size: 0.8rem !important;
            }
            
            h4 {
                font-size: 1.1rem !important;
            }
            
            h5 {
                font-size: 0.9rem !important;
            }
            
            h2 {
                font-size: 1.4rem !important;
            }
            
            .btn-sm {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
            
            .hero-buttons .btn {
                font-size: 0.8rem;
                padding: 0.6rem 1rem;
            }
            
            p.text-muted {
                font-size: 0.85rem;
            }
            
            .small {
                font-size: 0.75rem !important;
            }
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div class="container-fluid p-0">

        <!-- Navigation -->
        <?php include'../nav.php';?>

        <!-- Main Content -->
        <div class="container-fluid p-0">
            
            <!-- Hero Section -->
            <section class="threats-hero" style="background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%); min-height: 60vh; display: flex; align-items: center; position: relative; overflow: hidden;">
                <!-- Background Pattern -->
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.05) 1px, transparent 1px); background-size: 50px 50px; opacity: 0.3;"></div>
                
                <div class="container text-center">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-white">
                            <h1 class="display-3 font-weight-bold mb-4" style="font-size: 3.5rem; line-height: 1.1;">
                                Cybersecurity <span style="color: #3498db;">Threats</span>
                            </h1>
                            <p class="lead mb-5" style="font-size: 1.3rem; opacity: 0.9; max-width: 600px; margin: 0 auto;">
                                Alamin ang mga common cyber threats at kung paano protektahan ang inyong sarili laban dito.
                            </p>
                            
                            <!-- Action Buttons -->
                            <div class="hero-buttons">
                                <a href="../dashboard/" class="btn btn-outline-light btn-lg mr-3 px-4 py-3" style="border-radius: 50px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; border-width: 2px;">
                                    <i class="fas fa-home mr-2"></i>Back to Dashboard
                                </a>
                                <a href="#threats-section" class="btn btn-danger btn-lg px-4 py-3" style="border-radius: 50px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">
                                    <i class="fas fa-shield-alt mr-2"></i>Alamin ang mga Threats
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Cybersecurity Incidents Section -->
            <section id="threats-section" class="incidents-section py-5" style="background: #f8f9fa;">
                <div class="container">
                    <div class="row text-center mb-5">
                        <div class="col-12">
                            <h2 class="font-weight-bold text-dark mb-3">Mga Cybersecurity Incidents</h2>
                            <p class="text-muted">Intindihin ang mga pinakacommon na online threats at kung paano iwasan ang mga ito.</p>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center">
                        <!-- Phishing -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="threat-card h-100" style="background: white; border-radius: 1rem; padding: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08); border: none; transition: all 0.3s ease;">
                                <div class="threat-icon mb-3" style="width: 70px; height: 70px; background: linear-gradient(45deg, #1e3c72, #2a5298); border-radius: 1rem; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-fish text-white fa-2x"></i>
                                </div>
                                <h4 class="font-weight-bold text-dark mb-2">Panlilinlang sa Internet (Phishing)</h4>
                                <p class="text-muted mb-3">Mga manlolokong mensahe o email na naglalayong nakawin ang inyong personal na impormasyon, password, o datos pangkabuhayan.</p>
                                <ul class="list-unstyled text-left small mb-3">
                                    <li><i class="fas fa-exclamation-circle mr-2" style="color: #1e3c72;"></i>Pekeng login page</li>
                                    <li><i class="fas fa-exclamation-circle mr-2" style="color: #1e3c72;"></i>Kahina-hinalang link sa email</li>
                                    <li><i class="fas fa-exclamation-circle mr-2" style="color: #1e3c72;"></i>Pagpapanggap na ibang tao</li>
                                </ul>
                                <a href="#" class="btn btn-sm view-details-btn" style="border-color: #1e3c72; color: #1e3c72;" data-threat="phishing">
                                    Tingnan ang details <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Identity Theft -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="threat-card h-100" style="background: white; border-radius: 1rem; padding: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08); border: none; transition: all 0.3s ease;">
                                <div class="threat-icon mb-3" style="width: 70px; height: 70px; background: linear-gradient(45deg, #1e3c72, #2a5298); border-radius: 1rem; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user-secret text-white fa-2x"></i>
                                </div>
                                <h4 class="font-weight-bold text-dark mb-2">Pagnanakaw ng Pagkakakilanlan (Identity Theft)</h4>
                                <p class="text-muted mb-3">Ang di-awtorisadong paggamit ng personal na impormasyon ng isang tao upang magpanggap o pasukin ang kanilang mga account.</p>
                                <ul class="list-unstyled text-left small mb-3">
                                    <li><i class="fas fa-exclamation-circle mr-2" style="color: #1e3c72;"></i>Nakawin ang ID o dokumento</li>
                                    <li><i class="fas fa-exclamation-circle mr-2" style="color: #1e3c72;"></i>Hindi awtorisadong pag-access ng account</li>
                                    <li><i class="fas fa-exclamation-circle mr-2" style="color: #1e3c72;"></i>Pekeng profile</li>
                                </ul>
                                <a href="#" class="btn btn-sm view-details-btn" style="border-color: #1e3c72; color: #1e3c72;" data-threat="identity">
                                    Tingnan ang details <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Online Fraud -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="threat-card h-100" style="background: white; border-radius: 1rem; padding: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08); border: none; transition: all 0.3s ease;">
                                <div class="threat-icon mb-3" style="width: 70px; height: 70px; background: linear-gradient(45deg, #1e3c72, #2a5298); border-radius: 1rem; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-money-bill-wave text-white fa-2x"></i>
                                </div>
                                <h4 class="font-weight-bold text-dark mb-2">Pandaraya sa Internet (Online Fraud)</h4>
                                <p class="text-muted mb-3">Mga mapanlinlang na gawain sa internet tulad ng panloloko sa pera, investment scam, at iba pang online scams.</p>
                                <ul class="list-unstyled text-left small mb-3">
                                    <li><i class="fas fa-exclamation-circle mr-2" style="color: #1e3c72;"></i>Pandaraya sa credit card at banking</li>
                                    <li><i class="fas fa-exclamation-circle mr-2" style="color: #1e3c72;"></i>Panloloko sa investment at online shopping</li>
                                    <li><i class="fas fa-exclamation-circle mr-2" style="color: #1e3c72;"></i>Romance scam at job offer scam</li>
                                </ul>
                                <a href="#" class="btn btn-sm view-details-btn" style="border-color: #1e3c72; color: #1e3c72;" data-threat="fraud">
                                    Tingnan ang details <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Hacking/Unauthorized Access -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="threat-card h-100" style="background: white; border-radius: 1rem; padding: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08); border: none; transition: all 0.3s ease;">
                                <div class="threat-icon mb-3" style="width: 70px; height: 70px; background: linear-gradient(45deg, #1e3c72, #2a5298); border-radius: 1rem; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user-lock text-white fa-2x"></i>
                                </div>
                                <h4 class="font-weight-bold text-dark mb-2">Unauthorized Access / Hacking</h4>
                                <p class="text-muted mb-3">Ang iligal na pag-access sa mga computer system, network, o account nang walang awtorisasyon.</p>
                                <ul class="list-unstyled text-left small mb-3">
                                    <li><i class="fas fa-exclamation-circle mr-2" style="color: #1e3c72;"></i>Pag-agaw ng account</li>
                                    <li><i class="fas fa-exclamation-circle mr-2" style="color: #1e3c72;"></i>Hindi awtorisadong pagpasok sa network</li>
                                    <li><i class="fas fa-exclamation-circle mr-2" style="color: #1e3c72;"></i>Pagsira sa system</li>
                                </ul>
                                <a href="#" class="btn btn-sm view-details-btn" style="border-color: #1e3c72; color: #1e3c72;" data-threat="unauthorized">
                                    Tingnan ang details <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Cyberbullying -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="threat-card h-100" style="background: white; border-radius: 1rem; padding: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08); border: none; transition: all 0.3s ease;">
                                <div class="threat-icon mb-3" style="width: 70px; height: 70px; background: linear-gradient(45deg, #1e3c72, #2a5298); border-radius: 1rem; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-bullhorn text-white fa-2x"></i>
                                </div>
                                <h4 class="font-weight-bold text-dark mb-2">Pang-aabuso sa Internet (Cyberbullying)</h4>
                                <p class="text-muted mb-3">Pang-aapi, pagbabanta, o pananakot sa pamamagitan ng internet at social media.</p>
                                <ul class="list-unstyled text-left small mb-3">
                                    <li><i class="fas fa-exclamation-circle mr-2" style="color: #1e3c72;"></i>Pagbabanta online</li>
                                    <li><i class="fas fa-exclamation-circle mr-2" style="color: #1e3c72;"></i>Pag-uusig sa internet</li>
                                    <li><i class="fas fa-exclamation-circle mr-2" style="color: #1e3c72;"></i>Pang-aapi sa digital</li>
                                </ul>
                                <a href="#" class="btn btn-sm view-details-btn" style="border-color: #1e3c72; color: #1e3c72;" data-threat="cyberbullying">
                                    Tingnan ang details <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Protection Tips Section -->
            <section class="protection-section py-5">
                <div class="container">
                    <div class="row text-center mb-5">
                        <div class="col-12">
                            <h2 class="font-weight-bold text-dark mb-3">Mga Gabay sa Protection</h2>
                            <p class="text-muted">Essential security practices para manatiling safe online</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="protection-tip text-center p-4" style="background: white; border-radius: 1rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08); height: 100%;">
                                <div class="tip-icon mb-3" style="width: 60px; height: 60px; background: linear-gradient(45deg, #3498db, #2980b9); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                    <i class="fas fa-key text-white fa-lg"></i>
                                </div>
                                <h5 class="font-weight-bold mb-3">Malakas na Passwords</h5>
                                <p class="text-muted small">Gumamit ng complex passwords na may numbers, symbols, at letters. I-enable ang two-factor authentication.</p>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="protection-tip text-center p-4" style="background: white; border-radius: 1rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08); height: 100%;">
                                <div class="tip-icon mb-3" style="width: 60px; height: 60px; background: linear-gradient(45deg, #e74c3c, #c0392b); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                    <i class="fas fa-eye text-white fa-lg"></i>
                                </div>
                                <h5 class="font-weight-bold mb-3">I-verify ang Sources</h5>
                                <p class="text-muted small">Laging i-verify ang email senders at website URLs bago mag-click ng links o mag-download ng files.</p>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="protection-tip text-center p-4" style="background: white; border-radius: 1rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08); height: 100%;">
                                <div class="tip-icon mb-3" style="width: 60px; height: 60px; background: linear-gradient(45deg, #27ae60, #229954); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                    <i class="fas fa-sync text-white fa-lg"></i>
                                </div>
                                <h5 class="font-weight-bold mb-3">Palaging I-update</h5>
                                <p class="text-muted small">Regular na i-update ang inyong software, operating system, at antivirus programs.</p>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="protection-tip text-center p-4" style="background: white; border-radius: 1rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08); height: 100%;">
                                <div class="tip-icon mb-3" style="width: 60px; height: 60px; background: linear-gradient(45deg, #f39c12, #e67e22); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                    <i class="fas fa-exclamation-triangle text-white fa-lg"></i>
                                </div>
                                <h5 class="font-weight-bold mb-3">I-report ang mga Incidents</h5>
                                <p class="text-muted small">Agad na i-report ang anumang suspicious activity o security incidents sa appropriate authorities.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Educational Videos Section -->
            <section class="videos-section py-5" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
                <div class="container">
                    <div class="row text-center mb-5">
                        <div class="col-12">
                            <h2 class="font-weight-bold text-white mb-3"><i class="fas fa-play-circle mr-2"></i>Educational Videos</h2>
                            <p class="text-white-50">Panoorin ang mga video tungkol sa cybersecurity threats at paano protektahan ang sarili</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Video 1: Cybersecurity Basics -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="video-card h-100" style="background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2); transition: all 0.3s ease;">
                                <div class="video-container" style="padding-bottom: 56.25%; position: relative; height: 0;">
                                    <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;" src="https://www.youtube.com/embed/inWWhr5tnEA" title="What is Cybersecurity?" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <div class="p-4">
                                    <h5 class="font-weight-bold text-dark mb-2"><i class="fas fa-shield-alt mr-2" style="color: #1e3c72;"></i>Ano ang Cybersecurity?</h5>
                                    <p class="text-muted small mb-0">Alamin ang basics ng cybersecurity at kung bakit ito mahalaga sa ating pang-araw-araw na buhay online.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Video 2: Phishing Attacks -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="video-card h-100" style="background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2); transition: all 0.3s ease;">
                                <div class="video-container" style="padding-bottom: 56.25%; position: relative; height: 0;">
                                    <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;" src="https://www.youtube.com/embed/XBkzBrXlle0" title="Phishing Explained" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <div class="p-4">
                                    <h5 class="font-weight-bold text-dark mb-2"><i class="fas fa-fish mr-2" style="color: #1e3c72;"></i>Phishing Attacks</h5>
                                    <p class="text-muted small mb-0">Paano gumagana ang phishing attacks at paano ito maiiwasan. Matutong makilala ang mga fake emails at websites.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Video 3: Online Scams -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="video-card h-100" style="background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2); transition: all 0.3s ease;">
                                <div class="video-container" style="padding-bottom: 56.25%; position: relative; height: 0;">
                                    <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;" src="https://www.youtube.com/embed/PWVN3Rq4gzw" title="Common Online Scams" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <div class="p-4">
                                    <h5 class="font-weight-bold text-dark mb-2"><i class="fas fa-money-bill-wave mr-2" style="color: #1e3c72;"></i>Online Scams</h5>
                                    <p class="text-muted small mb-0">Mga common na online scams sa Pilipinas at kung paano protektahan ang iyong pera at personal na impormasyon.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Video 4: Password Security -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="video-card h-100" style="background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2); transition: all 0.3s ease;">
                                <div class="video-container" style="padding-bottom: 56.25%; position: relative; height: 0;">
                                    <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;" src="https://www.youtube.com/embed/3NjQ9b3pgIg" title="Password Security Tips" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <div class="p-4">
                                    <h5 class="font-weight-bold text-dark mb-2"><i class="fas fa-key mr-2" style="color: #1e3c72;"></i>Password Security</h5>
                                    <p class="text-muted small mb-0">Paano gumawa ng strong passwords at kung bakit mahalaga ang two-factor authentication.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Video 5: Social Media Safety -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="video-card h-100" style="background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2); transition: all 0.3s ease;">
                                <div class="video-container" style="padding-bottom: 56.25%; position: relative; height: 0;">
                                    <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;" src="https://www.youtube.com/embed/6Z1WDe0n-bQ" title="Social Media Safety" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <div class="p-4">
                                    <h5 class="font-weight-bold text-dark mb-2"><i class="fas fa-users mr-2" style="color: #1e3c72;"></i>Social Media Safety</h5>
                                    <p class="text-muted small mb-0">Mga tips para manatiling safe sa social media at protektahan ang iyong privacy online.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Video 6: Identity Theft -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="video-card h-100" style="background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2); transition: all 0.3s ease;">
                                <div class="video-container" style="padding-bottom: 56.25%; position: relative; height: 0;">
                                    <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;" src="https://www.youtube.com/embed/kDFeSUUwRnA" title="Identity Theft Prevention" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <div class="p-4">
                                    <h5 class="font-weight-bold text-dark mb-2"><i class="fas fa-user-secret mr-2" style="color: #1e3c72;"></i>Identity Theft</h5>
                                    <p class="text-muted small mb-0">Paano maiiwasan ang identity theft at ano ang gagawin kung ikaw ay naging biktima nito.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- More Videos CTA -->
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <a href="https://www.youtube.com/results?search_query=cybersecurity+awareness+philippines" target="_blank" class="btn btn-outline-light btn-lg px-5" style="border-radius: 50px; font-weight: 600;">
                                <i class="fab fa-youtube mr-2"></i>Maghanap ng Karagdagang Videos
                            </a>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <!-- End of Main Content -->
        
        <!-- Custom Styles -->
        <style>
            /* Video Card Hover Effects */
            .video-card {
                transition: all 0.3s ease;
            }
            
            .video-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(0,0,0,0.3) !important;
            }
            
            /* Hero Animation */
            .threats-hero {
                animation: fadeIn 1s ease-in-out;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            /* Threat Card Hover Effects */
            .threat-card {
                transition: all 0.3s ease;
            }
            
            .threat-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
            }
            
            .threat-card:hover .threat-icon {
                transform: scale(1.1) rotate(5deg);
            }
            
            /* Protection Tip Hover */
            .protection-tip {
                transition: all 0.3s ease;
            }
            
            .protection-tip:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
            }
            
            .protection-tip:hover .tip-icon {
                transform: scale(1.1);
            }
            
            /* Icon Animations */
            .threat-icon, .tip-icon {
                transition: all 0.3s ease;
            }
            
            /* Button Hover Effects */
            .btn {
                transition: all 0.3s ease;
            }
            
            .btn:hover {
                transform: translateY(-2px);
            }
            
            /* Section Animations */
            .incidents-section, .protection-section {
                animation: slideUp 1s ease-in-out 0.3s both;
            }
            
            @keyframes slideUp {
                from { opacity: 0; transform: translateY(50px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            /* Smooth Scroll */
            html {
                scroll-behavior: smooth;
            }
            
            /* Responsive Design */
            @media (max-width: 768px) {
                .display-3 {
                    font-size: 2.5rem !important;
                }
                
                .hero-buttons .btn {
                    margin-bottom: 1rem;
                    display: block;
                    width: 100%;
                }
                
                .threat-card, .protection-tip {
                    margin-bottom: 2rem;
                }
            }
        </style>
        
        <?php include'../footer.php';?>

    </div>
    <!-- End of Page Wrapper -->

    <!-- Threat Details Modal -->
    <div class="modal fade" id="threatModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="threatModalTitle">Threat Details</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="threatModalBody" style="max-height: 70vh; overflow-y: auto;">
                    <!-- Content will be loaded dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="../incident/register.php" class="btn btn-danger">I-report ang Incident</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <script>
        // Threat Details Data with comprehensive information, real cases, and sample images
        const threatDetails = {
            phishing: {
                title: "Panlilinlang sa Internet (Phishing)",
                content: `
                    <div class="threat-detail">
                        <!-- Video Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-video mr-2"></i>Panoorin: Ano ang Phishing?</h5>
                                <div style="max-width: 600px; margin: 0 auto;">
                                    <div class="video-container">
                                        <iframe src="https://www.youtube.com/embed/XBkzBrXlle0" title="What is Phishing?" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <p class="small text-muted"><i class="fas fa-info-circle mr-1"></i>Video: Learn how phishing attacks work and how to protect yourself.</p>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-question-circle mr-2"></i>Ano ang Phishing?</h5>
                                <p>Ang <strong>phishing</strong> ay isang uri ng panloloko sa internet kung saan ang mga kriminal ay nagpapanggap na kilalang kumpanya o tao upang nakawin ang inyong mga personal na impormasyon tulad ng password, credit card number, o bank account details.</p>
                                
                                <div class="alert alert-info mb-3">
                                    <h6 class="font-weight-bold mb-2"><i class="fas fa-info-circle mr-2"></i>Bakit "Phishing"?</h6>
                                    <p class="mb-0 small">Ang salitang ito ay nanggaling sa "fishing" dahil parang pangingisda rin - gumagamit ang mga scammer ng "pain" (bait) upang "hulihin" ang mga biktima!</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="font-weight-bold mb-2" style="color: #1e3c72;"><i class="fas fa-image mr-2"></i>Halimbawa ng Phishing Email:</h6>
                                <div class="card mb-3" style="border-color: #1e3c72;">
                                    <div class="card-body bg-light p-3" style="font-family: monospace; font-size: 0.85rem;">
                                        <p class="mb-1"><strong>From:</strong> security@bankofph-verify.com <span style="color: #1e3c72;">❌</span></p>
                                        <p class="mb-1"><strong>Subject:</strong> ⚠️ URGENT: Your account will be suspended!</p>
                                        <hr class="my-2">
                                        <p class="mb-1">Dear Valued Customer,</p>
                                        <p class="mb-1">We detected unusual activity in your account. Click the link below to verify your identity immediately or your account will be suspended in 24 hours.</p>
                                        <p class="mb-1" style="color: #1e3c72;"><u>http://bankofph-secure-login.xyz/verify</u> ❌</p>
                                        <p class="mb-0 small text-muted">Notice: Pekeng domain at urgent language!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-exclamation-triangle mr-2"></i>Paano Nangyayari ang Phishing?</h5>
                        <div class="alert alert-light" style="border-left: 4px solid #1e3c72 !important;">
                            <p><strong>1. Pekeng Email o Mensahe</strong><br>
                            Makakatanggap kayo ng email o text message na mukhang galing sa bangko, online shopping site, o gobyerno. Sasabihin nila na may problema sa inyong account at kailangan ninyong mag-log in kaagad.</p>
                            
                            <p><strong>2. Pekeng Website</strong><br>
                            Kapag nag-click kayo sa link sa email, dadalhin kayo sa pekeng website na halos kamukha ng tunay. Kapag nag-type kayo ng username at password dito, makukuha nila ito.</p>
                            
                            <p class="mb-0"><strong>3. Pagnanakaw ng Impormasyon</strong><br>
                            Gagamitin nila ang inyong username at password para pasukin ang inyong tunay na account at nakawin ang inyong pera o personal na datos.</p>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-book-open mr-2"></i>SCENARIOS</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card h-100" style="border-left: 4px solid #1e3c72;">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold" style="color: #1e3c72;"><i class="fas fa-user mr-2"></i>Si Maria at ang GCash Scam</h6>
                                        <p class="small mb-2"><strong>Nangyari:</strong> Nakatanggap si Maria ng text na "Your GCash account is locked. Click here to verify." Nag-click siya at nag-input ng MPIN. Nawala ang ₱15,000 sa kanyang account.</p>
                                        <p class="small mb-0 text-success"><strong>Paano Maiiwasan:</strong> Huwag mag-click ng links sa text. Direktang buksan ang GCash app o tumawag sa official hotline (2882).</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100" style="border-left: 4px solid #1e3c72;">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold" style="color: #1e3c72;"><i class="fas fa-user mr-2"></i>Si Juan at ang Bank Email</h6>
                                        <p class="small mb-2"><strong>Nangyari:</strong> May email si Juan na "Update your BDO account or it will be suspended." Nag-login siya sa pekeng website. Kinabukasan, may unauthorized withdrawal na ₱50,000.</p>
                                        <p class="small mb-0 text-success"><strong>Paano Maiiwasan:</strong> I-check ang email address ng sender. Ang legit na banks ay hindi nagpapadala ng ganitong urgent emails. Pumunta sa official website directly.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100" style="border-left: 4px solid #1e3c72;">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold" style="color: #1e3c72;"><i class="fas fa-user mr-2"></i>Si Ana at ang Facebook Message</h6>
                                        <p class="small mb-2"><strong>Nangyari:</strong> Nag-message ang "friend" ni Ana na may free load promo. Nag-click siya at hiningan ng Facebook password. Na-hack ang account niya at ginamit para mang-scam ng iba.</p>
                                        <p class="small mb-0 text-success"><strong>Paano Maiiwasan:</strong> Huwag ibigay ang password kahit kanino. I-verify muna sa kaibigan through call o personal na makipag-usap.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold text-primary mb-3"><i class="fas fa-shield-alt mr-2"></i>Paano Maprotektahan ang Sarili</h5>
                        <div class="row">
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-mouse-pointer fa-2x text-primary mb-2"></i>
                                    <p class="small mb-0 font-weight-bold">Huwag mag-click ng suspicious links</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-search fa-2x text-primary mb-2"></i>
                                    <p class="small mb-0 font-weight-bold">I-verify ang sender bago mag-respond</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-lock fa-2x text-primary mb-2"></i>
                                    <p class="small mb-0 font-weight-bold">Huwag ibigay ang OTP kahit kanino</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-phone fa-2x text-primary mb-2"></i>
                                    <p class="small mb-0 font-weight-bold">Tawagan ang official hotline kung may duda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `
            },
            identity: {
                title: "Pagnanakaw ng Pagkakakilanlan (Identity Theft)",
                content: `
                    <div class="threat-detail">
                        <!-- Video Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-video mr-2"></i>Panoorin: Ano ang Identity Theft?</h5>
                                <div style="max-width: 600px; margin: 0 auto;">
                                    <div class="video-container">
                                        <iframe src="https://www.youtube.com/embed/kDFeSUUwRnA" title="What is Identity Theft?" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <p class="small text-muted"><i class="fas fa-info-circle mr-1"></i>Video: Alamin kung paano nangyayari ang identity theft at paano ito maiiwasan.</p>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-question-circle mr-2"></i>Ano ang Identity Theft?</h5>
                                <p>Ang <strong>identity theft</strong> o pagnanakaw ng pagkakakilanlan ay nangyayari kapag may taong gumamit ng inyong personal na impormasyon (pangalan, birthday, ID number, o mga dokumento) nang walang pahintulot para sa kanilang sariling kapakinabangan.</p>
                                
                                <h6 class="font-weight-bold mt-3 mb-2" style="color: #1e3c72;">Mga Target na Information:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-1"><i class="fas fa-id-card mr-2" style="color: #1e3c72;"></i>Government IDs (Driver's License, Passport, PhilSys ID)</li>
                                    <li class="mb-1"><i class="fas fa-credit-card mr-2" style="color: #1e3c72;"></i>Credit/Debit card information</li>
                                    <li class="mb-1"><i class="fas fa-university mr-2" style="color: #1e3c72;"></i>Bank account details</li>
                                    <li class="mb-1"><i class="fas fa-birthday-cake mr-2" style="color: #1e3c72;"></i>Personal info (birthdate, address, mother's maiden name)</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="font-weight-bold mb-2" style="color: #1e3c72;"><i class="fas fa-image mr-2"></i>Halimbawa ng Identity Theft Post:</h6>
                                <div class="card mb-3" style="border-color: #1e3c72;">
                                    <div class="card-header text-white py-2" style="background: #1e3c72;">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>Dangerous Social Media Post
                                    </div>
                                    <div class="card-body bg-light p-3">
                                        <div class="d-flex mb-2">
                                            <div class="rounded-circle bg-secondary mr-2" style="width: 40px; height: 40px;"></div>
                                            <div>
                                                <p class="mb-0 font-weight-bold">Juan Dela Cruz</p>
                                                <p class="small text-muted mb-0">Just got my new ID! 🎉</p>
                                            </div>
                                        </div>
                                        <div class="bg-warning p-2 rounded text-center">
                                            <i class="fas fa-id-card fa-3x text-dark mb-2"></i>
                                            <p class="small mb-0 text-danger font-weight-bold">⚠️ HUWAG i-post ang litrato ng inyong ID online!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-exclamation-triangle mr-2"></i>Paano Nangyayari ang Identity Theft?</h5>
                        <div class="alert alert-light" style="border-left: 4px solid #1e3c72 !important;">
                            <p><strong>1. Pagkuha ng Personal na Impormasyon</strong><br>
                            Nakukuha ng mga kriminal ang inyong personal na datos mula sa social media posts, phishing emails, data breaches, o kahit mula sa mga itinatapon ninyong dokumento.</p>
                            
                            <p><strong>2. Paggamit ng Inyong Pagkakakilanlan</strong><br>
                            Gagamitin nila ang inyong pangalan, ID, at iba pang impormasyon para mag-apply ng loans, credit cards, o mag-open ng bagong accounts sa inyong pangalan.</p>
                            
                            <p class="mb-0"><strong>3. Pagkawala ng Pera at Reputasyon</strong><br>
                            Maaaring magkaroon kayo ng utang na hindi ninyo ginawa, masira ang inyong credit score, o ma-involve sa mga krimen na hindi ninyo ginawa.</p>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-book-open mr-2"></i>SCENARIOS</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card h-100" style="border-left: 4px solid #1e3c72;">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold" style="color: #1e3c72;"><i class="fas fa-user mr-2"></i>Si Pedro at ang Lending App</h6>
                                        <p class="small mb-2"><strong>Nangyari:</strong> May tumawag kay Pedro na may utang daw siya sa lending app na hindi naman niya ginamit. Nalaman niyang may gumamit ng kanyang ID photo para mag-apply ng ₱30,000 loan.</p>
                                        <p class="small mb-0 text-success"><strong>Paano Maiiwasan:</strong> Huwag i-post ang ID sa social media. I-watermark ang ID photos na pinapadala. I-report agad sa NBI Cybercrime.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100" style="border-left: 4px solid #1e3c72;">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold" style="color: #1e3c72;"><i class="fas fa-user mr-2"></i>Si Rosa at ang Facebook Clone</h6>
                                        <p class="small mb-2"><strong>Nangyari:</strong> May gumawa ng pekeng Facebook account gamit ang photos ni Rosa. Ginamit ito para humingi ng pera sa mga kaibigan niya, nagpapanggap na may emergency. ₱25,000 ang na-scam.</p>
                                        <p class="small mb-0 text-success"><strong>Paano Maiiwasan:</strong> I-private ang photos at friends list. Regular na i-search ang sariling pangalan para makita kung may fake accounts.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100" style="border-left: 4px solid #1e3c72;">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold" style="color: #1e3c72;"><i class="fas fa-user mr-2"></i>Si Carlo at ang SIM Registration</h6>
                                        <p class="small mb-2"><strong>Nangyari:</strong> May nag-register ng SIM card gamit ang ID ni Carlo. Ginamit ito para sa text scams. Nahuli siya ng pulisya dahil nasa pangalan niya ang SIM na ginamit sa panloloko.</p>
                                        <p class="small mb-0 text-success"><strong>Paano Maiiwasan:</strong> Huwag ipahiram ang ID kahit kanino. Sirain ang lumang ID copies. I-report ang lost IDs agad.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-exclamation-triangle mr-2"></i>Mga Palatandaan na Biktima Ka</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="alert alert-warning mb-0 h-100">
                                    <i class="fas fa-credit-card mr-2"></i>
                                    <strong>Financial Signs</strong>
                                    <ul class="small mt-2 mb-0 pl-3">
                                        <li>May transaksyon na hindi mo ginawa</li>
                                        <li>May bagong credit card o loan sa pangalan mo</li>
                                        <li>Tumatanggap ng collection calls</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="alert alert-warning mb-0 h-100">
                                    <i class="fas fa-envelope mr-2"></i>
                                    <strong>Account Signs</strong>
                                    <ul class="small mt-2 mb-0 pl-3">
                                        <li>Hindi makapag-login sa account</li>
                                        <li>May email about password change na hindi mo ginawa</li>
                                        <li>May bagong accounts gamit ang email mo</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="alert alert-warning mb-0 h-100">
                                    <i class="fas fa-users mr-2"></i>
                                    <strong>Social Signs</strong>
                                    <ul class="small mt-2 mb-0 pl-3">
                                        <li>May pekeng social media account</li>
                                        <li>Mga kaibigan nakatanggap ng weird messages "from you"</li>
                                        <li>May nakikikilala sa iyo na hindi mo kilala</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold text-primary mb-3"><i class="fas fa-shield-alt mr-2"></i>Paano Maprotektahan ang Sarili</h5>
                        <div class="row">
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 bg-light rounded h-100">
                                    <i class="fas fa-id-card fa-2x text-primary mb-2"></i>
                                    <p class="small mb-0 font-weight-bold">Huwag i-post ang ID sa social media</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 bg-light rounded h-100">
                                    <i class="fas fa-user-lock fa-2x text-primary mb-2"></i>
                                    <p class="small mb-0 font-weight-bold">I-private ang social media accounts</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 bg-light rounded h-100">
                                    <i class="fas fa-file-shredder fa-2x text-primary mb-2"></i>
                                    <p class="small mb-0 font-weight-bold">Sirain ang mga lumang documents</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 bg-light rounded h-100">
                                    <i class="fas fa-eye fa-2x text-primary mb-2"></i>
                                    <p class="small mb-0 font-weight-bold">Regular na i-check ang credit report</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `
            },
            fraud: {
                title: "Pandaraya sa Internet (Online Fraud)",
                content: `
                    <div class="threat-detail">
                        <!-- Video Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-video mr-2"></i>Panoorin: Paano Maiiwasan ang Online Scams?</h5>
                                <div style="max-width: 600px; margin: 0 auto;">
                                    <div class="video-container">
                                        <iframe src="https://www.youtube.com/embed/PWVN3Rq4gzw" title="Online Scams Prevention" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <p class="small text-muted"><i class="fas fa-info-circle mr-1"></i>Video: Mga tips para maiwasan ang online fraud at scams.</p>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-question-circle mr-2"></i>Ano ang Online Fraud?</h5>
                                <p>Ang <strong>online fraud</strong> o pandaraya sa internet ay mga panloloko na naglalayong nakawin ang inyong pera sa pamamagitan ng credit card, debit card, online banking, investment scam, at iba pang mapanlinlang na pamamaraan.</p>
                                
                                <h6 class="font-weight-bold mt-3 mb-2" style="color: #1e3c72;">Mga Uri ng Online Fraud:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-1"><i class="fas fa-credit-card mr-2" style="color: #1e3c72;"></i>Credit Card / Banking Fraud</li>
                                    <li class="mb-1"><i class="fas fa-chart-line mr-2" style="color: #1e3c72;"></i>Investment Scams (Ponzi, Pyramid)</li>
                                    <li class="mb-1"><i class="fas fa-shopping-cart mr-2" style="color: #1e3c72;"></i>Online Shopping Scams</li>
                                    <li class="mb-1"><i class="fas fa-heart mr-2" style="color: #1e3c72;"></i>Romance Scams</li>
                                    <li class="mb-1"><i class="fas fa-briefcase mr-2" style="color: #1e3c72;"></i>Job Offer Scams</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="font-weight-bold mb-2" style="color: #1e3c72;"><i class="fas fa-image mr-2"></i>Halimbawa ng Investment Scam:</h6>
                                <div class="card mb-3" style="border-color: #1e3c72;">
                                    <div class="card-header text-white py-2" style="background: #1e3c72;">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>Red Flags sa Investment Offer
                                    </div>
                                    <div class="card-body bg-light p-3">
                                        <div class="text-center mb-2">
                                            <span class="badge badge-danger">🚨 SCAM ALERT</span>
                                        </div>
                                        <p class="small mb-2 text-center font-weight-bold">"Guaranteed 50% return in just 7 days!"</p>
                                        <ul class="small mb-0">
                                            <li class="text-danger">❌ "Too good to be true" returns</li>
                                            <li class="text-danger">❌ Walang SEC registration</li>
                                            <li class="text-danger">❌ Pressure na mag-invest agad</li>
                                            <li class="text-danger">❌ Kailangan mag-recruit ng iba</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-exclamation-triangle mr-2"></i>Paano Nangyayari ang Online Fraud?</h5>
                        <div class="alert alert-light" style="border-left: 4px solid #1e3c72 !important;">
                            <p><strong>1. Pag-akit sa Biktima</strong><br>
                            Gagamitin ng mga scammer ang mga nakaka-akit na alok - mataas na returns sa investment, sobrang murang produkto, o emotional manipulation sa romance scam.</p>
                            
                            <p><strong>2. Paghingi ng Pera o Impormasyon</strong><br>
                            Hihilingin nila na mag-invest, mag-advance payment, o ibigay ang inyong bank details, OTP, o credit card information.</p>
                            
                            <p class="mb-0"><strong>3. Pagkawala at Pagkakalat</strong><br>
                            Pagkatapos makuha ang pera o impormasyon, mawawala ang scammer o gagamitin ang inyong datos para sa iba pang panloloko.</p>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-book-open mr-2"></i>SCENARIOS</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card h-100" style="border-left: 4px solid #1e3c72;">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold" style="color: #1e3c72;"><i class="fas fa-user mr-2"></i>Si Lito at ang Investment Scam</h6>
                                        <p class="small mb-2"><strong>Nangyari:</strong> Nag-invest si Lito ng ₱100,000 sa online trading platform na may "guaranteed 30% monthly returns." Unang 2 months okay, pero sa 3rd month nawala ang platform at ang pera niya.</p>
                                        <p class="small mb-0 text-success"><strong>Paano Maiiwasan:</strong> Check muna kung SEC-registered. Kung "guaranteed high returns," malamang scam. Mag-invest lang sa legit na platforms.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100" style="border-left: 4px solid #1e3c72;">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold" style="color: #1e3c72;"><i class="fas fa-user mr-2"></i>Si Emma at ang Online Shop</h6>
                                        <p class="small mb-2"><strong>Nangyari:</strong> Umorder si Emma ng branded bag online na ₱3,000 - sobrang mura. Nag-advance payment siya. Dumating ang bag - peke at mura ang material. Na-block na siya ng seller.</p>
                                        <p class="small mb-0 text-success"><strong>Paano Maiiwasan:</strong> Kung masyado murang presyo, red flag agad. Gumamit ng COD. Check reviews at verified sellers lang.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100" style="border-left: 4px solid #1e3c72;">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold" style="color: #1e3c72;"><i class="fas fa-user mr-2"></i>Si Ben at ang Job Scam</h6>
                                        <p class="small mb-2"><strong>Nangyari:</strong> May job offer si Ben - "Work from home, ₱50,000/month!" Pero kelangan daw mag-pay ng ₱5,000 training fee. Nagbayad siya. Nawala ang "employer" at pera niya.</p>
                                        <p class="small mb-0 text-success"><strong>Paano Maiiwasan:</strong> Legit na employer HINDI nagpapahanap ng bayad. Research ang company. Apply sa verified job sites lang.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold text-primary mb-3"><i class="fas fa-shield-alt mr-2"></i>Paano Maprotektahan ang Sarili</h5>
                        <div class="alert alert-warning">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="mb-0 small">
                                        <li><strong>Huwag ibigay ang OTP</strong> kahit kanino - kahit nagpapanggap na taga-bangko</li>
                                        <li><strong>Mag-research</strong> bago mag-invest - check SEC registration</li>
                                        <li><strong>Gumamit ng COD</strong> para sa online shopping kung puwede</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="mb-0 small">
                                        <li><strong>Kung too good to be true</strong>, malamang scam yan</li>
                                        <li><strong>I-verify ang seller</strong> - tingnan reviews at history</li>
                                        <li><strong>Report agad</strong> sa bangko kung may unauthorized transaction</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                `
            },
            unauthorized: {
                title: "Unauthorized Access / Hacking",
                content: `
                    <div class="threat-detail">
                        <!-- Video Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-video mr-2"></i>Panoorin: Paano Protektahan ang Account Mo?</h5>
                                <div style="max-width: 600px; margin: 0 auto;">
                                    <div class="video-container">
                                        <iframe src="https://www.youtube.com/embed/3NjQ9b3pgIg" title="Password Security and Hacking Prevention" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <p class="small text-muted"><i class="fas fa-info-circle mr-1"></i>Video: Mga tips para protektahan ang inyong accounts mula sa hacking.</p>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-question-circle mr-2"></i>Ano ang Unauthorized Access?</h5>
                                <p>Ang <strong>unauthorized access</strong> ay ang iligal na pagpasok sa inyong computer, cellphone, account, o network nang walang pahintulot. Ginagawa ito upang nakawin ang impormasyon, pera, o para sirain ang inyong device.</p>
                                
                                <h6 class="font-weight-bold mt-3 mb-2" style="color: #1e3c72;">Paano Nangyayari ang Unauthorized Access?</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-1"><i class="fas fa-key mr-2" style="color: #1e3c72;"></i>Mahina ang password (123456, birthday)</li>
                                    <li class="mb-1"><i class="fas fa-virus mr-2" style="color: #1e3c72;"></i>Virus o malware mula sa downloads</li>
                                    <li class="mb-1"><i class="fas fa-wifi mr-2" style="color: #1e3c72;"></i>Paggamit ng unsecured public WiFi</li>
                                    <li class="mb-1"><i class="fas fa-mobile-alt mr-2" style="color: #1e3c72;"></i>Outdated apps at operating system</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="font-weight-bold mb-2" style="color: #1e3c72;"><i class="fas fa-image mr-2"></i>Mga Halimbawa ng Weak Passwords:</h6>
                                <div class="card mb-3" style="border-color: #1e3c72;">
                                    <div class="card-body bg-light p-3">
                                        <div class="row text-center">
                                            <div class="col-6">
                                                <h6 class="text-danger font-weight-bold">❌ WEAK</h6>
                                                <ul class="list-unstyled small">
                                                    <li>123456</li>
                                                    <li>password</li>
                                                    <li>juan123</li>
                                                    <li>birthday (19900101)</li>
                                                    <li>iloveyou</li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="text-success font-weight-bold">✓ STRONG</h6>
                                                <ul class="list-unstyled small">
                                                    <li>Tr0p!c@lSunr1se#2024</li>
                                                    <li>M@ng0*Str33t_789!</li>
                                                    <li>B@gu10C1ty#R0cks!</li>
                                                    <li>P@ssw0rd combinations</li>
                                                    <li>with symbols & numbers</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-exclamation-triangle mr-2"></i>Paano Nangyayari ang Unauthorized Access?</h5>
                        <div class="alert alert-light" style="border-left: 4px solid #1e3c72 !important;">
                            <p><strong>1. Paghahanap ng Kahinaan</strong><br>
                            Hahanap ang mga hacker ng mga weak passwords, outdated software, o unsecured networks. Minsan gumagamit din sila ng phishing para makuha ang inyong login credentials.</p>
                            
                            <p><strong>2. Pagpasok sa System</strong><br>
                            Kapag nakapasok na sila, maaari nilang tingnan ang inyong files, i-install ang malware, o kontrolin ang inyong device nang hindi ninyo alam.</p>
                            
                            <p class="mb-0"><strong>3. Pagnanakaw o Pagsira</strong><br>
                            Maaari nilang nakawin ang inyong data, pera, o personal na impormasyon. Minsan sinisira nila ang inyong files o ginagamit ang inyong account para mang-scam ng iba.</p>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-book-open mr-2"></i>SCENARIOS</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card h-100" style="border-left: 4px solid #1e3c72;">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold" style="color: #1e3c72;"><i class="fas fa-user mr-2"></i>Si Mark at ang Free WiFi</h6>
                                        <p class="small mb-2"><strong>Nangyari:</strong> Nag-connect si Mark sa free WiFi ng coffee shop. Nag-login siya sa bank app. Kinabukasan, may ₱80,000 nawala - nahack ang session niya sa public WiFi.</p>
                                        <p class="small mb-0 text-success"><strong>Paano Maiiwasan:</strong> Huwag gumamit ng banking apps sa public WiFi. Gumamit ng VPN kung kailangan. Mag-logout pagkatapos gamitin.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100" style="border-left: 4px solid #1e3c72;">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold" style="color: #1e3c72;"><i class="fas fa-user mr-2"></i>Si Tina at ang Password</h6>
                                        <p class="small mb-2"><strong>Nangyari:</strong> Ginamit ni Tina ang "tina123" bilang password sa lahat ng accounts. Na-breach ang isang website kung saan siya naka-register. Na-hack lahat ng accounts niya - Facebook, email, at GCash.</p>
                                        <p class="small mb-0 text-success"><strong>Paano Maiiwasan:</strong> Gumamit ng unique at strong password per account. Enable 2FA. Gamitin ang password manager.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100" style="border-left: 4px solid #1e3c72;">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold" style="color: #1e3c72;"><i class="fas fa-user mr-2"></i>Si Danny at ang APK File</h6>
                                        <p class="small mb-2"><strong>Nangyari:</strong> Nag-download si Danny ng "free premium game" APK mula sa random website. Ang APK pala ay may hidden spyware na nag-record ng lahat ng keystrokes niya - nakuha ang bank passwords.</p>
                                        <p class="small mb-0 text-success"><strong>Paano Maiiwasan:</strong> Mag-download ng apps mula sa official stores lang. Huwag mag-install ng APK from unknown sources.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-exclamation-triangle mr-2"></i>Mga Senyales na Na-hack Ka</h5>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="alert alert-warning text-center h-100 mb-0">
                                    <i class="fas fa-tachometer-alt fa-2x mb-2"></i>
                                    <p class="small mb-0 font-weight-bold">Biglang kumagal ang device</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="alert alert-warning text-center h-100 mb-0">
                                    <i class="fas fa-lock fa-2x mb-2"></i>
                                    <p class="small mb-0 font-weight-bold">Hindi makapag-login sa account</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="alert alert-warning text-center h-100 mb-0">
                                    <i class="fas fa-paper-plane fa-2x mb-2"></i>
                                    <p class="small mb-0 font-weight-bold">May messages na hindi mo pinadala</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="alert alert-warning text-center h-100 mb-0">
                                    <i class="fas fa-bell fa-2x mb-2"></i>
                                    <p class="small mb-0 font-weight-bold">Unknown login notifications</p>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold text-primary mb-3"><i class="fas fa-shield-alt mr-2"></i>Paano Maprotektahan ang Sarili</h5>
                        <div class="row">
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 bg-light rounded h-100">
                                    <i class="fas fa-key fa-2x text-primary mb-2"></i>
                                    <p class="small mb-0 font-weight-bold">Gumamit ng malakas na password</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 bg-light rounded h-100">
                                    <i class="fas fa-mobile-alt fa-2x text-primary mb-2"></i>
                                    <p class="small mb-0 font-weight-bold">Enable Two-Factor Authentication</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 bg-light rounded h-100">
                                    <i class="fas fa-sync fa-2x text-primary mb-2"></i>
                                    <p class="small mb-0 font-weight-bold">Regular na i-update ang apps</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 bg-light rounded h-100">
                                    <i class="fas fa-wifi fa-2x text-primary mb-2"></i>
                                    <p class="small mb-0 font-weight-bold">Iwasan ang public WiFi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `
            },
            cyberbullying: {
                title: "Pang-aabuso sa Internet (Cyberbullying)",
                content: `
                    <div class="threat-detail">
                        <!-- Video Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-video mr-2"></i>Panoorin: Paano Labanan ang Cyberbullying?</h5>
                                <div style="max-width: 600px; margin: 0 auto;">
                                    <div class="video-container">
                                        <iframe src="https://www.youtube.com/embed/6Z1WDe0n-bQ" title="Cyberbullying Awareness" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <p class="small text-muted"><i class="fas fa-info-circle mr-1"></i>Video: Alamin kung paano harapin at labanan ang cyberbullying.</p>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-question-circle mr-2"></i>Ano ang Cyberbullying?</h5>
                                <p>Ang <strong>cyberbullying</strong> o pang-aabuso sa internet ay ang pag-api, pananakot, pagpapahiya, o pag-insulto sa isang tao gamit ang internet o social media. Ito ay isang krimen at may parusa sa batas (RA 10627 - Anti-Bullying Act at RA 10175 - Cybercrime Prevention Act).</p>
                                
                                <h6 class="font-weight-bold mt-3 mb-2" style="color: #1e3c72;">Mga Uri ng Cyberbullying:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-1"><i class="fas fa-comment-slash mr-2" style="color: #1e3c72;"></i>Harassment - Paulit-ulit na pang-iinsulto</li>
                                    <li class="mb-1"><i class="fas fa-user-times mr-2" style="color: #1e3c72;"></i>Exclusion - Sinadyang hindi isama sa groups</li>
                                    <li class="mb-1"><i class="fas fa-mask mr-2" style="color: #1e3c72;"></i>Impersonation - Pagpapanggap gamit fake account</li>
                                    <li class="mb-1"><i class="fas fa-camera mr-2" style="color: #1e3c72;"></i>Outing - Pagkalat ng private photos/info</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="font-weight-bold mb-2" style="color: #1e3c72;"><i class="fas fa-image mr-2"></i>Mga Halimbawa ng Cyberbullying:</h6>
                                <div class="card mb-3" style="border-color: #1e3c72;">
                                    <div class="card-header text-white py-2" style="background: #1e3c72;">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>Examples of Cyberbullying Messages
                                    </div>
                                    <div class="card-body bg-light p-3">
                                        <div class="mb-2 p-2 bg-white rounded border-danger" style="border-left: 3px solid #dc3545;">
                                            <p class="small mb-0 text-danger">"Ang pangit mo! Dapat wag ka na lumabas ng bahay!" ❌</p>
                                        </div>
                                        <div class="mb-2 p-2 bg-white rounded border-danger" style="border-left: 3px solid #dc3545;">
                                            <p class="small mb-0 text-danger">"Haha tingnan niyo 'to guys, sobrang tanga!" ❌</p>
                                        </div>
                                        <div class="p-2 bg-white rounded border-danger" style="border-left: 3px solid #dc3545;">
                                            <p class="small mb-0 text-danger">"Mag-suicide ka na lang, walang magsesave sa 'yo." ❌</p>
                                        </div>
                                        <p class="small mt-2 mb-0 text-muted"><i class="fas fa-info-circle mr-1"></i>Lahat ng ito ay punishable by law!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-exclamation-triangle mr-2"></i>Paano Nangyayari ang Cyberbullying?</h5>
                        <div class="alert alert-light" style="border-left: 4px solid #1e3c72 !important;">
                            <p><strong>1. Pagsisimula ng Pang-aapi</strong><br>
                            Nagsisimula ang cyberbullying sa pamamagitan ng mga offensive comments, pagkalat ng tsismis, o paggawa ng fake accounts para i-harass ang biktima.</p>
                            
                            <p><strong>2. Paulit-ulit na Pag-atake</strong><br>
                            Hindi ito isang beses lang - paulit-ulit na ginagawa ang pang-aapi. Maaaring kasama ang public shaming, pagbabanta, o pagkakalat ng private na impormasyon o photos.</p>
                            
                            <p class="mb-0"><strong>3. Epekto sa Biktima</strong><br>
                            Ang biktima ay nakakaranas ng matinding stress, anxiety, depression, at minsan ay nag-iisip na saktan ang sarili. Apektado rin ang kanilang pag-aaral at social life.</p>
                        </div>                        
                        <hr>
                        
                        <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-book-open mr-2"></i>SCENARIOS</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card h-100" style="border-left: 4px solid #1e3c72;">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold" style="color: #1e3c72;"><i class="fas fa-user mr-2"></i>Si Ella at ang Class GC</h6>
                                        <p class="small mb-2"><strong>Nangyari:</strong> Ginamit ng mga kaklase ni Ella ang group chat para pagtawanan siya. Nag-spread ng edited photos niya at gumawa ng fake account na nagpapanggap sa kanya. Hindi na siya pumapasok dahil sa kahihiyan.</p>
                                        <p class="small mb-0 text-success"><strong>Paano Maiiwasan:</strong> I-screenshot at i-save ang evidence. I-report sa guidance counselor at parents. I-block ang mga bully at i-report sa platform.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100" style="border-left: 4px solid #1e3c72;">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold" style="color: #1e3c72;"><i class="fas fa-user mr-2"></i>Si Kevin at ang Gaming Bully</h6>
                                        <p class="small mb-2"><strong>Nangyari:</strong> Laging nang-aasar at nang-i-insult si Kevin online sa gaming community. Nag-doxxing siya - pinost ang personal info ng biktima. Nagka-case siya sa Anti-Cybercrime at na-suspend sa school.</p>
                                        <p class="small mb-0 text-success"><strong>Paano Maiiwasan:</strong> Huwag mag-doxx o mangasar online. Lahat ng ginagawa mo online may record. May batas laban sa cyberbullying (RA 10175).</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100" style="border-left: 4px solid #1e3c72;"> 
                                    <div class="card-body">
                                        <h6 class="font-weight-bold" style="color: #1e3c72;"><i class="fas fa-user mr-2"></i>Si Joy at ang Ex-Boyfriend</h6>
                                        <p class="small mb-2"><strong>Nangyari:</strong> Nagbanta ang ex-boyfriend ni Joy na ikakalat ang private photos niya kung hindi sila magkabalikan. Nag-screenshot si Joy ng threats at ni-report sa PNP Cybercrime. Na-arrest ang ex dahil sa blackmail.</p>
                                        <p class="small mb-0 text-success"><strong>Paano Maiiwasan:</strong> Huwag magpadala ng sensitive photos. Kung may nambabanta, i-report agad sa PNP Anti-Cybercrime Group. Huwag mag-negotiate sa blackmailer.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-heart-broken mr-2"></i>Epekto ng Cyberbullying</h5>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="alert text-center h-100 mb-0" style="background: #e8eef7; border-color: #1e3c72;">
                                    <i class="fas fa-sad-tear fa-2x mb-2" style="color: #1e3c72;"></i>
                                    <p class="small mb-0 font-weight-bold">Depression at Anxiety</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="alert text-center h-100 mb-0" style="background: #e8eef7; border-color: #1e3c72;">
                                    <i class="fas fa-user-times fa-2x mb-2" style="color: #1e3c72;"></i>
                                    <p class="small mb-0 font-weight-bold">Social Isolation</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="alert text-center h-100 mb-0" style="background: #e8eef7; border-color: #1e3c72;">
                                    <i class="fas fa-school fa-2x mb-2" style="color: #1e3c72;"></i>
                                    <p class="small mb-0 font-weight-bold">Poor School Performance</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="alert text-center h-100 mb-0" style="background: #e8eef7; border-color: #1e3c72;">
                                    <i class="fas fa-heartbeat fa-2x mb-2" style="color: #1e3c72;"></i>
                                    <p class="small mb-0 font-weight-bold">Self-harm thoughts</p>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h5 class="font-weight-bold mb-3" style="color: #1e3c72;"><i class="fas fa-first-aid mr-2"></i>Ano ang Gagawin Kung Biktima Ka?</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card h-100" style="border-color: #1e3c72;">
                                    <div class="card-header text-white py-2" style="background: #1e3c72;">
                                        <i class="fas fa-check-circle mr-2"></i>Dapat Gawin
                                    </div>
                                    <div class="card-body">
                                        <ul class="small mb-0">
                                            <li><strong>I-screenshot at i-save</strong> ang lahat ng evidence</li>
                                            <li><strong>I-block</strong> ang taong nang-aabuso</li>
                                            <li><strong>I-report</strong> sa social media platform</li>
                                            <li><strong>Magsabi</strong> sa magulang, guro, o trusted adult</li>
                                            <li><strong>I-report</strong> sa PNP Anti-Cybercrime Group</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100" style="border-color: #1e3c72;">
                                    <div class="card-header text-white py-2" style="background: #1e3c72;">
                                        <i class="fas fa-times-circle mr-2"></i>Hindi Dapat Gawin
                                    </div>
                                    <div class="card-body">
                                        <ul class="small mb-0">
                                            <li><strong>Huwag sumagot</strong> o makipag-away</li>
                                            <li><strong>Huwag i-delete</strong> ang evidence</li>
                                            <li><strong>Huwag gumanti</strong> ng same behavior</li>
                                            <li><strong>Huwag ikahiya</strong> - hindi mo kasalanan</li>
                                            <li><strong>Huwag mag-isa</strong> - humingi ng tulong</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-danger mt-3">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="font-weight-bold mb-1"><i class="fas fa-gavel mr-2"></i>Legal na Parusa</h6>
                                    <p class="small mb-0">Ang cyberbullying ay may parusa sa ilalim ng RA 10175 (Cybercrime Prevention Act). Ang mga offenders ay puwedeng makulong at magbayad ng danyos.</p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <span class="badge badge-danger p-2">Up to 12 years imprisonment</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info">
                            <h6 class="font-weight-bold"><i class="fas fa-phone mr-2"></i>Hotlines para sa Tulong:</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="small mb-0"><strong>NCMH Crisis Hotline:</strong> 0917-899-8727</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="small mb-0"><strong>DOH Hotline:</strong> 1555</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="small mb-0"><strong>PNP Hotline:</strong> 911 </p>
                                </div>
                            </div>
                        </div>
                    </div>
                `
            }
        };

        // Handle threat detail buttons
        $('.view-details-btn').click(function(e) {
            e.preventDefault();
            const threatType = $(this).data('threat');
            const threat = threatDetails[threatType];
            
            if (threat) {
                $('#threatModalTitle').text(threat.title);
                $('#threatModalBody').html(threat.content);
                $('#threatModal').modal('show');
            }
        });

        // Navigation active state
        $(document).ready(function() {
            // Remove active class from all nav links
            $('.navbar-nav .nav-link').removeClass('active');
            
            // Add active class to Threats link (you'll need to add this to nav)
            $('.navbar-nav .nav-link[href*="threats"]').addClass('active');
            
            // Stagger animation for threat cards
            $('.threat-card').each(function(index) {
                $(this).css({
                    'animation-delay': (index * 0.1) + 's',
                    'animation': 'slideUp 0.6s ease-out forwards'
                });
            });
        });
    </script>

</body>

</html>
<?php
}
else{
    header("Location: ../../login.php");
    exit();
}
?>
