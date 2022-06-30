<?php

    try{
        $server = 'localhost:3306';
        $db = 'immobilien';
        $user = 'root';
        $pwd = '';
    
        $con = new PDO('mysql:host='.$server.';dbname='.$db.';charset=utf8', $user, $pwd);
    
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        echo $e->getCode().': '.$e->getMessage().'<br>';
    }

function makeStatement($query, $array = null){
        
    try {
        
        global $con;
        $stmt = $con->prepare($query);

        
        $stmt->execute($array);
        return $stmt;
    } catch (Exception $e) {
        echo "Ein fehler ist aufgetreten:".$e;
    }

    
}
