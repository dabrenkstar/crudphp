<?php

namespace App\Models;

use App\Models\Conex;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Rol extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function all()
    {
        $roles = Conex::getAll("SELECT * FROM roles", array());
        return $roles;
    }

    public static function read($id)
    {
        $rol_id = Conex::getOne("SELECT rol_id FROM empleado_rol WHERE empleado_id = ?", array($id));
        return $rol_id;
    }

}
