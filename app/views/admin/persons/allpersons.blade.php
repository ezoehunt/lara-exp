@extends('admin.layout_admin')

@section('content')
    
{{ Breadcrumbs::render('admin_model','Persons','admin/persons/allpersons') }}

<h1>All People</h1>  
<p>{{ link_to_route('admin.persons.index', '&#171; back') }}</p>

@if ($errors->any())
<div class="alert alert-error">
    <a href="#" data-dismiss="alert" class="close">&times;</a>
    <ul>
{{ implode('', $errors->all('<li>:message</li>')) }}  
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


<p>Current Total: 
<?php
// don't use $persons->count() b/c it counts only items visible this page
$countPersons = DB::table('persons')->count();
echo $countPersons;
?>
</p>

<?php
// Allow pagination through sorted results
echo $persons->addQuery('order',$order)->addQuery('sort', $sort)->links();
?>
<table class="table table-striped table-bordered">
<thead>
    <tr>
    <th>
    @if ($sort == 'id' && $order == 'asc') {{
        link_to_action(
            'AdminPersonsController@allpersons',
            'Person ID',
            array(
                'sort' => 'id',
                'order' => 'desc'
            )
        )
    }}
    @else {{
        link_to_action(
            'AdminPersonsController@allpersons',
            'Person ID',
            array(
                'sort' => 'id',
                'order' => 'asc'
            )
        )
    }}
    @endif
    </th>

    <th>Bioguide ID</th>
    
    <th>Status</th> 
    
    <th>
    @if ($sort == 'firstname' && $order == 'asc') {{
        link_to_action(
            'AdminPersonsController@allpersons',
            'First Name',
            array(
                'sort' => 'firstname',
                'order' => 'desc'
            )
        )
    }}
    @else {{
        link_to_action(
            'AdminPersonsController@allpersons',
            'First Name',
            array(
                'sort' => 'firstname',
                'order' => 'asc'
            )
        )
    }}
    @endif
    </th>

    <th>
    @if ($sort == 'lastname' && $order == 'asc') {{
        link_to_action(
            'AdminPersonsController@allpersons',
            'Last Name',
            array(
                'sort' => 'lastname',
                'order' => 'desc'
            )
        )
    }}
    @else {{
        link_to_action(
            'AdminPersonsController@allpersons',
            'Last Name',
            array(
                'sort' => 'lastname',
                'order' => 'asc'
            )
        )
    }}
    @endif
    </th>

    <th>
    @if ($sort == 'name' && $order == 'asc') {{
        link_to_action(
            'AdminPersonsController@allpersons',
            'Full Name',
            array(
                'sort' => 'name',
                'order' => 'desc'
            )
        )
    }}
    @else {{
        link_to_action(
            'AdminPersonsController@allpersons',
            'Full Name',
            array(
                'sort' => 'name',
                'order' => 'asc'
            )
        )
    }}
    @endif
    </th>
    </tr>
</thead>

<tbody>
@foreach ($persons as $person)
    <tr>
        <td>{{{ $person->id }}}</td>
        <td>{{ link_to('admin/persons/'.$person->slug, $person->bioguideid) }}</td>
        <td>
        </td>
        <td>{{{ $person->firstname }}}</td>
        <td>{{{ $person->lastname }}}</td>
        <td>{{ link_to('admin/persons/'.$person->slug, $person->name) }}</td>
    </tr>
@endforeach
</tbody>
</table>  

@stop