<?php 
    if(isset($_SESSION['user']))
    {
        $username=$_SESSION['user'];
        $tbl_name="tbl_app";
        $where="username='$username'";
        $query=$obj->selektoTeDhenat($tbl_name,$where);
        $res=$obj->ekzekutoQuery($conn,$query);
        $count_rows=$obj->numriRreshtave($res);
        if($count_rows==1)
        {
            $row=$obj->fetch_data($res);
            $app_id=$row['id_app'];
            $app_name=$row['emri_app'];
            $email=$row['email'];
            $username=$row['username'];
            $password=$row['password'];
            $kontakt=$row['kontakt'];
            $emer_imazhi=$row['emer_imazhi'];
        }
        else
        {
            header('location:'.SITEURL.'admin/login.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/index.php?page=logout');
    }
?>
        <div class="main">
            <div class="content">
                <div class="report">
                  
                        <?php 
                            if(isset($_SESSION['perditesimi']))
                            {
                                echo $_SESSION['perditesimi'];
                                unset($_SESSION['perditesimi']);
                            }
                            if(isset($_SESSION['pavlefshme']))
                            {
                                echo $_SESSION['pavlefshme'];
                                unset($_SESSION['pavlefshme']);
                            }
                            if(isset($_SESSION['password']))
                            {
                                echo $_SESSION['password'];
                                unset($_SESSION['password']);
                            }
                            if(isset($_SESSION['not_match']))
                            {
                                echo $_SESSION['not_match'];
                                unset($_SESSION['not_match']);
                            }
                        ?>
                       
                        
                   
                    <?php 
                        if(isset($_POST['submit']))
                        {
                           $app_name=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['emri_app']);
                           $email=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['email']);
                           $username=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['username']);
                           $kontakt=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['kontakt']);
                           $current_password=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['current_password']);
                           
                           if(($app_name=="")or($email=="")or($username=="")or($kontakt=="")or($current_password==""))
                           {
                                $_SESSION['validimi']="<div class='error'>Emri ose Emaili ose Username ose Kontakti ose Passwordi jane bosh.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=settings');
                           }
                           if($current_password==$password)
                           {
                                       
                                $tbl_name="tbl_app";
                            $data="
                                emri_app='$app_name',
                                email='$email',
                                username='$username',
                                kontakt='$kontakt'
                            ";
                            $where="id_app=$app_id";
                            $query=$obj->perditesoTeDhena($tbl_name,$data,$where);
                            $res=$obj->ekzekutoQuery($conn,$query);
                            if($res===true)
                            {
                                $_SESSION['perditesimi']="<div class='success'>Detajet u shtuan me sukses.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=settings');
                            }
                            else
                            {
                                $_SESSION['perditesimi']="<div class='error'>Detajet deshtuan te perditesohen.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=settings');
                            }
                           }
                           else{
                            $_SESSION['pavlefshme']="<div class='error'>Passwordi nuk perputhet.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=settings');
                           }
                        }
                    ?>
                </div>
                
                <div class="report">
                    
                    <form method="post" action="" class="forms">
                        <h2>Ndrysho passwordin</h2>
                        
                        <span class="name">Passwordi i tanishem</span>
                        <input type="password" name="current_password" placeholder="Passwordi i tanishem" required="true" /><br />
                        
                        <span class="name">Passwordi i ri</span>
                        <input type="password" name="new_password" placeholder="Passwordi i ri" required="true" /><br />
                        
                        <span class="name">Konfirmo Passwordin</span>
                        <input type="password" name="confirm_password" placeholder="Konfirmo Passwordin" required="true" /><br />
                        
                        
                        <input type="submit" name="update" value="Perditeso passwordin" class="btn-update" style="margin-left: 15%;" />
                        <a href="<?php echo SITEURL; ?>admin/index.php"><button type="button" class="btn-delete">Kthehu</button></a>
                    </form>
                    
                    <?php 
                        if(isset($_POST['update']))
                        {
                            $new_password=md5($obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['new_password']));
                            $confirm_password=md5($obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['confirm_password']));
                            $current_password=md5($obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['current_password']));
                            if($current_password==$password)
                            {
                                if($new_password==$confirm_password)
                                {
                                    $tbl_name='tbl_app';
                                    $data="password='$new_password'";
                                    $where="id_app='$app_id'";
                                    $query=$obj->perditesoTeDhena($tbl_name,$data,$where);
                                    $res=$obj->ekzekutoQuery($conn,$query);
                                    if($res==true)
                                    {
                                        $_SESSION['password']="<div class='success'>Passwordi i ndryshua me sukses.</div>";
                                        header('location:'.SITEURL.'admin/index.php?page=settings');
                                    }
                                    else
                                    {
                                        $_SESSION['password']="<div class='error'>Ndryshimi i passwordit deshtoi. Provo perseri.</div>";
                                        header('location:'.SITEURL.'admin/index.php?page=settings');
                                    }
                                }
                                else
                                {
                                    $_SESSION['not_match']="<div class='error'>Passwordi i ri dhe ai i vjeter nuk perputhen.</div>";
                                    header('location:'.SITEURL.'admin/index.php?page=settings');
                                }
                            }
                            else
                            {
                                $_SESSION['not_match']="<div class='error'>Passwordi i tanishem nuk perputhet.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=settings');
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
