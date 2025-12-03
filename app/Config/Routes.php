<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// RUTAS PRINCIPALES
$routes->get('/', 'Search::principal');
$routes->get('/search', 'Search::index');
$routes->get('/history', 'Search::history');
$routes->get('/responses', 'Search::responses');
$routes->get('/sources', 'Search::sources');

// FUNDAMENTOS DE IA
$routes->get('/ia/crear-id-fundamento', 'Search::crear_id_fundamento');
$routes->get('/ia/iniciar-sistema', 'Search::iniciar_sistema');
$routes->get('/ia/definir-modelo', 'Search::definir_modelo');
$routes->get('/ia/verificar-estado-inicial', 'Search::verificar_estado_inicial');
$routes->get('/ia/validar-version', 'Search::validar_version');

// CONFIGURACIÓN DEL ENTORNO n8n
$routes->get('/n8n/crear-id-config', 'Search::crear_id_config');
$routes->get('/n8n/configurar-entorno', 'Search::configurar_entorno_n8n');
$routes->get('/n8n/conectar-apis', 'Search::conectar_apis');
$routes->get('/n8n/validar-credenciales', 'Search::validar_credenciales_api');
$routes->get('/n8n/conectar-puerto', 'Search::conectar_puerto');
$routes->get('/n8n/obtener-url-servidor', 'Search::obtener_url_servidor');

// PROCESAR CONSULTA en n8n
$routes->get('/search/get-respuesta/(:segment)', 'Search::get_respuesta/$1');
