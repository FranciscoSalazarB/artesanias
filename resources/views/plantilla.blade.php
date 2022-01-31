<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa de las artesanías</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <script src="{{asset('js/login_component.js')}}"></script>
</head>
<body>
    <div id="app">
        <nav>
            <x-nav_bar/>
        </nav>
        <section>
            @yield('body') 
        </section> 
    </div>  
</body>
<script> var app = new Vue({el:'#app'});</script>
</html>