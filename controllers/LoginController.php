<?php 
namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;

    class LoginController{

        public static function recuperar(Router $router){
            $alertas = [];
            $error = null;
            $token = $_GET['token'] ?? null;

            //Buscamos al usuario por su token:
            $usuario = Usuario::where('token',$token);

            if(empty($usuario)){
                $alertas['error'][] = 'Token no válido';
                $error = true;
            }
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $password = new Usuario($_POST); //Creamos instancia de usuario y guardamos pass en memoria
                
                $alertas =  $password->validarPassword(); //Validamos que el pass esté en el post

                $usuario->password = $password->password; //Tomamos la contraseña de la instancia temporal

                //Hasheamos la contraseña IMPORTANTE
                $usuario->hashearPassword();

                $usuario->token = null;

                $resultado = $usuario->guardar();

                if($resultado){
                    header('Location: /');
                }

            }

            $alertas = Usuario::getAlertas();
            $router->render('auth/recuperar', [
                'alertas' => $alertas,
                'error' => $error
            ]);

            
        }
        public static function login(Router $router){
            $alertas  = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $auth = new Usuario($_POST);
                $alertas = $auth->validarLogin(); //Verificamos que se hayan llenado los campos

                if(empty($alertas)){ //Verificamos que no hayan alertas
                    //Verificamos que el usuario exista:
                    $usuario = Usuario::where('email', $auth->email);
                    //Buscamos al usuario con el email ingresado
                    if($usuario){
                        //Verificamos si el password es correcto:
                            if($auth->password != $usuario->password){
                                $alertas['error'][] = "La contraseña es incorrecta!";
                            }
                            //Password que nos pasaron
                            if($usuario->verificarPasswordAndVerificado($auth->password)){
                            //Autenticamos al usuario:
                                session_start();
                                $_SESSION['id'] = $usuario->id;
                                $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                                $_SESSION['email'] = $usuario->email;
                                $_SESSION['login'] = true;
                                
                                //Redireccionamiento:

                                if($usuario->admin == '1'){
                                    header('Location: /admin');
                                    $_SESSION['admin'] = $usuario->admin ?? null;
                                }else{
                                    header('Location: /cita');
                                }
                        } 
                        
                    }   

                }else{ //El usuario no ha sido encontrado por el email proporcionado:
                    Usuario::setAlerta('error', 'Usuario no encontrado!');
                }
            }

            $router->render('auth/login', [
                'alertas' => $alertas
            ]);
        }

        public static function logout(){
            session_start();

            $_SESSION = [];

            header('Location: /');
        }

        public static function olvide(Router $router){
            $alertas = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $auth = new Usuario($_POST);

                //Verificamos que se haya puesto un email
                $alertas =  $auth->validarEmail();

                if(empty($alertas)){
                    //Buscamos al usuario por su email
                    $usuario = Usuario::where('email',$auth->email);
                    
                    if($usuario && $usuario->confirmado === '1'){
                        echo 'Si existe y está confirmado';

                        //Generar el token:
                        $usuario->crearToken();

                        $usuario->guardar();

                        //Enviar el email:

                        $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                        $email->enviarInstrucciones();

                        //Alerta de exito
                        Usuario::setAlerta('exito', 'Revisa tu email');
                    }else{
                        Usuario::setAlerta('error', 'El usuario no existe o no ha sido confirmado!');
                    }
                }
            }

            $alertas = Usuario::getAlertas();
            $router->render('auth/olvide',[
                'alertas' => $alertas            
            ]);
        }

        public static function crear(Router $router){
            $usuario = new Usuario;

            //Arreglo con las alertas de validación al crear la cuenta
            $alertas = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                
                $usuario->sincronizar($_POST);
                
                $alertas = $usuario->validarNuevaCuenta();

                if(empty($alertas)){
                    //Registramos un nuevo usuario

                    $resultado = $usuario->verificarUsuario(); 
                    //Retorna el objeto, resultado de busqueda
                    
                    if($resultado->num_rows){ //Si existe resultados, hay una coincidencia de usuario
                        $alertas = Usuario::getAlertas();
                    }else{
                        //No está registrado, primero hasheamos pass
                        $usuario->hashearPassword();
                        //Segundo, creamos token para mandarlo por email
                        $usuario->crearToken();
                        
                        //Tercero: Abstraemos datos para el email:
                        $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                                            
                        //Enviamos el email de confirmación de cuneta:
                        $email->enviarConfirmacion();
                        
                        //Crear el usuario:
                        $resultado = $usuario->guardar();

                        if($resultado){
                            header('Location: /mensaje');
                        }
                    }      
                }
            }

            $router->render('auth/crear-cuenta', [
                'usuario' => $usuario,
                'alertas' => $alertas
            ]);
        }

        public static function mensaje (Router $router){
            $router->render('auth/mensaje');
        }

        public static function confirmar(Router $router){
            $alertas = [];

            $token = $_GET['token']; //Obtiene el token

            //Verifica en la base de datos si el token existe
            $usuario =  Usuario::where('token', $token);

            //Si no existe, creamos una alerta de error
           if(empty($usuario)){
               Usuario::setAlerta('error', 'Token no válido!');
               
           }else{
            //Eliminamos el token temporal
            $usuario->token = null;
            //Marcamos como confirmada la cuenta
            $usuario->confirmado = '1';

            //Guardamos cambios:
            $usuario->guardar();

            //Tiramos alerta de éxito
            Usuario::setAlerta('exito', 'Cuenta verificada correctamente!');
           }
            $alertas = Usuario::getAlertas();
            $router->render('auth/confirmar-cuenta', [
                'alertas' => $alertas
            ]);
        }
    }

?>