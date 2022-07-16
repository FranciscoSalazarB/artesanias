<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rama;
use App\Models\Rubro;
use App\Models\Foto;
use App\Models\Pieza;
use App\Models\Product;
use App\Models\PoliticaTiempo;

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
        //políticas de tiempo
        $politicasLunes = Politicatiempo::create([
            'dia'=>'Monday',
            'diasRelativosAvisoDePago'=> 1,
            'diasRelativosAvisoDeConfirmacion'=> 1
        ]);
        $politicasMartes = Politicatiempo::create([
            'dia'=>'Tuesday',
            'diasRelativosAvisoDePago'=> 1,
            'diasRelativosAvisoDeConfirmacion'=> 1
        ]);
        $politicasMiercoles = Politicatiempo::create([
            'dia'=>'Wednesday',
            'diasRelativosAvisoDePago'=> 1,
            'diasRelativosAvisoDeConfirmacion'=> 1
        ]);
        $politicasJueves = Politicatiempo::create([
            'dia'=>'Thursday',
            'diasRelativosAvisoDePago'=> 1,
            'diasRelativosAvisoDeConfirmacion'=> 3
        ]);
        $politicasViernes = Politicatiempo::create([
            'dia'=>'Friday',
            'diasRelativosAvisoDePago'=> 1,
            'diasRelativosAvisoDeConfirmacion'=> 2
        ]);
        $politicasSabado = Politicatiempo::create([
            'dia'=>'Saturday',
            'diasRelativosAvisoDePago'=> 2,
            'diasRelativosAvisoDeConfirmacion'=> 1
        ]);
        $politicasDomingo = Politicatiempo::create([
            'dia'=>'Sunday',
            'diasRelativosAvisoDePago'=> 1,
            'diasRelativosAvisoDeConfirmacion'=> 1
        ]);
    }
}
