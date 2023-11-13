@extends('layout')
@section('content')
    <form method="GET" action="{{ route('results') }}" class="form">
        <div class="bounds">

            <input type="search" name="n" placeholder="Latitude nord" />
            @error('n')
            <span style="color:red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input type="search" name="w" placeholder="Longitude ouest" />
            @error('w')
            <span style="color:red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input type="search" name="s" placeholder="Latitude sud" />
            @error('s')
            <span style="color:red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input type="search" name="e" placeholder="Longitude est" />
            @error('e')
            <span style="color:red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>
        <div class="filters">

            <label for="services[]">{{ __('Services:') }}</label>
            <select multiple name="services[]">
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ __($service->name) }}</option>
                @endforeach
            </select>
            @error('services')
            <span style="color:red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <label for="operator">{{ __('Operator:') }}</label>
            <select name="operator">
                <option value="OR">OR</option>
                <option value="AND">AND</option>
            </select>
            @error('operator')
            <span style="color:red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>
        <div class="submit">
            <input type="submit" />
        </div>
    </form>
@endsection