<?php

class room {

    function __construct(){
        $this-> lock(); 
    }

    public function move(){
        echo "You Are Moving  "."<br>";
    }
    public function on(){
        echo "Switched ON "."<br>";
        
    }
    public function off(){
        echo "Switched Off "."<br>";
    }
    private function close(){
        echo "You closed"."<br>";
    }
    private function open(){
        echo "You open "."<br>";
    }
    protected function lock(){
        echo "You trying to lock "."<br>";
    }
    
}

class tv extends room {

   function Change(){
    echo "Channel Changed";
    $this->lock();
   } 
}

class washroom extends room {
   function wash(){
    echo "washing "."<br>";
   } 
}


$room = new room();
 


$reflectionMethod = new ReflectionMethod('room', 'lock');
$reflectionMethod->setAccessible(true);

$reflectionMethod->invoke(new room);

$washroom = new washroom();
$washroom->wash();
$washroom->close();
$washroom->lock();

$washroom->wash();
$room->close();
$room->lock();

$tv = new tv();
$tv->on();
$tv->off();
$tv->Change();


?>