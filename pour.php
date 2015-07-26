<?php
        require_once __DIR__.'/includes/config.php';
        require_once __DIR__.'/admin/includes/models/tap.php';
        require_once __DIR__.'/admin/includes/managers/tap_manager.php';


        parse_str($_SERVER['QUERY_STRING']);

        $tapManager = new TapManager();

        db();

        if (isset($tapNum) and isset($pulses)){
                $tap = $tapManager->GetByNumber($tapNum);
                $tapId = $tap->get_id();

                $pulsesPerLitre = 5400;
                $galonsPerLitre = 0.264172;

                $amountPoured = $pulses / $pulsesPerLitre * $galonsPerLitre;
                
                $sql = "INSERT INTO pours (tapId, amountPoured, createdDate, modifiedDate) values ($tapId,$amountPoured,NOW(),NOW())";

                if(mysql_query($sql)) {
                        echo "Recorded Pour";
                } else {
                
                }
        }       
?>