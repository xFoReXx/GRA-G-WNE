<?php
require(__DIR__.'/../smarty/libs/Smarty.class.php');

$smarty = new Smarty();

$smarty->setTemplateDir(__DIR__.'/../smarty/templates');
$smarty->setCompileDir(__DIR__.'/../smarty/templates_c');
$smarty->setCacheDir(__DIR__.'/../smarty/cache');
$smarty->setConfigDir(__DIR__.'/../smarty/configs');


$name = "Mateusz";

$smarty->assign('imie', $name);

$smarty->display('test.tpl');

?>