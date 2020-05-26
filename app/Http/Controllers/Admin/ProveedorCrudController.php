<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProveedorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProveedorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProveedorCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Proveedor');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/proveedor');
        $this->crud->setEntityNameStrings('proveedor', 'Proveedores');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ProveedorRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
        $this->crud->addField(
            [   // Text
                'name' => 'nombre_proveedor',
                'label' => "Nombre Proveedor ",
                'type' => 'text',
            ]
        );

        $this->crud->addField(
            [   // Text
                'name' => 'telefono_proveedor',
                'label' => "Telefono Proveedor ",
                'type' => 'text',
            ]
        );

        $this->crud->addField(
            [   // Text
                'name' => 'direccion_proveedor',
                'label' => "Direccion Proveedor ",
                'type' => 'text',
            ]
        );

        $this->crud->addField(
            [   // Text
                'name' => 'tipo_producto',
                'label' => "Tipo de producto que surte ",
                'type' => 'text',
            ]
        );


    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
