Vue.component('carrito',{
    data(){
        return {
            activo:false,
            rutas:{},
            seleccionados : []
        }
    },
    async mounted(){
        this.$root.$on('addCarr',this.agregar);
        this.$root.$on('abrir',this.abrir);
        this.$root.$on('estoyEnCarrito',this.buscarPieza);
        this.rutas.addPieza = document.getElementById('addCarrito').value;
        this.rutas.removePieza = document.getElementById('removeCarrito').value;
        const rutaGet = document.getElementById('getCarrito').value;
        const response = await this.$http.post(rutaGet);
        this.seleccionados = await response.body;
        console.log(this.seleccionados);
    },
    methods:{
        buscarPieza(idPieza, callback){
            const res = this.seleccionados.find(function(pieza){
                return pieza.id == idPieza;
            });
            callback(res != undefined);
        },
        cerrar(){
            this.activo = false;
        },
        abrir(){
            this.activo = true;
        },
        async agregar(data){
            this.seleccionados.push(data);
            const pieza = {idPieza:data.id};
            var response = await this.$http.post(this.rutas.addPieza,pieza);
            console.log(response);
        },
        async remover(index){
            const artesania = this.seleccionados[index];
            this.seleccionados.splice(index,1);
            this.$root.$emit('removeCarr',artesania.id);
            const pieza = {idPieza:artesania.id};
            const res = await this.$http.post(this.rutas.removePieza,pieza); 
            console.log(res);
        }
    }
})