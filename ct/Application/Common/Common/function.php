<?php

function salt(){
    $salt = '';
    for ($i=0; $i < 8; $i++) {
        $salt .= rand('0','9');
    }
    return $salt;
}


 ?>
