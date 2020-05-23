<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VentaRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class VentaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class VentaCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Venta');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/venta');
        $this->crud->setEntityNameStrings('venta', 'ventas');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(VentaRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();

        $this->crud->addField(
            [  // Select2
                'label' => "Producto",
                'type' => 'select2',
                'name' => 'producto_id', // the db column for the foreign key
                'entity' => 'Producto', // the method that defines the relationship in your Model
                'attribute' => 'nombre_producto', // foreign key attribute that is shown to user

                // optional
             ]
        );

        $this->crud->addField(
            [   // Hidden
                'name' => 'user_id',
                'type' => 'hidden',
                'value' => 1, //se guardara el usuario actual
            ]
        );

        $this->crud->addField(
            [   // Text
                'name' => 'tipo_pago',
                'label' => "Tipo de pago",
                'type' => 'text',
            ]
        );

        $this->crud->addField(
            [   // Text
                'name' => 'cantidad_venta',
                'label' => "Total de articulos",
                'type' => 'text',
                'attributes' => [
                'readonly' => 'readonly',
                ]
            ]
        );

        $this->crud->addField(
            [   // Text
                'name' => 'total_venta',
                'label' => "Costo Total ",
                'type' => 'text',
                'attributes' => [
                'readonly' => 'readonly',
                ]
            ]
        );









    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
