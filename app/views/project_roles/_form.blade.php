<p class="required-warning">Required fields are marked with an asterisk.</p>

<div class="form-horizontal">

	<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {{ Form::label('name', 'Role name', array ('class' => 'col-sm-2 control-label required')) }}
        <div class="col-sm-6">
            {{ Form::text('name', $role->name, array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('hours') ? 'has-error' : '' }}">
        {{ Form::label('hours', 'Usual attendance hours', array ('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-1">
            {{ Form::text('hours', $role->hours, array ('class' => 'form-control')) }}
        </div>
        <p class="col-sm-offset-2 col-sm-10 help-block">You can enter this value as a whole number of hours or as a decimal fraction e.g. 1.5</p>
    </div>

    <div class="form-group">
        {{ Form::label('volunteer', 'Is this a volunteer role?', array ('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-2">
            <label class="checkbox-inline">{{ Form::radio('volunteer', true) }} Yes</label>
            <label class="checkbox-inline">{{ Form::radio('volunteer', false) }} No</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            {{ Form::submit($button, array ('class' => 'btn btn-primary')) }} 
        </div>
    </div>

</div>