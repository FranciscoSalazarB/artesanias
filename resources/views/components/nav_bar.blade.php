<div class="nav_bar">
    <h1>Casa de las Artesanías</h1>
    <ul>
        <li><a href="https://www.casadelasartesaniaschiapas.gob.mx/#gsc.tab=0" class="button">Home</a></li>
        <li><a href="#" class="button">Carrito</a></li>
        @if(Route::currentRouteName() == 'index')
            @auth
                <li><a href="#" class="button">Usuario</a></li>
            @endauth
            @guest
                <li><a href="{{route('login')}}" class="button">Registro</a></li>
            @endguest
        @else
            <li><a href="{{route('index')}}" class="button">Catálogo</a></li>
        @endif 
    </ul>
</div>