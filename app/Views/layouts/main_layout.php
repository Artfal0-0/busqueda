<?php
$this->section('content');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Búsqueda Multiagente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="public/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">RAG Search</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/search">Consulta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/history">Historial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/responses">Respuestas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/sources">Fuentes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="main-content">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="text-center">
        <div class="container">
            <p>&copy; <?= date('Y') ?> Sistema de Búsqueda Multiagente. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>