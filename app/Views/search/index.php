<?php $this->extend('layouts/main_layout');
$this->section('content'); ?>

<div class="container min-vh-100 d-flex flex-column justify-content-center">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-lg-10 text-center">
            
            <h1 class="display-4 fw-bold text-white mb-3">Sistema RAG Multiagente</h1>
            <p class="lead text-white-50 mb-5">Búsqueda inteligente con n8n</p>

            <form id="searchForm" class="mb-5">
                <div class="input-group input-group-lg shadow-lg" style="max-width: 800px; margin: 0 auto;">
                    <input type="text" id="query" class="form-control form-control-lg"
                        placeholder="Pregúntame cualquier cosa..." required
                        style="border-radius: 50px 0 0 50px; background:#ffffff; border:0; color:black; padding-left: 30px;">
                    <button class="btn btn-lg px-5" type="submit" id="btnBuscar"
                        style="border-radius: 0 50px 50px 0; background:#94AEE3; color:white; border:0; font-weight: bold;">
                        <span id="loading" class="spinner-border spinner-border-sm d-none me-2"></span>
                        Buscar
                    </button>
                </div>
            </form>

            <div id="statusMessage" class="mt-4"></div>

        </div>
    </div>
</div>

<script>
    document.getElementById('searchForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const query = document.getElementById('query').value.trim();
        if (!query) return;

        const loading = document.getElementById('loading');
        const btn = document.getElementById('btnBuscar');
        const statusMessage = document.getElementById('statusMessage');

        loading.classList.remove('d-none');
        btn.disabled = true;
        statusMessage.innerHTML = `<div class="text-info fs-4"><em><span class="spinner-grow spinner-grow-sm"></span> Consultando a los agentes...</em></div>`;

        try {
            // URL DEL WEBHOOK DE N8N
            const url = 'https://n8n-production-4fd2.up.railway.app/webhook/rag-consulta';

            const res = await fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ query })
            });

            if (!res.ok) throw new Error(`Error HTTP: ${res.status}`);

            const data = await res.json();

            // --- LÓGICA DE DATOS (Array vs Objeto) ---
            let dataFinal = { respuesta: "", pregunta: query };
            
            if (Array.isArray(data) && data.length > 0) {
                dataFinal.respuesta = data[0].respuesta;
                dataFinal.pregunta = data[0].pregunta || query;
            } else if (data && data.respuesta) {
                dataFinal.respuesta = data.respuesta;
                dataFinal.pregunta = data.pregunta || query;
            }

            if (!dataFinal.respuesta) throw new Error("Respuesta vacía del sistema.");

            // 1. GUARDAR EN MEMORIA DEL NAVEGADOR
            sessionStorage.setItem('ragData', JSON.stringify(dataFinal));

            // 2. REDIRIGIR A LA VISTA DE RESPUESTAS
            window.location.href = 'responses'; 

        } catch (err) {
            console.error(err);
            statusMessage.innerHTML = `<div class="alert alert-danger w-50 mx-auto">Error: ${err.message}</div>`;
            loading.classList.add('d-none');
            btn.disabled = false;
        }
    });
</script>

<?php $this->endSection(); ?>