<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Search extends Controller
{

    // VISTAS DEL SISTEMA RAG

    public function principal()
    {
        return view('layouts/index');
    }

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

    // FUNDAMENTOS DE IA
    public function crear_id_fundamento()
    {
        // Simulación de creación de ID
        $id = uniqid('fund_', true);
        return $this->response->setJSON(['id_fundamento' => $id]);
    }

    public function iniciar_sistema()
    {
        // Datos simulados del sistema
        $sistema = [
            'nombre' => 'RAG Multiagente',
            'estado' => 'inicializando',
            'hora_inicio' => date('Y-m-d H:i:s')
        ];
        return $this->response->setJSON(['sistema' => $sistema]);
    }

    public function definir_modelo()
    {
        // Simulación de selección de modelo
        $modelo = [
            'nombre' => 'GPT-5-MultiAgent',
            'tipo' => 'Generativo + Recuperativo',
            'entrenado_en' => 'Knowledge Base RAG',
        ];
        return $this->response->setJSON(['modelo_definido' => $modelo]);
    }

    public function verificar_estado_inicial()
    {
        // Estado inicial simulado
        $estado = [
            'memoria' => 'OK',
            'conexion_n8n' => 'OK',
            'modelos_cargados' => true,
        ];
        return $this->response->setJSON(['estado_inicial' => $estado]);
    }

    public function validar_version()
    {
        // Simulación de validación de versión
        $version = [
            'sistema' => 'v1.0.0-beta',
            'modelo_ia' => '5.0.2',
            'compatible' => true
        ];
        return $this->response->setJSON(['version' => $version]);
    }

    // CONFIGURACIÓN DEL ENTORNO n8n

    public function crear_id_config()
    {
        $id = uniqid('conf_', true);
        return $this->response->setJSON(['id_config' => $id]);
    }

    public function configurar_entorno_n8n()
    {
        $config = [
            'entorno_n8n' => 'Producción',
            'estado' => 'Configurado correctamente',
            'fecha' => date('Y-m-d H:i:s'),
        ];
        return $this->response->setJSON(['configuracion' => $config]);
    }

    public function conectar_apis()
    {
        $apis = [
            ['nombre' => 'OpenAI API', 'estado' => 'Conectada'],
            ['nombre' => 'VectorDB API', 'estado' => 'Conectada'],
        ];
        return $this->response->setJSON(['apis' => $apis]);
    }

    public function validar_credenciales_api()
    {
        $credenciales = [
            'api_key_openai' => 'válida',
            'api_key_vectordb' => 'válida',
        ];
        return $this->response->setJSON(['credenciales' => $credenciales]);
    }

    public function conectar_puerto()
    {
        $puerto = [
            'numero' => 5678,
            'estado' => 'Activo',
        ];
        return $this->response->setJSON(['puerto' => $puerto]);
    }

    public function obtener_url_servidor()
    {
        $servidor = [
            'url_servidor' => 'http://localhost:5678/n8n',
            'status' => 'Disponible',
        ];
        return $this->response->setJSON(['servidor' => $servidor]);
    }
}
