<?php
require(__DIR__.'/../smarty/libs/Smarty.class.php');

$smarty = new Smarty();

$smarty->setTemplateDir(__DIR__.'/../smarty/templates');
$smarty->setCompileDir(__DIR__.'/../smarty/templates_c');
$smarty->setCacheDir(__DIR__.'/../smarty/cache');
$smarty->setConfigDir(__DIR__.'/../smarty/configs');

include('route.php');

Route::add('/',function(){
    echo 'Strona glowna';
});

Route::add('/zaloguj',function(){
    global $smarty;
    $smarty->display('login.tpl');
});

Route::add('/zarejestruj',function(){
    global $smarty;
    $smarty->display('register.tpl');
});

Route::add('/ratusz',function(){
    global $smarty;
    $smarty->display('townHall.tpl');
});

// Simple test route that simulates static html file
Route::add('/test.html',function(){
    echo 'Hello from test.html';
});

Route::run('/GRAGŁÓWNE/sandbox');

?>