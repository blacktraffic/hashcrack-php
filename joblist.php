<?php
require_once 'style.php';



$cookie_name = 'hashcrack_jobs';

if(!isset($_COOKIE[$cookie_name])) {
    echo "nothing in jobs cookie";
} else {
    $ocv=$_COOKIE[$cookie_name];
    $cookie_value=$ocv;

    $jobs = explode(",", $cookie_value);
    foreach($jobs as $jid) {
        $jid = trim($jid);

        echo "Job $jid\n<br>";
        
        echo "<br>  <a href=\"job.php?jid=$jid\">Status</a> | <a href=\"kill.php?jid=$jid\">TERMINATE JOB</a> | <a href=\"killrestart.php?jid=$jid\">TERMINATE and RESTART JOB</a> | <a href=\"final.php?jid=$jid\">RESULTS</a> <br>";
    
        // directory in which the uploaded file will be moved
        $uploadFileDir = '/var/hashcrack/';

        $filepath=$uploadFileDir."/".$jid.".status";

        echo "<hr><h2>CRACKED<h2><iframe src=\"final.php?jid=$jid\" width=100% height=100></iframe>";

        echo "<hr><h2>STATUS<h2><iframe src=\"job.php?jid=$jid&short=true\" width=100% height=100></iframe>";
    }
    
}

?>