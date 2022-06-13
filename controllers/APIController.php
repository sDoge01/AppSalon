<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;


class APIController{

    public static function index(){
        $servicios = Servicio::all(); //Trae todos los servicios
        $arreglo = [];
        
        foreach($servicios as $servicio):
        $arreglo[] = $servicio; //Los ponemos dentro de este array
        endforeach;

        echo json_encode($arreglo); //Y los convertimos a JSON
    }

    public static function guardar () {
        
        $cita = new Cita($_POST);

        $resultado = $cita->guardar(); //Inserta en la DB y devuelve un true si pasa, si el query tiene algun error (como suele ser la razón de los errores), retorna un false

        //Recordar también que RESULTADO también contiene, el ID de la CITA

        //Traemos los ID's de los servicios que nos mande el cliente
       $idServicios = explode(",", $_POST['idServicio']);

        //Traemos los ID's de las citas creadas:
        $id = $resultado["id"]; 

        foreach($idServicios as $idServicio){ 
            $args = [
                'citaId' => $id, //Creamos la llave 'citaId y le ponemos el ID obtenido arriba
                'servicioId' => $idServicio //
            ];

            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        echo json_encode(['resultado' => $resultado ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id']; //Traemos el id

            //Identificamos la cita
            $cita = Cita::find($id);

            //La eliminamos:
            $cita->eliminar();

            header('Location: ' .  $_SERVER['HTTP_REFERER']);
            
        }
    }
}