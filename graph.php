<?php
require_once 'style.php';
 
if (isset($_GET['jid'])) {
    // get details of the uploaded file
    $jid = $_GET['jid'];

    if (!preg_match('/^[a-f0-9]+$/', $jid)) {
        echo "bad job ID";
    } else {
    
        // directory in which the uploaded file will be moved
        $uploadFileDir = '/var/hashcrack/';

        $filepath=$uploadFileDir."/".$jid.".status";

        $outp = shell_exec("python3 /var/www/html/graph-by-quality.py $filepath ");
        
        $outp = `cat $filepath-quality.html`;
        print $outp;        

    }
    
}

?>