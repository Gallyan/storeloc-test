@extends('layout')
@section('content')
    <div>
        {{ __('Liste des stores (services):') }}
        <ul>
        @forelse( $stores as $store )
            <li>
                <a href="{{ route('stores.show',$store->id) }}">{{ __($store->name) }}</a>
                ({{ $store->servicesEnum }})
            </li>
        @empty
            {{ __('Aucun store') }}
        @endforelse
        </ul>
    </div>
@endsection