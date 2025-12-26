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
        // Elementos del DOM
        const outputDiv = document.getElementById('markdownOutput');
        const errorDiv = document.getElementById('errorMessage');
        const questionTitle = document.getElementById('questionTitle');
        const galleryDiv = document.getElementById('imageGallery');

        try {
            // 1. Recuperar datos de la memoria
            const rawData = sessionStorage.getItem('ragData');

            // LOG PARA DEPURAR (Míralo en la consola F12)
            console.log("📦 Datos crudos recuperados:", rawData);

            if (!rawData) {
                throw new Error("No hay datos de búsqueda almacenados. Intenta buscar de nuevo.");
            }

            const data = JSON.parse(rawData);
            console.log("✨ Datos procesados (JSON):", data);

            // 2. Renderizar Pregunta
            // Aceptamos data.pregunta OR data.query OR "Pregunta desconocida"
            questionTitle.textContent = data.pregunta || data.query || "Resultado de la búsqueda";

            // 3. Renderizar Respuesta (Texto IA) - AQUÍ OCURRÍA EL ERROR
            // Verificamos si existe data.respuesta y si no es null
            let textoIA = data.respuesta;

            // Si viene vacío o undefined, ponemos un mensaje de fallback
            if (!textoIA) {
                console.warn("⚠️ La propiedad 'respuesta' está vacía o no existe.");
                textoIA = "⚠️ La IA no devolvió texto, pero la búsqueda se completó. Revisa la consola para ver la estructura de los datos.";
            }

            // Usamos marked solo si tenemos texto (evita el error 'marked(): input parameter is undefined')
            if (typeof marked !== 'undefined' && typeof marked.parse === 'function') {
                outputDiv.innerHTML = marked.parse(textoIA);
            } else {
                // Si marked falla por alguna razón, mostramos texto plano
                outputDiv.textContent = textoIA;
            }

            // 4. Renderizar Imágenes (Galería)
            // Aceptamos data.imagenes OR data.images OR array vacío
            const imagenes = data.imagenes || data.images || [];

            if (Array.isArray(imagenes) && imagenes.length > 0) {
                galleryDiv.innerHTML = ''; // Limpiar placeholders
                imagenes.forEach(imgUrl => {
                    const col = document.createElement('div');
                    col.className = 'col-md-4 mb-3';
                    col.innerHTML = `
                        <div class="card h-100 shadow-sm">
                            <img src="${imgUrl}" class="card-img-top" alt="Resultado visual" 
                                 style="height: 200px; object-fit: cover;"
                                 onerror="this.src='https://via.placeholder.com/300x200?text=Error+Imagen'">
                        </div>
                    `;
                    galleryDiv.appendChild(col);
                });
            } else {
                galleryDiv.innerHTML = '<p class="text-muted text-center col-12">No se encontraron imágenes relevantes.</p>';
            }

        } catch (error) {
            console.error("❌ Error grave en responses.php:", error);
            errorDiv.classList.remove('d-none');
            // Mostramos el detalle del error en la pantalla para que sea fácil verlo
            errorDiv.innerHTML = `<strong>Error de visualización:</strong> ${error.message}`;
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
        color: #94AEE3;
        /* Azul claro para títulos */
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