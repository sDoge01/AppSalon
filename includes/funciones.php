<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//Función para proteger la página de citas:
function isAuth () : void {
    if(!isset($_SESSION['login'])){
        header('Location: /');
    }
}

function isAdmin() : void {
    if(!isset($_SESSION['admin'])){
        header('Location: /');
    }
}

function esUltimo(string $actual, $proximo) : bool{
    if($proximo !== $actual){
        return true;
    } else{
        return false;
    }
}