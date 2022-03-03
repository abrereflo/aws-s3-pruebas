<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class ClientController extends Controller
{
    public function index()
    {
       $clientes = Client::all();
       return view('admin.clientes.index', compact('clientes'));
    }

    public function store(Request $request)
    {
    /*
          <!--
        'code'
        'name'
        'lastname'
        'phone'
        'city'
        'address'
        'nit'
        'ci'
        'email'
        'statu'--> */

       $rules = [

            'code' => 'required|unique:clients',
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required|numeric',
            'city' => 'required',
            'address' => 'required',
            'nit' => 'numeric|unique:clients',
            'ci' => 'required|unique:clients',
            'email' => 'required|unique:clients',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
			return redirect('admin/cliente')
			->withInput()
			->withErrors($validator);
		}
        else
        {
        $data = $request->input();

            try
            {
                $cliente = new Client();
                $cliente->code = $data['code'];
                $cliente->name = $data['name'];
                $cliente->lastname =$data['lastname'];
                $cliente->phone = $data['phone'];
                $cliente->city = $data['city'];
                $cliente->address = $data['address'];
                $cliente->nit = $data['nit'];
                $cliente->ci = $data['ci'];
                $cliente->email = $data['email'];
                $cliente->save();
                return  redirect('admin/cliente')->with('statu', 'Se registro corectamente');
            }
            catch(Exception $e)
            {
                return redirect('admin/cliente')->with('failed', 'Operacion Fallada');
            }
      }
    }
    public function show($id)
    {
        $clientes = Client::find($id);
        return view('admin.clientes.show', compact( 'clientes'));
    }

    public function edit($id)
    {
        $clientes = Client::find($id);
        return view('admin.clientes.edit', compact('clientes'));
    }

    public function update(Request $request, $id)
    {
        $rules = [

            'code' => 'required',
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required|numeric',
            'city' => 'required',
            'address' => 'required',
            'nit' => 'numeric',
            'ci' => 'required',
            'email' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            dd($validator);
			return redirect('admin/cliente')
			->withInput()
			->withErrors($validator);
		}
        else
        {
        $data = $request->input();
        try
            {
                $cliente =  Client::find($id);
                $cliente->code = $data['code'];
                $cliente->name = $data['name'];
                $cliente->lastname =$data['lastname'];
                $cliente->phone = $data['phone'];
                $cliente->city = $data['city'];
                $cliente->address = $data['address'];
                $cliente->nit = $data['nit'];
                $cliente->ci = $data['ci'];
                $cliente->email = $data['email'];
                $cliente->save();
                return  redirect('admin/cliente')->with('statu', 'Se registro corectamente');
            }
            catch(Exception $e)
            {
                return redirect('admin/cliente')->with('failed', 'Operacion Fallada');
            }
      }
    }


    public function UpdateStatusClientes(Request $request)
    {
        $estadoUpdate = Client::findOrFail($request->id);
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
        $clientes = Client::find($id);
        if($clientes->statu == 1)
        {
            $clientes->delete();
            return redirect('admin/cliente')->with('success', 'Tipo de Producto fue Eliminado');
        }
        else
        {
            return redirect('admin/cliente')->with('success', 'Tipo de Producto no fue Eliminado');
        }

    }

    public function buscar(Request $request)
    {

        $estados = $request->statu;
        $buscar = $request->buscar;
        $columnasClientes = $request->columnasClientes;

        if ($estados ==  1)
        {

            $clientes =  Client::query()
                        ->where('statu', 'LIKE', "%{$estados}%")
                        ->where($columnasClientes, 'LIKE', "%{$buscar}%")
                        ->paginate(10);
            return view('admin/clientes.index')->with('clientes', $clientes)
                        ->with('estado', $estados);
        }
        else if($estados == 0)
        {
            $clientes =  Client::query()
                        ->where('statu', 'LIKE', "%{$estados}%")
                        ->where($columnasClientes, 'LIKE', "%{$buscar}%")
                        ->paginate(10);
                        return view('admin/clientes.index')->with('clientes', $clientes)
                        ->with('estado', $estados);
        }
        else
        {
            $clientes = Client::orderBy('id', 'desc')->paginate(10);
            return view('admin/clientes.index', compact('clientes'))
                        ->with('estado', $estados);
        }
    }
}
