<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ProductFamily;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\admin\ProductType;
use PhpParser\Node\Expr\FuncCall;

class ProducFamiliesController extends Controller
{
    public function index()
    {
       $familiaproductos = ProductFamily::all();
       $tipoproductos = ProductType::all();

       return view('admin/familiaproducto.index', compact('familiaproductos'))->with('tipoproductos', $tipoproductos);
    }

    public function create()
    {
       return view('admin.familiaproducto.create');
    }
    public function store(Request $request)
    {
       $rules = [
            'name' => 'required|unique:product_families',
            'description' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
			return redirect('admin/familia_producto')
			->withInput()
			->withErrors($validator);
		}
        else
        {
        $data = $request->input();
            try
            {

                $familiaProducto = new ProductFamily();
                $familiaProducto->product_types_id = $data['product_types_id'];
                $familiaProducto->name = $data['name'];
                $familiaProducto->description = $data['description'];
                $familiaProducto->save();

                $notification ='Se registro corectamente';
                return redirect('admin/familia_producto')->with(compact('notification'));
            }
            catch(Exception $e)
            {
                $notification = 'Operacion Fallada.';
                return redirect('admin/familia_producto')->with(compact('notification'));
            }
      }
    }

    public function edit($id)
    {
        $familiaproductos = ProductFamily::find($id);
        $tipoproductos = ProductType::all();
        return view('admin.familiaproducto.edit', compact('familiaproductos'))->with('tipoproductos', $tipoproductos);
    }
    public function update(Request $request, $id)
    {

        $rules = [
            'name' => 'required',
            'product_types_id' => 'required',
            'description' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            dd($validator);
			return redirect('admin/familia_producto')
			->withInput()
			->withErrors($validator);
		}
        else
        {
        $data = $request->input();
            try
            {
                $familiaproducto = ProductFamily::find($id);
                $familiaproducto->name = $data['name'];
                $familiaproducto->product_types_id = $data['product_types_id'];
                $familiaproducto->description = $data['description'];
                $familiaproducto->save();
                $notification ='Se actualizo corectamente';
                return  redirect('admin/familia_producto')->with(compact('notification'));
            }
            catch(Exception $e)
            {
                $notification = 'Operacion Fallada';
                return redirect('admin/familia_producto')->with(compact('notification'));
            }
        }
    }
    public function show($id)
    {
        $familiaproductos = ProductFamily::find($id);
        return view('admin.familiaproducto.show', compact( 'familiaproductos'));
    }

    public function destroy($id)
    {
        $familiaproductos = ProductFamily::find($id);
        if($familiaproductos->statu == 1)
        {
            $familiaproductos->delete();
            $notification = 'La familia de Producto fue Eliminado';
            return redirect('admin/familia_producto')->with(compact('notification'));
        }
        else
        {
            $notification = 'Tipo de Producto no fue Eliminado';
            return redirect('admin/familia_producto')->with(compact('notification'));
        }

    }

    public function UpdateStatusFamiliaProducto(Request $request)
    {
        $estadoUpdate = ProductFamily::findOrFail($request->id);
        $estadoUpdate->statu = $request->statu;
        $estadoUpdate -> update();
            if($request->statu == 0)
            {
                $newStatus = '<p class="text-danger">Desabilitado</p>';
            }else{
                $newStatus =' <p class="text-success">Habilitado</p> ';
            }

            return response()->json(['var'=>''.$newStatus.'']);
    }

    public function buscar(Request $request)
    {

        $estados = $request->statu;
        $buscar = $request->buscar;
        $columnasFamiliaProducto = $request->columnasFamiliaProducto;


        if ($estados ==  1)
        {
            if($columnasFamiliaProducto == 'productstype' )
            {
                $tipoproductos = ProductType::query()->where('name','LIKE', "%{$buscar}%")->get();

                $familiaproductos =  ProductFamily::query()
                        ->where('product_types_id', $tipoproductos['0']->id)
                        ->where('statu', 'LIKE', "%{$estados}%")
                        ->paginate(10);

                return view('admin/familiaproducto.index')->with('familiaproductos', $familiaproductos)
                        ->with('estado', $estados)
                        ->with('tipoproductos', $tipoproductos);

            }
            else
            {
            $familiaproductos =  ProductFamily::query()
                        ->where('statu', 'LIKE', "%{$estados}%")
                        ->where($columnasFamiliaProducto, 'LIKE', "%{$buscar}%")
                        ->paginate(10);
            return view('admin/familiaproducto.index')->with('familiaproductos', $familiaproductos)
                        ->with('estado', $estados);
            }
        }
        else if($estados == 0)
        {
            if($columnasFamiliaProducto == 'productstype' )
            {
                $tipoproductos = ProductType::query()->where('name','LIKE', "%{$buscar}%")->get();

                $familiaproductos =  ProductFamily::query()
                        ->where('product_types_id', $tipoproductos['0']->id)
                        ->where('statu', 'LIKE', "%{$estados}%")
                        ->paginate(10);

                return view('admin/familiaproducto.index')->with('familiaproductos', $familiaproductos)
                        ->with('estado', $estados)
                        ->with('tipoproductos', $tipoproductos);

            }
            else
            {
                        $familiaproductos =  ProductFamily::query()
                        ->where('statu', 'LIKE', "%{$estados}%")
                        ->where($columnasFamiliaProducto, 'LIKE', "%{$buscar}%")
                        ->paginate(10);
                        return view('admin/familiaproducto.index')->with('familiaproductos', $familiaproductos)
                        ->with('estado', $estados);
            }
        }
        else
        {
            $familiaproductos = ProductFamily::orderBy('id', 'desc')->paginate(10);
            return view('admin/familiaproducto.index', compact('familiaproductos'))
                        ->with('estado', $estados);
        }
    }

}
