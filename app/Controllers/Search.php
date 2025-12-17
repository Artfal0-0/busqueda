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
        // 1. Obtener la pregunta
        $query = $this->request->getPost('query');

        if (!$query) {
            return $this->response->setJSON([
                'respuesta' => 'Por favor escribe una pregunta.',
                'pregunta' => '',
                'imagenes' => []
            ]);
        }

        $n8nUrl = 'https://n8n-production-4fd2.up.railway.app/webhook/rag-consulta';

        try {
            // 2. Conectar a N8N
            $client = \Config\Services::curlrequest();
            $response = $client->post($n8nUrl, [
                'json' => ['query' => $query],
                'headers' => ['Content-Type' => 'application/json'],
                'http_errors' => false,
                'timeout' => 60
            ]);

            // 3. Obtener el cuerpo crudo
            $body = $response->getBody();

            // 4. DECODIFICAR: Convertimos el texto de N8N a un Array PHP
            // Esto sirve para verificar si N8N nos mandó basura o un JSON real
            $data = json_decode($body, true);

            // Si la decodificación falló (es null), hubo un error en N8N
            if (json_last_error() !== JSON_ERROR_NONE) {
                // Forzamos un error visible para depurar
                return $this->response->setJSON([
                    'respuesta' => 'Error: N8N devolvió datos no válidos. ' . substr($body, 0, 100),
                    'pregunta' => $query,
                    'imagenes' => []
                ]);
            }

            // 5. ASEGURAR IMÁGENES: Si por alguna razón 'imagenes' no viene, ponemos un array vacío
            if (!isset($data['imagenes'])) {
                $data['imagenes'] = [];
            }

            // 6. ENVIAR: Usamos setJSON para que CodeIgniter ponga las cabeceras correctas automáticamente
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'respuesta' => 'Error de conexión: ' . $e->getMessage(),
                'pregunta' => $query,
                'imagenes' => []
            ]);
        }
    }
}
