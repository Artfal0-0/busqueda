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
                    <div class="spinner-border text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
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

            // --- LÓGICA DE IMÁGENES ---
            let imagenesHtml = '';
            
            // Verificamos si existe el array de imágenes y si tiene contenido
            if (data.imagenes && Array.isArray(data.imagenes) && data.imagenes.length > 0) {
                imagenesHtml += `<h5 class="text-white-50 mt-4 mb-3 small text-uppercase ls-1">Imágenes Relacionadas:</h5>`;
                imagenesHtml += `<div class="row mb-4">`;
                
                data.imagenes.forEach(imgUrl => {
                    imagenesHtml += `
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-0 shadow-sm" style="background-color: #2c2c2c; overflow: hidden; border-radius: 12px;">
                                <a href="${imgUrl}" target="_blank">
                                    <img src="${imgUrl}" class="card-img-top zoom-img" alt="Resultado visual" 
                                         style="height: 200px; object-fit: cover; width: 100%;" 
                                         onerror="this.style.display='none'">
                                </a>
                            </div>
                        </div>
                    `;
                });
                
                imagenesHtml += `</div>`;
            }

            // 2. RENDERIZAR EL CONTENIDO COMPLETO
            container.innerHTML = `
                <div class="card mb-4 bg-transparent border-secondary">
                    <div class="card-body">
                        <h5 class="text-white-50 text-uppercase small ls-1">Tu Pregunta:</h5>
                        <h3 class="text-white fw-bold">"${data.pregunta}"</h3>
                    </div>
                </div>

                ${imagenesHtml}

                <div class="card shadow-lg" style="background-color: #2c2c2c; border:none; border-radius: 15px;">
                    <div class="card-body text-start p-4">
                        <div class="d-flex align-items-center mb-3 border-bottom border-secondary pb-2">
                             <i class="bi bi-robot text-info fs-4 me-2"></i>
                             <h4 class="text-info m-0">Análisis del Agente</h4>
                        </div>
                        <div class="text-white lead markdown-body">
                            ${marked.parse(data.respuesta)}
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <a href="search" class="btn btn-outline-light px-4 rounded-pill">Hacer otra búsqueda</a>
                </div>
            `;

        } catch (e) {
            console.error(e);
            container.innerHTML = `<div class="alert alert-danger">Error al leer los datos de la respuesta.</div>`;
        }
    });
</script>

<style>
    /* Estilos para el Markdown */
    .markdown-body ul,
    .markdown-body ol {
        padding-left: 20px;
        color: #e0e0e0;
    }

    .markdown-body p {
        margin-bottom: 1rem;
        line-height: 1.7;
    }

    .markdown-body h1,
    .markdown-body h2,
    .markdown-body h3 {
        color: #94AEE3; /* Azul claro para títulos */
        margin-top: 1.5rem;
        font-weight: 600;
    }

    .markdown-body strong {
        color: #fff;
        font-weight: 700;
    }
    
    .markdown-body code {
        background-color: #1a1a1a;
        padding: 2px 5px;
        border-radius: 4px;
        color: #ff7b72;
        font-family: monospace;
    }

    /* Efecto Zoom en las imágenes */
    .zoom-img {
        transition: transform 0.3s ease;
    }
    .zoom-img:hover {
        transform: scale(1.05);
        cursor: pointer;
    }
</style>

<?php $this->endSection(); ?>