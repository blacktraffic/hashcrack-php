<?php
require_once 'style.php';
require_once 'inc.php';
 
if (isset($_GET['jid'])) {
    // get details of the uploaded file
    $jid = $_GET['jid'];

    if (!preg_match('/^[a-f0-9]+$/', $jid)) {
        
        echo "bad job ID";
        
    } else {

        print '<BR><pre style="line-height:1.1;">';
        $tspid=`tsp -l | grep $jid| cut -f 1 -d' '`;
        print "Killing task ID $tspid</pre>";
        print `tsp -k $tspid`;
        print "</pre><BR>";
    }
    
} else {

    print '<BR>need job ID';
}


?>
