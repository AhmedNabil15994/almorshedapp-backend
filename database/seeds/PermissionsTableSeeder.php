<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$role_id = 1;

        //insert permissions
        //dashboard permission
        $permission_id = DB::table('permissions')
				        	->insertGetId([
				        		'name' => 'dashboard_access2',
				        		'display_name' => 'access'
				        	]);

		DB::table('permission_translations')
			->insert([
				'description' => 'Dashboard access',
				'locale' => 'en',
				'permission_id' => $permission_id
			]);

		DB::table('permission_translations')
			->insert([
				'description' => 'الوصول للوحة التحكم',
				'locale' => 'ar',
				'permission_id' => $permission_id
			]);

		DB::table('permission_role')
			->insert([
				'permission_id' => $permission_id,
				'role_id' => $role_id
			]);

        //show roles permission
        $permission_id = DB::table('permissions')
				        	->insertGetId([
				        		'name' => 'show_roles',
				        		'display_name' => 'roles'
				        	]);

		DB::table('permission_translations')
			->insert([
				'description' => 'Show Roles',
				'locale' => 'en',
				'permission_id' => $permission_id
			]);

		DB::table('permission_translations')
			->insert([
				'description' => 'مشاهدة الصلاحيات',
				'locale' => 'ar',
				'permission_id' => $permission_id
			]);

		DB::table('permission_role')
			->insert([
				'permission_id' => $permission_id,
				'role_id' => $role_id
			]);

        //add roles permission
        $permission_id = DB::table('permissions')
				        	->insertGetId([
				        		'name' => 'add_roles',
				        		'display_name' => 'roles'
				        	]);

		DB::table('permission_translations')
			->insert([
				'description' => 'Add Roles',
				'locale' => 'en',
				'permission_id' => $permission_id
			]);

		DB::table('permission_translations')
			->insert([
				'description' => 'اضافة صلاحيات',
				'locale' => 'ar',
				'permission_id' => $permission_id
			]);

		DB::table('permission_role')
			->insert([
				'permission_id' => $permission_id,
				'role_id' => $role_id
			]);

        //edit roles permission
        $permission_id = DB::table('permissions')
				        	->insertGetId([
				        		'name' => 'edit_roles',
				        		'display_name' => 'roles'
				        	]);

		DB::table('permission_translations')
			->insert([
				'description' => 'Edit Roles',
				'locale' => 'en',
				'permission_id' => $permission_id
			]);

		DB::table('permission_translations')
			->insert([
				'description' => 'تعديل الصلاحيات',
				'locale' => 'ar',
				'permission_id' => $permission_id
			]);

		DB::table('permission_role')
			->insert([
				'permission_id' => $permission_id,
				'role_id' => $role_id
			]);

        //delete roles permission
        $permission_id = DB::table('permissions')
				        	->insertGetId([
				        		'name' => 'delete_roles',
				        		'display_name' => 'roles'
				        	]);

		DB::table('permission_translations')
			->insert([
				'description' => 'Delete Roles',
				'locale' => 'en',
				'permission_id' => $permission_id
			]);

		DB::table('permission_translations')
			->insert([
				'description' => 'حذف الصلاحيات',
				'locale' => 'ar',
				'permission_id' => $permission_id
			]);

		DB::table('permission_role')
			->insert([
				'permission_id' => $permission_id,
				'role_id' => $role_id
			]);
    }
}
