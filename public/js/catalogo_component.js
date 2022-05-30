Vue.component('catalogo',{
    data(){
        return {
            ruta : '',
            ramaSelect:'',
            rubroSelect:'',
            ramas : [],
            rubros: [],
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
        async getRubrosByRama(rama){
            rubros = await this.$http.post(this.ruta+"/rubros",rama);
            this.rubros = rubros.body;
        },
        async getPiezasByRubro(rubro){
            const res = await this.$http.post(this.ruta+"/piezasInRubro",rubro);
            this.piezas = res.body;
        }
    },
    watch:{
        rubroSelect: function(idRubro){
            var rubro = {id:idRubro}
            this.getPiezasByRubro(rubro);
        },
        ramaSelect : function(rama){   
            this.getRubrosByRama(rama);
        }
    }
    
});