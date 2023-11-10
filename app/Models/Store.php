<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Store extends Model
{
    use HasFactory;

    /**
     * Attribute is false when store is closed, return closing time when store is open.
     *
     * @var false, string
     */
    public function getOpenNowAttribute() {
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
}
