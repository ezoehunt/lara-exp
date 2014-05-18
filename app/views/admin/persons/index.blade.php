@extends('admin.layout_admin')

@section('content')
    
{{ Breadcrumbs::render('admin_model','Persons','persons') }}
        
<h3>Manage People</h3>
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
{{-- Form::open(array('action' => 'AdminPersonsController@upload','files' => true, 'method' => 'post')) }}
{{ Form::file('file', array('style' => '')) }}
{{ Form::submit('Upload Source File for Members of Congress', array('class' => 'btn btn-primary btn-small','style' => 'margin-top:1em;')) }}
{{ Form::close() --}}
    </div>
</div>


@stop