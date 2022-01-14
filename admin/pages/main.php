<?php 
    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
    }
    else
    {
        $page='home';
    }
    
    switch($page)
    {
        case "home":
        {
            include('dashboard.php');
        }
        break;
  
        case "studentet":
        {
            include('studentet.php');
        }
        break;
        
        case "shto_student":
        {
            include('shto_student.php');
        }
        break;
        
        case "perditeso_student":
        {
            include('perditeso_student.php');
        }
        break;
        
        case "fakultetet":
        {
            include('fakultetet.php');
        }
        break;
        
        case "shto_fakultet":
        {
            include('shto_fakultet.php');
        }
        break;
        
        case "perditeso_fakultet":
        {
            include('perditeso_fakultet.php');
        }
        break;
        
        case "pyetjet":
        {
            include('pyetjet.php');
        }
        break;
        
        case "shto_pyetje":
        {
            include('shto_pyetje.php');
        }
        break;
        
        case "perditeso_pyetje":
        {
            include('perditeso_pyetje.php');
        }
        break;
        
        case "rezultatet":
        {
            include('rezultatet.php');
        }
        break;
        
        case "shiko_rezultat":
        {
            include('shiko_rezultat.php');
        }
        break;
        
        case "settings":
        {
            include('settings.php');
        }
        break;
        
        case "logout":
        {
            if(isset($_SESSION['user']))
            {
                unset($_SESSION['user']);
            header('location:'.SITEURL.'admin/login.php');
            }
            
        }
        break;
        
        default:
        {
            include('dashboard.php');
        }
    }
?>