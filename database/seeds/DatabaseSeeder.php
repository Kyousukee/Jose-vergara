<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Jose',
        	'lastname' => 'Vergara',
        	'email' => 'jjosemiguel.jv@gmail.com',
        	'password' => bcrypt('123'),
        	'status' => 'Admin'
        ]);
        User::create([
        	'name' => 'Nombre1',
        	'lastname' => 'Apellido1',
        	'email' => 'Nombre1.Apellido1@gmail.com',
        	'password' => bcrypt('123'),
        	'status' => 'Normal'
        ]);
        User::create([
        	'name' => 'Nombre2',
        	'lastname' => 'Apellido2',
        	'email' => 'Nombre2.Apellido2@gmail.com',
        	'password' => bcrypt('123'),
        	'status' => 'Normal'
        ]);

        factory(Post::class, 10)->create();
    }
}
