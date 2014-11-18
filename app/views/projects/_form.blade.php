
<p class="required-warning">Required fields are marked with an asterisk.</p>

<div class="form-horizontal">

    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {{ Form::label('name', 'Project name', array ('class' => 'col-sm-2 control-label required')) }}
        <div class="col-sm-6">
            {{ Form::text('name', $project->name, array ('class' => 'form-control')) }}
        </div>
        <p class="col-sm-offset-2 col-sm-10 help-block">The name of the project needs to be unique.</p>
    </div>

    <div class="form-group {{ $errors->has('leader') ? 'has-error' : '' }}">
        {{ Form::label('leader', 'Project leader', array ('class' => 'col-sm-2 control-label required')) }}
        <div class="col-sm-6">
            {{ Form::text('leader', $project->leader, array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2">
            {{ Form::submit($button, array ('class' => 'btn btn-primary')) }} 
        </div>
    </div>

</div>