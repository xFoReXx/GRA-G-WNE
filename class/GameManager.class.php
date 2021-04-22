<?php 
require_once('Village.class.php');
require_once('Log.class.php');
class GameManager
{
    public $v; //wioska
    public $l; //logi
    public $t; //czas ostatniego refresha

    public function __construct()
    {
        $this->l = new Log();
        $this->l->log("Tworzę nową gre...", 'gameManager', 'info');
        $this->v = new Village($this);
        $this->t = time();
    }
    public function deltaTime() : int
    {
        return time() - $this->t;
    }
    public function sync()
    {
        $this->v->gain($this->deltaTime());

        //na koniec
        $this->t = time();
    }
}
?>