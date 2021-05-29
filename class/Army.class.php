<?php
class Army {
    public $location; //referencja do wioski
    public $targetLocation; //cel armii - referencja do wioski
    public $targetETA; //czas dotarcia do celu (UNIX timestamp)

    public $spearmen;   //ilość jednostek
    public $archers;    
    public $cavalry;

    public function __construct($s, $a, $c, $l)
    {
        $this->spearmen = $s;
        $this->archers = $a;
        $this->cavalry = $c;
        $this->location = $l;
    }
}
?>