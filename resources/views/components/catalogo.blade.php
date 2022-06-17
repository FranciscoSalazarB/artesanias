<catalogo inline-template>
    <div id="catalogoContainer">
        <input type="hidden" id="csrf_token" value="{{ csrf_token() }}"/>
        <input type="hidden" id="rute" value="{{route('catalogo')}}"/>
        <input type="hidden" id="getCarrito" value="{{route('carritoGet')}}"/>
        <input type="hidden" id="addCarrito" value="{{route('carritoAdd')}}"/>
        <input type="hidden" id="removeCarrito" value="{{route('carritoRemove')}}"/>
        <input type="hidden" id="guardarCarrito" value="{{route('carritoGuardar')}}"/>
        <div class="catalogoHeader">
            <div>
                <a href="https://www.google.com.mx/maps/place/Instituto+Casa+de+las+artesanias/@16.7542646,-93.1378318,3a,75y,146.11h,65.52t/data=!3m8!1e1!3m6!1sAF1QipOmAcpRP-ARPVmfHFTXN_k5kGIqAAFk7WutYi5G!2e10!3e11!6shttps:%2F%2Flh5.googleusercontent.com%2Fp%2FAF1QipOmAcpRP-ARPVmfHFTXN_k5kGIqAAFk7WutYi5G%3Dw224-h298-k-no-pi-20-ya168.8958-ro-0-fo100!7i4088!8i2044!4m7!3m6!1s0x85ecd90206455cdb:0x27c114a4eb0c70a6!8m2!3d16.754394!4d-93.1377278!14m1!1BCgIgARICCAI">
                   <h3>visita nuestro recorrido virtual</h3>
                </a>
            </div>
        </div>
        <div class="preloader" v-if="ramas.length === 0"> 
            <div class="lds-roller">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="caltalogoSelectContainer">
            <form action="#" class="caltalogoSelect">
                <label v-for="rama in ramas">
                    <input type="radio" :value ="rama" v-model="ramaSelect">
                    <span :class="ramaSelect.rama == rama.rama ? 'caltalogoSelected' : ''">@{{rama.rama}}</span>
                </label>
            </form>
            <form action="#" v-if="rubros.length != 0" class="caltalogoSelect">
                <label v-for="rubro in rubros">
                    <input type="radio" :value="rubro.id" v-model="rubroSelect">
                    <span :class="rubroSelect== rubro.id ? 'caltalogoSelected' : ''">@{{rubro.rubro}}</span>
                </label>
            </form>
        </div>
        <div class="catalogo" v-if="ramas.length !== 0">
            <div class="card_container" v-for= "artesania in piezas">
                <x-artesania/>
            </div>
        </div>
    </div>
</catalogo>