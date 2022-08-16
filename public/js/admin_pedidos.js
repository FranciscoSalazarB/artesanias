Vue.component('pedidosadmin',{
    data(){
        return {
            pedidosPendientes:[],
            rutas:"",
            root:''
        }
    },
    async mounted(){
        this.rutas = document.getElementById('rutaPedidos').value;
        this.root = document.getElementById('root').value
        await this.getPendiente();
        console.log(this.pedidosPendientes)
    },
    methods:{
        async getPendiente(){
            this.pedidosPendientes = await this.$http.post(this.rutas);
            this.pedidosPendientes = this.pedidosPendientes.body;
            this.pedidosPendientes = this.pedidosPendientes.map(function (pedido) {
                pedido.creado = moment(pedido.created_at).fromNow();
                return pedido;
            });
        },
        async aceptar(idPedido){
            Swal.fire({
                title:'¿Está seguro de aceptar el pago de este pedido?',
                showDenyButton: true,
                icon: 'warning',
                confirmButtonText: 'Aceptar Pago',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText:'Cancelar'
            }).then(async result => {
                if (result.isConfirmed) {
                    await this.$http.post(this.rutas+'/pagado',{idPedido:idPedido});
                    Swal.fire({
                        title : 'Pedido Aceptado',
                        icon: 'success'
                    });
                    this.getPendiente();
                }
            });
        },
        total(detalles){
            var precios = detalles.map(detalle=>detalle.pieza.precio);
            return precios.reduce(function(acum,value){
                return acum + value;
            });
        },
        tipos(){
            var salida =[];
            this.pedidosPendientes.forEach(item=>{
                if(!item.status in salida){
                    salida.push(item.status);
                }
            });
            return salida;
        },
        async denegar(idPedido){
            Swal.fire({
                title:'¿Está seguro de denegar este pedido?',
                showDenyButton: true,
                icon: 'warning',
                confirmButtonText: 'Denegar Pago',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText:'Cancelar'
            }).then(async result => {
                if (result.isConfirmed){
                    const { value : motivo } = await Swal.fire({
                        title : 'Escriba el motivo de la denegación',
                        input : 'text',
                        showCancelButton: true,
                        inputValidator : (value) => {
                            if (!value) {
                                return 'Escriba el motivo por favor';
                            }
                        }
                    });
                    await this.$http.post(this.rutas+'/denegado',{idPedido:idPedido, motivo : motivo});
                    Swal.fire({
                        title : 'Pedido Denegado',
                        icon: 'success'
                    });
                    this.getPendiente();
                }
            });
        },
        async subirGuiaEnvio(idPedido){
            Swal.fire({
                title:'¿Está seguro de subir la gía para este pedido?',
                showDenyButton: true,
                icon: 'warning',
                confirmButtonText: 'Aceptar Pago',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText:'Cancelar'
            }).then(async result => {
                if (result.isConfirmed){
                    var res = {
                        idPedido:idPedido,
                        referencia : await this.findPedidoRef(idPedido)
                    }
                    await this.$http.post(this.rutas+'/referencia', res);
                    Swal.fire({
                        title : 'Referencia correctamente subida',
                        icon: 'success'
                    });
                    this.getPendiente();
                }
            });
        },
        async findPedidoRef(idPedido){
            return this.pedidosPendientes.find((pedido) => {return pedido.id == idPedido}).referenciaEnvio;
        }
    }
});