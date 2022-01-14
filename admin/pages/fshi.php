<?php
    include('../config/apply.php'); 
    if((isset($_GET['id']))&&(isset($_GET['page'])))
    {
      
        $id=$_GET['id'];
        $page=$_GET['page'];
        
        switch($page)
        {
            case "studentet":
            {
                $tbl_name="tbl_student";
                $title="Student";
                $where="id_student=$id";
            }
            break;
            
            case "fakultetet":
            {
                $tbl_name="tbl_fakultet";
                $title="Fakultet";
                $where="id_fakultet=$id";
            }
            break;
            
            case "pyetjet":
            {
                $tbl_name="tbl_pyetje";
                $title="Pyetje";
                $where="id_pyetje=$id";
            }
            break;
        }
   
        $query=$obj->fshiTeDhena($tbl_name,$where);
        $res=$obj->ekzekutoQuery($conn,$query);
        if($res==true)
        {
            $_SESSION['fshi']="<div class='success'> U fshi me sukses.</div>";
            header('location:'.SITEURL.'admin/index.php?page='.$page);
        }
        else
        {
            $_SESSION['fshi']="<div class='error'>".$title." deshtoi te fshihej.</div>";
            header('location:'.SITEURL.'admin/index.php?page='.$page);
        }
    }
    else
    {
        $_SESSION['deshtimi']="<div class='error'>Pati nje deshtim ne fshirje. Ju lutem provoni perseri!.</div>";
        header('location:'.SITEURL.'admin/');
    }
?>