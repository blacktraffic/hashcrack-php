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

        if (isset($_GET['short'])) {
            $outp = shell_exec("cat $filepath | perl -pe 's/\x1b\[2K//g '| perl -pe 's/\x1b\[[0-9;]*[mG]//g' | grep -P 'Status|Recovered|Progress|Time.Started|Time.Estimated' | tail -5 ");
        } else {

            echo "<br> Status | <a href=\"kill.php?jid=$jid\">TERMINATE JOB</a> | <a href=\"killrestart.php?jid=$jid\">TERMINATE and RESTART JOB</a> | <a href=\"final.php?jid=$jid\">RESULTS</a> <br>";
            
            $outp = shell_exec("cat $filepath | perl -pe 's/\x1b\[2K//g '| perl -pe 's/\x1b\[[0-9;]*[mG]//g' | tail -30");
        }

        print '<BR><pre style="line-height:1.1;">';
        print "$outp";
        print "</pre><BR>";
    }
    
}

?>
