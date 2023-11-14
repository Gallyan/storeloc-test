<?php

namespace App\Http\Controllers;

use App\Models\Store;

class StoresController extends Controller
{
    public function index()
    {
        return view('stores.index')
            ->with( 'stores',
                cache()->remember(
                    'stores_list',
                    5, // 5 secondes seulement pour pouvoir vérifier que cela fonctionne
                    fn() => Store::all()
                )
            );
    }

    public function show(int $id)
    {
        return view('stores.show')
            ->with( 'store',
                cache()->remember(
                    'store_' . $id,
                    5, // 5 secondes seulement pour pouvoir vérifier que cela fonctionne
                    fn() => Store::findOrFail( $id )
                )
            );
    }

}
