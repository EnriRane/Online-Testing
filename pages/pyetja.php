<?php 
    include('kontrollo.php');
    include('pages/kontrolloKohen.php');
    $tbl_name4="tbl_student";
    $username=$_SESSION['student'];
    $where4="username='$username'";
    $query4=$obj->selektoTeDhenat($tbl_name4,$where4);
    $res4=$obj->ekzekutoQuery($conn,$query4);
    if($res4==true)
    {
        $row4=$obj->fetch_data($res4);
        $id_student=$row4['id_student'];
        $emer=$row4['emer'];
        $mbiemer=$row4['mbiemer'];
        $fakultet=$row4['fakultet'];
        $full_name=$emer.' '.$mbiemer;
    }
    $tbl_name_qns='tbl_fakultet';
    $where_qns="id_fakultet='$fakultet'";
    $query_qns=$obj->selektoTeDhenat($tbl_name_qns,$where_qns);
    $res_qns=$obj->ekzekutoQuery($conn,$query_qns);
    if($res_qns==true)
    {
        $row_qns=$obj->fetch_data($res_qns);
        $emri_fakultetit=$row_qns['emri_fakultetit'];
        $_SESSION['emriFakultetit']=$emri_fakultetit;
        $kohezgjatja=$row_qns['kohezgjatja'];
        $totalTime=$kohezgjatja*60;
        $qns_per_page=$row_qns['pyetje_per_set'];
        $total_pergjithshme=$row_qns['total_pergjithshme'];
        
       
    }
    if(!isset($_SESSION['starti_kohes']))
    {
        $_SESSION['starti_kohes']=date('h:i:s A');
    }
    if(!isset($_SESSION['koha_perfundimtare']))
    {
        $_SESSION['koha_perfundimtare']=date('h:i:s A',strtotime("+".$kohezgjatja." minutes"));
    }
    
    
?>
        <div class="main">
            <div class="content">
                
                Perdoruesi: <span class="heavy"><?php echo $full_name; ?></span>&nbsp;&nbsp;
                Fakulteti: <span class="heavy"><?php echo $emri_fakultetit; ?></span>&nbsp;&nbsp;
                Koha e fillimit: <span class="heavy"><?php echo $_SESSION['starti_kohes']; ?></span>&nbsp;&nbsp;
                Koha e mbarimit: <span class="heavy"><?php echo $_SESSION['koha_perfundimtare']; ?></span>&nbsp;&nbsp;
                <?php   
                    $startTime=strtotime($_SESSION['koha_perfundimtare']);
                    $currentTime=strtotime(date('h:i:s A'));
                    $timeDifference=$startTime-$currentTime;
                    
                ?>
                <span class="timer " data-seconds-left=<?php echo $timeDifference; ?>></span>
                <form method="post" action="">
                    <div class="welcome">
                        <div class="ques">
                        <?php 
                            
                            if(!isset($_SESSION['tegjitha_pyetjet']))
                            {
                                $_SESSION['tegjitha_pyetjet']=0;
                            }
                            
                            if(isset($_SESSION['nr']))
                            {
                                $nr=$_SESSION['nr'];
                            }
                            else
                            {
                                $nr=0;
                            }
                            $tbl_name="tbl_pyetje";
                            
                            if($nr<=$total_pergjithshme)
                            {
                             
                                $where="eshte_aktive='po' && kategoria='tepergjithshme' && fakultet='".$fakultet."' && id_pyetje NOT IN (".$_SESSION['tegjitha_pyetjet'].")";
                            }
                            else
                            {
                            
                                $where="eshte_aktive='po' && kategoria='matematike' && fakultet='".$fakultet."' && id_pyetje NOT IN (".$_SESSION['tegjitha_pyetjet'].")";
                            }
                           
                            $limit=1;
                            $query=$obj->selektoRreshtCfardo($tbl_name,$where,$limit);
                            $res=$obj->ekzekutoQuery($conn,$query);
                            if($res==true)
                            {
                                $count_rows=$obj->numriRreshtave($res);
                                if($count_rows>0)
                                {
                                    $row=$obj->fetch_data($res);
                                    $id_pyetje=$row['id_pyetje'];   
                                    $pyetje=$row['pyetje'];
                                    $pergjigjja_pare=$row['pergjigjja_pare'];
                                    $pergjigjja_dyte=$row['pergjigjja_dyte'];
                                    $pergjigjja_trete=$row['pergjigjja_trete'];
                                    $pergjigjja_katert=$row['pergjigjja_katert'];
                                    $pergjigjja_peste=$row['pergjigjja_peste'];
                                    $pergjigjja=$row['pergjigjja'];
                                    $pike=$row['pike'];
                                    $emer_imazhi=$row['emer_imazhi'];
                                }
                                else
                                {
                                   
                                    header('location:'.SITEURL.'index.php?page=mbaroSessionin');
                                }
                            }
                         
                            
                        ?>
                        <form method="post" action="">
                            <div class="left-ques">
                            <?php 
                            if(!isset($_SESSION['nr']))
                            {
                                $_SESSION['nr']=1;
                                echo $_SESSION['nr'];
                            }
                            else
                            {
                                echo $_SESSION['nr'];
                            } 
                            if($_SESSION['nr']>$qns_per_page)
                            {
                                header('location:'.SITEURL.'index.php?page=mbaroSessionin');
                            }
                            ?>. 
                                <?php echo $pyetje; ?><br />
                                <?php 
                                    if($emer_imazhi!="")
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/pyetja/<?php echo $emer_imazhi; ?>" alt="foto" />
                                        <?php
                                    }
                                ?>
                                
                            </div>
                            <div class="answers">
                                <input type="radio" name="answer" value="1" required="true" /> <span class="radio-ans"><?php echo $pergjigjja_pare; ?></span>  <hr /><br />
                                <input type="radio" name="answer" value="2" required="true" /> <span class="radio-ans"><?php echo $pergjigjja_dyte; ?></span> <hr /><br />
                                <input type="radio" name="answer" value="3" required="true" /> <span class="radio-ans"><?php echo $pergjigjja_trete; ?></span>  <hr /><br />
                                <input type="radio" name="answer" value="4" required="true" /> <span class="radio-ans"><?php echo $pergjigjja_katert; ?></span>  <hr /><br />
                                <input type="radio" name="answer" value="5" required="true" /> <span class="radio-ans"><?php echo $pergjigjja_peste; ?> <hr /><br />&nbsp;
                                <input type="hidden" name="id_pyetje" value="<?php echo $id_pyetje; ?>" />
                                <input type="hidden" name="pergjigjja_sakte" value="<?php echo $pergjigjja; ?>" />
                                <input type="hidden" name="pike" value="<?php echo $pike; ?>" />
                            </div>
                         
                            <div class="clearfix"></div>
                        
                            <div class="buttons">
                                <input type="submit" name="submit" value="Submit dhe vazhdo" class="btn-go" />
                                
                                <a href="<?php echo SITEURL; ?>index.php?page=logout">
                                    <button type="button" class="btn-exit">&nbsp; Dil &nbsp;</button>
                                </a>
                            </div>
                        </form>
                        <?php 
                            if(isset($_POST['submit']))
                            {
                               
                                $id_pyetje=$_POST['id_pyetje'];
                                
                               
                                if(isset($_POST['answer']))
                                {
                                    $pergjigjja_perdorues=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['answer']);
                                }
                                else
                                {
                                    $pergjigjja_perdorues=0;
                                }
                                $pergjigjja_sakte=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['pergjigjja_sakte']);
                                $id_pyetje=$obj->silleNeFormenEDuhurPerDatabazen($conn,$_POST['id_pyetje']);
                                $username=$_SESSION['student']; 
                                $pike=$_POST['pike'];
                          
                                $tbl_name="tbl_student";
                                $id_student=$obj->merrUserID($tbl_name,$username,$conn);
                                $data_krijimit=date('Y-m-d');
                                $tbl_name="tbl_rezultat";
                                $data="
                                id_student='$id_student',
                                id_pyetje='$id_pyetje',
                                pergjigjja_perdorues='$pergjigjja_perdorues',
                                pergjigjja_sakte='$pergjigjja_sakte',
                                data_krijimit='$data_krijimit'
                                ";
                                if(isset($_SESSION['piketTotale']))
                                {
                                    $totalScore=$_SESSION['piketTotale'];
                                }
                                else
                                {
                                    $totalScore=0;
                                }
                                
                                if(isset($_SESSION['nota_plote']))
                                {
                                    $full_marks=$_SESSION['nota_plote'];
                                }
                                else
                                {
                                    $full_marks=0;
                                }
                                
                                if($pergjigjja_perdorues==$pergjigjja_sakte)
                                {
                                    $_SESSION['piketTotale']=$totalScore+$pike;
                                    $_SESSION['nota_plote']=$full_marks+$pike;
                                }
                                else
                                {
                                    $_SESSION['piketTotale']=$totalScore+0;
                                    $_SESSION['nota_plote']=$full_marks+$pike;
                                }
                                $query=$obj->insertoTeDhena($tbl_name,$data);
                                $res=$obj->ekzekutoQuery($conn,$query);
                                if($res===true)
                                {
                                   
                                    
                               
                                    include('pages/kontrolloKohen.php');
                                    if(isset($_SESSION['tegjitha_pyetjet']))
                                    {
                                        $_SESSION['tegjitha_pyetjet']=$_SESSION['tegjitha_pyetjet'].','.$id_pyetje;
                                    }
                                    else
                                    {
                                        $_SESSION['tegjitha_pyetjet']=0;
                                    }
                                    if(isset($_SESSION['nr']))
                                    {
                                        $_SESSION['nr']=$_SESSION['nr']+1;
                                    }
                                    else
                                    {
                                        $_SESSION['nr']=1;
                                    }
                                    
                                    $_SESSION['pyetja']=$id_pyetje;
                                    header('location:'.SITEURL.'index.php?page=pyetja');
                                }
                                else
                                {
                                    echo "Error";
                                }
                                
                            }
                        ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
