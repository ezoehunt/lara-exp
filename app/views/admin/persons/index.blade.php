@extends('admin.layout_admin')

@section('content')
    
{{ Breadcrumbs::render('admin_model','Persons','persons') }}
        
<h1>Manage People</h1>
<p>{{ link_to_route('admin.persons.allpersons', 'View All People') }}</p>

@if ($errors->any())
<div class="alert alert-error">
    <h2>Errors</h2>
    <ul>
{{ implode('', $errors->all('<li>:message</li>')) }} <a href="#" data-dismiss="alert" class="close">&times;</a> 
    </ul>
</div>
@endif

@if(Session::has('success'))
<div class="alert alert-success" id="flash_notice">{{ Session::get('success') }}<a href="#" data-dismiss="alert" class="close">&times;</a></div>
@endif

@if(Session::has('secondary'))
<div class="alert alert-info" id="flash_notice">{{ Session::get('secondary') }}<a href="#" data-dismiss="alert" class="close">&times;</a></div>
@endif

@if(Session::has('error'))
<div class="alert alert-error" id="flash_notice">{{ Session::get('error') }}<a href="#" data-dismiss="alert" class="close">&times;</a></div>
@endif

<div class="row" style="border-bottom:1px solid #ddd;">
    <div class="col-xs-3" style="padding: .75em .75em .75em 1em;">&nbsp;
    </div>
    
    <div class="col-xs-9" style="padding: .75em .75em .75em 1em;font-weight:bold;border-left:1px solid #ddd;text-transform:uppercase;">Upload and Import Data&nbsp; - &nbsp;do these left-to-right, top-to-bottom
    </div>
</div>

<?php // UPLOAD ROW ?>
<div class="row" style="border-bottom:1px solid #ddd;margin-top:0;padding-top:0;">
    
    <div class="col-xs-3" style="padding: .75em .75em .75em 1em;font-weight:bold;display:block;height:86px;">Upload Files<br/><span style="font-weight:normal;font-size:90%;">Format &nbsp;=&nbsp; JSON or XML<br/>Overwrites existing file</span>
    </div>
    
    <div class="col-xs-9" style="padding: .75em .75em .75em 1em;font-weight:bold;border-left:1px solid #ddd;display:block;height:86px;">
{{ Form::open(array('action' => 'AdminPersonsController@upload','files' => true, 'method' => 'post')) }}
{{ Form::file('file', array('style' => '')) }}
{{ Form::submit('Upload Source File for Members of Congress', array('class' => 'btn btn-primary btn-small','style' => 'margin-top:1em;')) }}
{{ Form::close() }}
    </div>
</div>


<?php // PERSONS ROW ?>
<?php
$persons = DB::table('persons')->count();
$personsCount = (isset($persons)) ? $persons : '0';
$mostRecent = DB::table('persons')->orderBy('updated_at', 'desc')->first();
$recentDate = (isset($mostRecent)) ? date('m-d-y',strtotime($mostRecent->updated_at)) : '0';
$recentTime = (isset($mostRecent)) ? date('g:ia',strtotime($mostRecent->updated_at)) : '0';
?>
<div class="row" style="border-bottom:1px solid #ddd;margin-top:0;padding-top:0;height:86px;">  
    
    <div class="col-xs-3" style="padding: .75em .75em .75em 1em;font-weight:bold;display:block;">Members of Congress<br/>
    <span style="font-weight:normal;font-size:90%;">total: <span style="color:blue;font-weight:bold;"><?php echo $personsCount; ?></span></br>
    last updated: <span style="color:red;"><?php echo $recentDate.' at '.$recentTime; ?></span></span>
    </div>
    
    <div class="col-xs-2" style="padding: .75em .75em .75em 1em;font-weight:bold;border-left:1px solid #ddd;display:block;height:86px;">
{{ Form::open(array('method' => 'post', 'files' => true, 'action' => array('AdminPersonsController@addPersons', 'filelink' => urlencode('data/persons/legislators-historical.json'), 'tablename' => 'persons', 'type' => 'people', 'time' => 'historical'))) }}
{{ HTML::decode(Form::button('<span class="glyphicon glyphicon-plus"></span> Historical', array('class' => 'btn btn-primary btn-small', 'type' => 'submit'))) }}
{{ Form::close() }}
    </div>

    <div class="col-xs-2" style="padding: .75em .75em .75em 1em;font-weight:bold;border-left:1px solid #ddd;display:block;height:86px;">
{{ Form::open(array('method' => 'post', 'files' => true, 'action' => array('AdminPersonsController@addPersons', 'filelink' => urlencode('data/persons/legislators-current.json'), 'tablename' => 'persons', 'type' => 'people', 'time' => 'current'))) }}
{{ HTML::decode(Form::button('<span class="glyphicon glyphicon-plus"></span> Current', array('class' => 'btn btn-primary btn-small', 'type' => 'submit'))) }}
{{ Form::close() }}
    </div>

</div>


@stop