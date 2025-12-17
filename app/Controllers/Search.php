<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Search extends Controller
{
    public function index()
    {
        return view('search/index');
    }
    public function history()
    {
        return view('search/history');
    }
    public function responses()
    {
        return view('search/responses');
    }
    public function sources()
    {
        return view('search/sources');
    }
    public function principal()
    {
        return view('layouts/index');
    }


    // =============================================
    // BLOQUE 1: FUNDAMENTOS DE IA Y AUTOMATIZACIÓN
    // (Según diagrama AURIA)
    // =============================================

    public function Crear_id_fundamento()
    {
        // Simula la creación de un ID para el módulo de fundamentos
        return $this->response->setJSON(['id_fundamento' => uniqid('fund_'), 'status' => 'creado']);
    }

    public function Iniciar_sistema()
    {
        return $this->response->setJSON(['status' => 'Sistema RAG Multiagente iniciado', 'timestamp' => date('Y-m-d H:i:s')]);
    }

    public function Definir_modelo()
    {
        return $this->response->setJSON(['modelo' => 'Llama 3.3 Versatile (via Groq)', 'tipo' => 'LLM']);
    }

    public function Verificar_estado_inicial()
    {
        return $this->response->setJSON(['sistema' => 'online', 'memoria' => 'ok', 'conexiones' => 0]);
    }

    public function Validar_version()
    {
        return $this->response->setJSON(['version' => '1.0.0', 'compatible' => true]);
    }

    // =============================================
    // BLOQUE 2 y 3: CONFIGURACIÓN DEL ENTORNO N8N
    // (Según diagrama AURIA)
    // =============================================

    public function Crear_id_config()
    {
        // Este método aparece varias veces en el diagrama, genera un ID de configuración
        return $this->response->setJSON(['id_config' => uniqid('conf_'), 'step' => 'configuracion_iniciada']);
    }

    public function Configurar_entorno_n8n()
    {
        return $this->response->setJSON(['env' => 'production', 'platform' => 'Railway', 'status' => 'configurado']);
    }

    public function Conectar_apis()
    {
        // Simula la conexión con Groq y Google
        return $this->response->setJSON(['groq_api' => 'conectada', 'search_api' => 'conectada']);
    }

    public function Validar_credenciales_api()
    {
        return $this->response->setJSON(['auth' => 'success', 'permissions' => 'read/write']);
    }

    public function Conectar_puerto()
    {
        // En Railway el puerto es dinámico, pero simulamos el estándar
        return $this->response->setJSON(['port' => getenv('PORT') ?: 8080, 'status' => 'listening']);
    }

    public function Obtener_url_servidor()
    {
        return $this->response->setJSON(['url' => base_url(), 'type' => 'https']);
    }

    public function Configurar_nodos()
    {
        return $this->response->setJSON([
            'nodos' => [
                'Webhook',
                'Agente Tecnico',
                'Agente Simple',
                'Agente Sintetizador'
            ],
            'status' => 'workflow_ready'
        ]);
    }

    // =============================================
    // LOGICA DE PROCESAMIENTO (EXISTENTE)
    // =============================================
    
    public function process()
    {
        // Método auxiliar para evitar errores si el frontend llama a process
        return $this->response->setJSON(['status' => 'ok', 'info' => 'El procesamiento real ocurre via n8n']);
    }

    // // Procesar consulta (llama a n8n)
    // public function process()
    // {
    //     $query = $this->request->getPost('query');
    //     if (!$query) return $this->response->setJSON(['error' => 'Sin consulta'], 400);

    //     $sessionId = uniqid('sess_', true);

    //     $client = \Config\Services::curlrequest();
    //     $client->post('http://localhost:5678/webhook/rag-consulta', [
    //         'json' => ['query' => $query, 'session_id' => $sessionId],
    //         'timeout' => 30
    //     ]);

    //     return $this->response->setJSON([
    //         'status' => 'procesado',
    //         'session_id' => $sessionId,
    //         'mensaje' => 'Enviado a n8n + Gemini'
    //     ]);
    // }

    // // n8n llama aquí cuando termine
    // public function webhook_respuesta()
    // {
    //     $data = $this->request->getJSON(true);

    //     if (empty($data['session_id']) || empty($data['query'])) {
    //         return $this->response->setStatusCode(400)->setJSON(['error' => 'Faltan datos']);
    //     }

    //     // USAMOS EL MODEL AHORA
    //     $model = new \App\Models\SesionRagModel();
    //     $model->guardarDesdeN8n($data);

    //     return $this->response->setJSON(['guardado' => 'ok', 'session_id' => $data['session_id']]);
    // }


    // public function get_respuesta($sessionId)
    // {
    //     $model = new \App\Models\SesionRagModel();
    //     $sesion = $model->obtenerPorSessionId($sessionId);

    //     if ($sesion) {
    //         return $this->response->setJSON([
    //             'respuesta' => $sesion['respuesta'] ?: 'Aún procesando...',
    //             'pregunta'  => $sesion['pregunta']
    //         ]);
    //     }

    //     return $this->response->setJSON(['respuesta' => 'No encontrada aún. Espera un poco.'], 404);
    // }
}
