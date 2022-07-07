Vue.component('carrito',{
    data(){
        return {
            activo:false,
            rutas:{},
            seleccionados : [],
            destinos:[],
            destinoSelect:""
        }
    },
    async mounted(){
        this.$root.$on('addCarr',this.agregar);
        this.$root.$on('abrir',this.abrir);
        this.$root.$on('estoyEnCarrito',this.buscarPieza);
        this.rutas.addPieza = document.getElementById('addCarrito').value;
        this.rutas.removePieza = document.getElementById('removeCarrito').value;
        this.rutas.guardar = document.getElementById('guardarCarrito').value;
        const carritoGet = document.getElementById('getCarrito').value;
        const responseCarrito = await this.$http.post(carritoGet);
        this.seleccionados = responseCarrito.body;
        const destinosGet = document.getElementById('getDestinos').value;
        const responseDestinos = await this.$http.post(destinosGet);
        this.destinos = responseDestinos.body;
        console.log(responseDestinos);
        this.destinoSelect = this.destinos[0];
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
            var piezaCarrito = data.pieza;
            piezaCarrito['fotos'] = data.fotos
            this.seleccionados.push(piezaCarrito);
            const pieza = {idPieza:data.pieza.id};
            var response = await this.$http.post(this.rutas.addPieza,pieza);
        },
        async remover(index){
            const artesania = this.seleccionados[index];
            this.seleccionados.splice(index,1);
            this.$root.$emit('removeCarr',artesania.id);
            const pieza = {idPieza:artesania.id};
            const res = await this.$http.post(this.rutas.removePieza,pieza);
        },
        async guardar(){
            if(confirm('¿Está seguro de apartar estos productos?')){
                var ruta = {idDestino : this.destinoSelect};
                var res = await this.$http.post(this.rutas.guardar, ruta);
                res = res.body
                console.log(res);
                if (res.length < 1) window.location = document.getElementById('dashboardHref').href;
                else{
                    this.seleccionados = await this.seleccionados.filter(function(pieza){
                        piezaEliminada = false;
                        res.forEach(item=>{
                            if(item.id == pieza.id){
                                piezaEliminada = true;
                            }
                        });
                        return !piezaEliminada;
                    });
                    this.$emit('piezasApartadas');
                    alert('Algunas piezas ya están apartadas');
                }
            } else {
                console.log(this.destinoSelect);
            }
        }
    },
    computed:{
        costoTotal(){
            var precios = this.seleccionados.map(pieza=>pieza.precio);
            return precios.reduce(function(acum,precio){
                return acum + precio;
            });
        }
    }
})