<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body">
                    <h5 class="text-muted text-uppercase small mb-2">Consulta Realizada:</h5>
                    <h2 id="questionTitle" class="display-6 fw-bold text-primary">Cargando pregunta...</h2>
                </div>
            </div>
        </div>
    </div>

    <div id="errorMessage" class="alert alert-danger d-none shadow" role="alert">
    </div>

    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="card-title mb-0"><i class="fas fa-robot me-2 text-warning"></i>Respuesta Sintetizada</h4>
                </div>
                <div class="card-body">
                    <div id="markdownOutput" class="markdown-body">
                        <div class="text-center py-5">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Cargando...</span>
                            </div>
                            <p class="mt-3 text-muted">Procesando respuesta inteligente...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <h5 class="mb-3"><i class="fas fa-images me-2 text-success"></i>Fuentes Visuales</h5>
            <div id="imageGallery" class="row g-2">
                <div class="col-12">
                    <div class="placeholder-glow"><span class="placeholder col-12" style="height: 150px;"></span></div>
                </div>
                <div class="col-12">
                    <div class="placeholder-glow"><span class="placeholder col-12" style="height: 150px;"></span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 mb-5">
        <a href="<?= base_url('search') ?>" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fas fa-arrow-left me-2"></i>Nueva Búsqueda
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const outputDiv = document.getElementById('markdownOutput');
        const errorDiv = document.getElementById('errorMessage');
        const questionTitle = document.getElementById('questionTitle');
        const galleryDiv = document.getElementById('imageGallery');

        try {
            const rawData = sessionStorage.getItem('ragData');
            console.log("📦 Datos recuperados:", rawData);

            if (!rawData) {
                throw new Error("No hay datos de búsqueda. Vuelve al inicio.");
            }

            const data = JSON.parse(rawData);

            // 1. Pintar Pregunta
            if (questionTitle) {
                questionTitle.textContent = data.pregunta || data.query || "Resultado de la búsqueda";
            }

            // 2. Pintar Respuesta
            let textoIA = data.respuesta;
            if (!textoIA) textoIA = "⚠️ La IA no devolvió texto, pero la búsqueda terminó.";

            if (outputDiv) {
                if (typeof marked !== 'undefined') {
                    outputDiv.innerHTML = marked.parse(textoIA);
                } else {
                    outputDiv.textContent = textoIA;
                }
            }

            // 3. Pintar Imágenes
            const imagenes = data.imagenes || data.images || [];

            if (galleryDiv) {
                galleryDiv.innerHTML = '';

                if (Array.isArray(imagenes) && imagenes.length > 0) {
                    imagenes.forEach(imgUrl => {
                        const cleanUrl = imgUrl.replace(/["\[\]]/g, '');
                        if (cleanUrl.startsWith('http')) {
                            const col = document.createElement('div');
                            col.className = 'col-12 mb-3';
                            col.innerHTML = `
                                <div class="card border-0 shadow-sm overflow-hidden">
                                    <a href="${cleanUrl}" target="_blank">
                                        <img src="${cleanUrl}" class="card-img-top zoom-img" alt="Referencia visual" 
                                             style="height: 200px; object-fit: cover; width: 100%;"
                                             onerror="this.style.display='none'">
                                    </a>
                                </div>
                            `;
                            galleryDiv.appendChild(col);
                        }
                    });
                } else {
                    galleryDiv.innerHTML = '<div class="alert alert-light text-center">Sin imágenes relevantes</div>';
                }
            }

        } catch (error) {
            console.error("❌ Error JS:", error);
            if (errorDiv) {
                errorDiv.classList.remove('d-none');
                errorDiv.textContent = error.message;
            }
        }
    });
</script>

<style>
    /* Estilos dentro de la sección content para asegurar que carguen */
    .markdown-body ul,
    .markdown-body ol {
        padding-left: 20px;
        color: #555;
    }

    .markdown-body p {
        margin-bottom: 1rem;
        line-height: 1.7;
        color: #333;
    }

    .markdown-body h1,
    .markdown-body h2,
    .markdown-body h3 {
        color: #0d6efd;
        margin-top: 1.5rem;
        font-weight: 600;
    }

    .markdown-body strong {
        color: #000;
        font-weight: 700;
    }

    .markdown-body code {
        background-color: #f8f9fa;
        padding: 2px 5px;
        border-radius: 4px;
        color: #d63384;
        font-family: monospace;
    }

    .zoom-img {
        transition: transform 0.3s ease;
    }

    .zoom-img:hover {
        transform: scale(1.05);
        cursor: pointer;
    }
</style>

<?= $this->endSection() ?>