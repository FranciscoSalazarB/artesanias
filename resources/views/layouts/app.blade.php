<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Casa artesanias') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            .fondo{
                background-image: url({{asset('img/grecas.png')}});
                background-position: center;
                background-size: cover;
            }.hola{}
        </style>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/locale/es.js"></script>
        @if(Auth::user()->roll == "cliente")
        <script src="{{asset('js/cliente_component.js')}}"></script>
        <script src="{{asset('js/clienteCompras_component.js')}}"></script>
        <script src="{{asset('js/destinos_agregar.js')}}"></script>
        @else
        <script src="{{asset('js/almacen_component.js')}}"></script>
        <script src="{{asset('js/admin_pedidos.js')}}"></script>
        <script src="{{asset('js/ajustes_admin.js')}}"></script>
        <script src="{{asset('js/historico_pedidos.js')}}"></script>
        @endif
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 fondo">
            @include('layouts.navigation')
            <div id="app">
                <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
                <!-- Page Heading -->
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
        <input type="hidden" id="user" value="{{route('cliente')}}">
    </body>
    <script>
        let csrf_token =  document.getElementById('csrf_token');
        if(csrf_token !== null) Vue.http.headers.common['X-CSRF-TOKEN'] = csrf_token.value;
        let userRuta = document.getElementById('user').value;
        var app = new Vue({
            el:"#app",
            data:{
                picked : ''
            },
            async mounted(){
                var user = await this.$http.post(userRuta);
                user = user.body;
                if(user.roll == 'cliente') this.picked = 'politicas';
                else this.picked = 'pedidos';
            }
        });
    </script>
</html>