<?php 
require_once('Village.class.php');
class GameManager
{
    public $v; //wioska
    public $l; //logi
    public $t; //czas ostatniego refresha

    public function __construct()
    {
        $this->v = new Village();
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