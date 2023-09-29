<?php

require_once 'regmap.php';
require_once 'inc.php';

header("Content-Type: text/plain");
 
if (isset($_GET['jid'])) {

    $jid=$_GET['jid'];

    if (!preg_match('/^[a-f0-9]+$/', $jid)) {
        echo "bad job ID";
    } else {
        header("Refresh:5; url=final.php?jid=$jid");
    
        $dest_path = $uploadFileDir . $jid;
        
        $line=fgets(fopen($dest_path,'r'));

        $exec="cd ".$hashcrackDir." && python3 hashcrack.py -Z -i $dest_path | grep RUN: | head -1 | sed 's/RUN://' ";

        $hccmd=rtrim(shell_exec($exec));

        
        $dothis = "cd ".$hashcatRO." && " . rtrim(shell_exec($exec)) . " --potfile-path ".$hashcatRun."/hashcat.potfile --quiet --show > ".$dest_path.".out.final";

	//echo "Running: <pre>".$dothis."</pre>";
        
        $atq = `$dothis`;
        
        print file_get_contents($dest_path.".out.final");
    }

}
else
{
    print "Need jid param";
} 

?>


