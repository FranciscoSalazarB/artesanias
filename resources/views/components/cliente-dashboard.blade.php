<div>
    <input type="hidden" id="clienteRuta" value="{{route('cliente')}}">
    <div v-if="picked == 'politicas'" class="politicas">
    <h1>Políticas de ventas</h1>
    <p>
    1.	Para realizar una compra debes tener asignado un destino a donde serán enviadas las piezas compradas.<br>
    2.	Todas las piezas tienen un costo de envió extra, que se incluye en el Total.<br>
    3.	Si la pieza ya fue aparta por otro usuario, usted no podrá apartarla porque son piezas únicas.<br>
    4.	Usted podrá subir una imagen nítida de todo el comprobante de pago, que no supere los 500 kb.<br>
    5.	Después de apartar las piezas seleccionadas en el carrito, tendrá una fecha límite para subir su evidencia de pago que se le generará automáticamente. <br>
    6.	En caso que la imagen no corresponda al pedido o no sea nítida, su pedido será denegado. <br>
    7.	Una vez corroborado su depósito, usted podrá ver el número de guía del servicio de paquetería. <br>
    8.	Si usted tiene un carrito de compras que se encuentra en espera, no podrá realizar más pedidos, hasta que haya finalizado la compra del carrito anterior o lo cancele.<br> 
    9.	Si tu pedido se cancela, se deniega el pago o caduca la fecha límite para subir la evidencia, las piezas quedaran disponibles nuevamente. <br>
    10.	Si desea adquirir las piezas nuevamente, deberá realizar un pedido nuevo.<br>
    11.	 En caso de dudas, sugerencias o reclamos, comunicarse al numero 961….<br>
    </p>
    </div>
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
                        @{{destino.direccion}} @{{destino.cp}} en el estado de @{{destino.estado}}, municipio @{{destino.municipio}}
                    </div>
                    <destinosagregar inline-template>
                        <div>
                            <input type="hidden" id="destinosRuta" value="{{route('addDestino')}}">
                            <label>
                                <span>Dirección</span>
                                <input type="text" v-model="direccion" placeholder="Ingresa una dirección de envío">
                            </label>
                            <label>
                                <span>cp</span>
                                <input type="text" v-model="cp" placeholder="Ingresa el código postal">
                            </label>
                            <label>
                                <span>Estado</span>
                                <input type="text" v-model="estado" placeholder="Ingresa el Estado dentro del territorio Mexicano">
                            </label>
                            <label>
                                <span>Municipio</span>
                                <input type="text" v-model="municipio" placeholder="Ingresa el Municio de envío">
                            </label>
                            <label>
                                <button v-on:click="agregar" class="agregarDestino">Agregar destino</button>
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
                    <div>
                        <p>Estatus : @{{compra.venta.status}}</p>
                        <p>Pedido @{{compra.venta.creado}} el @{{compra.venta.created_at}}</p>
                        <p>El tiempo para subir la evidencia @{{ compra.venta.caducado ? 'ha vencido': 'vence '+compra.venta.caduca}} el @{{compra.venta.fechaLimitePago}}</p>
                        <p>Total $@{{total(compra.piezas)}}</p>
                        <p>Enviado a @{{compra.venta.destino.direccion}}</p>
                        <div v-for="pieza in compra.piezas">
                            @{{pieza.nombre}}, $@{{pieza.precio}}
                        </div>
                    </div>
                    <div class="evidencia" v-if="!compra.venta.caducado">
                        <input type="file" v-on:change="addEvidencia" acepted="imge/*">
                        <button class="subirEvidencia" v-on:click="subirEvidencia">Subir evidencia de pago</button>
                        <button class="cancelarPedido">Cancelar Pedido</button>
                    </div>
                    <div class="evidencia" v-if="compra.venta.evidencia.length > 0">
                        <button class = "evidenaciaButton">Descargar Evidencia</button>
                    </div>
                </div>
                <br>
            </div>
        </cliente-compras>
    </div>
</div>