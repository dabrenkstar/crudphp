<?php

namespace App\Models;

use App\Models\Conex;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Area extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function all()
    {
        $areas = Conex::getAll("SELECT * FROM areas", array());
        return $areas;
    }

}
