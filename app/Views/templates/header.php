<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Menús Digitales</title>
  <link rel="icon" type="image/png" href="<?= base_url('public/assets/images/logos/ico.png') ?>">
  <!-- CSS Locales -->
  <link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap/bootstrap.css') ?>">
  <link rel="stylesheet" href="<?= base_url('public/assets/css/menu/menu.css') ?>">
  <!-- Iconos de Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    html, body {
      height: 100%;
    }
    body {
      display: flex;
      flex-direction: column;
    }
    .content-wrapper {
      flex: 1;
    }
    footer {
      margin-top: auto;
    }
    .restaurant-card:hover h5 {
      color: #ff6b35 !important;
    }
    .restaurant-img {
      height: 200px;
      object-fit: cover;
    }
    .logo-responsive {
      max-height: 240px;
      width: auto;
      max-width: 100%;
      height: auto;
    }
    @media (max-width: 768px) {
      .logo-responsive {
        max-height: 120px;
      }
    }
  </style>
</head>
  <!-- Header Hero -->
  <header class="hero-header text-center position-relative">
    <div class="container">
      <div class="position-absolute top-0 end-0 p-3">
        <a href="<?= base_url('/login') ?>" class="btn btn-light px-3 py-2 rounded-pill fw-semibold" style="color: #ff6b35; border: 2px solid white;">
          <i class="bi bi-person-circle me-1"></i> Login
        </a>
      </div>
      <img src="<?= base_url('public/assets/images/logos/logo.png') ?>" alt="Logo" class="mb-4 logo-responsive">
      <h1 class="display-6 fw-bold">¡Pide lo que Quieras!</h1>
      <p class="lead">Descubre los mejores restaurantes y ordena tu comida favorita desde cualquier lugar.</p>
      <a href="#" class="btn btn-primary-custom px-4 py-2 rounded-pill">Comenzar Ahora</a>
    </div>
  </header>