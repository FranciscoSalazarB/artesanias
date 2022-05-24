Vue.component('artesania',{
    props:{
        artesania_atributes:'',
    },
    data(){
        return {apartado:false};
    },
    async mounted(){
        await this.$root.$on('removeCarr',(id)=>{
            if(this.artesania_atributes.pieza.id == id) this.remover()
        });
        this.$root.$emit('estoyEnCarrito',this.artesania_atributes.pieza.id, (res)=>{
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