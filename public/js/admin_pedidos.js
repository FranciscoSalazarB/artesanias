Vue.component('pedidosadmin',{
    data(){
        return {
            pedidosPendientes:[],
            rutas:""
        }
    },
    async mounted(){
        this.rutas = document.getElementById('rutaPedidos').value;
        this.pedidosPendientes = await this.$http.post(this.rutas);
        this.pedidosPendientes = this.pedidosPendientes.body;
        this.pedidosPendientes = this.pedidosPendientes.map(function (pedido) {
            pedido.creado = moment(pedido.created_at).fromNow();
            return pedido;
        })
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
        }
    }
});