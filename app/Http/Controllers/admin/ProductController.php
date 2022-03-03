<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ProductFamily;
use App\Models\admin\Product;
use Illuminate\Support\Facades\Validator;
use Exception;
use PhpParser\Node\Expr\FuncCall;

class ProductController extends Controller
{
    public function index()
    {
       $productos = Product::all();
       $familiaproductos = ProductFamily::all();

       return view('admin.productos.index', compact('productos'))->with('familiaproductos', $familiaproductos);
    }

    public function store(Request $request)
    {
    /*
        <!--'product_families_id'
        'code'
        'name'
        'image'
        'description'
        'cost'
        'salePrice'
        'invoicePrice'
        'stock'
        'statu'--> */

       $rules = [
            'product_families_id' => 'required',
            'code' => 'required|unique:products',
            'name' => 'required|unique:products',
            'image' => 'required|image|mimes:jpg,png,jpeg',
            'description' => 'nullable',
            'cost' => 'required|numeric',
            'salePrice' => 'required|numeric',
            'invoicePrice' => 'required|numeric',
            'stock' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
			return redirect('admin/producto')
			->withInput()
			->withErrors($validator);
		}
        else
        {
        $data = $request->input();

            try
            {
                $producto = new Product();
                $producto->product_families_id = $data['product_families_id'];
                $producto->code = $data['code'];
                $producto->name = $data['name'];
                $path = $request->file('image')->store('public/images');
                $producto->image = $path;
                $producto->description = $data['description'];
                $producto->cost = $data['cost'];
                $producto->salePrice = $data['salePrice'];
                $producto->invoicePrice = $data['invoicePrice'];
                $producto->stock = $data['stock'];
                $producto->save();

                $notification =  'Se registro corectamente';
                return  redirect('admin/producto')->with(compact('notification'));
            }
            catch(Exception $e)
            {
                $notification =  'Operacion Fallada';
                return redirect('admin/producto')->with(compact('notification'));
            }
      }
    }

    public function show($id)
    {
        $producto = Product::find($id);
        return view('admin.productos.show', compact( 'producto'));
    }

    public function edit($id)
    {
        $familiaproductos = ProductFamily::all();
        $producto = Product::find($id);
        return view('admin.productos.edit', compact('producto'))->with('familiaproductos', $familiaproductos);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'product_families_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'description' => 'nullable',
            'cost' => 'required|numeric',
            'salePrice' => 'required|numeric',
            'invoicePrice' => 'required|numeric',
            'stock' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
			return redirect('admin/producto')
			->withInput()
			->withErrors($validator);
		}
        else
        {
        $data = $request->input();

            try
            {
                $producto = Product::find($id);
                $producto->product_families_id = $data['product_families_id'];
                $producto->code = $data['code'];
                $producto->name = $data['name'];

                if($request->hasFile('image'))
                {
                    $request->validate([
                        'image' => 'required|image|mimes:jpg,png,jpeg'
                    ]);
                    $path = $request->file('image')->store('public/images');
                    $producto->image = $path;
                }



                $producto->description = $data['description'];
                $producto->cost = $data['cost'];
                $producto->salePrice = $data['salePrice'];
                $producto->invoicePrice = $data['invoicePrice'];
                $producto->stock = $data['stock'];
                $producto->save();

                $notification = 'Se actualizado los registros correctamente';
                return  redirect('admin/producto')->with(compact('notification'));
            }
            catch(Exception $e)
            {
                $notification = 'Su actualizado de los registros presenta errores';
                return  redirect('admin/producto')->with(compact('notification'));
            }
      }
    }
    public function UpdateStatusProducto(Request $request)
    {
        $estadoUpdate = Product::findOrFail($request->id);
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

    public function destroy($id)
    {

            $producto = Product::findOrFail($id);
            $borrar = public_path('/image'.$producto->image);
            if (file_exists($borrar))
            {
                unlink(realpath($borrar));
            }
            $producto->delete();
            $notification = 'El Producto fue Eliminado';
            return redirect('admin/producto')->with(compact('notification'));
    }

    public function buscar(Request $request)
    {

        $estados = $request->statu;
        $buscar = $request->buscar;
        $columnasProducto = $request->columnasProducto;


        if ($estados ==  1)
        {
            if($columnasProducto == 'productfamily' )
            {
                $familiaproducto = ProductFamily::query()->where('name','LIKE', "%{$buscar}%")->get();
                $familiaproductos = ProductFamily::all();
                $productos =  Product::query()
                        ->where('product_families_id', $familiaproducto['0']->id)
                        ->where('statu', 'LIKE', "%{$estados}%")
                        ->paginate(10);

                return view('admin.productos.index', compact('productos'))->with('familiaproductos', $familiaproductos)
                        ->with('estado', $estados);

            }
            else
            {
                $familiaproductos = ProductFamily::all();
                $productos =  Product::query()
                ->where('statu', 'LIKE', "%{$estados}%")
                ->where($columnasProducto, 'LIKE', "%{$buscar}%")
                ->paginate(10);
                return view('admin.productos.index', compact('productos'))
                            ->with('familiaproductos', $familiaproductos)
                            ->with('estado', $estados);
            }
        }
        else if($estados == 0)
        {
            if($columnasProducto == 'productfamily' )
            {
                $familiaproducto = ProductFamily::query()->where('name','LIKE', "%{$buscar}%")->get();
                $familiaproductos = ProductFamily::all();
                $productos =  Product::query()
                        ->where('product_families_id', $familiaproducto['0']->id)
                        ->where('statu', 'LIKE', "%{$estados}%")
                        ->paginate(10);

                return view('admin.productos.index', compact('productos'))->with('familiaproductos', $familiaproductos)
                        ->with('estado', $estados);

            }
            else
            {
                $familiaproductos = ProductFamily::all();
                $productos =  Product::query()
                ->where('statu', 'LIKE', "%{$estados}%")
                ->where($columnasProducto, 'LIKE', "%{$buscar}%")
                ->paginate(10);
                return view('admin.productos.index', compact('productos'))
                            ->with('familiaproductos', $familiaproductos)
                            ->with('estado', $estados);
            }
        }
        else
        {
            $productos = Product::orderBy('id', 'desc')->paginate(10);
            return view('admin.productos.index', compact('productos'))
                        ->with('estado', $estados);
        }
    }
}
