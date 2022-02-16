Vue.component('catalogo',{
    data(){
        return {
            listas : [[
                {id:1,precio:3,nombre:'algo',descript:'algo',img_url:'https://www.yoinfluyo.com/images/stories/hoy/jun19/260619/artesanias_p.jpg'},
                {id:2,precio:3,nombre:'algo',descript:'algo',img_url:'https://www.yoinfluyo.com/images/stories/hoy/jun19/260619/artesanias_p.jpg'},
                {id:3,precio:3,nombre:'algo',descript:'algo',img_url:'https://www.yoinfluyo.com/images/stories/hoy/jun19/260619/artesanias_p.jpg'}
            ],[
                {id:4,precio:3,nombre:'algo',descript:'algo',img_url:'https://www.yoinfluyo.com/images/stories/hoy/jun19/260619/artesanias_p.jpg'},
                {id:5,precio:3,nombre:'algo',descript:'algo',img_url:'https://www.yoinfluyo.com/images/stories/hoy/jun19/260619/artesanias_p.jpg'}
            ]],
            ajax:[]
        }
    },
    async mounted(){
        const url = document.getElementById('rute').value;
        try {
            this.ajax = await this.$http.post(url);
            console.log(this.ajax);
        } catch (error) {
            console.log(error);
        }
    }
});