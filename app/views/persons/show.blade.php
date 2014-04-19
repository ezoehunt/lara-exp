@extends('layout_main')

@section('content')

<!-- start yield content -->
    <div id="main-content-admin" class="col-xs-12 col-sm-9 col-md-10 main-col-padding">

<?php
$fullname = $person->firstname;
if ($person->middlename != 'null') {
    $fullname .= ' '.$person->middlename;
}
$fullname .= ' '.$person->lastname;
?>

{{-- Breadcrumbs::render('site_item', $person, 'Persons', '/persons', $fullname) --}}

<h1>View @if ($person->name == 'null') {{{ $person->firstname }}} {{{ $person->lastname }}} @else {{{ $person->name }}}@endif</h1>

<p>{{ link_to_route('persons.index', 'Return to all Members of Congress') }}</p>
	<div>

<p><b><?php echo $fullname; ?></b></p>




	</div>

</div><!-- / main-content -->
@stop
