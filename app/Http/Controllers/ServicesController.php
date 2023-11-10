<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        return view('services.index')->with( 'services', Service::all()) ;
    }

    public function show(Service $service)
    {
        return view('services.show')->with( 'service', $service );
    }

}
