<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بوابة المستخدم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #1a3a52;
            --primary-light: #2d5a7b;
            --accent: #6366f1;
            --accent-light: #818cf8;
            --accent-dark: #4f46e5;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --white: #ffffff;
            --gray-light: #f3f4f6;
            --gray: #e5e7eb;
            --gray-dark: #6b7280;
            --text-dark: #111827;
            --shadow: 0 10px 30px rgba(26, 58, 82, 0.15);
            --shadow-hover: 0 20px 50px rgba(26, 58, 82, 0.25);
        }

        body {
            background: linear-gradient(135deg, var(--primary) 0%, #0f2438 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
            position: relative;
            overflow-x: hidden;
        }

        /* Background animation */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 50%, rgba(99, 102, 241, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 80% 80%, rgba(16, 185, 129, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .container-fluid {
            position: relative;
            z-index: 1;
        }

        /* ============ HEADER ============ */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1.5rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 3rem;
            border-bottom: 3px solid var(--accent);
            animation: slideDown 0.6s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 1;
            min-width: 250px;
        }

        .company-logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .company-logo:hover {
            transform: scale(1.05) rotate(5deg);
            box-shadow: 0 6px 25px rgba(99, 102, 241, 0.4);
        }

        .company-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
        }

        .company-info h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.25rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .company-info p {
            color: var(--gray-dark);
            font-size: 0.9rem;
            font-weight: 500;
            margin: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .welcome-text {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .welcome-text .username {
            font-weight: 600;
            color: var(--primary);
            font-size: 1rem;
        }

        .welcome-text .subtitle {
            color: var(--gray-dark);
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .logout-btn {
            background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.2);
            text-decoration: none;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(239, 68, 68, 0.3);
            color: white;
            text-decoration: none;
        }

        .logout-btn:active {
            transform: translateY(0);
        }

        /* ============ MAIN SECTION ============ */
        .main-section {
            padding: 2rem 0 4rem 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
            color: white;
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            letter-spacing: -1px;
        }

        .section-header p {
            font-size: 1.1rem;
            opacity: 0.95;
            font-weight: 400;
            max-width: 600px;
            margin: 0 auto;
        }

        /* ============ PORTAL CARDS GRID ============ */
        .portals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        @media (max-width: 768px) {
            .portals-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        .portal-card {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: var(--shadow);
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            animation: cardFadeIn 0.6s ease-out backwards;
        }

        .portal-card:nth-child(1) { animation-delay: 0.1s; }
        .portal-card:nth-child(2) { animation-delay: 0.2s; }
        .portal-card:nth-child(3) { animation-delay: 0.3s; }
        .portal-card:nth-child(4) { animation-delay: 0.4s; }

        @keyframes cardFadeIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Gradient background overlay */
        .portal-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            transform: translate(100px, -100px);
            transition: transform 0.6s ease;
        }

        .portal-card:hover::before {
            transform: translate(50px, -50px);
        }

        .portal-card:hover {
            transform: translateY(-12px);
            box-shadow: var(--shadow-hover);
        }

        .portal-card.gis-card {
            border-top: 4px solid #3b82f6;
        }

        .portal-card.report-card {
            border-top: 4px solid #8b5cf6;
        }

        .portal-card.project-card {
            border-top: 4px solid #06b6d4;
        }

        .portal-icon {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            transition: all 0.4s ease;
            position: relative;
            z-index: 1;
        }

        .gis-card .portal-icon {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }

        .report-card .portal-icon {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
        }

        .project-card .portal-icon {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            box-shadow: 0 8px 20px rgba(6, 182, 212, 0.3);
        }

        .portal-card:hover .portal-icon {
            transform: scale(1.15) rotate(10deg);
        }

        .portal-card h5 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .portal-card .description {
            color: var(--gray-dark);
            font-size: 0.95rem;
            margin: 0;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        /* ============ BUTTONS ============ */
        .portal-btn {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            color: white;
            border: none;
            padding: 0.9rem 1.8rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.7rem;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.25);
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .portal-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .portal-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.4);
        }

        .portal-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .portal-btn:active {
            transform: translateY(-1px);
        }

        .portal-btn span {
            position: relative;
            z-index: 1;
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 768px) {
            .header-content {
                gap: 1rem;
            }

            .company-info h1 {
                font-size: 1.4rem;
            }

            .section-header h2 {
                font-size: 1.8rem;
            }

            .header-actions {
                width: 100%;
                justify-content: space-between;
            }

            .welcome-text {
                align-items: flex-start;
            }

            .welcome-text .username,
            .welcome-text .subtitle {
                text-align: left;
            }

            .logout-btn {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }

            .portal-card {
                padding: 1.8rem;
            }

            .portal-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }

        /* ============ ANIMATIONS ============ */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        .portal-card:hover .portal-icon {
            animation: pulse 0.8s ease-in-out infinite;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <div class="header">
        <div class="container-fluid px-4">
            <div class="header-content">
                <div class="logo-section">
                    <div class="company-logo">
                        <!-- استبدل هذا بـ <img src="path/to/your/logo.png" alt="شعار الشركة"> عندما تختار الصورة -->
                        <i class="fas fa-rocket"></i>
                    </div>
                    <div class="company-info">
                        <h1>Geox Mining</h1>
                        <p>نظام إدارة الخدمات المتقدم</p>
                    </div>
                </div>

                <div class="header-actions">
                    <div class="welcome-text">
                        <span class="username">👋 <?= htmlspecialchars($_SESSION['username']) ?></span>
                        <span class="subtitle">مرحباً بعودتك</span>
                    </div>
                    <a href="logout.php" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>خروج</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN SECTION -->
    <div class="main-section">
        <div class="container-fluid px-4">
            <div class="section-header">
                <h2>🚀 الخدمات المتاحة</h2>
                <p>اختر المنصة التي تريد الوصول إليها لإدارة مشاريعك وتقاريرك</p>
            </div>

            <div class="portals-grid">
                <!-- Portal 1: GIS Maps -->
                <div class="portal-card gis-card">
                    <div class="portal-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h5>خرائط GIS</h5>
                    <p class="description">نظام معلومات جغرافية متقدم لتصور وتحليل البيانات المكانية بدقة عالية</p>
                    <a href="https://ahmed2kira.github.io/Report-System/" target="_blank" class="portal-btn">
                        <span>انتقل إلى الخدمة</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>

                <!-- Portal 2: Report System -->
                <div class="portal-card report-card">
                    <div class="portal-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h5>نظام التقارير</h5>
                    <p class="description">منصة إعداد التقارير الذكية لإنشاء تقارير احترافية ومتقدمة بسهولة</p>
                    <a href="https://ahmed2kira.github.io/Report-System/" target="_blank" class="portal-btn">
                        <span>انتقل إلى الخدمة</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>

                <!-- Portal 3: Project Management -->
                <div class="portal-card project-card">
                    <div class="portal-icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <h5>إدارة المشاريع</h5>
                    <p class="description">نظام شامل لمتابعة وإدارة المشاريع بكفاءة عالية وتنظيم احترافي</p>
                    <a href="https://ahmed2kira.github.io/Report-System/" target="_blank" class="portal-btn">
                        <span>انتقل إلى الخدمة</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>