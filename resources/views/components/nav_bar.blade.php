<div class="nav_bar">
    <img src="{{asset('img/logo2.png')}}" class="logo">
    <ul>
        <li><a href="https://www.casadelasartesaniaschiapas.gob.mx/#gsc.tab=0" class="button">Sitio Casa de las Artesanías</a></li>
        @auth
            @if(Auth::user()->piezasApartadasSinPagar())
            <p>Ya hay piezas apartadas</p>
            <a href="{{ url('/dashboard') }}" id="dashboardHref" class="button">Panel de Control</a>
            @else
            <a href="#" class="button" v-on:click="abrir_carrito">Carrito</a>
            <a href="{{ url('/dashboard') }}" id="dashboardHref" class="button">Panel de Control</a>
            @endif
        @else
            @if(Route::currentRouteName() == "login")
                <a href="{{ route('/') }}" class="button">Regresar</a>
            @else
                <a href="{{ route('login') }}" class="button">IniciarSesión</a>
            @endif
            @if (Route::has('register'))
                @if(Route::currentRouteName() == "register")                
                    <a href="{{ route('/') }}" class="button">Regresar</a>
                @else
                    <a href="{{ route('register') }}" class="button">Registro</a>
                @endif
            @endif
        @endauth
    </ul>
</div>