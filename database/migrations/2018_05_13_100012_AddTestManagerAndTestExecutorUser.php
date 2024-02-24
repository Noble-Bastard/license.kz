<?php

use App\Data\Core\Dal\UserRoleDal;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestManagerAndTestExecutorUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $userManager = \App\Data\Core\Dal\UserDal::getByUserName('TestManager');

        if (is_null($userManager)) {
            DB::beginTransaction();

            $userManager = new User();
            $userManager->is_active = true;
            $userManager->name = 'TestManager';
            $userManager->password = \Illuminate\Support\Facades\Hash::make('uf4EG$5mivo');
            $userManager->email = 'manager@ipravo.kz';
            $userManager->save();

            UserRoleDal::insert($userManager->id, \App\Data\Helper\RoleList::Manager);
            $profile = new \App\Data\Core\Model\Profile();
            $profile->full_name = 'TestManager';
            $profile->user_id = $userManager->id;
            $profile->phone = '';
            $profile->email = 'manager@ipravo.kz';
            $profile->profile_state_type_id = 2;
            $profile->is_resident = 1;
            $profile->created_by = null;
            $profile->save();

            DB::commit();
        }

        $user = \App\Data\Core\Dal\UserDal::getByUserName('TestExecutor');
        $managerProfile = \App\Data\Core\Dal\ProfileDal::getByUserId($userManager->id);

        if (is_null($user)) {
            DB::beginTransaction();

            $users = new User();
            $users->is_active = true;
            $users->name = 'TestExecutor';
            $users->password = \Illuminate\Support\Facades\Hash::make('uf4EG$5mivo');
            $users->email = 'executor@ipravo.kz';
            $users->save();

            UserRoleDal::insert($users->id, \App\Data\Helper\RoleList::Executor);
            $profile = new \App\Data\Core\Model\Profile();
            $profile->full_name = 'TestExecutor';
            $profile->user_id = $users->id;
            $profile->phone = '';
            $profile->email = 'executor@ipravo.kz';
            $profile->profile_state_type_id = 2;
            $profile->is_resident = 1;
            $profile->created_by = null;
            $profile->manager_id = $managerProfile->id;
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
