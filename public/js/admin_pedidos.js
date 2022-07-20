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
        this.pedidosPendientes = await this.$http.post(this.rutas);
        this.pedidosPendientes = this.pedidosPendientes.body;
        this.pedidosPendientes = this.pedidosPendientes.map(function (pedido) {
            pedido.creado = moment(pedido.created_at).fromNow();
            return pedido;
        })
        console.log(this.pedidosPendientes)
    },
    methods:{
        async aceptar(idPedido){
            await this.$http.post(this.rutas+'/pagado',{idPedido:idPedido});
        },
        total(detalles){
            var precios = detalles.map(detalle=>detalle.pieza.precio);
            return precios.reduce(function(acum,value){
                return acum + value;
            });
        },
        async denegar(idPedido){
            await this.$http.post(this.rutas+'/denegado',{idPedido:idPedido});
        },
        async subirGuiaEnvio(idPedido){
            var res = await {
                idPedido:idPedido,
                referencia : await this.findPedidoRef(idPedido)
            }
            console.log(res);
            await this.$http.post(this.rutas+'/referencia', res);
        },
        async findPedidoRef(idPedido){
            return this.pedidosPendientes.find((pedido) => {return pedido.id == idPedido}).referenciaEnvio;
        }
    }
});