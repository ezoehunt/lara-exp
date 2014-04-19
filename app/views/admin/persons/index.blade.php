@extends('admin.layout_admin')

@section('content')
    
<!-- start yield content -->
    <div id="main-content-admin" class="col-xs-12 col-sm-9 col-md-10 main-col-padding">

{{-- Breadcrumbs::render('admin_model','Members of Congress','admin/persons/allpersons') --}}
        
        <div class="slide-wrapper">
            <div class="slide" id="">
                <div class="slide-inner">
                
<h1>All Members of Congress</h1>  

<p>Current Total: 
<?php
$countPersons = DB::table('persons')->count();
echo $countPersons;
?>
</p>

<?php
// Allow pagination through sorted results
//echo $persons->addQuery('order',$order)->addQuery('sort', $sort)->links();
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
                    <td>{{ link_to('admin/persons/'.$person->id, $person->bioguideid) }}</td>
                    <td>
                    </td>
                    <td>{{{ $person->firstname }}}</td>
                    <td>{{{ $person->lastname }}}</td>
                    
                    
                </tr>
            @endforeach
        </tbody>
    </table>   
                    
                    
                </div><!-- / slide-inner -->
            </div><!-- / slide -->
        </div><!-- / slide-wrapper -->
        
    </div><!-- end main-content column -->

<!--/div--><!-- WHERE IS THIS ? end main row -->
<!-- no bottom bar for admin -->
<!-- end yield content -->
@stop