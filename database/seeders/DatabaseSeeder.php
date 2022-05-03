<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rama;
use App\Models\Rubro;
use App\Models\Foto;
use App\Models\Pieza;
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
        //usuarios
        User::create([
            'name'=>'user',
            'email'=>'algo@gmail.com',
            'roll'=>'cliente',
            'password'=>Hash::make('password')
        ]);

        //Ramas
        $textiles = Rama::create([
            'rama'=>'textiles',
            'eliminado'=>FALSE
        ]);
        $ambar = Rama::create([
            'rama'=>'ambar',
            'eliminado'=>FALSE
        ]);

        //Rubros
        $playeras = Rubro::create([
            'rubro'=>'playeras',
            'eliminado'=>FALSE,
            'idRama'=>$textiles->id
        ]);
        $bufandas = Rubro::create([
            'rubro'=>'bufandas',
            'eliminado'=>FALSE,
            'idRama'=>$textiles->id
        ]);
        $pulseras = Rubro::create([
            'rubro'=>'pulseras',
            'eliminado'=>FALSE,
            'idRama'=>$ambar->id
        ]);
        $collares = Rubro::create([
            'rubro'=>'collares',
            'eliminado'=>FALSE,
            'idRama'=>$ambar->id
        ]);

        //productos
        $playeraMujer = Product::create([
            'descripcion'=>'playera de mujer',
            'eliminado'=>FALSE,
            'unidadDeMedida'=>'pieza',
            'idRubro'=>$playeras->id
        ]);
        $playeraHombre = Product::create([
            'descripcion'=>'playera de hombre',
            'eliminado'=>FALSE,
            'unidadDeMedida'=>'pieza',
            'idRubro'=>$playeras->id
        ]);
        $playeraNiño = Product::create([
            'descripcion'=>'playera de niño',
            'eliminado'=>FALSE,
            'unidadDeMedida'=>'pieza',
            'idRubro'=>$playeras->id
        ]);
        $playeraNiña = Product::create([
            'descripcion'=>'playera de niña',
            'eliminado'=>FALSE,
            'unidadDeMedida'=>'pieza',
            'idRubro'=>$playeras->id
        ]);
        $bufandaLarga = Product::create([
            'descripcion'=>'bufanda larga',
            'eliminado'=>FALSE,
            'unidadDeMedida'=>'pieza',
            'idRubro'=>$bufandas->id
        ]);
        $bufandaPalestina = Product::create([
            'descripcion'=>'bufanda palestina',
            'eliminado'=>FALSE,
            'unidadDeMedida'=>'pieza',
            'idRubro'=>$bufandas->id
        ]);
        $pulseraPequeña = Product::create([
            'descripcion'=>'pulsera pequeña',
            'eliminado'=>FALSE,
            'unidadDeMedida'=>'pieza',
            'idRubro'=>$pulseras->id
        ]);

        //piezas 
        $playera1 = Pieza::create([
            'nombre'=>'playera color rojo tejido de rombos',
            'precio'=>125,
            'codigoAlterno'=>'qwertyuiop',
            'idProducto'=>$playeraHombre->id,
        ]);
        $playera2 = Pieza::create([
            'nombre'=>'playera multicolor tejido de rombos',
            'precio'=>120,
            'codigoAlterno'=>'qwertyuiop',
            'idProducto'=>$playeraHombre->id,
        ]);
        //fotos
        Foto::create([
            'nombreArchivo'=>'041ebb62-bd82-49f3-92cc-afa7deef907b_nube-157b55c5cd2b1e04ca16147021134732-1024-1024.jpg',
            'url'=>'https://d2r9epyceweg5n.cloudfront.net/stores/001/560/902/products/',
            'eliminado'=>FALSE,
            'idPieza'=>$playera1->id
        ]);
        Foto::create([
            'nombreArchivo'=>'D_NQ_NP_851833-MLM44940501510_022021-W.jpg',
            'url'=>'https://http2.mlstatic.com/',
            'eliminado'=>FALSE,
            'idPieza'=>$playera2->id
        ]);
    }
}
