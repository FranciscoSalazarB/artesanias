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
            this.ramas = this.ramas.body;
            this.rubros = await this.$http.post(this.urls.rubros);
            this.rubros = this.rubros.body;
            this.productos = await this.$http.post(this.urls.productos);
            this.piezas = await this.$http.post(this.urls.piezas);
            this.piezas = this.piezas.body;
            this.productos = this.productos.body;
        } catch (error) {
            console.log(error);
        }
    },
    methods:{
        findRama(idRama){
            const rama = this.ramas.find(rama=>{
                return rama.id == idRama;
            });
            return rama;
        },
        findRubro(idRubro){
            const rubro = this.rubros.find(rubro=>{
                return rubro.id == idRubro;
            });
            return rubro;
        },
        findProducto(idProducto){
            const Producto = this.productos.find(Producto=>{
                return Producto.id == idProducto;
            });
            return Producto;
        }
    },
});