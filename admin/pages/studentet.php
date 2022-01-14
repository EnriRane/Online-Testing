
        <div class="main" >
            <div class="content">
                <div class="report">
                    <h2>Menaxho studentet</h2>
                    
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=shto_student"><button type="button" class="btn-add">Shto student</button></a>
                    <?php
                        if(isset($_SESSION['shto']))
                        {
                            echo $_SESSION['shto'];
                            unset($_SESSION['shto']);
                        }
                        if(isset($_SESSION['perditesimi']))
                        {
                            echo $_SESSION['perditesimi'];
                            unset($_SESSION['perditesimi']);
                        }
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
                            <th>Emaili</th>
                            <th>Kontakti</th>
                            <th>Fakulteti</th>
                            <th>Aktiviteti</th>
                            <th>Veprime</th>
                        </tr>
                  
                    <?php 
                        $tbl_name="tbl_student ORDER BY id_student DESC";
                        $query=$obj->selektoTeDhenat($tbl_name);
                        $nr=1;
                        $res=$obj->ekzekutoQuery($conn,$query);
                        $count_rows=$obj->numriRreshtave($res);
                        if($count_rows>0)
                        {
                            while($row=$obj->fetch_data($res))
                            {
                                $id_student=$row['id_student'];
                                $emer=$row['emer'];
                                $mbiemer=$row['mbiemer'];
                                $full_name=$emer.' '.$mbiemer;
                                $email=$row['email'];
                                $kontakt=$row['kontakt'];
                                $fakultet=$row['fakultet'];
                                $eshte_aktive=$row['eshte_aktive'];
                                ?>
                                <tr>
                                    <td><?php echo $nr++; ?> </td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $kontakt; ?></td>
                                    <td>
                                        <?php 
                                
                                            $tbl_name2="tbl_fakultet";
                                            $emri_fakultetit=$obj->merrEmrinFakultetit($tbl_name2,$fakultet,$conn);
                                            echo $emri_fakultetit;
                                        ?>
                                    </td>
                                    <td><?php echo $eshte_aktive; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/index.php?page=perditeso_student&id_student=<?php echo $id_student; ?>"><button type="button" class="btn-update">Perditeso</button></a> 
                                        <a href="<?php echo SITEURL; ?>admin/pages/fshi.php?id=<?php echo $id_student; ?>&page=studentet"><button type="button" class="btn-delete" onclick="return confirm('Je i sigurt qe do ta fshish?')">Fshi studentin</button></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            echo "<tr><td colspan='7'><div class='error'>Nuk ka asnje student ne liste.</div></tr></td>";
                        }
                    ?>
                        
                    </table>
                </div>
            </div>
        </div>
      