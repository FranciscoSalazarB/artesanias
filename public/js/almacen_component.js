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
            const res = await this.$http.post(this.urls.ramas+"/add",this.newRama);
            console.log(res);
        },
        async delRama(rama){
            const res = await this.$http.post(this.urls.ramas+"/del",rama);
            console.log(res);
        },
        async editRama(rama){
            const res = await this.$http.post(this.urls.ramas+"/edit",rama);
            console.log(res);
        },
        async addRubro(){
            const res = await this.$http.post(this.urls.rubros+"/add",this.newRubro);
            console.log(res);
        },
        async editRubro(rubro){
            const res = await this.$http.post(this.urls.rubros+"/edit",rubro);
            console.log(res);
        },
        async addProducto(){
            const res = await this.$http.post(this.urls.productos+"/add",this.newProducto);
            console.log(res);
        },
        async editProducto(producto){
            const res = await this.$http.post(this.urls.productos+"/edit",producto);
            console.log(res);
        },
        async addPieza(){
            const res = await this.$http.post(this.urls.piezas+"/add",this.newPieza);
            console.log(res);
        },
        async editPieza(pieza){
            const res = await this.$http.post(this.urls.piezas+"/edit",pieza);
            console.log(res);
        }
    },
});