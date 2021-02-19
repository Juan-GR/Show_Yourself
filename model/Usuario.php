<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Juan
 */
class Usuario {
    private $nombre;
    private $email;
    private $password;
    private $icono;
    private $fecha_alta;
    
    function __construct($nombre, $email, $password, $icono) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->icono = $icono;
    }
    function getNombre() {
        return $this->nombre;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getIcono() {
        return $this->icono;
    }


    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    function setEmail($email): void {
        $this->email = $email;
    }

    function setPassword($password): void {
        $this->password = $password;
    }

    function setIcono($icono): void {
        $this->icono = $icono;
    }

}
