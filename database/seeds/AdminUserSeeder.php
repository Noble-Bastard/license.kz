<?php

use App\Data\Core\Dal\UserRoleDal;
use App\Data\Core\Model\Profile;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        $users = new User();
        $users->is_active = true;
        $users->name = 'Administrator';
        $users->password =  Hash::make('uf4EG$5mivo');
        $users->email = 'administrator@ipravo.kz';
        $users->save();

        UserRoleDal::insert($users->id, \App\Data\Helper\RoleList::Administrator);
        $profile = new Profile();
        $profile->full_name = 'Administrator';
        $profile->user_id = $users->id;
        $profile->phone ='';
        $profile->email = 'administrator@ipravo.kz';
        $profile->profile_state_type_id = 2;
        $profile->is_resident = 1;
        $profile->created_by = null;
        $profile->save();

        DB::commit();
    }
}
