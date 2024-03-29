<div>
    <div v-if="picked == 'pedidos'">
        <pedidosadmin inline-template>
            <div>
                <input type="hidden" id="rutaPedidos" value = "{{route('adminPedidos')}}">
                <input type="hidden" id="root" value = "{{route('/')}}">
                <div v-for="pedido in pedidosPendientes" class="pedidoPorConfirmar">
                    <h4>para @{{pedido.cliente.name}} Con destino a @{{pedido.destino.direccion}}</h4>
                    <h4>pedido @{{pedido.creado}} por un total de $@{{total(pedido.detalles)}}</h4>
                    <h4>Piezas seleccionadas : </h4>
                    <ul v-for="detalle in pedido.detalles">
                        <li class="listadoPiezasPedido">@{{detalle.pieza.nombre}}  $@{{detalle.pieza.precio}}</li>
                    </ul>
                    <button class="aceptarPago" v-on:click="aceptar(pedido.id)" v-if="pedido.status == 'porConfirmar'">Aceptar Pago</button>
                    <button class="denegarPago" v-on:click="denegar(pedido.id)" v-if="pedido.status == 'porConfirmar'">Denegar Pago</button>
                    <button class="aceptarPago" v-on:click="subirGuiaEnvio(pedido.id)" v-if="pedido.status == 'confirmado'">Subir Guía de envío</button>
                    <input type="text" v-model="pedido.referenciaEnvio" v-if="pedido.status == 'confirmado'">
                    <button class="descargarEvidencia"><a :href="root + pedido.evidencia[0].nombreArchivo">Descargar Evidencia de Pago</a></button>
                </div>
            </div>
        </pedidosadmin>
    </div>
    <div v-if="picked == 'historico'">
        <historico inline-template>
            <div>
                <input type="hidden" id="historicoPedidos" value="{{route('historico')}}">
                <div v-for ="pedidos in listado" class="listado">
                    Estatus : @{{pedidos.status == 'espera'  ? 'caducado' : pedidos.status}}<br>
                    Pedido el : @{{pedidos.created_at}}<br>
                    Cliente : @{{pedidos.cliente.name}}, @{{pedidos.cliente.email}}, @{{pedidos.cliente.cel}}<br>
                    Destino : @{{pedidos.destino.direccion}} Estado de @{{pedidos.destino.estado}} municipio @{{pedidos.destino.municipio}}  localidad @{{pedidos.destino.localidad}}<br>
                    CP : @{{pedidos.destino.cp}}<br>
                    Cel: @{{pedidos.cliente.cel}}
                    <div v-for = "piezas in pedidos.detalles" class="productos">
                        *@{{piezas.pieza.nombre}}<br>
                        $@{{piezas.pieza.precio}}<br>
                        Código : @{{piezas.pieza.codigoAlterno}}
                    </div>
                </div>
            </div>
        </historico>
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