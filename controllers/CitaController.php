<?php
namespace Controllers;

use MVC\Router;


class CitaController{

    public static function index(Router $router){
        
            isAuth(); //Comprobamos en la session si el usuario está logueado
        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);
    }
}
