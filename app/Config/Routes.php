<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =============================================
// RUTAS PRINCIPALES DEL BUSCADOR
// =============================================
$routes->get('/', 'Search::principal');

// 1. Pantalla de Búsqueda
$routes->get('/search', 'Search::index');

// 2. Procesar la pregunta (POST) - ¡ESTA FALTABA!
$routes->post('/search/process', 'Search::process');

// 3. Pantalla de Resultados (Corregida para coincidir con tu JS)
$routes->get('/search/responses', 'Search::responses'); 

// Otras pantallas
$routes->get('/search/history', 'Search::history');
$routes->get('/search/sources', 'Search::sources');


// =============================================
// FUNDAMENTOS DE IA (Diagrama AURIA)
// =============================================
$routes->get('/ia/crear-id-fundamento', 'Search::Crear_id_fundamento');
$routes->get('/ia/iniciar-sistema', 'Search::Iniciar_sistema');
$routes->get('/ia/definir-modelo', 'Search::Definir_modelo');
$routes->get('/ia/verificar-estado-inicial', 'Search::Verificar_estado_inicial');
$routes->get('/ia/validar-version', 'Search::Validar_version');


// =============================================
// CONFIGURACIÓN DEL ENTORNO N8N (Diagrama AURIA)
// =============================================
$routes->get('/n8n/crear-id-config', 'Search::Crear_id_config');
$routes->get('/n8n/configurar-entorno', 'Search::Configurar_entorno_n8n');
$routes->get('/n8n/conectar-apis', 'Search::Conectar_apis');
$routes->get('/n8n/validar-credenciales', 'Search::Validar_credenciales_api');
$routes->get('/n8n/conectar-puerto', 'Search::Conectar_puerto');
$routes->get('/n8n/obtener-url-servidor', 'Search::Obtener_url_servidor');
$routes->get('/n8n/configurar-nodos', 'Search::Configurar_nodos'); // Agregué esta que faltaba del controlador

// Rutas auxiliares
$routes->get('/search/get-respuesta/(:segment)', 'Search::get_respuesta/$1');