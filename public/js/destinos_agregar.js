Vue.component('destinosagregar',{
    data(){
        return {
            direccion : "",
            cp : "",
            estado:"",
            municipio:"",
            localidad:"",
            ruta : ""
        }
    },
    mounted(){
        this.ruta = document.getElementById('destinosRuta').value;
    },
    methods:{
        async agregar(){
            Swal.fire({
                title:'¿Está seguro de agregar un nuevo destino?',
                icon: 'warning',
                showDenyButton: true,
                confirmButtonText: 'Agregar destino',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText:'cancelar'
            }).then(async result => {
                if(result.isConfirmed){
                    var data = {
                        direccion : this.direccion,
                        cp : this.cp,
                        estado : this.estado,
                        municipio : this.municipio
                    };
                    await this.$http.post(this.ruta,data);
                    Swal.fire({
                        title : 'destino agregado correctamente',
                        icon : 'success',
                    });
                    this.$root.$emit('actualizarDesstinos');
                }
            });
        }
    }
});