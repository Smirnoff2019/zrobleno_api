<?php

use Illuminate\Database\Seeder;
use App\Models\Role\Role;
use App\Models\Role\AdminRole;
use App\Models\Role\ContractorRole;
use App\Models\Role\CustomerRole;
use App\Models\Role\EditorRole;
use App\Models\Role\ManagerRole;
use App\Models\Role\OwnerQARole;
use App\Models\Role\SeniorAdminRole;
use App\Models\Role\SuperUserRole;
use App\Models\Role\UserRole;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Role::class)->states(SuperUserRole::class)->create();
        factory(Role::class)->states(SeniorAdminRole::class)->create();
        factory(Role::class)->states(AdminRole::class)->create();
        factory(Role::class)->states(ManagerRole::class)->create();
        factory(Role::class)->states(EditorRole::class)->create();
        factory(Role::class)->states(ContractorRole::class)->create();
        factory(Role::class)->states(CustomerRole::class)->create();
        factory(Role::class)->states(UserRole::class)->create();
        factory(Role::class)->states(OwnerQARole::class)->create();
        
    }
}
