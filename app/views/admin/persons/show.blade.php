@extends('admin.layout_admin')

@section('content')

<div id="main-content-admin" class="col-xs-12 col-sm-9 col-md-10 main-col-padding">
<?php
$fullname = $person->firstname;
if ($person->middlename != 'null') {
    $fullname .= ' '.$person->middlename;
}
$fullname .= ' '.$person->lastname;
?>

{{-- Breadcrumbs::render('admin_item', $person, 'Persons', '/admin/persons', $fullname) --}}
        
        <div class="slide-wrapper">
            <div class="slide" id="">
                <div class="slide-inner">
                
<h3>View Member of Congress</h3>

<p>{{ link_to_route('admin.persons.index', 'Return to all Members of Congress') }}</p>
    <div>

<p><b><?php echo $fullname; ?></b></p>
<ul>
</ul>
</br>  

</div>


</div><!-- / slide-inner -->
            </div><!-- / slide -->
        </div><!-- / slide-wrapper -->
        
    </div><!-- end main-content column -->

<!--/div--><!-- WHERE IS THIS ? end main row -->
<!-- no bottom bar for admin -->
<!-- end yield content -->

@stop
