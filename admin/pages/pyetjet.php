
        <div class="main">
            <div class="content">
                <div class="report">
                    <h2>Menaxho pyetjet</h2>
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=shto_pyetje">
                            <button type="button" class="btn-add">Shto pyetje</button>
                        </a>
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
                            <th>Pyetja</th>
                            <th>Pergjigja</th>
                            <th>Fakulteti</th>
                            <th>Aktiviteti</th>
                            <th>Veprime</th>
                        </tr>
                        
                        <?php 
                           
                            $tbl_name="tbl_pyetje ORDER BY id_pyetje DESC";
                            $query=$obj->selektoTeDhenat($tbl_name);
                            $res=$obj->ekzekutoQuery($conn,$query);
                            $count_rows=$obj->numriRreshtave($res);
                            $nr=1;
                            if($count_rows>0)
                            {
                                while($row=$obj->fetch_data($res))
                                {
                                    $id_pyetje=$row['id_pyetje'];
                                    $pyetje=$row['pyetje'];
                                    $pergjigjja=$row['pergjigjja'];
                                    $fakultet=$row['fakultet'];
                                    $eshte_aktive=$row['eshte_aktive'];
                                    ?>
                                    <tr>
                                        <td><?php echo $nr++; ?>. </td>
                                        <td style="width: 650px;"><?php echo $pyetje; ?></td>
                                        <td><?php echo $pergjigjja; ?></td>
                                        <td><?php echo $fakultet; ?></td></td>
                                        <td><?php echo $eshte_aktive; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/index.php?page=perditeso_pyetje&id=<?php echo $id_pyetje; ?>"><button type="button" class="btn-update">Perditeso</button></a> 
                                            <a href="<?php echo SITEURL; ?>admin/pages/fshi.php?id=<?php echo $id_pyetje; ?>&page=pyetjet"><button type="button" class="btn-delete" onclick="return confirm('Je i sigurt qe do ta fshish')">Fshi</button></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<tr><td colspan='6'><div class='error'></div></td></tr>";
                            }
                        ?>
                        
                    </table>
                </div>
            </div>
        </div>
      