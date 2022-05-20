Vue.component('catalogo',{
    data(){
        return {
            piezas : []
        }
    },
    async mounted(){
        const url = document.getElementById('rute').value;
        try {
            this.piezas = await this.$http.post(url);
            this.piezas = this.piezas.body;
        } catch (error) {
            console.log(error);
        }
    }
    
});