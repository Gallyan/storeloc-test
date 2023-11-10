<html>
    <head>
        <title>Storeloc Test</title>
        <style>
            body {
                font-family: 'Roboto', Arial;
            }
            .form {
                display: flex;
                gap: 12px;
            }
            .bounds, .filters {
                display: flex;
                flex-direction: column;
                gap: 12px;
                justify-content: stretch;
            }
            div {
                margin: 10px;
            }
            table {
                border-spacing: 0;
            }
            td {
                border: Solid 1px #f2f2f2;
                padding: 10px;
            }
            .font-bold {
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="{{ route('index') }}">{{ __('Accueil') }}</a></li>
                <li><a href="{{ route('services.index') }}">{{ __('Services') }}</a></li>
                <li><a href="{{ route('stores.index') }}">{{ __('Stores') }}</a></li>
            </ul>
        </nav>
        @yield('content')
    </body>
</html>