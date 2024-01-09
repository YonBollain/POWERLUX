<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'lastname' => 'admin',
            'city' => 'city',
            'province'=>'province',
            'address'=>'address',
            'dni'=>'54323232D',
            'contact_number'=>'629327821',
            'irpf'=>18,
            'iban'=>'123212323321',
            'cp'=>'03700',
            'objectives'=>'Gas',
            'payment_method'=>'Visa',
            'contact_name'=>'Alberto',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'administrador',
            'created_at' => date('Y-m-d h:i:s', time()),
            'updated_at' => date('Y-m-d h:i:s', time()),
        ]);
        DB::table('users')->insert([
            'name' => 'Manolo',
            'lastname' => 'Garcia Lorenzo',
            'city' => 'city',
            'province'=>'province',
            'address'=>'address',
            'dni'=>'54323232H',
            'contact_number'=>'643231543',
            'irpf'=>0,
            'iban'=>'123212323321',
            'cp'=>'03700',
            'objectives'=>'Gas',
            'payment_method'=>'Visa',
            'contact_name'=>'Alberto',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'Agente',
            'created_at' => date('Y-m-d h:i:s', time()),
            'updated_at' => date('Y-m-d h:i:s', time()),
        ]);
    }
}
