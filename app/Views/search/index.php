<?php $this->extend('layouts/main_layout');
$this->section('content'); ?>

<div class="container py-5 min-vh-100">
    <div class="row justify-content-center">
        <div class="col-lg-9 text-center">
            <br>
            <h1 class="display-4 fw-bold text-white mb-3 ">Sistema RAG Multiagente</h1>
            <p class="lead text-white-50 mb-5">Busqueda con n8n</p>

            <form id="searchForm" class="mb-5">
                <div class="input-group input-group-lg shadow-lg" style="max-width: 700px; margin: 0 auto;">
                    <input type="text" id="query" class="form-control form-control-lg "
                        placeholder="Pregúntame cualquier cosa..." required
                        style="border-radius: 50px 0 0 50px; background:#ffff; border:0; color:black;">
                    <button class=" btn-lg px-5" type="submit" id="btnBuscar"
                        style="border-radius: 0 50px 50px 0; background:#94AEE3; color:white; border:0;">
                        <span id="loading" class="spinner-border spinner-border-sm d-none me-2"></span>
                        Buscar
                    </button>
                </div>
            </form>

            <div id="resultado" class="mt-5"></div>

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
        const resultado = document.getElementById('resultado');

        loading.classList.remove('d-none');
        btn.disabled = true;
        resultado.innerHTML = `<div class="text-info fs-5"><em>Consultando a agente especializado...</em></div>`;

        try {
            // URL DEL WEBHOOK 
            const url = 'http://127.0.0.1:5678/webhook/rag-consulta';

            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    query
                })
            });

            if (!res.ok) throw new Error(`Error HTTP: ${res.status}`);

            const data = await res.json();


            // respuesta del agente
            let respuestaTexto = "";
            let preguntaOriginal = "";

            if (Array.isArray(data) && data.length > 0) {
                respuestaTexto = data[0].respuesta;
                preguntaOriginal = data[0].pregunta;
            } else if (data && data.respuesta) {
                respuestaTexto = data.respuesta;
                preguntaOriginal = data.pregunta;
            }

            if (!respuestaTexto) {
                throw new Error("no se recibió una respuesta válida del sistema.");
            }

            resultado.innerHTML = `
                <div class="card" style="background-color: #2c2c2c; border:none; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                    <div class="card-header text-start" style="background-color: #1e1e1e; border-bottom: 1px solid #444;">
                    </div>
                <div class="card-body text-start">
                    <div class="text-white lead">${marked.parse(respuestaTexto)}</div>
                `;
        } catch (err) {
            console.error("ERROR CRÍTICO:", err);
            resultado.innerHTML = `<div class="alert alert-danger">
                <strong>Ocurrió un error:</strong> ${err.message}<br>
            </div>`;
        } finally {
            loading.classList.add('d-none');
            btn.disabled = false;
        }
    });
</script>

<?php $this->endSection(); ?>