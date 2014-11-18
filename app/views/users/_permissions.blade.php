
<fieldset>
    <legend>Permissions</legend>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-7">
            <label for="superuser" class="control-label">
                {{ Form::checkbox('superuser', true, $user->isSuperUser() ? true : false) }} Superuser</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-7">
            <label for="user_administration" class="control-label">
                {{ Form::checkbox('user_administration', true, $user->inGroup($user_administration) ? true : false) }} User Administration</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-7">
            <label for="project_administration" class="control-label">
                {{ Form::checkbox('project_administration', true, $user->inGroup($project_administration) ? true : false) }} Project Administration</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-7">
            <label for="contact_administration" class="control-label">
                {{ Form::checkbox('contact_administration', true, $user->inGroup($contact_administration) ? true : false) }} Contact Administration</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-7">
            <label for="attendance_administration" class="control-label">
                {{ Form::checkbox('attendance_administration', true, $user->inGroup($attendance_administration) ? true : false) }} Attendance Administration</label>
        </div>
    </div>

</fieldset>
