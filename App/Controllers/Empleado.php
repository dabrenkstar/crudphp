<?php

namespace App\Controllers;

use \App\Models\Area as Area;
use \App\Models\Empleado as ModelEmpleado;
use \App\Models\Rol as Rol;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Empleado extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $empleados = ModelEmpleado::all();
        View::renderTemplate('Empleado/index.html', ['empleados' => $empleados,
            'url_base' => $this->url_base]);
    }

    /**
     * Show the create page
     *
     * @return void
     */
    public function createAction()
    {
        $areas = Area::all();
        $roles = Rol::all();
        View::renderTemplate('Empleado/create.html',
            ['areas' => $areas,
                'roles' => $roles,
                'url_base' => $this->url_base]);
    }

    /**
     * Show the edit page
     *
     * @return void
     */
    public function editAction()
    {
        $id = $this->route_params["id"];
        $empleado = ModelEmpleado::read($id);
        $rol_id = Rol::read($id);
        $areas = Area::all();
        $roles = Rol::all();
        View::renderTemplate('Empleado/edit.html',
            ['empleado' => $empleado,
                'areas' => $areas,
                'roles' => $roles,
                'rol_id' => $rol_id,
                'url_base' => $this->url_base]);
    }

    /**
     * Store model
     *
     * @return void
     */
    public function storeAction()
    {
        extract($_REQUEST);
        if(!isset($boletin)){
            $boletin = 0;
        }
        ModelEmpleado::store($nombre, $email, $sexo, $area_id, $boletin, $descripcion, $roles);
        header("Location:$this->url_base/empleados");
    }

    /**
     * Update model
     *
     * @return void
     */
    public function updateAction()
    {
        extract($_REQUEST);
        ModelEmpleado::update($nombre, $email, $sexo, $area_id, $boletin, $descripcion, $roles, $id);
        header("Location:$this->url_base/empleados");
    }

    /**
     * Delete model
     *
     * @return void
     */
    public function deleteAction()
    {
        $id = $this->route_params["id"];
        ModelEmpleado::delete($id);
        header("Location:$this->url_base/empleados");
    }

}
