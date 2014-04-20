@extends('layout_main')

@section('content')

<!-- start yield content -->
    <div id="main-content-admin" class="col-xs-12 col-sm-9 col-md-10 main-col-padding">

{{-- Breadcrumbs::render('site_model','Persons','persons') --}}        

<h1>All Members of Congress</h1>  

<p>Current Total: {{{ $persons->count() }}}</p>

<div style="float:left;">
<?php
// Allow pagination through sorted results
//echo $persons->addQuery('order',$order)->addQuery('sort', $sort)->links();
?>
</div>

<div style="float:right;">

</div>

<?php
// select * from personTerms WHERE id=id AND current=1 orderby by id asc
//SQL: select * from `persons` order by `status` asc limit 25 offset 0

?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>

                <th>Bioguide ID</th>
                
                <th>Status</th> 
                
                <th>First name</th>

                <th>Last name</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($persons as $person)
                <tr>
                    <td>{{{ $person->id }}}</td>
                    <td>{{ link_to('persons/'.$person->id, $person->bioguideid) }}</td>
                    <td>terms</td>
                    <td>{{{ $person->firstname }}}</td>
                    <td>{{{ $person->lastname }}}</td>
                    
                    
                </tr>
            @endforeach
        </tbody>
    </table>
    


</div>
@stop
