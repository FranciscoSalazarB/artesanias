<div v-for="artesania in lista" class="card">
    <artesania :artesania_atributes="artesania" inline-template>
        <div class="artesania_card">
            <img :src="artesania_atributes.img_url" >
            <p class="name">@{{artesania_atributes.nombre}}</p>
            <p class="descript">@{{artesania_atributes.descript}}</p>
            <p>$@{{artesania_atributes.precio}}</p>
            @auth
                <a href="#" class="button_card" >Agregar al carrito</a>
            @endauth
        </div>
    </artesania>
</div>