Vue.component('almacen',{
    data(){
        return{
            select : '',
            ramas:[],
            newRama:{
                rama:''
            },
            newRubro:{
                rubro:'',
                idRama:0
            },
            newProducto:{
                descripcion:'',
                unidadDeMedida:'',
                idRubro:0
            },
            newPieza:{
                nombre:'',
                precio:0,
                codigoAlterno:'',
                idProducto:0
            },
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
        },
        async addRama(){
            await this.$http.post(this.urls.ramas+"/add",this.newRama);
        },
        async delRama(rama){
            await this.$http.post(this.urls.ramas+"/del",rama);
        },
        async editRama(rama){await this.$http.post(this.urls.ramas+"/edit",rama);
        },
        async addRubro(){
            await this.$http.post(this.urls.rubros+"/add",this.newRubro);
        },
        async editRubro(rubro){
            await this.$http.post(this.urls.rubros+"/edit",rubro);
        },
        async delRubro(rubro){
            await this.$http.post(this.urls.rubros+'/del',rubro);
        },
        async addProducto(){
            await this.$http.post(this.urls.productos+"/add",this.newProducto);
        },
        async editProducto(producto){
            await this.$http.post(this.urls.productos+"/edit",producto);
        },
        async delProducto(producto){
            await this.$http.post(this.urls.productos+"/del",producto);
        },
        async addPieza(){
            await this.$http.post(this.urls.piezas+"/add",this.newPieza);
        },
        async editPieza(pieza){
            await this.$http.post(this.urls.piezas+"/edit",pieza);
        },
        async delPieza(pieza){
            await this.$http.post(this.urls.piezas+"/del",pieza);
        }
    },
});