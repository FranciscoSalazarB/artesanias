<div>
    <div v-if="picked == 'pedidos'">
        <pedidosadmin inline-template>
            <div>
                <input type="hidden" id="rutaPedidos" value = "{{route('adminPedidos')}}">
                <h1 v-if="pedidosPendientes.length == 0">No hay nuevos pedidos</h1>
                <div v-for="pedido in pedidosPendientes" class="pedidoPorConfirmar">
                    <h4>para @{{pedido.cliente.name}} Con destino a @{{pedido.destino.direccion}}</h4>
                    <h4>pedido @{{pedido.creado}} por un total de $@{{total(pedido.detalles)}}</h4>
                    <h4>Piezas seleccionadas : </h4>
                    <ul v-for="detalle in pedido.detalles">
                        <li class="listadoPiezasPedido">@{{detalle.pieza.nombre}}  $@{{detalle.pieza.precio}}</li>
                    </ul>
                    <button class="aceptarPago" v-on:click="aceptar(pedido.id)">Aceptar Pago</button>
                    <button class="denegarPago" v-on:click="denegar(pedido.id)">Denegar Pago</button>
                    <button class="descargarEvidencia">Descargar Evidencia de Pago</button>
                </div>
            </div>
        </pedidosadmin>
    </div>
    <div v-if="picked == 'almacen'">
        <almacen inline-template>
            <div>
                <x-almacen-select/>
                <x-almacen-body/>
            </div>
        </almacen>
    </div>
    <div v-if="picked == 'ajustes'">
        <input type="hidden" id="rutaAjustes" value = "{{route('ajustes')}}">
        <ajustes inline-template>
            <div>
                <div v-for="dia in dias">
                    <p>@{{getDayName(dia.id)}}</p>
                    <div>
                        <input type="range" id="test5" min="1" max="7" v-model="dia.diasRelativosAvisoDePago"/>
                        <span>Día Límitie de pago @{{getDayName(dia.id + parseInt(dia.diasRelativosAvisoDePago))}}</span>
                        <input type="range" id="test5" min="1" max="7" v-model="dia.diasRelativosAvisoDeConfirmacion"/>
                        <span>Día Límitie de confirmación @{{getDayName(dia.id + parseInt(dia.diasRelativosAvisoDePago) + parseInt(dia.diasRelativosAvisoDeConfirmacion))}}</span>
                    </div>
                </div>
                <button v-on:click="guardarCambios" class="guardarCambios">Guardar Cambios</button>
            </div>
        </ajustes>
    </div>
</div>