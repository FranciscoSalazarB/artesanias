<div>
    <input type="hidden" id="clienteRuta" value="{{route('cliente')}}">
    <div v-if="picked == 'main'">
        <cliente inline-template>
            <div>
                <div>
                    Nombre : @{{user.name}} <br>
                    Correo : @{{user.email}} <br> 
                    @{{user.roll}}
                </div>
                <br>
                <div>
                    <p>Destinos</p>
                    <div v-for="destino in destinos">
                        @{{destino.direccion}} @{{destino.gps}}
                    </div>
                    <div>
                        <label>
                            <span>Dirección</span>
                            <input type="text">
                        </label>
                        <label>
                            <span>gps</span>
                            <input type="text">
                        </label>
                        <label>
                            <button>Agregar destino</button>
                        </label>
                    </div>
                </div>
            </div>
        </cliente>
    </div>
    <div v-if="picked == 'compras'">
        <cliente-compras inline-template>
            <div v-if="compras.length != 0">
                <div v-for="compra in compras">
                    <p>Pedido @{{compra.venta.creado}}</p>
                    <div v-for="pieza in compra.piezas">
                        @{{pieza.nombre}} 
                    </div>
                </div>
                <br>
            </div>
        </cliente-compras>
    </div>
</div>