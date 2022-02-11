Vue.component('carrito',{
    data(){
        return {
            seleccionados : []
        }
    },
    mounted(){
        this.$root.$on('addCarr',(data)=>{
            this.seleccionados.push(data);
        });
    }
})