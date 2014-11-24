<?php

use Cartalyst\Sentry\Users\Eloquent\User as SentryModel;

class User extends SentryModel {


	// Relationship: attendance_records
    public function attendance_records()
    {
        return $this->hasMany('AttendanceRecord');
    }

}