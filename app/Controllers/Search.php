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
    // 1-6. MÓDULOS DEL CURSO RAG MULTIAGENTE
    // =============================================
    public function iniciar_sistema()
    {
        return $this->response->setJSON(['status' => 'RAG Multiagente iniciado', 'fecha' => date('Y-m-d H:i:s')]);
    }
    public function definir_modelo()
    {
        return $this->response->setJSON(['modelo' => 'Gemini 1.5 Flash + RAG', 'estado' => 'activado']);
    }
    public function verificar_estado_inicial()
    {
        return $this->response->setJSON(['todo' => 'OK', 'n8n' => 'conectado', 'gemini' => 'listo']);
    }

    public function configurar_entorno_n8n()
    {
        return $this->response->setJSON(['n8n' => 'http://localhost:5678', 'estado' => 'corriendo']);
    }
    public function validar_credenciales_api()
    {
        return $this->response->setJSON(['gemini' => 'válida', 'base_datos' => 'conectada']);
    }

    public function process()
    {
        // aqui no se hace nada porque todo lo hace n8n directamente
        return $this->response->setJSON(['status' => 'ok']);
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
