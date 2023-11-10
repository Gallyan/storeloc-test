@extends('layout')
@section('content')
    <div>

        <p>{{ __('Store :id:', [ 'id' => $store->id ]) }} {{ $store->name }}</p>

        <p>{{ __('Latitude:') }} {{ $store->lat }}</p>

        <p>{{ __('Longitude:') }} {{ $store->lng }}</p>

        <p>{{ __('Address:') }} {{ $store->address }}</p>

        <p>{{ __('City:') }} {{ $store->city }}</p>

        <p>{{ __('Zipcode:') }} {{ $store->zipcode }}</p>

        <p>{{ __('Country:') }} {{ Lang::has('country.'.$store->country_code) ? __('country.'.$store->country_code) : __($store->country_code) }}</p>

        <table>
            @php
                $weekdays = Carbon\Carbon::getDays();
                array_push( $weekdays, array_shift( $weekdays ) );
                $horaires = json_decode($store->hours,true);
            @endphp

            <tr>
                <td>{{ __('Jour') }}</td>
                @foreach( $weekdays as $day )
                    <td @if(Carbon\Carbon::parse($day)->isToday()) class="font-bold" @endif>
                        {{ __($day) }}
                    </td>
                @endforeach
            </tr>

            <tr>
                <td>{{ __('Horaire') }}</td>
                @foreach( $weekdays as $day )
                    <td @if(Carbon\Carbon::parse($day)->isToday()) class="font-bold" @endif>
                        @isset( $horaires[$day] )
                            @foreach( $horaires[$day] as $h )
                                <p>{{ $h }}</p>
                            @endforeach
                        @else
                            <p>{{ __('Closed') }}</p>
                        @endisset
                    </td>
                @endforeach
            </tr>
        </table>

        <p>
        @if( $store->openNow )
            {{ __('Votre magasin est ouvert, il ferme ses portes :time.', ['time'=>$store->openNow->diffForHumans()] ) }}
        @else
            {{ __('Votre magasin est actuellement fermé.') }}
        @endif
        </p>
    </div>
@endsection