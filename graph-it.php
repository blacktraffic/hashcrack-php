<?php
require_once 'style.php';
require_once 'inc.php';
 
$message = ''; 
if (isset($_GET['jid'])) {

    $jid=$_GET['jid'];
    
    if (!preg_match('/^[a-f0-9]+$/', $jid)) {
        echo "bad job ID";
    } else {
   
        $dest_path = $uploadFileDir . $jid;
    
        $line=fgets(fopen($dest_path,'r'));

        $exec="cd ".$hashcrackDir." && python3 hashcrack.py -Z -i $dest_path | grep RUN: | head -1 | sed 's/RUN://' ";

        $hccmd=rtrim(shell_exec($exec));

        //print "<pre>$hccmd</pre>";
    
        $dothis = "cd ".$hashcatRO." && " . rtrim(shell_exec($exec)) . " --potfile-path ".$hashcatRun."/hashcat.potfile --quiet --show > ".$dest_path.".out.final";
    
        $atq = `$dothis`;

        $filepath=$uploadFileDir.$jid.".out.final";
        
        $outp = shell_exec("python3 ".$wwwroot."/graph-pw-by-length.py $filepath ");
        
        $outp = `cat $filepath-bylen.html`;
        print $outp;
        
    }            
} else {
    print "Need jid param";
}

?>

</body>
</html>
