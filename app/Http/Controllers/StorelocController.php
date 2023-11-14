<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorelocGetRequest;

class StorelocController extends Controller
{
    public function index()
    {
        return view('index', [
            'services' => cache()->remember(
                'services_list',
                5, // 5 secondes seulement pour pouvoir vérifier que cela fonctionne
                fn() => Service::all()
            )
        ]);
    }

    /**
	 * Search stores.
	 *
	 * @param  \Illuminate\Http\StorelocGetRequest  $request
	 * @return \Illuminate\Http\Response
	 */
    public function results(StorelocGetRequest $request)
    {
        // Retrieve the validated input data and initialise missing
        $search = array_merge([
            'n' => null,
            'e' => null,
            's' => null,
            'w' => null,
            'services' => [],
            'operator' => 'OR',
            ],
            $request->validated()
        );

        if ( isset($search['services']) ) {

            if ( $search['operator'] === 'OR' ) {

                $stores_id = cache()->remember(
                    'OR_'.implode('_',$search['services']),
                    5,
                    fn() => DB::table('service_store')
                                ->whereIn( 'service_id', $search['services'] )
                                ->pluck('store_id')
                );

            } elseif ($search['operator'] === 'AND') {

                $stores_id = cache()->remember(
                    'AND_'.implode('_',$search['services']),
                    5,
                    function() use ($search) {
                        $stores_id = Store::pluck('id');
                        foreach( $search['services'] as $s ) {
                            $stores_id = $stores_id->intersect(
                                DB::table('service_store')
                                    ->whereServiceId( $s )
                                    ->pluck('store_id')
                            );
                        }
                        return $stores_id;
                });
            }
        }

        // Latitude : -90° S // +90° N
        // Longitude : -180° E // +180° W
        $query = Store::query()
            ->when($search['n'], fn($query,$north) => $query->where('stores.lat','<',$north))
            ->when($search['s'], fn($query,$south) => $query->where('stores.lat','>',$south))
            ->when($search['e'], fn($query,$east) => $query->where('stores.lng','>',$east))
            ->when($search['w'], fn($query,$west) => $query->where('stores.lng','<',$west))
            ->when($search['services'], fn($query) => $query->whereIn('id', $stores_id) );

        $cache_key = sha1( json_encode( $search ) );

        return view('stores.index')
            ->with( 'stores',
            cache()->remember(
                'stores_list_'.$cache_key,
                15, // 15 secondes seulement pour pouvoir vérifier que cela fonctionne
                fn() => $query->get()
            )
        );
    }
}
