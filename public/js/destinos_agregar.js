Vue.component('destinosagregar',{
    data(){
        return {
            direccion : "",
            cp : "",
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
                cp : this.cp
            };
            await this.$http.post(this.ruta,data);
        }
    }
});