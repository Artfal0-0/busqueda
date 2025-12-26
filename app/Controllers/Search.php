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

        $n8nUrl = 'https://mi-n8n-final-nvg8.onrender.com/webhook/rag-consulta';

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

            // 4. Convertir el texto de N8N a un Array PHP
            $data = json_decode($body, true);

            // Si la decodificación falló (es null), hubo un error en N8N
            if (json_last_error() !== JSON_ERROR_NONE) {
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

            // 6. Usar setJSON para que CodeIgniter ponga las cabeceras correctas automáticamente
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
