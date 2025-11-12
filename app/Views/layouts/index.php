<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Búsqueda Multiagente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #1a1a1a;
            color: #e0e0e0;
            font-family: 'Arial', sans-serif;
        }

        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 80px;
        }

        .navbar {
            background-color: #2c2c2c;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .navbar-brand {
            color: #ffffff !important;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #b0b0b0 !important;
            margin-right: 1rem;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #1e90ff !important;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        footer {
            background-color: #2c2c2c;
            padding: 1rem 0;
            color: #b0b0b0;
            border-top: 1px solid #444;
        }

        .hero-section {
            text-align: center;
            max-width: 800px;
            padding: 2rem;
        }


        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #b0b0b0;
            line-height: 1.6;
        }

        .features-section {
            margin: 3rem 0;
            display: flex;
            /* flex-wrap: wrap; */
            justify-content: center;
            gap: 2rem;
        }

        .feature-card {
            background-color: #2c2c2c;
            border-radius: 10px;
            padding: 1.5rem;
            width: 250px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #1e90ff;
        }

        .feature-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #ffffff;
        }

        .feature-description {
            font-size: 0.9rem;
            color: #b0b0b0;
        }

        .cta-button {
            background-color: #1e90ff;
            color: white;
            border: none;
            border-radius: 25px;
            padding: 0.75rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 2rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .cta-button:hover {
            background-color: #1c86ee;
            transform: translateY(-3px);
            color: white;
        }

        .cta-button:active {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .feature-card {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>

<body>
    <main class="main-content">
        <div class="hero-section">
            <h1 class="hero-title">Sistema Multiagente de Búsqueda</h1>


            <div class="features-section">
                <div class="feature-card">
                    <div class="feature-icon">🤖</div>
                    <h3 class="feature-title">Agentes Especializados</h3>
                    <p class="feature-description">Múltiples agentes trabajan en conjunto para analizar y procesar tus consultas.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🔍</div>
                    <h3 class="feature-title">Búsqueda Inteligente</h3>
                    <p class="feature-description">Algoritmos avanzados que comprenden el contexto y la intención detrás de tus preguntas.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">📚</div>
                    <h3 class="feature-title">Fuentes Diversas</h3>
                    <p class="feature-description">Acceso a múltiples fuentes de información para respuestas completas y precisas.</p>
                </div>
            </div>

            <a href="search" class="cta-button">Ir al Chat de Búsqueda</a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>