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
            return 100 + precios.reduce(function(acum,value){
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
            Swal.fire({
                title:'¿Está seguro de subir esta evidencia de pago?',
                icon: 'warning',
                showDenyButton: true,
                confirmButtonText: 'Subir evidencia',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText:'cancelar'
            }).then(async result => {
                if(result.isConfirmed){
                    try {
                        let res = await this.$http.post(this.ruta+'/addEvidencia',this.evidenciaASuvir);
                        res = res.body;
                        if (res.length > 0) {
                            Swal.fire({
                                title : 'Error',
                                icon : 'error',
                                text : res
                            });
                        } else {
                            Swal.fire({
                                title : 'Se a subido correctamente la evidencia',
                                icon : 'success',
                            });
                        }
                        
                    } catch (error) {
                        Swal.fire({
                            title : 'Error',
                            icon : 'error',
                            text : 'Hubo un error al subir la evidencia, inténtelo más tarde'
                        });
                    }
                }
            });
        },
        async cancelarPedido(pedido){
            Swal.fire({
                title:'¿Está seguro de cancelar este pedido?',
                icon: 'warning',
                showDenyButton: true,
                confirmButtonText: 'Cancelar Pedido',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText:'regresar'
            }).then(async result => {
                if (result.isConfirmed) {
                    var req = {idPedido:pedido}
                    try {
                        await this.$http.post(this.ruta+'/cancelar',req);
                        Swal.fire({
                            title : 'Pedido cancelado correctamente',
                            icon: 'success'
                        });
                    } catch (error) {
                        Swal.fire({
                            title: 'Error',
                            icon : 'error',
                            text : 'Algo salió mal, intenta cancelar este pedido más tarde'
                        })
                    }
                }
            });
        }
    }
});