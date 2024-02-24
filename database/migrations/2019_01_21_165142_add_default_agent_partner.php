<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Hash;
use \App\Data\Core\Dal\UserRoleDal;

class AddDefaultAgentPartner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = \App\Data\Core\Dal\UserDal::getByUserName('TestAgent');

        if (is_null($user)) {
            DB::beginTransaction();

            $users = new User();
            $users->is_active = true;
            $users->name = 'TestAgent';
            $users->password = Hash::make('uf4EG$5mivo');
            $users->email = 'agent@ipravo.kz';
            $users->save();

            UserRoleDal::insert($users->id, \App\Data\Helper\RoleList::Agent);
            $profile = new \App\Data\Core\Model\Profile();
            $profile->full_name = 'TestAgent';
            $profile->user_id = $users->id;
            $profile->phone = '';
            $profile->email = 'agent@ipravo.kz';
            $profile->profile_state_type_id = 2;
            $profile->is_resident = 1;
            $profile->created_by = null;
            $profile->save();

            DB::commit();

            DB::statement('update users set password = \'$2y$10$zPcSEq4CRtMvf4PseTEDHuvDH3VwZ63zx3xxKfsSLAtZSNEG3XzG.\' where id = ' . $users->id);
        }

        $user = \App\Data\Core\Dal\UserDal::getByUserName('TestPartner');

        if (is_null($user)) {
            DB::beginTransaction();

            $users = new User();
            $users->is_active = true;
            $users->name = 'TestPartner';
            $users->password = Hash::make('uf4EG$5mivo');
            $users->email = 'partner@ipravo.kz';
            $users->save();

            UserRoleDal::insert($users->id, \App\Data\Helper\RoleList::Partner);
            $profile = new \App\Data\Core\Model\Profile();
            $profile->full_name = 'TestPartner';
            $profile->user_id = $users->id;
            $profile->phone = '';
            $profile->email = 'partner@ipravo.kz';
            $profile->profile_state_type_id = 2;
            $profile->is_resident = 1;
            $profile->created_by = null;
            $profile->save();

            DB::commit();

            DB::statement('update users set password = \'$2y$10$zPcSEq4CRtMvf4PseTEDHuvDH3VwZ63zx3xxKfsSLAtZSNEG3XzG.\' where id = ' . $users->id);
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
