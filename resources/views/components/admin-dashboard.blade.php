<div>
    <div v-if="picked == 'solicitudes'">
        aquí van los pedidos
    </div>
    <div v-if="picked == 'almacen'">
        <almacen inline-template>
            <div>
                <div>
                    <form action="#">
                        <input type="hidden" id="urlRamas" value="{{route('ramasGet')}}">
                        <input type="hidden" id="urlRubros" value="{{route('rubrosGet')}}">
                        <input type="hidden" id="urlProductos" value="{{route('productosGet')}}">
                        <input type="hidden" id="urlPiezas" value="{{route('piezasGet')}}">
                        <label>
                            <input v-model="select" type="radio" name="almacen" value="ramas" checked>
                            <span>Ramas</span>
                        </label>
                        <label>
                            <input v-model="select" type="radio" name="almacen" value="rubros">
                            <span>Rubros</span>
                        </label>
                        <label>
                            <input v-model="select" type="radio" name="almacen" value="productos">
                            <span>Productos</span>
                        </label>
                        <label>
                            <input v-model="select" type="radio" name="almacen" value="piezas">
                            <span>Piezas</span>
                        </label>
                        <label>
                            <input v-model="select" type="radio" name="almacen" value="fotos">
                            <span>Fotos</span>
                        </label>
                    </form>
                </div>
                <div>
                    <div v-if="select == 'ramas'">
                        <div v-for="rama in ramas" class="rama">
                            @{{rama.rama}}
                        </div>
                        <div>
                            add rama
                        </div>
                    </div>
                </div>
            </div>
        </almacen>
    </div>
    <div v-if="picked == 'ajustes'">
        ajustes
    </div>
</div>