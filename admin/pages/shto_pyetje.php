        <div class="main">
            <div class="content">
                <div class="report">
                    
                    <form method="post" action="" class="forms" enctype="multipart/form-data">
                        <h2>Shto pyetje</h2>
                        <?php 
                            if(isset($_SESSION['shto']))
                            {
                                echo $_SESSION['shto'];
                                unset($_SESSION['shto']);
                            }
                            if(isset($_SESSION['pavlefshme']))
                            {
                                echo $_SESSION['pavlefshme'];
                                unset($_SESSION['pavlefshme']);
                            }
                            if(isset($_SESSION['upload']))
                            {
                                echo $_SESSION['upload'];
                                unset($_SESSION['upload']);
                            }
                        ?>
                        <span class="name">Pyetja</span> <br />
                        <textarea name="pyetje" required="true"></textarea> <br />
                        <script>
                            CKEDITOR.replace( 'pyetje' );
                        </script>
                        
                        <span class="name">Foto</span>
                        <input type="file" name="image" /><br />
                        
                        <span class="name">Alternativa e pare</span>
                        <input type="text" name="pergjigjja_pare" placeholder="Alternativa e pare" required="true" /><br />
                        
                        <span class="name">Alternativa e dyte</span>
                        <input type="text" name="pergjigjja_dyte" placeholder="Alternativa e dyte" required="true" /><br />
                        
                        <span class="name">Alternativa e trete</span>
                        <input type="text" name="pergjigjja_trete" placeholder="Alternativa e trete" required="true" /><br />
                        
                        <span class="name">Alternativa e katert</span>
                        <input type="text" name="pergjigjja_katert" placeholder="Alternativa e katert" required="true" /><br />
                        
                         <span class="name">Alternativa e peste</span>
                        <input type="text" name="pergjigjja_peste" placeholder="Alternativa e peste" required="true" /><br />
                       
                        
                        <span class="name">Pergjigjia e sakte</span>
                        <select name="pergjigjja">
                            <option value="1">Alternativa e pare</option>
                            <option value="2">Alternativa e dyte</option>
                            <option value="3">Alternativa e trete</option>
                            <option value="4">Alternativa e katert</option>
                            <option value="5">Alternativa e peste</option>
                        </select>
                        <br />
                        
                        <span class="name">Shpjegimi</span><br />
                        <textarea name="shpjegimi" ></textarea>
                        <script>
                            CKEDITOR.replace( 'shpjegimi' );
                        </script>
                        <br />
                        
                        <span class="name">Piket</span>
                        <input type="text" name="pike" placeholder="Piket per kete pyetje" />
                        <br />
                        
                        <span class="name">Kategoria</span>
                        <select name="kategoria">
                            <option value="tepergjithshme">Te pergjithshme</option>
                            <option value="matematike">Matematike</option>
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
                                        <option value="<?php echo $id_fakultet; ?>"><?php echo $emri_fakultetit; ?></option>
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
                        <input type="radio" name="eshte_aktive" value="po" /> Po
                        <input type="radio" name="eshte_aktive" value="jo" /> Jo
                        <br />
                        
                        <input type="submit" name="submit" value="Shto pyetje" class="btn-add" style="margin-left: 15%;" />
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=pyetjet"><button type="button" class="btn-delete">Kthehu</button></a>
                    </form>
                    
                    <?php 
                        if(isset($_POST['submit']))
                        {
                        
                            if($_FILES['image']['name']!="")
                            {
                                $ext=end(explode('.',$_FILES['image']['name']));
                               
                                $valid_file=$obj->kontrolloTipinImazhit($ext);
                                if($valid_file==false)
                                {
                                    $_SESSION['pavlefshme']="<div class='error'>Tipi i imazhit nuk eshte i duhuri. Ju lutem perdorni te tipit JPG ose PNG ose GIF .</div>";
                                    header('location:'.SITEURL.'admin/index.php?page=shto_pyetje');
                                    die();
                                }
                                $new_name='Enri Rane'.$obj->uniqid();
                                $emer_imazhi=$new_name.'.'.$ext;
                                $source=$_FILES['image']['tmp_name'];
                                $destination="../images/pyetjet/".$emer_imazhi;
                                $upload=$obj->upload_file($source,$destination);
                                if($upload==false)
                                {
                                    $_SESSION['upload']="<div class='error'>Upload-imi i fotos deshtoi. Provo perseri!.</div>";
                                    header('location:'.SITEURL.'admin/index.php?page=shto_pyetje');
                                    die();
                                }
                            }
                            else
                            {
                                $emer_imazhi="";
                            }
                         
                            $pyetje=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pyetje']);
                            $pergjigjja_pare=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pergjigjja_pare']);
                            $pergjigjja_dyte=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pergjigjja_dyte']);
                            $pergjigjja_trete=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pergjigjja_trete']);
                            $pergjigjja_katert=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pergjigjja_katert']);
                            $pergjigjja_peste=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pergjigjja_peste']);
                           
                            $fakultet=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['fakultet']);
                            if(isset($_POST['eshte_aktive']))
                            {
                                $eshte_aktive=$_POST['eshte_aktive'];
                            }
                            else
                            {
                                $eshte_aktive='po';
                            }
                            $pergjigjja=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pergjigjja']);
                            $shpjegimi=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['shpjegimi']);
                            $pike=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pike']);
                            $kategoria=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['kategoria']);
                            $data_krijimit=date('Y-m-d');
                            
                            $tbl_name='tbl_pyetje';
                            $data="pyetje='$pyetje',
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
                                    data_krijimit='$data_krijimit',
                                    data_perditesimit='',
                                    emer_imazhi='$emer_imazhi'
                                    ";
                            $query=$obj->insertoTeDhena($tbl_name,$data);
                            $res=$obj->ekzekutoQuery($conn,$query);
                            if($res===true)
                            {
                                $_SESSION['shto']="<div class='success'>Pyetja u shtua me sukses.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=pyetjet');
                            }
                            else
                            {
                                $_SESSION['shto']="<div class='error'>Shtimi i pyetjes deshtoi. Ju lutem provoni perseri.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=shto_pyetje');
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
