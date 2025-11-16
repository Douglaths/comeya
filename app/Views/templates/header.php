<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Mi Sitio Web' ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h1>Mi Sitio</h1>
            </div>
            <ul>
                <li><a href="<?= base_url() ?>">Inicio</a></li>
                <li><a href="<?= base_url('about') ?>">Acerca de</a></li>
                <li><a href="<?= base_url('contact') ?>">Contacto</a></li>
            </ul>
        </nav>
    </header>
    <main>