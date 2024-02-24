<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestCurator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $userClient = \App\Data\Core\Dal\UserDal::getByUserName('TestCurator');

        if (is_null($userClient)) {
            DB::beginTransaction();


            $userClient = new \App\User();
            $userClient->is_active = true;
            $userClient->name = 'TestCurator';
            $userClient->password = \Illuminate\Support\Facades\Hash::make('uf4EG$5mivo');
            $userClient->email = 'Curator@ipravo.kz';
            $userClient->save();

            \App\Data\Core\Dal\UserRoleDal::insert($userClient->id, \App\Data\Helper\RoleList::Curator);
            $profile = new \App\Data\Core\Model\Profile();
            $profile->full_name = 'TestCurator';
            $profile->user_id = $userClient->id;
            $profile->phone = '';
            $profile->email = 'Curator@ipravo.kz';
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
