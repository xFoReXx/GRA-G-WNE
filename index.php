<?php
require_once(__DIR__ . '/smarty/libs/Smarty.class.php');
require_once(__DIR__ . '/class/DB.class.php');
require_once(__DIR__ . '/class/GameManager.class.php');
require_once(__DIR__ . '/class/Route.class.php');
session_start();
$smarty = new Smarty();
$db = new DB();
$smarty->setTemplateDir(__DIR__ . '/smarty/templates');
$smarty->setCompileDir(__DIR__ . '/smarty/templates_c');
$smarty->setCacheDir(__DIR__ . '/smarty/cache');
$smarty->setConfigDir(__DIR__ . '/smarty/configs');
$smarty->assign('config', array(
    'date' => '%d.%m.%Y',
    'time' => '%H:%M:%S',
    'datetime' => '%H:%M:%S %d.%m.%Y'
));
if(isset($_SESSION['gm'])) {
    $gm = $_SESSION['gm'];
    if(isset($_SESSION['player_login']))
    {
        $smarty->assign('playerLogin', $_SESSION['player_login']);
        $v = $gm->v;
        $gm->sync();
        $smarty->assign('wood', $v->showStorage("wood"));
        $smarty->assign('iron', $v->showStorage("iron"));
        $smarty->assign('food', $v->showStorage("food"));
        $smarty->assign('logArray', $gm->l->getLog());
    }
}
Route::add('/', function () {
    global $smarty;
    if (!isset($_SESSION['gm'])) // jeżeli nie ma w sesji naszej gry
    {
        global $smarty;
        $smarty->display('login.tpl');
        
    }
    $smarty->assign('mainContent', "village.tpl");
    $smarty->display('index.tpl');
});
Route::add('/login', function () {
    global $smarty;
    $smarty->display('login.tpl');
});
Route::add('/login', function () {
    //proces logowania
    global $smarty, $db;
    if (isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        //zaloguj gracza
        if($db->loginPlayer($_REQUEST['login'], $_REQUEST['password'])) {//spróbuj zalogować
            //udało się
            $gm = new GameManager();
            $_SESSION['gm'] = $gm;
            header('Location: /');
        } else {
            //nie udało się
            $smarty->assign('error', "Niepoprawny login lub hasło!");
            $smarty->display('login.tpl');
        } 
    }
}, 'post');
Route::add('/register', function () {
    global $smarty;
    $smarty->display('register.tpl');
});
Route::add('/register', function () {
    global $smarty, $db;
    if (isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        //zapisz usera do bazy
        if($db->registerPlayer($_REQUEST['login'], $_REQUEST['password'])) {//próbujemy zapisać do bazy
            //udało sie
            $smarty->display('login.tpl');
        } else {
            //nie udało się utworzyc konta
            $smarty->assign('error', "Niepoprawny nie udało się utworzyć konta!");
            $smarty->display('register.tpl');
        }
    }
    
}, 'post');
Route::add('/logout', function () {
    session_destroy();
    header('Location: /login');
});
Route::add('/townhall', function () {
    global $smarty, $v, $gm;
    $smarty->assign('buildingList', $v->buildingList());
    $buildingUpgrades = $gm->s->getTasksByFunction("scheduledBuildingUpgrade");
    $smarty->assign('buildingUpgrades', $buildingUpgrades);
    $smarty->assign('mainContent', "townHall.tpl");
    $smarty->display('index.tpl');
});
Route::add('/townsquare', function () {
    global $smarty, $v, $gm;
    $smarty->assign('armyList', $gm->getArmyList());
    $smarty->assign('mainContent', "townSquare.tpl");
    $smarty->display('index.tpl');
});
Route::add('/upgradeBuilding', function () {
    global $smarty, $v, $gm;
    $v->upgradeBuilding($_REQUEST['building']);
    $smarty->assign('buildingList', $v->buildingList());
    $buildingUpgrades = $gm->s->getTasksByFunction("scheduledBuildingUpgrade");
    $smarty->assign('buildingUpgrades', $buildingUpgrades);
    $smarty->assign('mainContent', "townHall.tpl");
    $smarty->display('index.tpl');
}, 'post');

Route::add('/newUnit', function () {
    global $smarty, $v, $gm;
    if (isset($_REQUEST['spearmen'])) //kliknelismy wyszkol przy włócznikach
    {
        $count = $_REQUEST['spearmen']; //ilość nowych włóczników
        $gm->newArmy($count, 0, 0, $v); //tworz nowy oddział włóczników w wiosce w ilosci $count;
    }
    if (isset($_REQUEST['archer'])) {
        $count = $_REQUEST['archer'];
        $gm->newArmy(0, $count, 0, $v);
    }
    if (isset($_REQUEST['cavalry'])) {
        $count = $_REQUEST['cavalry'];
        $gm->newArmy(0, 0, $count, $v);
    }
    $smarty->assign('armyList', $gm->getArmyList());
    $smarty->assign('mainContent', "townSquare.tpl");
    $smarty->display('index.tpl');
}, 'post');

Route::run('/');
exit;