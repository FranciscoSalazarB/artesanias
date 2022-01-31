Vue.component('login',{
    data(){
        return{
            state:"login"
        }
    },
    methods:{
        change(){
            this.state === "login" ? this.state = "registro" : this.state = "login"; 
        }
    },
    computhed:{
        estado: function(){
            if(this.state === "login") return "registro";
            else return "login";
        }
    }
})