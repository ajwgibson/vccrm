<?php

class SentrySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users_groups')->delete();
        DB::table('groups')->delete();

        // Create the all users group
        $all_users = Sentry::createGroup(array(
            'name'        => 'All Users',
            'permissions' => array(
                'home' => 1,
                'logout' => 1,
                'account.*' => 1,
                'attendance_record.*' => 1,
                'project.roles' => 1,
            ),
        ));

        // Create the user administration group
        $user_admin_group = Sentry::createGroup(array(
            'name'        => 'User Administration',
            'permissions' => array(
                'user.*' => 1,
            ),
        ));

        // Create the project administration group
        $project_admin_group = Sentry::createGroup(array(
            'name'        => 'Project Administration',
            'permissions' => array(
                'project.*' => 1,
                'project_role.*' => 1,
            ),
        ));

        // Create the contact administration group
        $contact_admin_group = Sentry::createGroup(array(
            'name'        => 'Contact Administration',
            'permissions' => array(
                'contact.*' => 1,
                'volunteer_details.*' => 1,
                'connection_card.*' => 1,
            ),
        ));

        // Create the attendance administration group
        $attendance_admin_group = Sentry::createGroup(array(
            'name'        => 'Attendance Administration',
            'permissions' => array( ),
        ));

        // Alan
        $alan = Sentry::createUser(array(
            'email'      => 'ajw.gibson@gmail.com',
            'password'   => 'password',
            'first_name' => 'Alan',
            'last_name'  => 'Gibson',
            'activated'  => true,
            'permissions' => array(
                'superuser' => 1
            ),
        ));

        // Sue
        $sue = Sentry::createUser(array(
            'email'      => 'sue@vineyardcompassion.co.uk',
            'password'   => 'password',
            'first_name' => 'Sue',
            'last_name'  => 'Gibson',
            'activated'  => true,
        ));
        $sue->addGroup($all_users);
        $sue->addGroup($user_admin_group);
        $sue->addGroup($project_admin_group);
        $sue->addGroup($contact_admin_group);
        $sue->addGroup($attendance_admin_group);
    }

}