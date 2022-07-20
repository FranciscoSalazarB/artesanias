<artesania :artesania_atributes="artesania" inline-template @wheel.prevent @touchmove.prevent @scroll.preven>
    <div class="artesania_card">
        <img :src="artesania_atributes.fotos[0].url+artesania_atributes.fotos[0].nombreArchivo" >
        <p>@{{artesania_atributes.producto.descripcion}}</p>
        <p class="name">@{{artesania_atributes.nombre}}</p>
        <p class="descript">@{{artesania_atributes.descript}}</p>
        <p>$@{{artesania_atributes.precio}}</p>
        @auth
            @if(Auth::user()->piezasApartadasSinPagar())
            <p>Tiene Pedidos Pendientes</p>
            @else
            <p v-if="apartado" class="apartado">Agregado</p>
            <a href="#" class="button_card" v-on:click="agregar" v-else>Agregar al carrito</a>
            {{Auth::user()->piezasApartadasSinPagar()}}
            @endif
        @endauth
        @guest
            <a href="{{route('login')}}" class="piezaIniciarSesion">Inicie sesión para comprar</a>
        @endguest
        <p>@{{apartado}}</p>
    </div>
</artesania>