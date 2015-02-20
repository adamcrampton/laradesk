<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserlevelsTableSeeder');
		$this->command->info('Userlevels table seeded.');

		// $this->call('UsersTableSeeder');
		// $this->command->info('Users table seeded.');

		$this->call('CategoriesTableSeeder');
		$this->command->info('Categories table seeded.');

		$this->call('PrioritiesTableSeeder');
		$this->command->info('Priorities table seeded.');

		$this->call('StatusesTableSeeder');
		$this->command->info('Statuses table seeded.');

		// $this->call('MasterTableSeeder');
		// $this->command->info('Master table seeded.');
	}

}

class UserlevelsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('userlevels')->delete();

		$stamp = date('Y-m-d H:i:s');

		$userlevels_array = array(
			array(
				'userlevels_name' => 'Admin User',
				'created_at' => $stamp,
				'updated_at' => $stamp,
			),

			array(
				'userlevels_name' => 'Support User',
				'created_at' => $stamp,
				'updated_at' => $stamp,
			),

			array(
				'userlevels_name' => 'Staff User',
				'created_at' => $stamp,
				'updated_at' => $stamp,
			),

		);

		foreach ($userlevels_array as $added_row)
		{
			Userlevel::create($added_row);
		}

	}

}

class UsersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();
	
		$admin_userlevel = DB::table('userlevels')->select('userlevels_id')->where('userlevels_name', 'admin')->first()->userlevels_id;
		$support_userlevel = DB::table('userlevels')->select('userlevels_id')->where('userlevels_name', 'support')->first()->userlevels_id;
		$staff_userlevel = DB::table('userlevels')->select('userlevels_id')->where('userlevels_name', 'staff')->first()->userlevels_id;
		
		$stamp = date('Y-m-d H:i:s');

		$users_array = array(
				array(
					'users_username' => 'admin',
					'users_email' => 'admin@companyname.com.au',
					'users_userlevels_fk' => $admin_userlevel,
					'password' => Hash::make('password'),
					'created_at' => $stamp,
					'updated_at' => $stamp,
				),

				array(
					'users_username' => 'support',
					'users_email' => 'support@companyname.com.au',
					'users_userlevels_fk' => $support_userlevel,
					'password' => Hash::make('password'),
					'created_at' => $stamp,
					'updated_at' => $stamp,
				),


				array(
					'users_username' => 'staff',
					'users_email' => 'staff@companyname.com.au',
					'users_userlevels_fk' => $staff_userlevel,
					'password' => Hash::make('password'),
					'created_at' => $stamp,
					'updated_at' => $stamp,
				),

			);

		foreach ($users_array as $added_row)
		{
			User::create($added_row);
		}

	}

}

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('categories')->delete();

		$stamp = date('Y-m-d H:i:s');

		$categories_array = array(
			array(
				'categories_name' => 'Phone',
				'created_at' => $stamp,
				'updated_at' => $stamp,
			),

			array(
				'categories_name' => 'Logging In',
				'created_at' => $stamp,
				'updated_at' => $stamp,
			),

			array(
				'categories_name' => 'Printer',
				'created_at' => $stamp,
				'updated_at' => $stamp,
			),

		);

		foreach ($categories_array as $added_row)
		{
			Category::create($added_row);
		}

	}

}

class PrioritiesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('priorities')->delete();

		$stamp = date('Y-m-d H:i:s');

		$priorities_array = array(
			array(
				'priorities_name' => 'Low',
				'created_at' => $stamp,
				'updated_at' => $stamp,
			),

			array(
				'priorities_name' => 'Medium',
				'created_at' => $stamp,
				'updated_at' => $stamp,
			),

			array(
				'priorities_name' => 'High',
				'created_at' => $stamp,
				'updated_at' => $stamp,
			),

			array(
				'priorities_name' => 'Urgent',
				'created_at' => $stamp,
				'updated_at' => $stamp,
				),

		);

		foreach ($priorities_array as $added_row)
		{
			Priority::create($added_row);
		}

	}

}

class StatusesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('statuses')->delete();

		$stamp = date('Y-m-d H:i:s');

		$statuses_array = array(
			array(
				'statuses_name' => 'Open',
				'created_at' => $stamp,
				'updated_at' => $stamp,
			),

			array(
				'statuses_name' => 'In Progress',
				'created_at' => $stamp,
				'updated_at' => $stamp,
			),

			array(
				'statuses_name' => 'On Hold',
				'created_at' => $stamp,
				'updated_at' => $stamp,
			),

			array(
				'statuses_name' => 'Closed',
				'created_at' => $stamp,
				'updated_at' => $stamp,
			),

		);

		foreach ($statuses_array as $added_row)
		{
			Status::create($added_row);
		}

	}

}

class MasterTableSeeder extends Seeder {

	public function run()
	{
		DB::table('master')->delete();

		$stamp = date('Y-m-d H:i:s');

		$staff_user = DB::table('users')->select('users_id')->where('users_username', 'Staff User')->first()->users_id;
		$printer_category = DB::table('categories')->select('categories_id')->where('categories_name', 'Printer')->first()->categories_id;
		$medium_priority = DB::table('priorities')->select('priorities_id')->where('priorities_id', 'Medium')->first()->priorities_id;
		$open_status = DB::table('statuses')->select('statuses_id')->where('statuses_id', 'Open')->first()->statuses_id;

		$master_array = array(
			array(
					'master_description' => 'Looks like the printer is out of toner',
					'master_users_fk' => $staff_user,
					'master_categories_fk' => $printer_category,
					'master_priorities_fk' => $medium_priority,
					'master_statuses_fk' => $open_status,
					'created_at' => $stamp,
					'updated_at' => $stamp,
				),

		);

		foreach ($master_array as $added_row)
		{
			Master::create($added_row);
		}

	}

}
