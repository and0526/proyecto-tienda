<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VentaRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

use App\Models\Producto;
use App\Models\venta;

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
        //$this->crud->setFromDb();
        $this->crud->addColumn(
            [
                'name' => 'Producto.nombre_producto',
                'label' => 'Producto',
            ]
        );
        $this->crud->addColumn(
            [
                'name' => 'User.name',
                'label' => 'Usuario',
            ]
        );
        $this->crud->addColumn(
            [ // select_from_array
                'name' => 'tipo_pago',
                'label' => "Tipo de pago",
                'type' => 'select_from_array',
                'options' => ['Paypal', 'Efectivo', 'Tarjeta'],
            ]
        );
        $this->crud->addColumn(
            [   // Text
                'name' => 'cantidad_venta',
                'label' => 'Cantidad',
                'type' => 'text',
            ]
        );
        $this->crud->addColumn(
            [   // Text
                'name' => 'total_venta',
                'label' => 'Costo total',
                'type' => 'text',
            ]
        );
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(VentaRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();

        $this->crud->addField(
            [   // select2_from_array
                'name'        => 'Productos',
                'label'       => "Productos",
                'type'        => 'productosParaVenta',
                'options'     => Producto::all()->pluck('nombre_producto', 'id')->toArray(),
                'allows_null' => false,
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ]
        );

        $this->crud->addField(
            [   // Hidden
                'name' => 'user_id',
                'type' => 'hidden',
                'value' => backpack_user()->id, //se guardara el usuario actual
            ]
        );

        $this->crud->addField(
            [ // select_from_array
                'name' => 'tipo_pago',
                'label' => "Tipo de pago",
                'type' => 'select_from_array',
                'options' => ['Paypal', 'Efectivo', 'Tarjeta'],
                'allows_null' => false,
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ]
        );

        $this->crud->addField(
            [   // Number
                'name' => 'cantidad_venta',
                'label' => 'Cantidad',
                'type' => 'number',
                // optionals
                'attributes' => ["step" => "1",  'min' => '1',
                'max' => '99',], // allow decimals
                'prefix' => "#",
                //'suffix' => ".00",
            ]
        );

        $this->crud->addField(
            [   // Text
                'name' => 'total_venta',
                'label' => "Costo total ",
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

    public function getProductos(Request $request)
    {
        $producto = $request->get('producto');
        $cantidad = $request->get('cantidad');
        if($producto && $cantidad){
            $producto = Producto::find($producto);
            if($producto){
                if($producto->stock < $cantidad){
                    return ['id' => $producto->id, 'nombre_producto' => $producto->nombre_producto, 'cantidad' => $producto->stock];
                }else{
                    return ['id' => $producto->id, 'nombre_producto' => $producto->nombre_producto, 'cantidad' => $cantidad, 'costoTotal' => $producto->precio_producto * $cantidad];
                }
            }
        }

        return[];
    }
}
