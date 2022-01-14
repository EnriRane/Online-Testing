<?php 
    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
    }
    else
    {
        $page='miresevini';
    }
    
    switch($page)
    {
        case "miresevini":
        {
            include('miresevini.php');
        }
        break;
        
        case "pyetja":
        {
            include('pyetja.php');
        }
        break;
        
        case "login":
        {
            include('login.php');
        }
        break;
        
        case "mbaroSessionin":
        {
            include('mbaroSessionin.php');
        }
        break;
        
        case "detaje_rezultati":
        {
            include('detaje_rezultati.php');
        }
        break;
        
        case "logout":
        {
            
            $tbl_name="tbl_student";
            $username=$_SESSION['student'];
            $id_student=$obj->merrUserID($tbl_name,$username,$conn);
            $res=true;
            if($res==true)
            {
               
                $tbl_name3="tbl_student";
                $data3="eshte_aktive='jo'";
                $where3="id_student='$id_student'";
                $query3=$obj->perditesoTeDhena($tbl_name3,$data3,$where3);
                $res3=$obj->ekzekutoQuery($conn,$query3);
                if($res3===true)
                {
                    session_destroy();
                    header('location:'.SITEURL.'index.php?page=login');
                }
                else
                {
                    echo "Error";
                }
                
            }
            else
            {
                echo "Error";
            }
            
        }
        break;
        
        default:
        {
            include('miresevini.php');
        }
        break;
    }
?>