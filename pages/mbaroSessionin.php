<?php 
    include('kontrollo.php');
            if(isset($_SESSION['piketTotale']))
            {
                $maximumScore=$_SESSION['nota_plote'];
                $totalScore=$_SESSION['piketTotale'];
               if($totalScore>0.95*$maximumScore){
                   $totalScore=10;
               }
              else if($totalScore>=0.8* $maximumScore && $totalScore<=0.95* $maximumScore){
                $totalScore=9;
              }
              else if($totalScore>=0.7* $maximumScore && $totalScore<0.8* $maximumScore){
                $totalScore=8;
              }
              else if($totalScore>=0.6* $maximumScore && $totalScore<0.7* $maximumScore){
                $totalScore=7;
              }
              else if($totalScore>=0.5* $maximumScore && $totalScore<0.6* $maximumScore){
                $totalScore=6;
              }
              else if($totalScore>=0.4* $maximumScore && $totalScore<0.5* $maximumScore){
                $totalScore=5;
              }
              else{
                $totalScore=4;
              }
            }
            else
            {
                $totalScore=4;
            }
         
            $tbl_name="tbl_student";
            $username=$_SESSION['student'];
            $id_student=$obj->merrUserID($tbl_name,$username,$conn);
         
            $data_krijimit=date('Y-m-d');
            $tbl_name2="tbl_rezultat_permbledhje";
            $data="id_student='$id_student',
                    pike='$totalScore',
                    data_krijimit='$data_krijimit'
                    ";
            $query=$obj->insertoTeDhena($tbl_name2,$data);
            $res=$obj->ekzekutoQuery($conn,$query);
?>

        <div class="main">
            <div class="content">
                <div class="welcome">
                    <?php 
                        if(isset($_SESSION['koha_komplet']))
                        {
                            echo $_SESSION['koha_komplet'];
                        }
                    ?>
                    Testi u kompletua me sukses!!! Shihemi heren tjeter!<br />
                     <?php 
                        $tbl_name='tbl_student';
                        $username=$_SESSION['student'];
                        $userid=$obj->merrUserID($tbl_name,$username,$conn);
                    
                       
                        $_SESSION['USERID']= $userid;
                       
                       
                     ?>
                    Nota juaj ne provim eshte : <h2><?php echo $totalScore; ?></h2>
 Keni marre <b><?php echo $_SESSION['piketTotale']; ?></b> nga <b><?php echo $_SESSION['nota_plote']; ?></b> pike ne total! <br>
 <a href="<?php echo SITEURL; ?>index.php?page=detaje_rezultati">
                        <button type="button" class="btn-exit">
                            Shiko rezultatin
                        </button>
                     </a>
                    
                    <a href="<?php echo SITEURL; ?>index.php?page=logout">
                        <button type="button" class="btn-exit">&nbsp; Dil jashte &nbsp;</button>
                    </a>
                </div>
            </div>
        </div>
