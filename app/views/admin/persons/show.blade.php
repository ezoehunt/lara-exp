@extends('admin.layout_admin')

@section('content')

{{ Breadcrumbs::render('admin_item', $person, 'Persons', '/admin/persons/allpersons', $person->name) }}
                
<h3>{{{ $person->name }}}</h3>

<p><b>{{{ $person->name }}}</b></p>

@stop
