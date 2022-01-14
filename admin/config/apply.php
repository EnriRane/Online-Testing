<?php 
    
    session_start();
    include('functions.php');
  
    date_default_timezone_set('Europe/Tirane');
    $obj=new Functions();
 
    $conn=$obj->lidhuMeDatabazen();
    $selektoDatabazen=$obj->selektoDatabazen($conn);
?>