<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

        public function run()
    {
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);
        Permission::create(['name' => 'add-adherant']);
        Permission::create(['name' => 'edit-adherant']);
        Permission::create(['name' => 'delete-adherant']);
        Permission::create(['name' => 'add-village']);
        Permission::create(['name' => 'edit-village']);
        Permission::create(['name' => 'delete-village']);
        Permission::create(['name' => 'payer-facture']);
        Permission::create(['name' => 'show-facture']);
        Permission::create(['name' => 'show-statistic']);
        Permission::create(['name' => 'edit-compteur']);
        Permission::create(['name' => 'deposer-consommation']);
        Permission::create(['name' => 'edit-tranche']);


        $GerantRole = Role::create(['name' => 'Gerant']);
        $TechnicienRole = Role::create(['name' => 'Technicien']);
        $ResponsableRole = Role::create(['name' => 'responsable']);


        $GerantRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'show-statistic',
            'show-facture',
            'edit-tranche',


        ]);

        $ResponsableRole->givePermissionTo([
            'payer-facture',
            'edit-village',
            'add-village',
            'delete-village',
            'add-adherant',
            'edit-adherant',
            'delete-adherant',

        ]);
        $TechnicienRole->givePermissionTo([
            'deposer-consommation',
            'edit-compteur'

        ]);
    }

}
