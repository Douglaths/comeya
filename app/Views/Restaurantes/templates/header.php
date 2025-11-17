<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Parrilla Dorada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-red: #d32323;
            --text-dark: #1a1a1a;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background-color: #f8f9fa;
        }

        .header {
            background: white;
            padding: 15px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .restaurant-logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .restaurant-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }

        .restaurant-info {
            color: #666;
            font-size: 0.9rem;
        }

        .restaurant-subtitle {
            color: #666;
            font-size: 0.95rem;
            margin-top: 5px;
        }

        .destacados-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1.3rem;
            font-weight: 700;
            margin: 30px 0 20px 0;
            color: var(--text-dark);
        }

        .star-icon {
            color: var(--primary-red);
        }

        .card-destacado {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-destacado:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .card-destacado img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .badge-destacado {
            position: absolute;
            top: 12px;
            right: 12px;
            background-color: var(--primary-red);
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .card-destacado .card-body {
            padding: 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-destacado .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .card-destacado .card-text {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 12px;
        }

        .price {
            color: var(--primary-red);
            font-size: 1.3rem;
            font-weight: 700;
            margin-top: auto;
        }

        .nav-tabs {
            border-bottom: 2px solid #e0e0e0;
            margin: 30px 0 20px 0;
        }

        .nav-tabs .nav-link {
            color: #666;
            border: none;
            padding: 12px 20px;
            font-weight: 500;
            border-bottom: 3px solid transparent;
        }

        .nav-tabs .nav-link.active {
            color: var(--text-dark);
            background: none;
            border-bottom: 3px solid var(--text-dark);
        }

        .section-title {
            color: #666;
            font-size: 0.95rem;
            margin: 25px 0 15px 0;
        }

        .menu-item {
            background: white;
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            transition: box-shadow 0.2s;
        }

        .menu-item:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        }

        .menu-item img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }

        .menu-item-content {
            flex: 1;
        }

        .menu-item-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .menu-item-description {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 8px;
        }

        .menu-item-price {
            color: var(--primary-red);
            font-size: 1.1rem;
            font-weight: 700;
        }

        .btn-agregar {
            background-color: var(--primary-red);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: background-color 0.2s;
        }

        .btn-agregar:hover {
            background-color: #b91e1e;
        }

        .badge-popular {
            position: absolute;
            top: 8px;
            left: 8px;
            background-color: var(--primary-red);
            color: white;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        #destacadosCarousel .carousel-control-prev,
        #destacadosCarousel .carousel-control-next {
            width: 35px !important;
            height: 35px !important;
            background-color: rgba(255, 255, 255, 0.9) !important;
            border-radius: 50% !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            opacity: 0.8 !important;
            transition: all 0.3s ease !important;
            border: 1px solid rgba(0,0,0,0.1) !important;
        }

        #destacadosCarousel .carousel-control-prev:hover,
        #destacadosCarousel .carousel-control-next:hover {
            opacity: 1 !important;
            background-color: white !important;
            transform: translateY(-50%) scale(1.1) !important;
        }

        #destacadosCarousel .carousel-control-prev-icon,
        #destacadosCarousel .carousel-control-next-icon {
            width: 12px !important;
            height: 12px !important;
            background-size: 12px !important;
            filter: invert(0.3) !important;
        }

        #destacadosCarousel .carousel-control-prev {
            left: 10px !important;
        }

        #destacadosCarousel .carousel-control-next {
            right: 10px !important;
        }

        #destacadosCarousel .row {
            display: flex;
            align-items: stretch;
        }

        #destacadosCarousel .col-md-4 {
            display: flex;
        }

        #destacadosCarousel .card-destacado {
            min-height: 320px;
        }

        .tab-content {
            min-height: 400px;
        }

        .tab-pane {
            padding-bottom: 50px;
        }

        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
        }

        footer {
            margin-top: auto;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .cart-float-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: var(--primary-red);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .cart-float-btn:hover {
            transform: scale(1.1);
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: white;
            color: var(--primary-red);
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
        }

        #cartModal {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100%;
            background-color: white;
            z-index: 2000;
            transition: right 0.3s ease;
            box-shadow: -2px 0 10px rgba(0,0,0,0.3);
        }

        #cartModal.show {
            right: 0;
        }

        .cart-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .cart-overlay.show {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="d-flex align-items-center">
                <i class="fas fa-arrow-left me-3" style="font-size: 1.3rem; cursor: pointer;"></i>
                <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=100&h=100&fit=crop" alt="Logo" class="restaurant-logo me-3">
                <div>
                    <h1 class="restaurant-name">La Parrilla Dorada</h1>
                    <div class="restaurant-info">
                        <i class="fas fa-map-marker-alt"></i> Madrid
                        <span class="mx-2">•</span>
                        <i class="fas fa-phone"></i> +34 912 345 678
                    </div>
                    <p class="restaurant-subtitle mb-0">Especialistas en carnes a la brasa y parrilla argentina</p>
                </div>
            </div>
        </div>
    </div>