
        <div class="main">
            <div class="content">
                <div class="report">
                    
                    <form method="post" action="" class="forms">
                        <h2>Shto student</h2>
                        <?php 
                            if(isset($_SESSION['validimi']))
                            {
                                echo $_SESSION['validimi'];
                                unset($_SESSION['validimi']);
                            }
                            if(isset($_SESSION['shto']))
                            {
                                echo $_SESSION['shto'];
                                unset($_SESSION['shto']);
                            }
                        ?>
                        <span class="name">Emri</span> 
                        <input type="text" name="emer" placeholder="Emri" required="true" /> <br />
                        
                        <span class="name">Mbiemri</span>
                        <input type="text" name="mbiemer" placeholder="Mbiemri" required="true" /><br />
                        
                        <span class="name">Emaili</span>
                        <input type="email" name="email" placeholder="Emaili" required="true" /><br />
                        
                        <span class="name">Username</span>
                        <input type="text" name="username" placeholder="Username" required="true" /><br />
                        
                        <span class="name">Password</span>
                        <input type="text" name="password" placeholder="Password" required="true" /><br />
                        
                        <span class="name">Kontakt</span>
                        <input type="tel" name="kontakt" placeholder="Nr. kontakti" /><br />
                        
                        <span class="name">Gjinia</span>
                        <input type="radio" name="gjinia" value="mashkull" /> Mashkull
                        <input type="radio" name="gjinia" value="femer" /> Femer 
                        <input type="radio" name="gjinia" value="tjeter" /> Tjeter
                        <br />
                        
                        <span class="name">Fakulteti</span>
                        <select name="fakultet">
                            <?php 
                               
                                $tbl_name="tbl_fakultet";
                                $where="eshte_aktive='po'";
                                $query=$obj->selektoTeDhenat($tbl_name,$where);
                                $res=$obj->ekzekutoQuery($conn,$query);
                                $count_rows=$obj->numriRreshtave($res);
                                if($count_rows>0)
                                {
                                    while($row=$obj->fetch_data($res))
                                    {
                                        $id_fakultet=$row['id_fakultet'];
                                        $emri_fakultetit=$row['emri_fakultetit'];
                                        ?>
                                        <option value="<?php echo $id_fakultet; ?>"><?php echo $emri_fakultetit; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo("<option value='none'>Asnje</option>");
                                }
                            ?>
                        </select>
                        <br />
                        
                        <span class="name">Aktiviteti?</span>
                        <input type="radio" name="eshte_aktive" value="po" /> Po
                        <input type="radio" name="eshte_aktive" value="jo" /> Jo
                        <br />
                        
                        <input type="submit" name="submit" value="Shto student" class="btn-add" style="margin-left: 15%;" />
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
                                $gjinia=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['gjinia']);
                            }
                            else
                            {
                                $gjinia='mashkull';
                            }
                            
                            $fakultet=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['fakultet']);
                            if(isset($_POST['eshte_aktive']))
                            {
                                $eshte_aktive=$_POST['eshte_aktive'];
                            }
                            else
                            {
                                $eshte_aktive='po';
                            }
                            $data_krijimit=date('Y-m-d');
                            
                         
                            if(($emer||$mbiemer||$email||$username||$password)==null)
                            {
                            
                                $_SESSION['validimi']="<div class='error'>Emri ose Mbiemri, ose Emaili ose Username ose Password jane bosh.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=shto_student');
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
                                    data_krijimit='$data_krijimit',
                                    data_perditesimit=''";
                            $query=$obj->insertoTeDhena($tbl_name,$data);
                            $res=$obj->ekzekutoQuery($conn,$query);
                            if($res===true)
                            {
                                $_SESSION['shto']="<div class='success'>Studenti i ri u shtua me sukses.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=studentet');
                            }
                            else
                            {
                                $_SESSION['shto']="<div class='error'>Shtimi i studentit deshtoi. Provo perseri.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=shto_student');
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    