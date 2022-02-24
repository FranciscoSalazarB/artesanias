<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Foto;
use App\Models\Inventario;
use App\Models\Product;
use App\Models\VentaLinea;
use App\Models\VentaLineaDetalle;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'user',
            'email'=>'algo@gmail.com',
            'password'=>Hash::make('password')
        ]);
        $fotos = [
            'https://topadventure.com/__export/1621035632999/sites/laverdad/img/2021/05/14/top_5_de_las_artesanias_de_chiapasx.png_2135189049.png',
            'https://www.dondeir.com/wp-content/uploads/2021/10/expo-las-manos-del-mundo-llega-al-wtc-cdmx-en-octubre-portada.jpg',
            'https://www.mexicodesconocido.com.mx/wp-content/uploads/2019/03/Huicholes_artesanias_Mexico_Desconocido_09-683x1024.jpg',
            'https://www.mexicodesconocido.com.mx/wp-content/uploads/2020/08/artesanias.jpg',
            'https://elsouvenir.com/wp-content/uploads/2018/03/artesanias-mexicanas.jpg',
            'https://www.yoinfluyo.com/images/stories/hoy/jun19/260619/artesanias_p.jpg',
            'https://pasajemoneda.com/contenido/wp-content/uploads/2020/12/pasaje-moneda-33.jpg',
            'https://pasajemoneda.com/contenido/wp-content/uploads/2020/12/pasaje-moneda-29.jpg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUBh3lpEVlW1utMMWiVGE2T70bOE97Zt95C5G-lHkJKpOlDHu1jWDonqYYcmur87Y8EAY&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRQw7wNUyXf5AhbjlpFZVou8pmhBcOTMQzVNg&usqp=CAU'
        ];
        $a=0;
        while ($a < 5)
        {
            $product = Product::create([
                'unidadDeMedida'=>1,
                'eliminado'=>FALSE,
                'descripcion'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. A id soluta debitis alias dolores ipsum doloribus magni laborum blanditiis nostrum adipisci earum esse quo, impedit at cupiditate maxime animi laudantium.',
            ]);
            Foto::create([
                'nombreArchivo'=>'foto.jpg',
                'url'=>$fotos[$a],
                'eliminado'=>FALSE,
                'idProduct'=>$product->id
            ]);
            Foto::create([
                'nombreArchivo'=>'foto.jpg',
                'url'=>$fotos[$a+5],
                'eliminado'=>FALSE,
                'idProduct'=>$product->id
            ]);
            Inventario::create([
                'nombre'=>Str::random(10),
                'precio'=>10,
                'codigoAlterno'=>Str::random(5),
                'idProduct'=>$product->id
            ]);
            $a++;
        }
    }
}
