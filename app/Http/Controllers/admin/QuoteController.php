<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Quotation;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
       $cotizaciones = Quotation::all();
       return view('admin.cotizaciones.index', compact('cotizaciones'));
    }

    public function create()
    {
        return view('admin.cotizaciones.create');
    }
}
