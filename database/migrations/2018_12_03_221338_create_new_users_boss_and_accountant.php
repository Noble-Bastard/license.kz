<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewUsersBossAndAccountant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $userClient = \App\Data\Core\Dal\UserDal::getByUserName('TestHead');
        if (is_null($userClient)) {
            DB::beginTransaction();

            $userClient = new \App\User();
            $userClient->is_active = true;
            $userClient->name = 'TestHead';
            $userClient->password = \Illuminate\Support\Facades\Hash::make('uf4EG$5mivo');
            $userClient->email = 'Head@ipravo.kz';
            $userClient->save();

            \App\Data\Core\Dal\UserRoleDal::insert($userClient->id, \App\Data\Helper\RoleList::Head);
            $profile = new \App\Data\Core\Model\Profile();
            $profile->full_name = 'TestHead';
            $profile->user_id = $userClient->id;
            $profile->phone = '';
            $profile->email = 'Head@ipravo.kz';
            $profile->profile_state_type_id = 2;
            $profile->is_resident = 1;
            $profile->created_by = null;
            $profile->save();

            DB::commit();
        }

        $userClient = \App\Data\Core\Dal\UserDal::getByUserName('TestAccountant');
        if (is_null($userClient)) {
            DB::beginTransaction();

            $userClient = new \App\User();
            $userClient->is_active = true;
            $userClient->name = 'TestAccountant';
            $userClient->password = \Illuminate\Support\Facades\Hash::make('uf4EG$5mivo');
            $userClient->email = 'Accountant@ipravo.kz';
            $userClient->save();

            \App\Data\Core\Dal\UserRoleDal::insert($userClient->id, \App\Data\Helper\RoleList::Accountant);
            $profile = new \App\Data\Core\Model\Profile();
            $profile->full_name = 'TestAccountant';
            $profile->user_id = $userClient->id;
            $profile->phone = '';
            $profile->email = 'Accountant@ipravo.kz';
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
//        DB::statement('
//            delete from user where name=\'TestHead\'');
//        DB::statement('
//            delete from profile where full_name=\'TestHead\'');
        //        DB::statement('
//            delete from user where name=\'TestAccountant\'');
//        DB::statement('
//            delete from profile where full_name=\'TestAccountant\'');
    }
}
