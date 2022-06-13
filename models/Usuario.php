<?php

namespace Model;

    class Usuario extends ActiveRecord{
        public static $tabla = 'usuarios';
        public static $columnasDB = ['id', 'nombre', 'apellido', 'email','password','telefono', 'admin', 'confirmado', 'token'];

        public $id;
        public $nombre;
        public $apellido;
        public $email;
        public $password;
        public $telefono;
        public $admin;
        public $confirmado;
        public $token;

        public function __construct($args = []){

        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
        
        }
        
        //Validación para los nuevos usuarios:
        public function validarNuevaCuenta(){
            if(!$this->nombre){
                self::$alertas['error'][] = 'Es necesario un nombre!';
            }

            if(!$this->apellido){
                self::$alertas['error'][] = 'Es necesario un apellido!';
            }

            if(!$this->email){
                self::$alertas['error'][] = 'Es necesario un email!';
            }

            if(!$this->password){
                self::$alertas['error'][] = 'Es necesario un password!';
            }

            if(strlen($this->password) < 6){
                self::$alertas['error'][] = 'La contraseña debe tener un mínimo de 6 dígitos!';
            }
            return self::$alertas;
        } 
        
        public function validarEmail(){
            
            if(!$this->email){
                self::$alertas['error'][] = 'El email es obligatorio!';
            }
            return self::$alertas;
        }
        
        public function verificarUsuario(){
            $query = "SELECT * FROM ". self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1 "; 

            $resultado = self::$db->query($query);
            if($resultado->num_rows){
                self::$alertas['error'][] = "Este usuario ya está registrado!";
            }

            return $resultado;
        }

        public function validarLogin(){
            if(!$this->email){
                self::$alertas['error'][] = "El email es obligatorio!";
            }
            if(!$this->password){
                self::$alertas['error'][] = "El password es obligatorio!";
            }
            return self::$alertas;
        } 
        
        public function hashearPassword(){
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
            
        }

        public function crearToken(){
            $this->token = uniqid();
        }

        public function verificarPasswordAndVerificado($password){
            $resultado = password_verify($password, $this->password);

            if(!$resultado || !$this->confirmado){
                self::$alertas['error'][] = "Password incorrecto o tu contraseña no ha sido confirmada";
            }else{
                return true;
            }
            
           
        }

        public function validarPassword(){
            

            if(!$this->password){
                self::$alertas['error'][] = "La contraseña es obligatoria!";
            }
            if(strlen($this->password)<6){
                self::$alertas['error'][] = "La contraseña debe tener un mínimo de 6 dígitos";
            }

            return self::$alertas;
        }
    }

?>