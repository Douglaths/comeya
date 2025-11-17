<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Menús Digitales</title>
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
  </style>
</head>
  <!-- Header Hero -->
  <header class="hero-header text-center">
    <div class="container">
      <i class="bi bi-x-lg d-block mx-auto mb-3" style="font-size: 1.5rem;"></i>
      <h1 class="display-5 fw-bold">Menús Digitales para tu Restaurante</h1>
      <p class="lead">Moderniza tu negocio con menús digitales interactivos. Fácil de gestionar, perfecto para tus clientes.</p>
      <a href="#" class="btn btn-primary-custom px-4 py-2 rounded-pill">Comenzar Ahora</a>
    </div>
  </header>