@extends('admin.layout_admin')

@section('content')

{{ Breadcrumbs::render('admin_item', $person, 'Persons', '/admin/persons/allpersons', $person->name) }}
                
<h1>{{{ $person->name }}}</h1>
<p>{{ link_to_route('admin.persons.allpersons', '&#171; back') }}</p>

<p><b>Name: {{{ $person->name }}}</b></p>

<?php 
// example of injecting service
//echo 'display name '.$displayName; ?></p>


@stop
