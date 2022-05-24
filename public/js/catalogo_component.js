Vue.component('catalogo',{
    data(){
        return {
            ruta : '',
            ramaSelect:'',
            rubroSelect:'',
            ramas : [],
            piezas : []
        } 
    },
    async mounted(){
        this.ruta = document.getElementById('rute').value;
        try {
            this.ramas = await this.$http.post(this.ruta+"/ramas");
            this.ramas = this.ramas.body;
        } catch (error) {
            console.log(error);
        }
    },
    methods:{
        async getPiezasByRubro(rubro){
            const res = await this.$http.post(this.ruta+"/piezasInRubro",rubro);
            this.piezas = res.body;
            console.log(this.piezas);
        }
    },
    watch:{
        rubroSelect: function(idRubro){
            var rubro = {id:idRubro}
            this.getPiezasByRubro(rubro);
        } 
    }
    
});