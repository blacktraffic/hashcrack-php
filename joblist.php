<?php
require_once 'style.php';
require_once 'inc.php';

?>

<body>

<div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">

<h1>Jobs I've Submitted</h1>

<p>See cookie 'hashcrack_jobs'</p>

<?php

$cookie_name = 'hashcrack_jobs';

if(!isset($_COOKIE[$cookie_name])) {
    echo "nothing in jobs cookie";
} else {
    $ocv=$_COOKIE[$cookie_name];
    $cookie_value=$ocv;

    $jobs = explode(",", $cookie_value);
    foreach($jobs as $jid) {
        $jid = trim($jid);

        if (!preg_match('/^[a-f0-9]+$/', $jid)) {
            echo "bad job ID";
        } else {

            echo "Job $jid\n<br>";
        
            echo "<br>  <a href=\"job.php?jid=$jid\">Status</a> | <a href=\"kill.php?jid=$jid\">TERMINATE JOB</a> | <a href=\"killrestart.php?jid=$jid\">TERMINATE and RESTART JOB</a> | <a href=\"final.php?jid=$jid\">RESULTS</a> <br>";
            
            $filepath=$uploadFileDir."/".$jid.".status";
            
            echo "<hr><h2>CRACKED<h2><iframe src=\"final.php?jid=$jid\" width=100% height=100></iframe>";            
        }
    }
    
}

?>
