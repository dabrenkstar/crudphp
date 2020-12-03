<?php

namespace App\Models;

use App\Models\Conex;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Empleado extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function all()
    {
        $empleados = Conex::getAll("SELECT e.*, a.nombre AS area FROM empleados AS e INNER JOIN areas AS a ON e.area_id = a.id", array());
        return $empleados;
    }

    public static function read($id)
    {
        $empleado = Conex::getRow("SELECT * FROM empleados WHERE id = ?", array($id));
        return $empleado;
    }

    public static function store($nombre, $email, $sexo, $area_id, $boletin, $descripcion, $roles)
    {
        Conex::query("INSERT INTO empleados (nombre,email,sexo,area_id,boletin,descripcion) VALUES (?,?,?,?,?,?)", array($nombre, $email, $sexo, $area_id, $boletin, $descripcion));
        $empleado = Conex::getOne("SELECT MAX(id) FROM empleados", array());
        Conex::query("INSERT INTO empleado_rol (empleado_id,rol_id) VALUES (?,?)", array($empleado, $roles));
    }

    public static function update($nombre, $email, $sexo, $area_id, $boletin, $descripcion, $roles, $id)
    {
         Conex::query("UPDATE empleados SET nombre = ? ,email = ? ,sexo = ? ,area_id = ? ,boletin = ? ,descripcion = ?  WHERE id = ? ", array($nombre, $email, $sexo, $area_id, $boletin, $descripcion, $id));
         Conex::query("UPDATE empleado_rol SET rol_id = ? WHERE empleado_id = ?", array($roles, $id));
     }

    public static function delete($id)
    {
        Conex::query("DELETE FROM empleados WHERE id = ?", array($id));
    }
}
