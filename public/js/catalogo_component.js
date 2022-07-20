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
            this.ramaSelect = this.ramas[0];
        } catch (error) {
            console.log(error);
        }
        this.$root.$on('piezasApartadas',this.piezasApartadas)
    },
    methods:{
        async getRubrosByRama(rama){
            rubros = await this.$http.post(this.ruta+"/rubros",rama);
            this.rubros = rubros.body;
            this.rubroSelect = this.rubros[0].id;
        },
        async getPiezasByRubro(rubro){
            const res = await this.$http.post(this.ruta+"/piezasInRubro",rubro);
            this.piezas = res.body;
            console.log(this.piezas)
        },
        piezasApartadas(){
            this.getPiezasByRubro({id : this.rubroSelect});
        }
    },
    watch:{
        rubroSelect: function(idRubro){
            var rubro = {id : idRubro}
            this.getPiezasByRubro(rubro);
        },
        ramaSelect : function(rama){   
            this.getRubrosByRama(rama);
        }
    }
    
});