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
                    </form>
                </div>
                <div>
                    <div v-if="select == 'ramas'">
                        <div v-for="rama in ramas">
                            <input type="text" v-model="rama.rama">
                            <button>Editar</button>
                            <button>Eliminar</button>
                        </div>
                        <div>
                            <input type="text">
                            <button>Agregar nueva rama</button>
                        </div>
                    </div>
                    <div v-if="select == 'rubros'">
                        <div v-for="rubro in rubros">
                            <input type="text" v-model="rubro.rubro">
                            <p>rama : @{{findRama(rubro.idRama).rama}}</p>
                        </div>
                        <div>
                            <input type="text">
                            <select>
                                <option value="rama.value" v-for="rama in ramas">@{{rama.rama}}</option>
                            </select>
                        </div>
                    </div>
                    <div v-if="select == 'productos'">
                        <div v-for="producto in productos">
                            <input type="text" v-model="producto.descripcion">
                            <input type="text" v-model="producto.unidadDeMedida">
                            <p>Rubro : @{{findRubro(producto.idRubro).rubro}}</p>
                        </div>
                        <div>
                            <input type="text">
                            <input type="text">
                            <select>
                                <option value="rubro.value" v-for="rubro in rubros">@{{rubro.rubro}}</option>
                            </select>
                        </div>
                    </div>
                    <div v-if="select == 'piezas'">
                        <div v-for="pieza in piezas">
                            <input type="text" v-model="pieza.nombre">
                            <input type="number" v-model="pieza.precio">
                            <input type="text" v-model="pieza.codigoAlterno">
                            <p>Producto : @{{findProducto(pieza.idProducto).descripcion}}</p>
                            <img :src="foto.url + foto.nombreArchivo" v-for="foto in pieza.fotos">
                        </div>
                        <div>
                            add pieza
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