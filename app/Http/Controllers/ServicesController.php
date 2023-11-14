<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServicesController extends Controller
{
    public function index()
    {
        return view('services.index')
            ->with( 'services',
                cache()->remember(
                    'services_list',
                    5, // 5 secondes seulement pour pouvoir vérifier que cela fonctionne
                    fn() => Service::all()
                )
            );
    }

    public function show(int $id)
    {
        return view('services.show')
        ->with( 'service',
            cache()->remember(
                'service_' . $id,
                5, // 5 secondes seulement pour pouvoir vérifier que cela fonctionne
                fn() => Service::findOrFail( $id )
            )
        );
    }

}
