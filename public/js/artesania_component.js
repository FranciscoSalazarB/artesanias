Vue.component('artesania',{
    props:{
        artesania_atributes:'',
    },
    data(){
        return {apartado:false};
    },
    mounted(){
        this.$root.$on('removeCarr',(id)=>{
            if(this.artesania_atributes.id == id) this.remover()
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