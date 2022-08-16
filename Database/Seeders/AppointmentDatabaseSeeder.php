<?php

namespace Modules\Appointment\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Acl\Utils\AclSeederHelper;
use Modules\Appointment\Enum\MeetingPermission;

class AppointmentDatabaseSeeder extends Seeder
{
    use AclSeederHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->acl('appointment')
            ->attachEnum(MeetingPermission::class, MeetingPermission::All->value)
            ->create();

        // $this->call("OthersTableSeeder");
    }
}
