        <div class="main" style="color:black;font-weight: 500;">
            <div class="content">
                <div class="report">
                    <h2>Menaxho rezultatet</h2>
                  
                    <?php 
                        if(isset($_SESSION['fshi']))
                        {
                            echo $_SESSION['fshi'];
                            unset($_SESSION['fshi']);
                        }
                    ?>
                    <table>
                        <tr>
                            <th>Nr.</th>
                            <th>Emri i plote</th>
                            <th>Data</th>
                            <th>Nota</th>
                            <th>Fakulteti</th>
                            <th>Veprime</th>
                        </tr>
                        
                        <?php 
                            $tbl_name="tbl_rezultat_permbledhje ORDER BY data_krijimit DESC";
                            $query=$obj->selektoTeDhenat($tbl_name);
                            $res=$obj->ekzekutoQuery($conn,$query);
                            $count_rows=$obj->numriRreshtave($res);
                            $nr=1;
                            if($count_rows>0)
                            {
                                while($row=$obj->fetch_data($res))
                                {
                                    $id_permbledhje=$row['id_permbledhje'];
                                    $id_student=$row['id_student'];
                                    $pike=$row['pike'];
                                    $data_krijimit=$row['data_krijimit'];
                                    ?>
                                    <tr>
                                        <td><?php echo $nr++; ?>. </td>
                                        <td>
                                            <?php 
                                                $tbl_name="tbl_student";
                                                $full_name=$obj->merrEmrinPlote($tbl_name,$id_student,$conn);
                                                echo $full_name;
                                            ?>
                                        </td>
                                        <td><?php echo $data_krijimit; ?></td>
                                        <td><?php echo $pike; ?></td>
                                        <td>
                                            <?php 
                                             
                                                $tbl="tbl_student";
                                                $tbl2="tbl_fakultet";
                                                $fakultet=$obj->merrFakultetin($tbl,$id_student,$conn);
                                                echo $emri_fakultetit=$obj->merrEmrinFakultetit($tbl2,$fakultet,$conn);
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/index.php?page=shiko_rezultat&id_student=<?php echo $id_student; ?>&data_krijimit=<?php echo $data_krijimit; ?>"><button type="button" class="btn-update">Shiko</button></a> 
                                            <a href="<?php echo SITEURL; ?>admin/pages/fshi_rezultat.php?id_permbledhje=<?php echo $id_permbledhje; ?>&id_student=<?php echo $id_student; ?>&data_krijimit=<?php echo $data_krijimit; ?>"><button type="button" class="btn-delete">Fshi rezultatin</button></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<tr><td colspan='7'><span class='error'>Nuk u gjet asnje rezultat.</span></td></tr>";
                            }
                        ?>
                        
                    </table>
                </div>
            </div>
        </div>
    