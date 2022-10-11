<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->truncateTables(["permisos", "entidads", "rols"]);
        $this->call(TipoSeeder::class);
        $this->call(DiaSeeder::class);
        $this->call(NacionalidadSeeder::class);
        $this->call(EntidadSeeder::class);
        $this->call(PermisoSeeder::class);
        $this->call(MonedaSeeder::class);
        $this->call(CompaniaSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
    }

    public function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        foreach($tables as $t){
            DB::table($t)->truncate();
        }
    }
}
