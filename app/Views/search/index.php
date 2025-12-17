<?php $this->extend('layouts/main_layout');
$this->section('content'); ?>

<div class="container min-vh-100 d-flex flex-column justify-content-center">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-lg-10 text-center">
            
            <h1 class="display-4 fw-bold text-white mb-3">Sistema RAG Multiagente</h1>
            <p class="lead text-white-50 mb-5">Búsqueda inteligente con n8n + Imágenes</p>

            <form id="searchForm" class="mb-5">
                <div class="input-group input-group-lg shadow-lg" style="max-width: 800px; margin: 0 auto;">
                    <input type="text" id="queryInput" name="query" class="form-control form-control-lg"
                        placeholder="Pregúntame cualquier cosa..." required
                        style="border-radius: 50px 0 0 50px; background:#ffffff; border:0; color:black; padding-left: 30px;">
                    <button class="btn btn-lg px-5" type="submit" id="btnBuscar"
                        style="border-radius: 0 50px 50px 0; background:#94AEE3; color:white; border:0; font-weight: bold;">
                        <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none me-2"></span>
                        Buscar
                    </button>
                </div>
            </form>

            <div id="statusMessage" class="mt-4"></div>

        </div>
    </div>
</div>

<script>
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // 1. Obtener datos
        const query = document.getElementById('queryInput').value.trim();
        const btn = document.getElementById('btnBuscar');
        const spinner = document.getElementById('loadingSpinner');
        const statusMsg = document.getElementById('statusMessage');

        if (!query) return;

        // 2. Activar estado de carga visual
        btn.disabled = true;
        spinner.classList.remove('d-none');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Consultando Agentes...';
        statusMsg.innerHTML = '<div class="text-info">Conectando con Groq y buscando imágenes...</div>';

        // 3. Preparar datos para el Controlador PHP
        const formData = new FormData();
        formData.append('query', query);

        // 4. Enviar petición al Controlador (NO a N8N directo)
        fetch('search/process', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log("Respuesta recibida:", data); // Para depurar en consola

            if (data.error) {
                throw new Error(data.respuesta || "Error desconocido");
            }

            // 5. GUARDAR TODO EN MEMORIA (Texto + Imágenes)
            // Aquí 'data' ya contiene: { respuesta: "...", pregunta: "...", imagenes: [...] }
            sessionStorage.setItem('ragData', JSON.stringify(data));

            // 6. Redirigir a la vista de resultados
            window.location.href = 'search/responses';
        })
        .catch(error => {
            console.error('Error:', error);
            statusMsg.innerHTML = `<div class="alert alert-danger w-50 mx-auto">Error: ${error.message}</div>`;
            
            // Restaurar botón
            btn.disabled = false;
            spinner.classList.add('d-none');
            btn.innerHTML = 'Buscar';
        });
    });
</script>

<?php $this->endSection(); ?>