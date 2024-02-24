<?php

use App\Data\Core\Dal\UserRoleDal;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = \App\Data\Core\Dal\UserDal::getByUserName('Administrator');

        if (is_null($user)) {
            DB::beginTransaction();

            $users = new User();
            $users->is_active = true;
            $users->name = 'Administrator';
            $users->password = Hash::make('uf4EG$5mivo');
            $users->email = 'administrator@ipravo.kz';
            $users->save();

            UserRoleDal::insert($users->id, \App\Data\Helper\RoleList::Administrator);
            $profile = new \App\Data\Core\Model\Profile();
            $profile->full_name = 'Administrator';
            $profile->user_id = $users->id;
            $profile->phone = '';
            $profile->email = 'administrator@ipravo.kz';
            $profile->profile_state_type_id = 2;
            $profile->is_resident = 1;
            $profile->created_by = null;
            $profile->save();

            DB::commit();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
