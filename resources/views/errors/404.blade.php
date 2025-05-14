<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            color: #1f2937;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
            line-height: 1.5;
        }
        
        .error-container {
            max-width: 500px;
            width: 100%;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .dino-scene {
            width: 240px;
            height: 180px;
            margin: 0 auto 30px;
            position: relative;
        }
        
        .ground {
            width: 100%;
            height: 5px;
            background-color: #d1d5db;
            position: absolute;
            bottom: 30px;
            border-radius: 2px;
        }

        .cactus {
            position: absolute;
            width: 15px;
            height: 40px;
            background-color: #047857;
            bottom: 35px;
            right: 30px;
            border-radius: 2px;
            animation: moveCactus 3s infinite linear;
        }
        
        .cactus:before {
            content: "";
            position: absolute;
            width: 10px;
            height: 15px;
            background-color: #047857;
            top: 10px;
            left: -5px;
            border-radius: 2px;
        }
        
        .cactus:after {
            content: "";
            position: absolute;
            width: 10px;
            height: 15px;
            background-color: #047857;
            top: 20px;
            right: -5px;
            border-radius: 2px;
        }
        
        .dino {
            position: absolute;
            bottom: 35px;
            left: 30px;
            animation: dinoJump 1.5s infinite ease-in-out;
        }
        
        @keyframes dinoJump {
            0%, 100% { transform: translateY(0); }
            40% { transform: translateY(-40px); }
            60% { transform: translateY(-40px); }
        }
        
        @keyframes moveCactus {
            0% { transform: translateX(100px); }
            100% { transform: translateX(-200px); }
        }
        
        .error-code {
            font-size: 48px;
            font-weight: 600;
            margin-bottom: 12px;
            color: #4b5563;
        }
        
        .error-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #1f2937;
        }
        
        .error-message {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 24px;
        }
        
        .button {
            display: inline-block;
            background-color: #3b82f6;
            color: white;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        
        .button:hover {
            background-color: #2563eb;
        }
        
        @media (max-width: 480px) {
            .error-container {
                padding: 30px 20px;
            }
            
            .dino-scene {
                width: 200px;
                height: 150px;
                margin-bottom: 20px;
            }
            
            .error-code {
                font-size: 36px;
            }
            
            .error-title {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="dino-scene">
            <div class="ground"></div>
            <div class="cactus"></div>
            <svg class="dino" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 100 100" fill="#3b82f6">
                <!-- Badan -->
                <path d="M40,78 L40,58 L18,58 L18,38 L8,38 L8,18 L28,18 L28,8 L48,8 L48,18 L58,18 L58,38 L68,38 L68,58 L80,58 L80,78 L60,78 L60,68 L40,68 Z" />
                
                <!-- Kepala -->
                <path d="M58,18 L58,8 L78,8 L78,28 L68,28 L68,38 L58,38 Z" />
                
                <!-- Mata -->
                <circle cx="68" cy="18" r="3" fill="white" />
                
                <!-- Kaki belakang -->
                <rect x="30" y="78" width="10" height="10" />
                
                <!-- Kaki depan -->
                <rect x="70" y="78" width="10" height="10" />
                
                <!-- Tangan -->
                <rect x="48" y="48" width="10" height="5" />
            </svg>
        </div>
        <h1 class="error-code">404</h1>
        <h2 class="error-title">Halaman Tidak Ditemukan</h2>
        <p class="error-message">Maaf, halaman yang Anda cari tidak dapat ditemukan atau telah dipindahkan.</p>
        <a href="{{ url('/') }}" class="button">Kembali ke Beranda</a>
    </div>

    <script>
        // Script untuk menambah interaktivitas
        document.addEventListener('DOMContentLoaded', function() {
            const dino = document.querySelector('.dino');
            const container = document.querySelector('.error-container');
            
            // Tambahkan interaksi mouse/touch
            container.addEventListener('click', function() {
                dino.style.animationName = 'none';
                
                // Memicu reflow
                void dino.offsetWidth;
                
                // Mulai animasi lompat dari awal
                dino.style.animationName = 'dinoJump';
            });
        });
    </script>
</body>
</html> 