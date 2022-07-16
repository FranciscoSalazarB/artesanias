Vue.component('artesania',{
    props:{
        artesania_atributes:'',
    },
    data(){
        return {apartado:false};
    },
    async mounted(){
        await this.$root.$on('removeCarr',(id)=>{
            if(this.artesania_atributes.id == id) this.removerDelCarrito()
        });
        await this.$root.$on('removeCatalogo',this.removerDelCarrito);
        await this.$root.$emit('estoyEnCarrito',this.artesania_atributes.id, (res)=>{
            console.log(this.artesania_atributes); 
            this.apartado = res;
        });
    },
    methods:{
        agregar(){
            this.$root.$emit('addCarr',this.artesania_atributes);
            this.apartado = true;
        },
        removerDelCarrito(){
            this.apartado= false;
        },
        removerDelCatalogo(){
            console.log(this.artesania_atributes);
            this.$destroy();
        }
    }
});