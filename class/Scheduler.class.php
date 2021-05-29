<?php
class Scheduler
{
    public $schedule; // (timestamp, klasa, funkcja, parametr)
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
                        'param' => $p);
        array_push($this->schedule, $task);
        $this->log('dodano do schedulera nową pozycję', 'info');
    }

    public function check()
    {
        /*
        $todo = array();
        $this->log('kompletuje listę zaległych rzeczy do zrobienia od czasu '.date('d.m.Y H:m:s',$timestamp), 'info');
        foreach($this->schedule as &$task) 
        {
            if($task['timestamp'] >= $timestamp && $task['timestamp'] <= time())
            {
                array_push($todo, $task);
                unset($task);
            }
        }
        $this->execute($todo);
        */
        foreach($this->schedule as $key => $task) {
            if($task['timestamp'] <= time()) //jeżeli zadanie ma czas wykonania z przeszłości - miało już się zdarzyć
                if($this->execute($task)){ //spróbuj wykonać zadanie, jesli się uda wykonaj zawartość ifa
                    unset($this->schedule[$key]);
                    $this->schedule = array_values($this->schedule);
                }
                else {
                    $this->log("Nie udało sie wykonać zadania z timestamp: ".$task['timestamp'], "error");
                }
        }
    }

    public function execute($task)
    {
        /*
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
                $this->log("wywołuje funkcję $functionName dla klasy $className z parametrem $param", 'info');
                $this->gm->v->gain($task['timestamp'] - $this->gm->t);
                $this->log("synchronizuje surowce w wiosce",'info');
                $this->gm->t = $task['timestamp'];
                $this->log("synchronizuje czas gry do czasu ukonczneia zadania", 'info');
            }
        }
        */
        if($task['class'] == 'Village') 
            {
                //przetwarzanie zadań dla wioski
                $className = $task['class'];
                $functionName = $task['function'];
                $param = $task['param'];

                $this->log("synchronizuje surowce w wiosce do stanu na czas ".date('d.m.Y H:i:s',$task['timestamp']),'info');
                $this->gm->v->gain($task['timestamp'] - $this->gm->t); //różnica między ostatnim refreshem a czasem zdarzenia (postawieniem budynku)

                $this->log("wywołuje funkcję $functionName dla klasy $className z parametrem $param", 'info');
                $this->gm->v->{$functionName}($param);



                $this->log("synchronizuje czas gry do czasu ukonczneia zadania", 'info');
                $this->gm->t = $task['timestamp'];

            }
        return true;
    }
    public function getTasksByFunction($function) : array
    {
        $tasks = array();
        foreach ($this->schedule as $key => $task)
        {
            if($task['function'] == $function)
                array_push($tasks, $task); //skopij znalezione zadanie do tabeli tasks
        }
        return $tasks;
    }
    public function log(string $message, string $type)
    {
        $this->gm->l->log($message, 'scheduler', $type);
    }
}
?>