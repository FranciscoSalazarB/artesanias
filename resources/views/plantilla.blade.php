<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa de las artesanías</title>
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
</head>
<body>
    <nav>
        <x-nav_bar/>
    </nav>
    <section>
        @yield('body') 
    </section>   
</body>
</html>