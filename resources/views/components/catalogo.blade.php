<catalogo inline-template>
    <div>
        <input type="hidden" id="csrf_token" value="{{ csrf_token() }}"/>
        <input type="hidden" id="rute" value="{{route('artesanias')}}"/>
        <div class="preloader" v-if="listas.length === 0">
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
        <div class="catalogo" v-if="listas.length !== 0">
            <div class="card_container" v-for= "lista in listas">
                <x-artesania/>
            </div>
        </div>
    </div>
</catalogo>