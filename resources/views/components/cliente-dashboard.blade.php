<div>
    <input type="hidden" id="clienteRuta" value="{{route('cliente')}}">
    <div v-if="picked == 'main'">
        <cliente inline-template>
            <div>
                <div>
                    <p>Nombre : @{{user.name}} <br>Correo : @{{user.email}} <br> @{{user.roll}}</p>
                </div>
                <br>
                <div>
                    <p>Destinos</p>
                    <div v-for="destino in destinos">
                        @{{destino.direccion}} @{{destino.cp}}
                    </div>
                    <destinosagregar inline-template>
                        <div>
                            <input type="hidden" id="destinosRuta" value="{{route('addDestino')}}">
                            <label>
                                <span>Dirección</span>
                                <input type="text" v-model="direccion">
                            </label>
                            <label>
                                <span>cp</span>
                                <input type="text" v-model="cp">
                            </label>
                            <label>
                                <button v-on:click="agregar">Agregar destino</button>
                            </label>
                        </div>
                    </destinosagregar>
                </div>
            </div>
        </cliente>
    </div>
    <div v-if="picked == 'compras'">
        <cliente-compras inline-template>
            <div v-if="compras.length != 0">
                <div v-for="compra in compras" class="compra">
                    <p>Pedido @{{compra.venta.creado}}</p>
                    <p>Total $@{{total(compra.piezas)}}</p>
                    <div v-for="pieza in compra.piezas">
                        @{{pieza.nombre}}, $@{{pieza.precio}}
                    </div>
                </div>
                <br>
            </div>
        </cliente-compras>
    </div>
</div>