<?php

namespace Controllers;

use MVC\Router;
use Model\Servicio;


class ServicioController{

    
    public static function index(Router $router) {

        isAdmin();
        $servicios = Servicio::all();

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }


    public static function crear(Router $router) {
        isAdmin();
        $servicio = new Servicio; //Un modelo de servicios vacío
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $servicio->sincronizar($_POST);

            $alertas = $servicio->validar();                    
            if(empty($alertas)){ //No hay errores traidos
                $servicio->guardar();
                header('Location: /servicios');
            }
        }
        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    

    public static function actualizar(Router $router) {
        isAdmin();
        $alertas = [];
        if(!is_numeric($_GET['id'])) return;
        $servicio = Servicio::find($_GET['id']);

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas

        ]);
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
          $servicio->sincronizar($_POST);
          $alertas = $servicio->validar();

          if(empty($alertas)){
              $servicio->guardar();

              header('Location: /servicios');
          }
        }
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];

            $servicio = Servicio::find($id);
            
            $servicio->eliminar();

            header('Location: /servicios');
        }
    }
}

