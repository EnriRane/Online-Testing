        <div class="main">
            <div class="content">
                <div class="report">
                    <h2>Menaxho fakultetet</h2>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=shto_fakultet">
                        <button type="button" class="btn-add">Shto fakultet</button>
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
                            <th>Emri i fakultetit</th>
                            <th>Kohezgjatja</th>
                            <th>Pyetje per provim</th>
                            <th>Aktiviteti</th>
                            <th>Veprime</th>
                        </tr>
                        
                        <?php 
                            
                            $tbl_name="tbl_fakultet ORDER BY id_fakultet DESC";
                            $query=$obj->selektoTeDhenat($tbl_name);
                            $res=$obj->ekzekutoQuery($conn,$query);
                            $count_rows=$obj->numriRreshtave($res);
                            $nr=1;
                            if($count_rows>0)
                            {
                                while($row=$obj->fetch_data($res))
                                {
                                    $id_fakultet=$row['id_fakultet'];
                                    $emri_fakultetit=$row['emri_fakultetit'];
                                    $kohezgjatja=$row['kohezgjatja'];
                                    $qns_per_page=$row['pyetje_per_set'];
                                    $eshte_aktive=$row['eshte_aktive'];
                                    ?>
                                    <tr>
                                        <td><?php echo $nr++; ?>. </td>
                                        <td><?php echo $emri_fakultetit; ?></td>
                                        <td><?php echo $kohezgjatja; ?></td>
                                        <td><?php echo $qns_per_page; ?></td>
                                        <td><?php echo $eshte_aktive; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/index.php?page=perditeso_fakultet&id=<?php echo $id_fakultet; ?>"><button type="button" class="btn-update">Perditeso</button></a> 
                                            <a href="<?php echo SITEURL; ?>admin/pages/fshi.php?id=<?php echo $id_fakultet; ?>&page=fakultetet"><button type="button" class="btn-delete" onclick="return confirm('Je i sigurt qe do ta fshish?')">Fshi fakultetin</button></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<tr><td colspan='6'><div class='error'>Asnje fakultet nuk u shtua.</div></td></tr>";
                            }
                        ?>
                        
                        
                    </table>
                </div>
            </div>
        </div>
        