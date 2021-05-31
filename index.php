<?php 
/* begin smarty init */
require(__DIR__.'/smarty/libs/Smarty.class.php');

$smarty = new Smarty();

$smarty->setTemplateDir(__DIR__.'/smarty/templates');
$smarty->setCompileDir(__DIR__.'/smarty/templates_c');
$smarty->setCacheDir(__DIR__.'/smarty/cache');
$smarty->setConfigDir(__DIR__.'/smarty/configs');
$smarty->assign('config', array('date' => '%d.%m.%Y', 
                                'time' => '%H:%M:%S',
                                'datetime' => '%H:%M:%S %d.%m.%Y'));
$smarty->assign('mainContent', "village.tpl"); //default view
/* end smarty init */
require_once('./class/GameManager.class.php');
session_start();
if(!isset($_SESSION['gm'])) // jeżeli nie ma w sesji naszej wioski
    {
    $gm = new GameManager();
    $_SESSION['gm'] = $gm;
} 
else //mamy już wioskę w sesji - przywróć ją
{
    $gm = $_SESSION['gm'];
}
$v = $gm->v; //niezależnie cyz nowa gra czy załadowana
$gm->sync(); //przelicz surowce

        if(isset($_REQUEST['action'])) 
        {
            switch($_REQUEST['action'])
            {
                case 'upgradeBuilding':
                    $v->upgradeBuilding($_REQUEST['building']);
                    $smarty->assign('buildingList', $v->buildingList());
                    $buildingUpgrades = $gm->s->getTasksByFunction("scheduledBuildingUpgrade");
                    $smarty->assign('buildingUpgrades', $buildingUpgrades);
                    $smarty->assign('mainContent', "townHall.tpl");
                break;
                case 'newUnit':
                    if(isset($_REQUEST['spearmen'])) //kliknelismy wyszkol przy włócznikach
                    {
                        $count = $_REQUEST['spearmen']; //ilość nowych włóczników
                        $gm->newArmy($count, 0, 0, $v); //tworz nowy oddział włóczników w wiosce w ilosci $count;
                    }
                    if(isset($_REQUEST['archer']))
                    {
                        $count = $_REQUEST['archer']; 
                        $gm->newArmy(0, $count, 0, $v); 
                    }
                    if(isset($_REQUEST['cavalry']))
                    {
                        $count = $_REQUEST['cavalry']; 
                        $gm->newArmy(0, 0, $count, $v); 
                    }
                    $smarty->assign('armyList', $gm->getArmyList());
                    $smarty->assign('mainContent', "townSquare.tpl");
                break;
                case 'townHall':
                    $smarty->assign('buildingList', $v->buildingList());
                    $buildingUpgrades = $gm->s->getTasksByFunction("scheduledBuildingUpgrade");
                    $smarty->assign('buildingUpgrades', $buildingUpgrades);
                    $smarty->assign('mainContent', "townHall.tpl");
                break;
                case 'townSquare':
                    $smarty->assign('armyList', $gm->getArmyList());
                    $smarty->assign('mainContent', "townSquare.tpl");
                break;
                default:

                    $gm->l->log("Nieprawidłowa zmienna \"action\"", "controller", "error");
            }
        } 
$smarty->assign('wood', $v->showStorage("wood"));      
$smarty->assign('iron', $v->showStorage("iron"));        

$smarty->assign('logArray', $gm->l->getLog());
$smarty->display('index.tpl');     
?> 