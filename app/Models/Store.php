<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Store extends Model
{
    use HasFactory;

    /**
     * Attribute is false when store is closed, return closing time when store is open.
     *
     * @var false, string
     */
    public function getOpenNowAttribute()
    {
        $horaires = json_decode($this->hours,true);
        $today = Carbon::today()->format('l');

        if ( !isset( $horaires[$today] ) ) return false;

        foreach( $horaires[$today] as $plage ) {
            $tranche = explode( '-', $plage );

            $start = Carbon::createFromTimeString( $tranche[0] );
            $end   = Carbon::createFromTimeString( $tranche[1] );

            if ( Carbon::now()->between($start, $end) ) return $end;
        }
        return false;
    }

    /**
     * The services list that belong to the store : serv, ice, list
     */
    public function getServicesEnumAttribute()
    {
        return cache()->remember(
            'store_' . $this->id . '_services',
            30, // 30 secondes seulement pour pouvoir vérifier que cela fonctionne
            function() {
                return $this->belongsToMany( Service::class )->get()->pluck('name')->implode(', ');
            }
        );
    }

    /**
     * The services list that belong to the store .
     */
    public function services()
    {
        return $this->belongsToMany( Service::class );
    }

}
