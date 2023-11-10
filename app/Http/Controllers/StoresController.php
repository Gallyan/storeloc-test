<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    public function index()
    {
        return view('stores.index')->with( 'stores', Store::all()) ;
    }

    public function show(Store $store)
    {
        return view('stores.show')->with( 'store', $store );
    }

}
