<carrito inline-template>
    <div class="carrito_compras" v-if="activo">
        <a href="#" class="cerrar_carrito" v-on:click="cerrar">&#10006;</a>
        <div class="container">
            <h1 v-if="seleccionados.length === 0">No hay elementos en el carrito</h1>
            <div v-else class="seleccionados_container">
                <div v-for="(seleccionado, index) in seleccionados" class="seleccionados">
                    <img :src="seleccionado.fotos[0].url+seleccionado.fotos[0].nombreArchivo" class="imgCarrito">
                    <p>@{{seleccionado.nombre}} $@{{seleccionado.precio}}</p>
                    <a href="#" v-on:click="remover(index)">Remover del carrito</a>
                </div>
            </div>
            <a href="#" class="comprar" v-on:click="guardar" v-if="seleccionados.length !== 0">Comprar por $@{{costoTotal}}</a>
        </div>
    </div>
</carrito>