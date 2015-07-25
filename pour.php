<?php
        require_once __DIR__.'/includes/config.php';

        parse_str($_SERVER['QUERY_STRING']);

        db();

        if (isset($tapId) and isset($amountPoured)){
                $sql = "INSERT INTO pours (tapId, amountPoured, createdDate, modifiedDate) values ($tapId,$amountPoured,NOW(),NOW())";

                if(mysql_query($sql)) {
                        echo "Recorded Pour";
                } else {
                
                }
        }       
?>