@extends('layout')
@section('content')
    <div>
        {{ __('Liste des services:') }}
        <ul>
        @forelse( $services as $service )
            <li><a href="{{ route('services.show',$service->id) }}">{{ __($service->name) }}</a></li>
        @empty
            {{ __('Aucun service') }}
        @endforelse
        </ul>
    </div>
@endsection