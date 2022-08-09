<div>
    <input type="hidden" id="clienteRuta" value="{{route('cliente')}}">
    <div v-if="picked == 'politicas'" class="politicas">
    <h1>Políticas de ventas</h1>
    <div class="politicaContainer">
        <h2>Políticas de registro</h2>
        <p>1.    El Correo electrónico solo podrá estar registrado una vez, es decir, es único en el uso de esta plataforma</p>
        <p>2.    Para realizar una compra debes tener asignado un destino a donde serán enviadas las piezas compradas.</p>
        <p>3.    Cada que realiza una orden de pedido tiene un costo de envio, que se desgloza en el total del carrito.</p>
        <p>4.    Si las pieza seleccionadas ya fueron apartada por otro usuario, usted no podrá apartarlas porque son piezas únicas.</p>
    </div>
    <div class="politicaContainer">
        <h2>Políticas de pago</h2>
        <p>5.	Usted deberá subir una imagen nítida en formato jpg de todo el comprobante de pago, que no supere los 500 kb.</p>
        <p>6.	Después de apartar las piezas seleccionadas en el carrito, tendrá una fecha límite para subir su evidencia de pago que se le generará automáticamente.</p>
        <p>7.	En caso que la imagen no corresponda al pedido o no sea nítida, su pedido será denegado.</p>
        <p>8.	Una vez corroborado su depósito, usted podrá ver el número de guía del servicio de paquetería.</p>
        <p>9.   Una vez realizado el pago no podrá cancelar el pedido</p>
    </div>
    <div class="politicaContainer">
        <h2>Políticas de envío</h2>
        <p>10. Después de conocer su número de guia y empresa de paquetería, podrá hacer el seguimiento en la plataforma de la paquetería</p>
    </div>
    <div class="politicaContainer">
        <h2>Políticas del carrito de compras</h2>
        <p>11.	Si usted tiene un carrito de compras que se encuentra en espera, no podrá realizar más pedidos, hasta que haya subido su evidencia de pago, cancele el pedido o caduque la fecha límite.</p>
        <p>12.	Si su pedido se cancela, se deniega el pago o caduca la fecha límite para subir la evidencia, las piezas quedaran disponibles nuevamente.</p>
        <p>13.	Si desea adquirir las piezas nuevamente, deberá realizar un pedido nuevo.</p>
    </div>
    <div class="politicaContainer">
        <h2>Sugerencias y aclaraciones</h2>
        <p>14.	 En caso de dudas, sugerencias o reclamos, comunicarse al numero 961….</p>
    </div>
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
                                <input class="inputDestino" type="text" v-model="direccion" placeholder="Ingresa una dirección de envío">
                            </label>
                            <label>
                                <span>cp</span>
                                <input class="inputDestino" type="text" v-model="cp" placeholder="Ingresa el código postal">
                            </label>
                            <label>
                                <span>Estado</span>
                                <input class="inputDestino" type="text" v-model="estado" placeholder="Ingresa el Estado dentro del territorio Mexicano">
                            </label>
                            <label>
                                <span>Municipio</span>
                                <input class="inputDestino" type="text" v-model="municipio" placeholder="Ingresa el Municio de envío">
                            </label>
                            <br>
                            <label>
                                <span>Localidad</span>
                                <input class="inputDestino" type="text" v-model="localidad" placeholder="Ingresa la Localidad de envío">
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
                    <div class="compraDatos">
                        <p>Estatus : @{{compra.venta.status == 'espera' && compra.venta.caducado ? 'caducado' : compra.venta.status}}</p>
                        <p>Pedido @{{compra.venta.creado}} el @{{compra.venta.created_at}}</p>
                        <p>El tiempo para subir la evidencia @{{ compra.venta.caducado ? 'ha vencido': 'vence '+compra.venta.caduca}} el @{{compra.venta.fechaLimitePago}}</p>
                        <p v-if="compra.venta.referenciaEnvio">La referencia de envío es : @{{compra.venta.referenciaEnvio}}</p>
                        <p v-if="compra.venta.status == 'denegado'">Motivo de denegación : @{{compra.venta.motivo}}</p>
                        <p>Total $@{{total(compra.piezas)}}</p>
                        <p>Con destino a @{{compra.venta.destino.direccion}}</p>
                        <div v-for="pieza in compra.piezas">
                            @{{pieza.nombre}}, $@{{pieza.precio}}
                        </div>
                        <p>Numero de cuenta : 4152 3136 6112 8970</p>
                    </div>
                    <div class="evidencia compraOpciones" v-if="!compra.venta.caducado && compra.venta.status == 'espera'">
                        <input type="file" v-on:change="addEvidencia" acepted="imge/*">
                        <button class="subirEvidencia" v-on:click="subirEvidencia">Subir evidencia de pago</button>
                        <button class="cancelarPedido" v-on:click="cancelarPedido(compra.venta.id)">Cancelar Pedido</button>
                    </div>
                    <div class="evidencia compraOpciones" v-if="compra.venta.evidencia.length > 0">
                        <button class = "evidenaciaButton"><a :href="'{{route('/')}}' + compra.venta.evidencia[0].nombreArchivo">Descargar Evidencia</a></button>
                    </div>
                </div>
                <br>
            </div>
        </cliente-compras>
    </div>
</div>