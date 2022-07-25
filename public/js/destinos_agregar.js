Vue.component('destinosagregar',{
    data(){
        return {
            direccion : "",
            cp : "",
            estado:"",
            municipio:"",
            localidad:"",
            ruta : ""
        }
    },
    mounted(){
        this.ruta = document.getElementById('destinosRuta').value;
    },
    methods:{
        async agregar(){
            var data = {
                direccion : this.direccion,
                cp : this.cp,
                estado : this.estado,
                municipio : this.municipio
            };
            await this.$http.post(this.ruta,data);
        }
    }
});