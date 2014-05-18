<?php
/*---- Site ----*/
Breadcrumbs::register('siteindex', function($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

// Site pages that aren't dynamic and have 1 level
Breadcrumbs::register('site_section', function($breadcrumbs, $sectionName, $sectionUrl) {
    $breadcrumbs->parent('siteindex');
    $breadcrumbs->push($sectionName, url('/'.$sectionUrl));
});

// Site Model Index
Breadcrumbs::register('site_model', function($breadcrumbs, $modelName, $modelUrl) {
    $breadcrumbs->parent('siteindex');
    $breadcrumbs->push($modelName, url($modelUrl));
});

// Site Model Item (ids, store, update)
Breadcrumbs::register('site_item', function($breadcrumbs, $item, $modelName, $modelUrl, $itemname) {
    $breadcrumbs->parent('site_model', $modelName, $modelUrl);
    $breadcrumbs->push($itemname, url($modelUrl.'/'.$item->id, $item->id));
});

// Site Model Item Sub (edit)
Breadcrumbs::register('site_item_edit', function($breadcrumbs, $item, $modelName, $modelUrl, $itemname) {
    $breadcrumbs->parent('site_model', $modelName, $modelUrl);
    $breadcrumbs->push($itemname, url($modelUrl.'/'.$item->id, $item->id));
});

// Site Model Action (create, delete)
Breadcrumbs::register('site_action', function($breadcrumbs, $action, $modelName, $modelUrl) {
    $breadcrumbs->parent('site_model', $modelName, $modelUrl);
    $breadcrumbs->push($action, url($modelUrl.'/'.$action));
});


/*---- Admin ----*/
Breadcrumbs::register('admin_home', function($breadcrumbs) {
    $breadcrumbs->push('Admin Home', route('admin'));
});

// Admin Model Index
Breadcrumbs::register('admin_model', function($breadcrumbs, $modelName, $modelUrl) {
    $breadcrumbs->parent('admin_home');
    $breadcrumbs->push($modelName, url($modelUrl));
});

// Admin Model Item (ids, store, edit, update)
Breadcrumbs::register('admin_item', function($breadcrumbs, $item, $modelName, $modelUrl, $itemname) {
    $breadcrumbs->parent('admin_model', $modelName, $modelUrl);
    $breadcrumbs->push($itemname, url($modelUrl.'/'.$item->id, $item->id));
});

// Admin Model Action (create, delete)
Breadcrumbs::register('admin_action', function($breadcrumbs, $action, $modelName, $modelUrl) {
    $breadcrumbs->parent('admin_model', $modelName, $modelUrl);
    $breadcrumbs->push($action, url($modelUrl.'/'.$action));
});



/*
Breadcrumbs::register('blog', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Blog', route('blog'));
});

Breadcrumbs::register('category', function($breadcrumbs, $category) {
    $breadcrumbs->parent('blog');

    foreach ($category->ancestors as $ancestor) {
        $breadcrumbs->push($ancestor->title, route('category', $ancestor->id));
    }

    $breadcrumbs->push($category->title, route('category', $category->id));
});

Breadcrumbs::register('page', function($breadcrumbs, $page) {
    $breadcrumbs->parent('category', $page->category);
    $breadcrumbs->push($page->title, route('page', $page->id));
});
*/