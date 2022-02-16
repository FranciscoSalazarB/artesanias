Vue.component('carrito',{
    data(){
        return {
            activo:false,
            seleccionados : []
        }
    },
    mounted(){
        this.$root.$on('addCarr',this.agregar);
        this.$root.$on('abrir',this.abrir)
    },
    methods:{
        cerrar(){
            this.activo = false;
        },
        abrir(){
            this.activo = true;
        },
        agregar(data){
            this.seleccionados.push(data)
        },
        remover(index){
            const artesania = this.seleccionados[index];
            this.seleccionados.splice(index,1);
            this.$root.$emit('removeCarr',artesania.id); 
        }
    }
})