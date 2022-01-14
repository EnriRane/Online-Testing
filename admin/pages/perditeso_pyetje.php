        <?php 
            if(isset($_GET['id']))
            {
                $id_pyetje=$_GET['id'];
                $tbl_name='tbl_pyetje';
                $where="id_pyetje=$id_pyetje";
                $query=$obj->selektoTeDhenat($tbl_name,$where);
                $res=$obj->ekzekutoQuery($conn,$query);
                $count_rows=$obj->numriRreshtave($res);
                if($count_rows==1)
                {
                    $row=$obj->fetch_data($res);
                   $pyetje=$row['pyetje'];
                   $pergjigjja_pare=$row['pergjigjja_pare'];
                   $pergjigjja_dyte=$row['pergjigjja_dyte'];
                   $pergjigjja_trete=$row['pergjigjja_trete'];
                   $pergjigjja_katert=$row['pergjigjja_katert'];
                   $pergjigjja_peste=$row['pergjigjja_peste'];
                   $pergjigjja=$row['pergjigjja'];
                   $shpjegimi=$row['shpjegimi'];
                   $pike=$row['pike'];
                   $kategoria=$row['kategoria'];
                   $fakultet_db=$row['fakultet'];
                   $eshte_aktive=$row['eshte_aktive'];
                   $previous_image=$row['emer_imazhi'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/index.php?page=pyetjet');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/index.php?page=pyetjet');
            }
        ?>
        <div class="main">
            <div class="content">
                <div class="report">
                    
                    <form method="post" action="" class="forms" enctype="multipart/form-data">
                        <h2>Perditeso fakultetin</h2>
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
                        <span class="name">Pyetja</span><br />
                        <textarea name="pyetje" required="true"><?php echo $pyetje; ?></textarea> <br />
                        <script>
                            CKEDITOR.replace( 'pyetje' );
                        </script>
                        
                        <?php 
                            if($previous_image!="")
                            {
                                ?>
                                <span class="name">Imazhi i meparshem</span>
                                <img src="<?php echo SITEURL; ?>images/pyetjet/<?php echo $previous_image; ?>" /> <br />
                                <?php
                            }
                        ?>
                        <input type="hidden" name="previous_image" value="<?php echo $previous_image; ?>" />
                        
                        <span class="name">Imazhi i ri</span>
                        <input type="file" name="image" /><br />
                        
                        <span class="name">Alternativa e pare</span>
                        <input type="text" name="pergjigjja_pare" value="<?php echo $pergjigjja_pare;; ?>" required="true" /><br />
                        
                        <span class="name">Alternativa e dyte</span>
                        <input type="text" name="pergjigjja_dyte" value="<?php echo $pergjigjja_dyte; ?>" required="true" /><br />
                        
                        <span class="name">Alternativa e trete</span>
                        <input type="text" name="pergjigjja_trete" value="<?php echo $pergjigjja_trete; ?>" required="true" /><br />
                        
                        <span class="name">Alternativa e katert</span>
                        <input type="text" name="pergjigjja_katert" value="<?php echo $pergjigjja_katert; ?>" required="true" /><br />
                        
                        <span class="name">Alternativa e peste</span>
                        <input type="text" name="pergjigjja_peste" value="<?php echo $pergjigjja_peste; ?>" required="true" /><br />
                        
                        
                        <span class="name">Pergjigja</span>
                        <select name="pergjigjja">
                            <option <?php if($pergjigjja==1){echo "selected='seleccted'";} ?> value="1">Alternativa e pare</option>
                            <option <?php if($pergjigjja==2){echo "selected='seleccted'";} ?> value="2">Alternativa e dyte</option>
                            <option <?php if($pergjigjja==3){echo "selected='seleccted'";} ?> value="3">Alternativa e trete</option>
                            <option <?php if($pergjigjja==4){echo "selected='seleccted'";} ?> value="4">Alternativa e katert</option>
                            <option <?php if($pergjigjja==5){echo "selected='seleccted'";} ?> value="5">Alternativa e peste</option>
                        </select>
                        <br />
                        
                        <span class="name">Shpjegimi</span><br />
                        <textarea name="shpjegimi" ><?php echo $shpjegimi; ?></textarea>
                        <script>
                            CKEDITOR.replace( 'shpjegimi' );
                        </script>
                        <br />
                        
                        <span class="name">Piket</span>
                        <input type="text" name="pike" value="<?php echo $pike; ?>" />
                        <br />
                        
                        <span class="name">Kategoria</span>
                        <select name="kategoria">
                            <option <?php if($kategoria=="tepergjithshme"){echo "selected='seleccted'";} ?> value="tepergjithshme">Te pergjithshme</option>
                            <option  <?php if($kategoria=="matematike"){echo "selected='seleccted'";} ?> value="matematike">Matematike</option>
                        </select>
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
                                        <option <?php if($fakultet_db==$id_fakultet){echo"selected='selected'";} ?> value="<?php echo $id_fakultet; ?>"><?php echo $emri_fakultetit; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">Pa ketegori</option>
                                    <?php
                                }
                            ?>
                        </select>
                        <br />
                        
                        <span class="name">Aktiviteti</span>
                        <input <?php if($eshte_aktive=='po'){echo "checked='checked'";} ?> type="radio" name="eshte_aktive" value="po" /> Po 
                        <input <?php if($eshte_aktive=='jo'){echo "checked='checked'";} ?> type="radio" name="eshte_aktive" value="jo" /> Jo
                        <br />
                        
                        <input type="submit" name="submit" value="Perditeso pyetje" class="btn-update" style="margin-left: 15%;" />
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=pyetjet"><button type="button" class="btn-delete">Kthehu</button></a>
                    </form>
                    <?php 
                        if(isset($_POST['submit']))
                        {
                            
                            $pyetje=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pyetje']);
                            $pergjigjja_pare=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pergjigjja_pare']);
                            $pergjigjja_dyte=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pergjigjja_dyte']);
                            $pergjigjja_trete=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pergjigjja_trete']);
                            $pergjigjja_katert=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pergjigjja_katert']);
                            $pergjigjja_peste=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pergjigjja_peste']);
                            $pergjigjja=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pergjigjja']);
                            $shpjegimi=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['shpjegimi']);
                            $pike=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pike']);
                            $kategoria=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['kategoria']);
                            $fakultet=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['fakultet']);
                            $previous_image=$_POST['previous_image'];
                            if(isset($_POST['eshte_aktive']))
                            {
                                $eshte_aktive=$_POST['eshte_aktive'];
                            }
                            else
                            {
                                $eshte_aktive="po";
                            }
                            $data_perditesimit=date('Y-m-d');
                          
                            if($_FILES['image']['name']!="")
                            {
                            
                                $ext=end(explode('.',$_FILES['image']['name']));
                            
                                $valid_file=$obj->kontrolloTipinImazhit($ext);
                                if($valid_file==false)
                                {
                                    $_SESSION['pavlefshme']="<div class='error'>Imazhi eshte i pavlefshem. Provo te tipit JPG ose PNG ose GIF.</div>";
                                    header('location:'.SITEURL.'admin/index.php?page=perditeso_pyetje&id='.$id_pyetje);
                                    die();
                                }
                             
                                if($previous_image!="")
                                {
                                    $path="../images/pyetjet/".$previous_image;
                                    $remove=$obj->remove_file($path);
                                    if($remove==false)
                                    {
                                        $_SESSION['remove_book']="Heqja e imazhit deshtoi. Provo perseri.";
                                        header('location:'.SITEURL.'admin/index.php?page=perditeso_pyetje&id='.$id_pyetje);
                                        die();
                                    }
                                }
                              
                                $new_name='Enri Rane'.$obj->uniqid();
                                $emer_imazhi=$new_name.'.'.$ext;
                               
                                $source=$_FILES['image']['tmp_name'];
                                $destination="../images/pyetjet/".$emer_imazhi;
                                $upload=$obj->upload_file($source,$destination);
                                if($upload==false)
                                {
                                    $_SESSION['upload']="<div class='error'>Upload-imi i imazhit deshtoi. Provo perseri.</div>";
                                    header('location:'.SITEURL.'admin/index.php?page=perditeso_pyetje&id='.$id_pyetje);
                                    die();
                                }
                            }
                            else
                            {
                                $emer_imazhi=$previous_image;
                            }
                            
                         
                            if(($pyetje==null)or($pergjigjja_pare==null)or($pergjigjja_dyte==null)or($pergjigjja_trete==null)or($pergjigjja_katert==null)or($pergjigjja_peste==null))
                            {
                                $_SESSION['validimi']="<div class='error'>Njera nga fushat e pyetjes ose pergjigjes eshte bosh.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=perditeso_pyetje&id='.$id_pyetje);
                            }
                            $tbl_name="tbl_pyetje";
                            $data="
                                    pyetje='$pyetje',
                                    pergjigjja_pare='$pergjigjja_pare',
                                    pergjigjja_dyte='$pergjigjja_dyte',
                                    pergjigjja_trete='$pergjigjja_trete',
                                    pergjigjja_katert='$pergjigjja_katert',
                                    pergjigjja_peste='$pergjigjja_peste',
                                    pergjigjja='$pergjigjja',
                                    shpjegimi='$shpjegimi',
                                    pike='$pike',
                                    kategoria='$kategoria',
                                    fakultet='$fakultet',
                                    eshte_aktive='$eshte_aktive',
                                    data_perditesimit='$data_perditesimit',
                                    emer_imazhi='$emer_imazhi'
                            ";
                            $where="id_pyetje='$id_pyetje'";
                            $query=$obj->perditesoTeDhena($tbl_name,$data,$where);
                            $res=$obj->ekzekutoQuery($conn,$query);
                            if($res===true)
                            {
                                $_SESSION['perditesimi']="<div class='success'>Pyetja u shtua me sukses.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=pyetjet');
                            }
                            else
                            {
                                $_SESSION['perditesimi']="<div class='error'>Perditesimi i pyetjes deshtoi.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=perditeso_pyetje&id='.$id_pyetje);
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
