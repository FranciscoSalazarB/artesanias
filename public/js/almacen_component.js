Vue.component('almacen',{
    data(){
        return{
            select : '',
            ramas:[],
            rubros:[],
            productos:[],
            piezas:[],
            urls:{
                ramas:'',
                rubros:'',
                productos:'',
                piezas:'',
                fotos:''
            }
        }
    },
    async mounted(){
        this.urls.ramas = document.getElementById('urlRamas').value;
        this.urls.rubros = document.getElementById('urlRubros').value;
        this.urls.productos = document.getElementById('urlProductos').value;
        this.urls.piezas = document.getElementById('urlPiezas').value;
        try {
            this.ramas = await this.$http.post(this.urls.ramas);
            this.rubros = await this.$http.post(this.urls.rubros);
            this.productos = await this.$http.post(this.urls.productos);
            this.piezas = await this.$http.post(this.urls.piezas);
            this.ramas = this.ramas.body;
            this.rubros = this.rubros.body;
            this.piezas = this.piezas.body;
            this.productos = this.productos.body;
        } catch (error) {
            console.log(error);
        }
    }
});