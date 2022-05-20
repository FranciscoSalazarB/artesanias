Vue.component('artesania',{
    props:{
        artesania_atributes:'',
    },
    data(){
        return {apartado:false};
    },
    async mounted(){
        const rutaEmitir = "esta"+this.artesania_atributes.id;
        await this.$root.$on('removeCarr',(id)=>{
            if(this.artesania_atributes.id == id) this.remover()
        });
        this.$root.$emit('estoyEnCarrito',this.artesania_atributes.id, (res)=>{
            this.apartado = res;
        });
    },
    methods:{
        agregar(){
            this.$root.$emit('addCarr',this.artesania_atributes);
            this.apartado = true;
        },
        remover(){
            this.apartado= false;
        }
    }
});