<?php 
    if(!isset($_SESSION['user']))
    {
        $_SESSION['gabim']="<div class='error'>Ju lutem logohuni per te patur akses</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>

        <nav class="menu">
            <div class="wrapper" style="width:100%;">
                
                <ul>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=home"><li>Menuja kryesore</li></a>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=studentet"><li>Studentet</li></a>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=fakultetet"><li>Fakultetet</li></a>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=pyetjet"><li>Pyetjet</li></a>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=rezultatet"><li>Rezultatet</li></a>

                    <?php
                   $tbl_names="tbl_student";
                   $query=$obj->selektoTeDhenat($tbl_names);
                   $res=$obj->ekzekutoQuery($conn,$query);
                   $count_rows=$obj->numriRreshtave($res);
                   if($count_rows>0){
                       $email=" ";
                    while($row=$obj->fetch_data($res))
                    {
                        $email.=$row['email'].",";
                    }
                }
                    ?>
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=<?php echo $email ?>" target="_blank"><li>Dergo detyre</li></a>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=settings"><li>Settings</li></a>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=logout"onclick="return confirm('Je i sigurt qe do ta dalesh?')"><li >Dil</li></a>
                </ul>
            </div>
        </nav>
     