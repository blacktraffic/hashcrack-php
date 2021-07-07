<?php
require_once 'style.php';
require_once 'regmap.php';
 
$message = ''; 
if (isset($_GET['jid'])) {

    $jid=$_GET['jid'];
    
    $uploadFileDir = '/var/hashcrack/';
    $dest_path = $uploadFileDir . $jid;
    
    $line=fgets(fopen($dest_path,'r'));

    $exec="cd /home/jamie.riden/hashcrack/ && python3 /home/jamie.riden/hashcrack/hashcrack.py -Z -i $dest_path | grep RUN: | head -1 | sed 's/RUN://' ";

    //print "<pre>$exec</pre>";

    $hccmd=rtrim(shell_exec($exec));

    //print "<pre>$hccmd</pre>";
    
    $dothis = "cd /home/jamie.riden/hc-ro/ &&" . rtrim(shell_exec($exec)) . " --potfile-path /home/jamie.riden/hc-www-6.1.1/hashcat.potfile --quiet --show > ".$dest_path.".out.final";

    
    $atq = `$dothis`;

    $filepath=$uploadFileDir.$jid.".out.final";

    $outp = shell_exec("python3 /var/www/html/graph-pw-by-length.py $filepath ");

    $outp = `cat $filepath-bylen.html`;
    print $outp;



}

?>

</body>
</html>