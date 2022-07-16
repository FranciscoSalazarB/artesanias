Vue.component('cliente',{
    data(){
        return{
            user:"",
            destinos:[],
            ruta:'',
            newDestino:{
                direccion:'',
                cp:'',
                estado:'',
                municipio:''
            }
        }
    },
    async mounted(){
        this.ruta = document.getElementById('clienteRuta').value;
        this.user = await this.$http.post(this.ruta);
        this.user = this.user.body;
        this.destinos = await this.$http.post(this.ruta+"/destinos");
        this.destinos = this.destinos.body;
    },
    methods:{
        async agregarDestino(){
            await this.$http.post(this.ruta+'/addDestino',this.newDestino);
        }
    }
});