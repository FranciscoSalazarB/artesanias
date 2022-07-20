Vue.component('cliente-compras',{
    data(){
        return{
            compras:[],
            evidenciaASuvir:"",
            ruta:"",
        };
    },
    async mounted(){
        this.ruta = document.getElementById('clienteRuta').value;
        this.compras = await this.$http.post(this.ruta+"/compras");
        this.compras = this.compras.body;
        const hoy = new Date();
        this.compras = this.compras.map(function(compra){
            compra.venta.caducado = hoy > new Date(compra.venta.fechaLimitePago);
            compra.venta.creado = moment(compra.venta.created_at).fromNow();
            compra.venta.caduca = moment(compra.venta.fechaLimitePago).fromNow();
            compra.venta.created_at = moment(compra.venta.created_at).format('MMMM Do YYYY, [a las] h:mm:ss a');
            compra.venta.fechaLimitePago = moment(compra.venta.fechaLimitePago).format('MMMM Do YYYY, [a las] h:mm:ss a');
            return compra;
        }); 
        console.log(this.compras);
    },
    methods:{
        total(piezas){
            const precios = piezas.map(pieza=>pieza.precio);
            return precios.reduce(function(acum,value){
                return acum + value;
            });
        },
        addEvidencia(event){
            var form_data = new FormData();
            const idVenta = this.getPedidoSinEvidencia().id;
            const img  =  event.target.files[0];
            form_data.append('img',img);
            form_data.append('idVenta',idVenta);
            this.evidenciaASuvir = form_data;
        },
        getPedidoSinEvidencia(){
            var pedido = this.compras.find(compra => {
                return compra.venta.status  == 'espera' && !compra.venta.caducado;
            });
            return pedido.venta;
        },
        async subirEvidencia(){
            const res = await this.$http.post(this.ruta+'/addEvidencia',this.evidenciaASuvir);
            console.log(res);
        },
        async cancelarPedido(pedido){
            var req = {idPedido:pedido}
            const res = await this.$http.post(this.ruta+'/cancelar');
        }
    }
});