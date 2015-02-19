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

		$this->call('UsersTableSeeder');
		$this->command->info('Users table seeded.');
	}

}

class UserlevelsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('userlevels')->delete();

		$userlevels_array = array(
			array('userlevels_name' => 'admin'),
			array('userlevels_name' => 'staff'),
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
