<carrito inline-template>
    <div class="carrito_compras" v-if="activo">
        <div class="container">
            <div class="headeCarrito">
                <h2>Carrito de compras</h2>
                <a href="#" class="cerrar_carrito" v-on:click="cerrar">&#10006;</a>
            </div>
            <h1 v-if="seleccionados.length === 0">No hay elementos en el carrito</h1>
            <div v-else class="seleccionados_container">
                <div v-for="(seleccionado, index) in seleccionados" class="seleccionados">
                    <p>@{{seleccionado.nombre}}</p>
                    <a href="#" v-on:click="remover(index)">Remover del carrito</a>
                </div>
                <a href="#" class="comprar" v-on:click="guardar">Comprar</a>
            </div>
        </div>
    </div>
</carrito>