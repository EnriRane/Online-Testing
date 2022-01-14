
<?php 
    if(isset($_GET['id_student']))
    {
        $id_student=$_GET['id_student'];
        $tbl_name='tbl_student';
        $where="id_student=$id_student";
        $query=$obj->selektoTeDhenat($tbl_name,$where);
        $res=$obj->ekzekutoQuery($conn,$query);
        $count_rows=$obj->numriRreshtave($res);
        if($count_rows==1)
        {
            $row=$obj->fetch_data($res);
            $emer=$row['emer'];
            $mbiemer=$row['mbiemer'];
            $email=$row['email'];
            $username=$row['username'];
            $password=$row['password'];
            $kontakt=$row['kontakt'];
            $gjinia=$row['gjinia'];
            $fakultet=$row['fakultet'];
            $eshte_aktive=$row['eshte_aktive'];
        }
        else
        {
            header('location:'.SITEURL.'admin/index.php?page=studentet');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/index.php?page=studentet');
    }
?>
        <div class="main">
            <div class="content">
                <div class="report">
                    
                    <form method="post" action="" class="forms">
                        <h2>Perditeso student</h2>
                        <?php 
                            if(isset($_SESSION['validimi']))
                            {
                                echo $_SESSION['validimi'];
                                unset($_SESSION['validimi']);
                            }
                            if(isset($_SESSION['perditesimi']))
                            {
                                echo $_SESSION['perditesimi'];
                                unset($_SESSION['perditesimi']);
                            }
                        ?>
                        <span class="name">Emri</span> 
                        <input type="text" name="emer" value="<?php echo $emer; ?>" required="true" /> <br />
                        
                        <span class="name">Mbiemri</span>
                        <input type="text" name="mbiemer" value="<?php echo $mbiemer; ?>" required="true" /><br />
                        
                        <span class="name">Emaili</span>
                        <input type="email" name="email" value="<?php echo $email; ?>" required="true" /><br />
                        
                        <span class="name">Username</span>
                        <input type="text" name="username" value="<?php echo $username; ?>" required="true" /><br />
                        
                        <span class="name">Passwordi</span>
                        <input type="text" name="password" value="<?php echo $password; ?>" required="true" /><br />
                        
                        <span class="name">Kontakti</span>
                        <input type="tel" name="kontakt" value="<?php echo $kontakt; ?>" /><br />
                        
                        <span class="name">Gjina</span>
                        <input <?php if($gjinia=='mashkull'){echo "checked='checked'";} ?> type="radio" name="gjinia" value="mashkull" /> Mashkull 
                        <input <?php if($gjinia=='femer'){echo "checked='checked'";} ?> type="radio" name="gjinia" value="femer" /> Femer 
                        <input <?php if($gjinia=='tjeter'){echo "checked='checked'";} ?> type="radio" name="gjinia" value="tjeter" /> Tjeter
                        <br />
                        
                        <span class="name">Fakulteti</span>
                        <select name="fakultet">
                            <?php 
                              
                                $tbl_name="tbl_fakultet";
                                $query=$obj->selektoTeDhenat($tbl_name);
                                $res=$obj->ekzekutoQuery($conn,$query);
                                $count_rows=$obj->numriRreshtave($res);
                                if($count_rows>0)
                                {
                                    while($row=$obj->fetch_data($res))
                                    {
                                        $id_fakultet=$row['id_fakultet'];
                                        $emri_fakultetit=$row['emri_fakultetit'];
                                        ?>
                                        <option <?php if($fakultet==$id_fakultet){echo"selected='selected'";} ?> value="<?php echo $id_fakultet; ?>"><?php echo $emri_fakultetit; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">Pa kategori</option>
                                    <?php
                                }
                            ?>
                        </select>
                        <br />
                        
                        <span class="name">Aktiviteti</span>
                        <input <?php if($eshte_aktive=='po'){echo "checked='checked'";} ?> type="radio" name="eshte_aktive" value="po" />Po
                        <input <?php if($eshte_aktive=='jo'){echo "checked='checked'";} ?> type="radio" name="eshte_aktive" value="jo" /> Jo
                        <br />
                        
                        <input type="submit" name="submit" value="Perditeso student" class="btn-update" style="margin-left: 15%;" />
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=studentet"><button type="button" class="btn-delete">Kthehu</button></a>
                    </form>
                    
                    <?php 
                        if(isset($_POST['submit']))
                        {
                         
                            $emer=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['emer']);
                            $mbiemer=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['mbiemer']);
                            $email=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['email']);
                            $username=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['username']);
                            $password=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['password']);
                            $kontakt=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['kontakt']);
                            if(isset($_POST['gjinia']))
                            {
                                $gjinia=$_POST['gjinia'];
                            }
                            $fakultet=$_POST['fakultet'];
                            if(isset($_POST['eshte_aktive']))
                            {
                                $eshte_aktive=$_POST['eshte_aktive'];
                            }
                            $data_perditesimit=date('Y-m-d');
                            
                          
                            if(($emer||$mbiemer||$email||$username||$password)==null)
                            {
                             
                                $_SESSION['validimi']="<div class='error'>Emri ose mbiemri ose Emaili ose Username ose Passwordi jane bosh.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=perditeso_student&id_student='.$id_student);
                            }
                          
                            $tbl_name='tbl_student';
                          
                            $data="emer='$emer',
                                    mbiemer='$mbiemer',
                                    email='$email',
                                    username='$username',
                                    password='$password',
                                    kontakt='$kontakt',
                                    gjinia='$gjinia',
                                    fakultet='$fakultet',
                                    eshte_aktive='$eshte_aktive',
                                    data_perditesimit='$data_perditesimit'
                                    ";
                            $where="id_student=$id_student";
                            $query=$obj->perditesoTeDhena($tbl_name,$data,$where);
                            $res=$obj->ekzekutoQuery($conn,$query);
                            if($res===true)
                            {
                                $_SESSION['perditesimi']="<div class='success'>Studenti u perditesua me sukses.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=studentet');
                            }
                            else
                            {
                                $_SESSION['perditesimi']="<div class='error'>Perditesimi i studentit deshtoi.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=perditeso_student&id_student='.$id_student);
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
