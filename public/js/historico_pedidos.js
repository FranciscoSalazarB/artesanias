Vue.component('historico',{
    data(){
        return {
            ruta : '',
            listado : ''
        };
    },
    async mounted(){
        this.ruta = document.getElementById('historicoPedidos').value;
        res = await this.$http.post(this.ruta);
        this.listado = res.body;
    }
});