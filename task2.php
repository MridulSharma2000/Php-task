<?php

function check($arr1){
    $len = count($arr1);
    if($len <= 0){
        return 0;
    }
    else{
        foreach($arr1 as $key => $value){
        
            if(is_array($value)){
            
             check($value); 
            } 
            else{
           
             echo $value.' , ';
            }
        }
    }
} 





$arr1 =  array(
    "birds" => array(
        "Eagle",
        "Parrot",
        "Swan"
    ),
    "mammals" => array(
        "Human",
        "cat" => array(
            "Lion",
            "Tiger",
            "Jaguar"
        ),
        "Elephant",
        "Monkey"
    ),
    "reptiles" => array(
        "snake" => array(
            "Cobra" => array(
                "King Cobra",
                "Egyptian cobra"
            ),
            "Viper",
            "Anaconda"
        ),
        "Crocodile",
        "Dinosaur" => array(
            "T-rex",
            "Alamosaurus"
        )
    )
);

echo check($arr1);

?>