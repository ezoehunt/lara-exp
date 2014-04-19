@extends('admin.layout_admin')

@section('content')
	
<!-- start yield content -->
	<div id="main-content-admin" class="col-xs-12 col-sm-9 col-md-10 main-col-padding">

{{-- Breadcrumbs::render('admin_model','Persons','persons') --}}
		
		<div class="slide-wrapper">
			<div class="slide" id="">
				<div class="slide-inner">
				
<h3>Members of Congress</h3>
<p>{{-- link_to_route('admin.persons.allpersons', 'View All Members of Congress') --}}</p>

<!-- check for flash notification messages -->
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
<!-- end flash notification messages -->

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
{{ Form::open(array('method' => 'post', 'files' => true, 'action' => array('AdminPersonsController@addPersonData', 'filelink' => urlencode('data/persons/legislators-historical.json'), 'tablename' => 'persons', 'type' => 'historical'))) }}
{{ HTML::decode(Form::button('<span class="glyphicon glyphicon-plus"></span> Historical', array('class' => 'btn btn-primary btn-small', 'type' => 'submit'))) }}
{{ Form::close() }}
	</div>

	<div class="col-xs-2" style="padding: .75em .75em .75em 1em;font-weight:bold;border-left:1px solid #ddd;display:block;height:86px;">
{{ Form::open(array('method' => 'post', 'files' => true, 'action' => array('AdminPersonsController@updatePersonData', 'filelink' => urlencode('data/persons/legislators-historical.json'), 'tablename' => 'persons', 'type' => 'historical'))) }}
{{ HTML::decode(Form::button('<span class="glyphicon glyphicon-refresh"></span> Historical', array('class' => 'btn btn-primary btn-small', 'type' => 'submit'))) }}
{{ Form::close() }}	
	</div>
	
	<div class="col-xs-2" style="padding: .75em .75em .75em 1em;font-weight:bold;border-left:1px solid #ddd;display:block;height:86px;">
{{ Form::open(array('method' => 'post', 'files' => true, 'action' => array('AdminPersonsController@addPersonData', 'filelink' => urlencode('data/persons/legislators-current.json'), 'tablename' => 'persons', 'type' => 'current'))) }}
{{ HTML::decode(Form::button('<span class="glyphicon glyphicon-plus"></span> Current', array('class' => 'btn btn-primary btn-small', 'type' => 'submit'))) }}
{{ Form::close() }}
	</div>

	<div class="col-xs-3" style="padding: .75em .75em .75em 1em;font-weight:bold;border-left:1px solid #ddd;display:block;height:86px;">
{{ Form::open(array('method' => 'post', 'files' => true, 'action' => array('AdminPersonsController@updatePersonData', 'filelink' => urlencode('data/persons/legislators-current.json'), 'tablename' => 'persons', 'type' => 'current'))) }}
{{ HTML::decode(Form::button('<span class="glyphicon glyphicon-refresh"></span> Current', array('class' => 'btn btn-primary btn-small', 'type' => 'submit'))) }}
{{ Form::close() }}
	</div>
</div>


<?php // TERMS ROW ?>
<?php
unset($mostRecent);
$terms = DB::table('person_terms')->count();
$termsCount = (isset($terms)) ? $terms : '0';
$mostRecent = DB::table('person_terms')->orderBy('updated_at', 'desc')->first();
$recentDate = (isset($mostRecent)) ? date('m-d-y',strtotime($mostRecent->updated_at)) : '0';
$recentTime = (isset($mostRecent)) ? date('g:ia',strtotime($mostRecent->updated_at)) : '0';
?>
<div class="row" style="border-bottom:1px solid #ddd;margin-top:0;padding-top:0;height:86px;">	
	
	<div class="col-xs-3" style="padding: .75em .75em .75em 1em;font-weight:bold;display:block;">Member Terms<br/>
	<span style="font-weight:normal;font-size:90%;">total: <span style="color:blue;font-weight:bold;"><?php echo $termsCount; ?></span></br>
	last updated: <span style="color:red;"><?php echo $recentDate.' at '.$recentTime; ?></span></span>
	</div>
	
	<div class="col-xs-3" style="padding: .75em .75em .75em 1em;font-weight:bold;border-left:1px solid #ddd;display:block;height:86px;">
{{ Form::open(array('method' => 'post', 'files' => true, 'action' => array('AdminPersonsController@addPersonData', 'filelink' => urlencode('data/persons/legislators-combined.json'), 'tablename' => 'person_terms', 'type' => 'terms'))) }}
{{ HTML::decode(Form::button('<span class="glyphicon glyphicon-plus"></span> Historical + Current', array('class' => 'btn btn-primary btn-small', 'type' => 'submit'))) }}
{{ Form::close() }}
	</div>

	<div class="col-xs-6" style="padding: .75em .75em .75em 1em;font-weight:normal;border-left:1px solid #ddd;display:block;height:86px;"><span style="color:red;">Uses <b>LEGISLATORS-COMBINED.JSON</b> file.</span><br/>Each insert truncates and deletes earlier data.
	</div>
</div>


<?php // ROLES ROW ?>
<?php
unset($mostRecent);
$roles = DB::table('person_roles')->count();
$rolesCount = (isset($roles)) ? $roles : '0';
$mostRecent = DB::table('person_roles')->orderBy('updated_at', 'desc')->first();
$recentDate = (isset($mostRecent)) ? date('m-d-y',strtotime($mostRecent->updated_at)) : '0';
$recentTime = (isset($mostRecent)) ? date('g:ia',strtotime($mostRecent->updated_at)) : '0';
?>
<div class="row" style="border-bottom:1px solid #ddd;margin-top:0;padding-top:0;height:86px;">	
	
	<div class="col-xs-3" style="padding: .75em .75em .75em 1em;font-weight:bold;display:block;">Member Roles<br/>
	<span style="font-weight:normal;font-size:90%;">total: <span style="color:blue;font-weight:bold;"><?php echo $rolesCount; ?></span></br>
	last updated: <span style="color:red;"><?php echo $recentDate.' at '.$recentTime; ?></span></span>
	</div>
	
	<div class="col-xs-3" style="padding: .75em .75em .75em 1em;font-weight:bold;border-left:1px solid #ddd;display:block;height:86px;">
{{ Form::open(array('method' => 'post', 'files' => true, 'action' => array('AdminPersonsController@addPersonData', 'filelink' => urlencode('data/persons/legislators-combined.json'), 'tablename' => 'person_roles', 'type' => 'roles'))) }}
{{ HTML::decode(Form::button('<span class="glyphicon glyphicon-plus"></span> Historical + Current', array('class' => 'btn btn-primary btn-small', 'type' => 'submit'))) }}
{{ Form::close() }}
	</div>

	<div class="col-xs-6" style="padding: .75em .75em .75em 1em;font-weight:normal;border-left:1px solid #ddd;display:block;height:86px;"><span style="color:red;">Uses <b>LEGISLATORS-COMBINED.JSON</b> file.</span><br/>Each insert truncates and deletes earlier data.
	</div>
</div>


<?php // FAMILY RELATIONS ROW ?>
<?php
unset($mostRecent);
$relations = DB::table('person_relations')->count();
$relationsCount = (isset($relations)) ? $relations : '0';
$mostRecent = DB::table('person_relations')->orderBy('updated_at', 'desc')->first();
$recentDate = (isset($mostRecent)) ? date('m-d-y',strtotime($mostRecent->updated_at)) : '0';
$recentTime = (isset($mostRecent)) ? date('g:ia',strtotime($mostRecent->updated_at)) : '0';
?>
<div class="row" style="border-bottom:1px solid #ddd;margin-top:0;padding-top:0;height:86px;">	
	
	<div class="col-xs-3" style="padding: .75em .75em .75em 1em;font-weight:bold;display:block;">Member Family Relations<br/>
	<span style="font-weight:normal;font-size:90%;">total: <span style="color:blue;font-weight:bold;"><?php echo $relationsCount; ?></span></br>
	last updated: <span style="color:red;"><?php echo $recentDate.' at '.$recentTime; ?></span></span>
	</div>
	
	<div class="col-xs-3" style="padding: .75em .75em .75em 1em;font-weight:bold;border-left:1px solid #ddd;display:block;height:86px;">
{{ Form::open(array('method' => 'post', 'files' => true, 'action' => array('AdminPersonsController@addPersonData', 'filelink' => urlencode('data/persons/legislators-combined.json'), 'tablename' => 'person_relations', 'type' => 'relations'))) }}
{{ HTML::decode(Form::button('<span class="glyphicon glyphicon-plus"></span> Historical + Current', array('class' => 'btn btn-primary btn-small', 'type' => 'submit'))) }}
{{ Form::close() }}
	</div>

	<div class="col-xs-6" style="padding: .75em .75em .75em 1em;font-weight:normal;border-left:1px solid #ddd;display:block;height:86px;"><span style="color:red;">Uses <b>LEGISLATORS-COMBINED.JSON</b> file.</span><br/>Each insert truncates and deletes earlier data.
	</div>
</div>


<?php // EXECUTIVE ROW ?>
<?php
unset($mostRecent);
$getTerms = DB::table('person_terms')->where('execflag', '=', 'executive')->get();
foreach ($getTerms as $term) {
	$getMembers[] = DB::table('persons')->where('id', '=', $term->person_id)->pluck('id');
}
$execCount = (isset($getMembers)) ? count(array_unique($getMembers)) : '0';	
$mostRecent = DB::table('person_terms')->where('execflag','=','executive')->orderBy('updated_at', 'desc')->first();
$recentDate = (isset($mostRecent)) ? date('m-d-y',strtotime($mostRecent->updated_at)) : '0';
$recentTime = (isset($mostRecent)) ? date('g:ia',strtotime($mostRecent->updated_at)) : '0';
?>
<div class="row" style="border-bottom:1px solid #ddd;margin-top:0;padding-top:0;">
	
	<div class="col-xs-3" style="padding: .75em .75em .75em 1em;font-weight:bold;display:block;height:86px;">Executives<br/>
	<span style="font-weight:normal;font-size:90%;">total: <span style="color:blue;font-weight:bold;"><?php echo $execCount; ?></span><br/>
	last updated: <span style="color:red;"><?php echo $recentDate.' at '.$recentTime; ?></span></span>
	</div>
	
	<div class="col-xs-2" style="padding: .75em .75em .75em 1em;font-weight:bold;border-left:1px solid #ddd;display:block;height:86px;">
{{ Form::open(array('method' => 'post', 'files' => true, 'action' => array('AdminPersonsController@addPersonData', 'filelink' => urlencode('data/persons/executive-updated.json'), 'tablename' => 'persons', 'type' => 'executive'))) }}
{{ HTML::decode(Form::button('<span class="glyphicon glyphicon-plus"></span> Executives', array('class' => 'btn btn-primary btn-small', 'type' => 'submit'))) }}
{{ Form::close() }}
	</div>

	<div class="col-xs-2" style="padding: .75em .75em .75em 1em;font-weight:bold;border-left:1px solid #ddd;display:block;height:86px;">
{{ Form::open(array('method' => 'post', 'files' => true, 'action' => array('AdminPersonsController@updatePersonData', 'filelink' => urlencode('data/persons/executive-updated.json'), 'tablename' => 'persons', 'type' => 'executive'))) }}
{{ HTML::decode(Form::button('<span class="glyphicon glyphicon-refresh"></span> Executives', array('class' => 'btn btn-primary btn-small', 'type' => 'submit'))) }}
{{ Form::close() }}
	</div>

	<div class="col-xs-2" style="padding: .75em .75em .75em 1em;font-weight:bold;border-left:1px solid #ddd;display:block;height:86px;">
{{ Form::open(array('method' => 'post', 'files' => true, 'action' => array('AdminPersonsController@addPersonData', 'filelink' => urlencode('data/persons/executive-updated.json'), 'tablename' => 'person_terms', 'type' => 'execterms'))) }}
{{ HTML::decode(Form::button('<span class="glyphicon glyphicon-plus"></span> Executive Terms', array('class' => 'btn btn-primary btn-small', 'type' => 'submit'))) }}
{{ Form::close() }}
	</div>

	<div class="col-xs-3" style="padding: .75em .75em .75em 1em;font-weight:normal;border-left:1px solid #ddd;display:block;height:86px;">Each insert truncates and deletes earlier data.
	</div>
</div>


<?php // SOCIAL MEDIA ROW ?>
<?php
unset($mostRecent);
$social = DB::table('persons')
	->where('twitterid','!=','null')
	->orWhere('facebookid','!=','null')
	->orWhere('youtubeid','!=','null')
	->count();
$socialCount = (isset($social)) ? $social : '0';
$mostRecent = DB::table('persons')->where('twitterid','!=','null')->orderBy('updated_at', 'desc')->first();
$recentDate = (isset($mostRecent)) ? date('m-d-y',strtotime($mostRecent->updated_at)) : '0';
$recentTime = (isset($mostRecent)) ? date('g:ia',strtotime($mostRecent->updated_at)) : '0';
?>
<div class="row" style="border-bottom:1px solid #ddd;margin-top:0;padding-top:0;">
	
	<div class="col-xs-3" style="padding: .75em .75em .75em 1em;font-weight:bold;display:block;height:86px;">Members with Social Media<br/>
	<span style="font-weight:normal;font-size:90%;">total: <span style="color:blue;font-weight:bold;"><?php echo $socialCount; ?></span></br>
	last updated: <span style="color:red;"><?php echo $recentDate.' at '.$recentTime; ?></span></span>
	</div>
	
	<div class="col-xs-2" style="padding: .75em .75em .75em 1em;font-weight:bold;border-left:1px solid #ddd;display:block;height:86px;">
{{ Form::open(array('method' => 'post', 'files' => true, 'action' => array('AdminPersonsController@updatePersonData', 'filelink' => urlencode('data/persons/legislators-social-media.json'), 'tablename' => 'persons', 'type' => 'social'))) }}
{{ HTML::decode(Form::button('<span class="glyphicon glyphicon-plus"></span> Social Accounts', array('class' => 'btn btn-primary btn-small', 'type' => 'submit'))) }}
{{ Form::close() }}
	</div>

	<div class="col-xs-2" style="padding: .75em .75em .75em 1em;font-weight:bold;border-left:1px solid #ddd;display:block;height:86px;">
{{ Form::open(array('method' => 'post', 'files' => true, 'action' => array('AdminPersonsController@clearMemberSocial', 'filelink' => urlencode('data/persons/legislators-social-media.json'), 'tablename' => 'persons', 'type' => 'clearsocial'))) }}
{{ HTML::decode(Form::button('<span class="glyphicon glyphicon-remove"></span> Social Accounts', array('class' => 'btn btn-primary btn-small', 'type' => 'submit'))) }}
{{ Form::close() }}
	</div>

	<div class="col-xs-5" style="padding: .75em .75em .75em 1em;font-weight:normal;border-left:1px solid #ddd;display:block;height:86px;"><span style="color:red;"><b>Do Social Media last</span> because it overwrites other Member data.</b> Social Media only valid for Current Members, so clear Social Accounts for non-Current Members.
	</div>
</div>


					
					
					<div class="bs-example" style="margin-top:3em;padding-bottom: 24px;">
						<a id="testing" href="#" class="btn btn-lg btn-danger testpopover" title="A Title" data-content-target="#popup1" role="button" data-class-in="animated bounceInRight" data-class-out="animated bounceOutRight">Click to 1 popover</a>

						<div id="popup1" class="popover-content-wrapper hide" style="border:3px solid red;margin-top:3em;">
							<div>This is your div content 1</div>
							<button class="btn btn-xs closeit" type="button" >Close</button>
						</div>
					</div>
					
					
					
				</div><!-- / slide-inner -->
			</div><!-- / slide -->
		</div><!-- / slide-wrapper -->
		
	</div><!-- end main-content column -->

<!--/div--><!-- WHERE IS THIS ? end main row -->
<!-- no bottom bar for admin -->
<!-- end yield content -->
@stop