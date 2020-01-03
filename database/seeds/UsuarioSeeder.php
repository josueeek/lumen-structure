<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $usuario = new User();
        $usuario_second = new User();
        $usuario->username = 'develop@mestresdaweb.com.br';
        $usuario->name = 'Develop';
        $usuario->password = Hash::make('123456');
        $usuario->saas_business_id = 1;
        $usuario->save();
    }
}
