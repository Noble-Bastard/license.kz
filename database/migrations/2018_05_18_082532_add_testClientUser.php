<?php

use App\Data\Core\Dal\UserRoleDal;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestClientUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $userClient = \App\Data\Core\Dal\UserDal::getByUserName('TestClient');

        if (is_null($userClient)) {
            DB::beginTransaction();


            $userClient = new User();
            $userClient->is_active = true;
            $userClient->name = 'TestClient';
            $userClient->password = \Illuminate\Support\Facades\Hash::make('uf4EG$5mivo');
            $userClient->email = 'client@ipravo.kz';
            $userClient->save();

            UserRoleDal::insert($userClient->id, \App\Data\Helper\RoleList::Client);
            $profile = new \App\Data\Core\Model\Profile();
            $profile->full_name = 'TestClient';
            $profile->user_id = $userClient->id;
            $profile->phone = '';
            $profile->email = 'client@ipravo.kz';
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
