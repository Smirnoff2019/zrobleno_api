<?php

use Illuminate\Database\Seeder;
use App\Models\Permission\Permission;
use App\Models\Role\Role;
use App\Models\PermissionRole\PermissionRole;
use App\Schemes\PermissionRole\PermissionRoleSchema;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->roles())->map(function ($item){
            Permission::all()->each(function ($item_) use ($item){
                PermissionRole::create([
                    PermissionRoleSchema::COLUMN_ROLE_ID => $item->id,
                    PermissionRoleSchema::COLUMN_PERMISSION_ID =>$item_->id
                ]);
            });
        });
    }

    private function roles () {
        return Role::whereIn('slug', ['super_user', 'senior_admin', 'admin', 'manager', 'editor'])->get();
    }
}
