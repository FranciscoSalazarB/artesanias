<catalogo inline-template>
    <div id="catalogoContainer">
        <input type="hidden" id="csrf_token" value="{{ csrf_token() }}"/>
        <input type="hidden" id="rute" value="{{route('artesanias')}}"/>
        <div class="catalogoHeader">
            <h2>Recorrido virtual</h2>
            
        </div>
        <div class="preloader" v-if="piezas.length === 0">
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
        <div class="catalogo" v-if="piezas.length !== 0">
            <div class="card_container" v-for= "artesania in piezas">
                <x-artesania/>
            </div>
        </div>
    </div>
</catalogo>