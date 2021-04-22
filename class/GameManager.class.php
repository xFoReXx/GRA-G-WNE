<?php 
require_once('Village.class.php');
class GameManager
{
    public $v; //wioska
    public $l; //logi

    public function __construct()
    {
        $this->v = new Village();
    }
}
?>