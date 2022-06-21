<div>
    <div v-if="picked == 'pedidos'">
        <pedidosadmin inline-template>
            <div>
                <input type="hidden" id="rutaPedidos" value = "{{route('adminPedidos')}}">
                <h1 v-if="pedidosPendientes.length == 0">No hay nuevas compras</h1>
                <div v-for="pedido in pedidosPendientes">
                    <h4>para @{{pedido.cliente.name}} Con destino a @{{pedido.destino.direccion}}</h4>
                    <h4>pedido @{{pedido.creado}} por un total de $@{{total(pedido.detalles)}}</h4>
                    <div v-for="detalle in pedido.detalles">
                        <h4>@{{detalle.pieza.nombre}}  $@{{detalle.pieza.precio}}</h4>
                    </div>
                    <button v-on:click="aceptar(pedido.id)">Pagado</button>
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
        ajustes
    </div>
</div>