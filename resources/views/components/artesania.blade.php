<artesania :artesania_atributes="artesania" inline-template @wheel.prevent @touchmove.prevent @scroll.preven>
    <div class="artesania_card">
        <img :src="artesania_atributes.fotos[0].url+artesania_atributes.fotos[0].nombreArchivo" >
        <p class="name">@{{artesania_atributes.pieza.nombre}}</p>
        <p class="descript">@{{artesania_atributes.pieza.descript}}</p>
        <p>$@{{artesania_atributes.pieza.precio}}</p>
        @auth
            <p v-if="apartado" class="apartado">Agregado</p>
            <a href="#" class="button_card" v-on:click="agregar" v-else>Agregar al carrito</a>
        @endauth
        @guest
            <a href="{{route('login')}}" class="piezaIniciarSesion">Inicie sesión para comprar</a>
        @endguest
    </div>
</artesania>