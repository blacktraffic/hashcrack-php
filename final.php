<?php
require_once 'style.php';
require_once 'regmap.php';
 
$message = ''; 
if (isset($_GET['jid'])) {

    $jid=$_GET['jid'];

    header("Refresh:5; url=final.php?jid=$jid");
    
    $uploadFileDir = '/var/hashcrack/';
    $dest_path = $uploadFileDir . $jid;
    
    $line=fgets(fopen($dest_path,'r'));

    $exec="cd /home/www-data/hashcrack/ && python3 /home/www-data/hashcrack/hashcrack.py -Z -i $dest_path | grep RUN: | head -1 | sed 's/RUN://' ";

    //print "<pre>$exec</pre>";

    $hccmd=rtrim(shell_exec($exec));

    //print "<pre>$hccmd</pre>";
    
    $dothis = "cd /home/www-data/hc-ro/ &&" . rtrim(shell_exec($exec)) . " --potfile-path /home/www-data/hashcat-6.2.2/hashcat.potfile --quiet --show > ".$dest_path.".out.final";

//    print "<code>$dothis";
//    print "</code><BR>";
    
    $atq = `$dothis`;
    print "<pre>";

    print file_get_contents($dest_path.".out.final");
    print "</pre>";


}

?>

</body>
</html>
