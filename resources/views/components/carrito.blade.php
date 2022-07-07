<carrito inline-template>
    <div class="carrito_compras" v-if="activo">
        <a href="#" class="cerrar_carrito" v-on:click="cerrar">&#10006;</a>
        <div class="container">
            <h1 v-if="seleccionados.length === 0">No hay elementos en el carrito</h1>
            <div v-else class="seleccionados_container">
                <div v-for="(seleccionado, index) in seleccionados" class="seleccionados">
                    <img :src="seleccionado.fotos[0].url+seleccionado.fotos[0].nombreArchivo" class="imgCarrito">
                    <p>@{{seleccionado.nombre}} $@{{seleccionado.precio}}</p>
                    <a href="#" v-on:click="remover(index)">&#10006;</a>
                </div>
            </div>
            <div v-if="seleccionados.length !== 0" class="carrito_info">
                <div>
                    <div class="texto_carrito">Costo de envío : $100</div>
                    <div class="texto_carrito">Enviar a :</div>
                    <select v-model="destinoSelect" :value="destinos[0]">
                        <option :value="destino.id" v-for="destino in destinos">@{{destino.direccion}}</option>
                    </select>
                </div>
                <a href="#" class="comprar" v-on:click="guardar">Realizar Pedido por $@{{costoTotal}}</a>
            </div>
        </div>
    </div>
</carrito>