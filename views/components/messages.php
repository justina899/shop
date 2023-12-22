<?php if (isset($_SESSION["success"])) { ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION["success"] ?>
        </div>
    <?php
        unset($_SESSION["success"]);
    } ?>
    
    <?php if (isset($_SESSION["alert"])) { 
        foreach ($_SESSION["alert"] as $alert) {?>
            <div class="alert alert-danger" role="alert">
                <?= $alert?>
            </div>
    <?php
        }
        unset($_SESSION["alert"]);
    } ?>