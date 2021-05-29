<?php
require_once('Village.class.php');
require_once('Log.class.php');
require_once('Scheduler.class.php');
require_once('Army.class.php');
class GameManager
{
    public $v; //wioska
    public $a; //armie jako tablica
    public $l; //logi
    public $s; // scheduler
    public $t; //czas ostatniego refresha
    public function __construct()
    {
        $this->l = new Log();

        $this->l->log("Tworzę nową gre...", 'gameManager', 'info');
        $this->v = new Village($this);
        $this->a = array();
        $this->s = new Scheduler($this);
        $this->t = time();

    }
    public function deltaTime() : int
    {
        return time() - $this->t;
    }
    public function sync()
    {
        $this->s->check($this->t);
        //na koniec synchronizuj z obecnym czasem
        $this->v->gain($this->deltaTime());
        $this->t = time();

    }
    public function newArmy($spearmen, $archers, $cavalry, $location) 
    {
        $this->l->log("tworzę nową armię", "gamemanager");
        foreach($this->a as &$otherArmy)
        {
            if($otherArmy->location == $location) //jeżeli inna armia jest w tym samym miejscu - połącz
            {
                $otherArmy->spearmen += $spearmen;
                $otherArmy->archers += $archers;
                $otherArmy->cavalry += $cavalry;
                return;
            }
        }
        $army = new Army($spearmen, $archers, $cavalry, $location);
        array_push($this->a, $army);
    }
    public function getArmyList()
    {
        return $this->a;
    }
}
?>