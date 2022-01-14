        <div class="main">
            <div class="login">
                <form method="post" action="">
                    <h2>Log In</h2>
                    <?php 
                        if(isset($_SESSION['pavlefshme']))
                        {
                            echo $_SESSION['pavlefshme'];
                            unset($_SESSION['pavlefshme']);
                        }
                    ?>
                    <input type="text" name="username" placeholder="Username" required="true" />
                    <input type="password" name="password" placeholder="Password" required="true" />
                    <input type="submit" name="submit" value="Log In" class="btn-go"/>
                    <input type="reset" name="reset" value="Reset" class="btn-exit" />
                </form>
                <?php 
                    if(isset($_POST['submit']))
                    {
                    
                        $username=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['username']);
                        $password=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['password']);
                       
                        $tbl_name="tbl_student";
                        $where="username='$username' && password='$password' && eshte_aktive='po'";
                        $query=$obj->selektoTeDhenat($tbl_name,$where);
                        $res=$obj->ekzekutoQuery($conn,$query);
                        $count_rows=$obj->numriRreshtave($res);
                        if($count_rows>0)
                        {
                            $_SESSION['student']=$username;
                            $_SESSION['login']="<div class='success'>Logimi pati sukses.</div>";
                            header('location:'.SITEURL.'index.php?page=miresevini');
                        }
                        else
                        {
                            $_SESSION['pavlefshme']="<div class='error'>Username or Passwordi eshte i gabuar.</div>";
                            header('location:'.SITEURL.'index.php?page=login');
                        }
                    }
                ?>
            </div>
        </div>
     