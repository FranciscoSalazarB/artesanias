Vue.component('ajustes',{
    data(){
        return{
            dias:[],
            ruta:''
        };
    },
    async mounted(){
        this.ruta = document.getElementById('rutaAjustes').value;
        const res = await this.$http.post(this.ruta);
        console.log(res);
        this.dias = res.body;
    },
    methods:{
        getDayName(day){
            if(day > 7) return this.getDayName(day - 7);
            if(day == 1) return 'Lunes';
            if(day == 2) return 'Martes';
            if(day == 3) return 'Miércoles';
            if(day == 4) return 'Jueves';
            if(day == 5) return 'Viernes';
            if(day == 6) return 'Sábado';
            if(day == 7) return 'Domingo';
        },
        async guardarCambios(){
            Swal.fire({
                title:'¿Está seguro de guardar los cambios realizados?',
                icon: 'warning',
                showDenyButton: true,
                confirmButtonText: 'Guardar cambios',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText:'cancelar'
            }).then(async result => {
                if(result.isConfirmed){
                    var data = this.dias.map(function(dia){
                        dia.diasRelativosAvisoDeConfirmacion = parseInt(dia.diasRelativosAvisoDeConfirmacion);
                        dia.diasRelativosAvisoDePago = parseInt(dia.diasRelativosAvisoDePago);
                        return dia;
                    });
                    var a = await this.$http.post(this.ruta+'/guardar',{cambios:data});
                    console.log(a);
                    Swal.fire({
                        title : 'Los cambios se guardaron correctamente',
                        icon : 'success',
                    });
                }
            });
        }
    },
    watch:{
        dias:function(dia){
            console.log(dia);
        }
    }
});