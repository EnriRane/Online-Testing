<?php 
    include('kontrollo.php');
?>

        <div class="main">
            <div class="content">
                <div class="welcome">
                    <?php 
                        if(isset($_SESSION['login']))
                        {
                            echo $_SESSION['login'];
                            unset($_SESSION['login']);
                        }
                        if(!isset($_SESSION['koha_fillestare']))
                        {
                          
                        }
                    ?>
                    Pershendetje <span class="heavy"><?php echo $_SESSION['student']; ?></span>. Miresevini ne testin online.<br />
                    
                    <div class="success">
                        <p style="text-align: left;">
                            Keto jane disa nga rregullat e kesaj platforme.<br />
                            1. Ne castin qe ti i jep submit nje pyetjeje nuk mund te kthehesh me serish te ajo.<br />
                            2. Nese vendos te dalesh nga testi atehere mund te futesh serish vetem me lejen e mesuesit.<br />
                            3. Pasi te klikosh kronometri i testit do te filloje.<br />
                        <h4> Pac fat!!!</h4>
                        </p>
                    </div>
                    
                    <a href="<?php echo SITEURL; ?>index.php?page=pyetja">
                        <button type="button" class="btn-go">Fillo testin</button>
                    </a>
                    <a href="https://mail.google.com/mail/u/0/#inbox">
                        <button type="button" class="btn-go">Kontrollo per detyre</button>
                    </a>
                    <a href="<?php echo SITEURL; ?>index.php?page=logout">
                        <button type="button" class="btn-exit">&nbsp; Dil &nbsp;</button>
                    </a>
                </div>
            </div>
        </div>
