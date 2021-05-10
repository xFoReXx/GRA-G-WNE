<?php
class Scheduler
{
    private $schedule; // (timestamp, klasa, funkcja, paramter)
    private $gm;

    public function __construct($gameManager) {
        $this->schedule = array();
        $this->gm = $gameManager;
        $this->log('utworzono schedulera', 'info');
    }

    public function add($t, $c, $f, $p)
    {
        $task = array('timestamp' => $t,
                        'class' => $c,
                        'function' => $f,
                        'param' =>  $p);
        array_push($this->schedule, $task);
        $this->log('dodano do schedulera nową pozycję', 'info');
    }

    public function check($timestamp)
    {
        $todo = array();
        $this->log('kompletuje listę zaległych rzeczy do zrbienia', 'info');
        foreach($this->schedule as $task)
        {
            if($task['timestamp'] >= $timestamp && $timestamp <= time())
            {
                array_push($todo, $task);
            }
        }
        $this->execute($todo);
    }

    public function execute($taskList)
    {
        if(count($taskList) > 0)
            $this->log('wykonuje listę zadań', 'info');
        foreach($taskList as $task)
        {
            if($task['class'] == 'Village')
            {
                //przetwarzanie zadań dla wioski
                $className = $task['class'];
                $functionName = $task['function'];
                $param = $task['param'];
                $this->gm->v->{$functionName}($param);
                $this->log("wywyołuje funkcję $functionName dla klasy $className z parametrem $param", 'info');
                $this->gm->v->gain($task['timestamp'] - $this->gm->t);
                $this->log("synchronizzuje surowce w wiosce", 'info');
                $this->gm->t = $task['timestamp'];
                $this->log("synchronizuje czas gry do czasu ukończenia zadania", 'info');
            }
        }
    }
    public function log(string $message, string $type)
    {
        $this->gm->l->log($message, 'scheduler', $type);
    }
}
?>