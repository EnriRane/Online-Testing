<?php 
    if(isset($_SESSION['koha_perfundimtare']))
    {
        
        $current_time=date('h:i:s A');
        $start=strtotime($current_time);
        $end=strtotime($_SESSION['koha_perfundimtare']);
        if($start>$end)
        {
            $_SESSION['koha_komplet']="<div class='error'>Provimi sapo mbaroi!!!.</div>";
            header('location:'.SITEURL.'index.php?page=mbaroSessionin');
           die();
        }
    }
?>