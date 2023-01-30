<?php
// importamos todos los archivos: configuracion, el modelo de la base de datos y los controladores.
require_once 'templates/header.php';
require_once 'conf/config.php';
require_once 'controllers/GamesController.php';
require_once 'controllers/TeamsController.php';
// recogemos el controlador y la acción pasados por GET
$controller = filter_input(INPUT_GET,"controller");
$action = filter_input(INPUT_GET,"action");
// Define la acción por defecto
define('DEFAULT_ACTION', 'listGames');

// Define el controlador por defecto
define('DEFAULT_CONTROLLER', 'Games');

/**
 * @param: $controllerObj
 * comprobamos que la función existe en el controlador pasado por parametros, en caso de no existir cargaremos la acción por defecto. Llama a la funcion loadAction.
 */
function lunchAction($controllerObj){
    if(isset($action) && method_exists($controllerObj, $action)){
        loadAction($controllerObj, $action);
    } 
    else{
        loadAction($controllerObj, DEFAULT_ACTION);
    }
}
/**
 * @param:$controllerObj
 * @param:$action
 * esta funcion ejecutara el metodo pasado por parametros del objeto que hayamos pasado.
 */
function loadAction($controllerObj, $action){
    $accion=$action;
    if(method_exists($controllerObj,$accion)){
        $controllerObj->$accion();
    } else {
        die("Acción no válida.");
    }
}


/**
 * @param:$controller
 * @return:$controlador
 * esta funcion recibira un controlador por parametros y si existe retornara una instancia del controlador
 */
function loadController($controller) {
    $controlador = $controller . 'Controller';
    if (class_exists($controlador)) {
        return new $controlador();
    } else {
        die("controlador no válido");
    }
}

// Carga el controlador y la acción correspondientes
if(isset($controller)&&isset($action)){
    $controllerObj=loadController($controller);
    loadAction($controllerObj,$action);
}else{
    $controllerObj=loadController(DEFAULT_CONTROLLER);
    loadAction($controllerObj,DEFAULT_ACTION);
}

