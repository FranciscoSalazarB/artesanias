Vue.component('cliente-compras',{
    data(){
        return{
            compras:[],
            ruta:"",
            ahora:""
        };
    },
    async mounted(){
        this.ahora = new Date();
        this.ruta = document.getElementById('clienteRuta').value;
        this.compras = await this.$http.post(this.ruta+"/compras");
        this.compras = this.compras.body;
        moment.locale('es');
        this.compras = this.compras.map(function(compra){
            compra.venta.creado = moment(compra.venta.created_at).fromNow();
            return compra;
        });
        console.log(this.compras);
    },
});