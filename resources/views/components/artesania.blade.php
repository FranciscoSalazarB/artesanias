<artesania :artesania_atributes="artesania" inline-template>
    <div class="artesania_card">
        <img :src="artesania_atributes.fotos[0].url+artesania_atributes.fotos[0].nombreArchivo" >
        <p class="name">@{{artesania_atributes.nombre}}</p>
        <p class="descript">@{{artesania_atributes.descript}}</p>
        <p>$@{{artesania_atributes.precio}}</p>
        @auth
            <p v-if="apartado" class="apartado">Agregado</p>
            <a href="#" class="button_card" v-on:click="agregar" v-else>Agregar al carrito</a>
        @endauth
    </div>
</artesania>
