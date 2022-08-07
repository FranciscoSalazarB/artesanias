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
                idProducto:0,
                img:''
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
        await this.getAlmacen();
        this.select = 'ramas'
    },
    methods:{
        getAlmacen(){
            try {
                this.getRamas();
                this.getRubros();
                this.getProductos();
                this.getPiezas();
            } catch (error) {
                console.log(error);
            }
        },
        async getRamas(){
            this.ramas = await this.$http.post(this.urls.ramas);
            this.ramas = this.ramas.body;
        },
        async getRubros(){
            this.rubros = await this.$http.post(this.urls.rubros);
            this.rubros = this.rubros.body;
        },
        async getProductos(){
            this.productos = await this.$http.post(this.urls.productos);
            this.productos = this.productos.body;
        },
        async getPiezas(){
            this.piezas = await this.$http.post(this.urls.piezas);
            this.piezas = this.piezas.body;
        },
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
            Swal.fire({
                title:'¿Está seguro de agregar una nueva rama?',
                icon: 'warning',
                showDenyButton: true,
                confirmButtonText: 'Guardar rama',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText:'cancelar'
            }).then(async result => {
                if(result.isConfirmed){
                    await this.$http.post(this.urls.ramas+"/add",this.newRama);
                    Swal.fire({
                        title : 'La nueva rama se ha agregado correctamente',
                        icon : 'success',
                    });
                    this.getRamas();
                }
            });
        },
        async delRama(rama){
            Swal.fire({
                title:'¿Está seguro de eliminar esta rama?',
                icon: 'warning',
                showDenyButton: true,
                confirmButtonText: 'Eliminar rama',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText:'cancelar'
            }).then(async result => {
                if(result.isConfirmed){
                    await this.$http.post(this.urls.ramas+"/del",rama);
                    Swal.fire({
                        title : 'La rama se ha eliminado correctamente',
                        icon : 'success',
                    });
                    this.getRamas();
                }
            });
        },
        async editRama(rama){
            Swal.fire({
                title:'¿Está seguro de editar esta rama?',
                icon: 'warning',
                showDenyButton: true,
                confirmButtonText: 'Editar rama',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText:'cancelar'
            }).then(async result => {
                if(result.isConfirmed){
                    await this.$http.post(this.urls.ramas+"/edit",rama);
                    Swal.fire({
                        title : 'La rama se ha editado correctamente',
                        icon : 'success',
                    });
                    this.getRamas();
                }
            });
        },
        async resetRama(rama){
            Swal.fire({
                title:'¿Está seguro de restaurar esta rama?',
                icon: 'warning',
                showDenyButton: true,
                confirmButtonText: 'Restaurar rama',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText:'cancelar'
            }).then(async result => {
                if(result.isConfirmed){
                    await this.$http.post(this.urls.ramas+"/reset",rama);
                    Swal.fire({
                        title : 'La rama se ha erestaurado correctamente',
                        icon : 'success',
                    });
                    this.getRamas();
                }
            });
        },
        async addRubro(){
            Swal.fire({
                title:'¿Está seguro de agregar este rubro?',
                icon: 'warning',
                showDenyButton: true,
                confirmButtonText: 'Agregar rubro',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText:'cancelar'
            }).then(async result => {
                if(result.isConfirmed){
                    await this.$http.post(this.urls.rubros+"/add",this.newRubro);
                    Swal.fire({
                        title : 'El rubro se ha agregado correctamente',
                        icon : 'success',
                    });
                    this.getRubros();
                }
            });
        },
        async editRubro(rubro){
            await this.$http.post(this.urls.rubros+"/edit",rubro);
            this.getRubros();
        },
        async delRubro(rubro){
            rubro.eliminado = true;
            await this.$http.post(this.urls.rubros+'/del',rubro);
            this.getRubros();
        },
        async resetRubro(rubro){
            rubro.eliminado = false;
            await this.$http.post(this.urls.rubros+'/reset',rubro);
            this.getRubros();
        },
        async addProducto(){
            await this.$http.post(this.urls.productos+"/add",this.newProducto);
            this.getProductos();
        },
        async editProducto(producto){
            await this.$http.post(this.urls.productos+"/edit",producto);
            this.getProductos();
        },
        async delProducto(producto){
            producto.eliminado = true;
            await this.$http.post(this.urls.productos+"/del",producto);
            this.getProductos();
        },
        async resetProducto(producto){
            producto.eliminado = false;
            await this.$http.post(this.urls.productos+"/reset",producto);
            this.getProductos();
        },
        async addPieza(){
            var req = new FormData;
            req.append('img',this.newPieza.img);
            req.append('nombre',this.newPieza.nombre);
            req.append('precio',parseInt(this.newPieza.precio));
            req.append('codigoAlterno',this.newPieza.codigoAlterno);
            req.append('idProducto',this.newPieza.idProducto);
            await this.$http.post(this.urls.piezas+"/add",req);
            this.getPiezas();
        },
        async editPieza(pieza){
            await this.$http.post(this.urls.piezas+"/edit",pieza);
            this.getPiezas();
        },
        async delPieza(pieza){
            pieza.estatus = "eliminado";
            await this.$http.post(this.urls.piezas+"/del",pieza);
            this.getPiezas();
        },
        async resetPieza(pieza){
            pieza.estatus = "activo";
            await this.$http.post(this.urls.piezas+"/reset",pieza);
            this.getPiezas();
        },
        async addImg(evento){
            this.newPieza.img = evento.target.files[0];
            console.log(this.newPieza);
        }
    },
});