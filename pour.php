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
                $amountPoured = $pulses / 5400 * 0.264172; // galons = pulses / pulsesPerLitre * GalonsPerLitre

                $sql = "INSERT INTO pours (tapId, amountPoured, createdDate, modifiedDate) values ($tapId,$amountPoured,NOW(),NOW())";

                if(mysql_query($sql)) {
                        echo "Recorded Pour";
                } else {
                
                }
        }       
?>