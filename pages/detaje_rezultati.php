        <div class="main">
            <div class="content">
                <div class="report">
                    
                    <?php 
                        if(isset($_SESSION['USERID']))
                        {
                            $id_student=$_SESSION['USERID'];
                            $full_name=$obj->merrEmrinPlote('tbl_student',$id_student,$conn);
                            echo "<h2>".$full_name."</h2>";
                        }
                        else
                        {
                            header('location:'.SITEURL.'index.php?page=logout');
                        }
                        $data_krijimit=date('Y-m-d');
                        $tbl_name="tbl_rezultat";
                        $where="id_student='$id_student' && data_krijimit='$data_krijimit'";
                        $query=$obj->selektoTeDhenat($tbl_name,$where);
                        $res=$obj->ekzekutoQuery($conn,$query);
                        $nr=1;
                        while($row=$obj->fetch_data($res))
                        {
                            $id_student=$row['id_student'];
                            $id_pyetje=$row['id_pyetje'];
                            $pergjigjja_perdorues=$row['pergjigjja_perdorues'];
                            $pergjigjja_sakte=$row['pergjigjja_sakte'];
                            
                            $data_krijimit=$row['data_krijimit'];
                            $tbl_name2="tbl_pyetje";
                            $where2="id_pyetje='$id_pyetje'";
                            $query2=$obj->selektoTeDhenat($tbl_name2,$where2);
                            $res2=$obj->ekzekutoQuery($conn,$query2);
                            $row2=$obj->fetch_data($res2);
                            $pyetje=$row2['pyetje'];
                            $pergjigjja_pare=$row2['pergjigjja_pare'];
                            $pergjigjja_dyte=$row2['pergjigjja_dyte'];
                            $pergjigjja_trete=$row2['pergjigjja_trete'];
                            $pergjigjja_katert=$row2['pergjigjja_katert'];
                            $pergjigjja_peste=$row2['pergjigjja_peste'];
                            $shpjegimi=$row2['shpjegimi'];
                            ?>
                            <label style="font-weight: bold;"><?php echo $nr++.'. '.$pyetje; ?></label><br />
                            <?php 
                                switch($pergjigjja_perdorues)
                                {
                                    case 0:
                                    {
                                        $pergjigjaPerdoruesit="Asnje";
                                    }
                                    break;
                                    
                                    case 1:
                                    {
                                        $pergjigjaPerdoruesit=$pergjigjja_pare;
                                    }
                                    break;
                                    case 2:
                                    {
                                        $pergjigjaPerdoruesit=$pergjigjja_dyte;
                                    }
                                    break;
                                    case 3:
                                    {
                                        $pergjigjaPerdoruesit=$pergjigjja_trete;
                                    }
                                    break;
                                    case 4:
                                    {
                                        $pergjigjaPerdoruesit=$pergjigjja_katert;
                                    }
                                    break;
                                    case 5:
                                    {
                                        $pergjigjaPerdoruesit=$pergjigjja_peste;
                                    }
                                    break;
                                }
                               
                                switch($pergjigjja_sakte)
                                {
                                    case 0:
                                    {
                                        $pergjigjaSakte="Asnje";
                                    }
                                    break;
                                    
                                    case 1:
                                    {
                                        $pergjigjaSakte=$pergjigjja_pare;
                                    }
                                    break;
                                    case 2:
                                    {
                                        $pergjigjaSakte=$pergjigjja_dyte;
                                    }
                                    break;
                                    case 3:
                                    {
                                        $pergjigjaSakte=$pergjigjja_trete;
                                    }
                                    break;
                                    case 4:
                                    {
                                        $pergjigjaSakte=$pergjigjja_katert;
                                    }
                                    break;
                                    case 5:
                                    {
                                        $pergjigjaSakte=$pergjigjja_peste;
                                    }
                                    break;
                                }
                            ?>
                            <label>Pergjigja e perdoruesit: </label>
                            <?php 
                                if($pergjigjaPerdoruesit==$pergjigjaSakte)
                                {
                                    ?>
                                    <label style="color: green;"><?php echo $pergjigjaPerdoruesit; ?></label>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <label style="color: red;"><?php echo $pergjigjaPerdoruesit; ?></label>
                                    <?php
                                }
                            ?>
                            
                            <br />
                            <label>Pergjigja e sakte:</label><label style="color: green;"><?php echo $pergjigjaSakte; ?></label><br />
                            
                            
                                <?php 
                                    if($shpjegimi!="")
                                    {
                                        echo "<div class='success'>".$shpjegimi."</div>";
                                    }
                                ?>
                            <hr />
                            <?php
                        }
                    ?>
                        <a href="<?php echo SITEURL; ?>index.php?page=logout">
                            <button type="button" class="btn-exit">Kthehu</button>
                        </a>
                    
                    
                </div>
            </div>
        </div>
