<?php 
    include('config/apply.php');
    include('../box/header.php');
?>

        <div class="main">
            <div class="login">
                <form method="post" action="">
                    <h2>Logohu si admin</h2>
                    <?php 
                        if(isset($_SESSION['validimi']))
                        {
                            echo $_SESSION['validimi'];
                            unset($_SESSION['vaidation']);
                        }
                        if(isset($_SESSION['deshtimi']))
                        {
                            echo $_SESSION['deshtimi'];
                            unset($_SESSION['deshtimi']);
                        }
                        if(isset($_SESSION['gabim']))
                        {
                            echo $_SESSION['gabim'];
                            unset($_SESSION['gabim']);
                        }
                    ?>
                    <input type="text" name="username" placeholder="Username" required="true" />
                    <input type="password" name="password" placeholder="Passwordi" required="true" />
                    <input type="submit" name="submit" value="Log In" class="btn-go" />
                    <input type="reset" name="reset" value="Reset" class="btn-exit" />
                </form>
                <?php 
                    if(isset($_POST['submit']))
                    {
                        $username=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['username']);
                        $password_db=md5($obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['password']));
                        
                        if(($username=="")or($password=""))
                        {
                        
                            $_SESSION['validimi']="<div class='error'>Username ose Passwordi eshte bosh</div>";
                            header('location:'.SITEURL.'admin/login.php');
                        }
                        $tbl_name="tbl_app";
                        $where="username='$username' AND password='$password_db'";
                        $query=$obj->selektoTeDhenat($tbl_name,$where);
                        $res=$obj->ekzekutoQuery($conn,$query);
                        $count_rows=$obj->numriRreshtave($res);
                        if($count_rows==1)
                        {
                            $_SESSION['user']=$username;
                            $_SESSION['success']="<div class='success'>Logimi pati sukses. Miresevini ".$username." ne menune kryesore.</div>";
                            header('location:'.SITEURL.'admin/index.php');
                        }
                        else
                        {
                            $_SESSION['deshtimi']="<div class='error'>Username ose Passwordi nuk jane te vlefshem. Provo perseri.</div>";
                            header('location:'.SITEURL.'admin/login.php');
                        }
                    }
                ?>
            </div>
        </div>
    

<?php
    include('../box/footer.php');
?>