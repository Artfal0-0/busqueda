<?php
$this->extend('layouts/main_layout');
$this->section('content');
?>

<div class="container py-5 min-vh-100">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <br>
            <h2 class="text-white mb-4 border-bottom pb-2">Resultado de la Investigación</h2>
            <div id="responseContainer">
                <div class="text-center text-white-50 mt-5">
                    <p>Cargando respuesta...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('responseContainer');

        // 1. RECUPERAR DATOS DE LA MEMORIA
        const storedData = sessionStorage.getItem('ragData');

        if (!storedData) {
            // Si no hay datos (entró directo por URL), mostrar aviso
            container.innerHTML = `
                <div class="alert alert-warning text-center">
                    <h4>No hay ninguna búsqueda reciente</h4>
                    <p>Por favor, ve al inicio para realizar una consulta.</p>
                    <a href="search" class="btn btn-warning mt-2">Ir a Buscar</a>
                </div>
            `;
            return;
        }

        try {
            const data = JSON.parse(storedData);

            // 2. RENDERIZAR EL CONTENIDO
            container.innerHTML = `
                <div class="card mb-4 bg-transparent border-secondary">
                    <div class="card-body">
                        <h5 class="text-white-50 text-uppercase small ls-1">Tu Pregunta:</h5>
                        <h3 class="text-white fw-bold">"${data.pregunta}"</h3>
                    </div>
                </div>

                <div class="card shadow-lg" style="background-color: #2c2c2c; border:none;">
                    <div class="card-body text-start p-4">
                        <div class="text-white lead markdown-body">
                            ${marked.parse(data.respuesta)}
                        </div>
                    </div>
                </div>
            `;

        } catch (e) {
            container.innerHTML = `<div class="alert alert-danger">Error al leer los datos de la respuesta.</div>`;
        }
    });
</script>

<style>
    .markdown-body ul,
    .markdown-body ol {
        padding-left: 20px;
    }

    .markdown-body p {
        margin-bottom: 1rem;
    }

    .markdown-body h1,
    .markdown-body h2,
    .markdown-body h3 {
        color: #94AEE3;
        margin-top: 1.5rem;
    }

    .markdown-body strong {
        color: #fff;
    }
</style>

<?php $this->endSection(); ?>