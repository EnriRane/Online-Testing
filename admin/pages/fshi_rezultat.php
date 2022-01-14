<?php 
    include('../config/apply.php');
    
    
    if((isset($_GET['id_permbledhje']))&&(isset($_GET['id_student']))&&(isset($_GET['data_krijimit'])))
    {
       
        $id_permbledhje=$_GET['id_permbledhje'];
        $id_student=$_GET['id_student'];
        $data_krijimit=$_GET['data_krijimit'];
        
       
        $tbl_name="tbl_rezultat_permbledhje";
        $where="id_permbledhje='$id_permbledhje'";
        $query=$obj->fshiTeDhena($tbl_name,$where);
        $res=$obj->ekzekutoQuery($conn,$query);
        if($res==true)
        {
         
            $tbl_name2="tbl_rezultat";
            $where2="id_student='$id_student' && data_krijimit='$data_krijimit'";
            $query2=$obj->fshiTeDhena($tbl_name2,$where2);
            $res2=$obj->ekzekutoQuery($conn,$query2);
            if($res2==true)
            {
                $_SESSION['fshi']="<span class='success'>Rezultati i fshi me sukses.</span>";
                header('location:'.SITEURL.'admin/index.php?page=rezultatet');
            }
            else
            {
                $_SESSION['fshi']="<span class='error'>Fshirja e rezultait deshtoi. Provo perseri!</span>";
                header('location:'.SITEURL.'admin/index.php?page=rezultatet');
            }
        }
        
        
    }
    else
    {
        header('location:'.SITEURL.'admin/index.php?page=rezultatet');
    }
?>