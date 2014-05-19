<div id="main-sidebar" class="col-xs-3 col-sm-3 col-md-2 sidebar-offcanvas" role="navigation">
    <div class="gs-sidebar">
        <!-- display logo for sizes +xs -->
        <a href="/" title="Go to the website home page"><img id="logo-img-big" class="logo-sidebar" src="/images/logos/icon_gov.png"></a>
        
        <ul class="gs-sidenav sidebar-nav">

<?php if ( isset($bodyclass) & !in_array('dashboard',$bodyclass)) { ?>
            <li style="background-color:#fff;text-transform:none;letter-spacing:0;"><a class="" href="<?php echo URL::route('admin'); ?>" title=""> &#171; back to Admin Home</a></li>
<? } ?>                         
            <li<?php if ( isset($bodyclass) & in_array('congresses',$bodyclass)) {echo ' class="active"';} ?>><a class="nav-link" href="<?php echo URL::route('admin'); ?>" title="Congresses"><span aria-hidden="true" class="icon-flag"></span> Congresses</a></li>
                
        <ul class="gs-sidenav-inner">
        <li<?php if ( isset($bodyclass) & in_array('sessions',$bodyclass)) {echo ' class="active"';} ?>><a class="nav-link" href="<?php echo URL::route('admin.persons.index');?>" title="Bills and Resolutions"><span aria-hidden="true" class="icon-calendar2"></span> Sessions</a></li>
            
        <li<?php if ( isset($bodyclass) & in_array('bills',$bodyclass)) {echo ' class="active"';} ?>><a class="nav-link" href="<?php echo URL::route('admin.persons.index');?>" title="Bills and Resolutions"><span aria-hidden="true" class="icon-stack"></span> Bills</a></li>
            
        <li<?php if ( isset($bodyclass) & in_array('persons',$bodyclass)) {echo ' class="active"';} ?>><a class="nav-link" href="<?php echo URL::route('admin.persons.index');?>" title="People"><span aria-hidden="true" class="icon-users"></span> People</a></li>

        <li<?php if ( isset($bodyclass) & in_array('committees',$bodyclass)) {echo ' class="active"';} ?>><a class="nav-link" href="<?php echo URL::route('admin.persons.index');?>" title="Committees"><span aria-hidden="true" class="icon-users"></span> Committees</a></li>
            
        <li<?php if ( isset($bodyclass) & in_array('votes',$bodyclass)) {echo ' class="active"';} ?>><a class="nav-link" href="<?php echo URL::route('admin.persons.index');?>" title="Votes"><span aria-hidden="true" class="icon-checkbox"></span> Votes</a></li>
            
        <li<?php if ( isset($bodyclass) & in_array('budgets',$bodyclass)) {echo ' class="active"';} ?>><a class="nav-link" href="<?php echo URL::route('admin.persons.index');?>" title="Budgets"><span class="glyphicon glyphicon-usd" aria-hidden="true" ></span> Budgets</a></li>    
                                                
        </ul>

            <li><a class="nav-link" href="<?php echo URL::route('admin.persons.index');?>" title="View Reports"><span aria-hidden="true" class="icon-library"></span> Reports</a></li>

            <li><a class="nav-link" href="<?php //echo URL::route('admin.users.index');?>" title=""><span aria-hidden="true" class="icon-library"></span> Users</a></li>
            
            <!-- display avatar for sizes +xs -->
            <li class="sidebar-avatar">
                <a class="nav-link" href="<?php //echo '/username';?>" title="Your Profile"><div class="block-avatar"><img class="side-avatar" src="/images/users/user_img.jpg"></div><div class="sidebar-username">Profile</div></a>
            </li>

        </ul>
        
    </div><!-- end gs-sidebar-->
 </div><!-- end main-sidebar -->