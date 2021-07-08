
<?php
require_once 'style.php';
require_once 'regmap.php';
require_once 'inc.php';
 
$message = ''; 
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload') {
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        // get details of the uploaded file
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $fileType = $_FILES['uploadedFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName=hash_file('sha256', $fileTmpPath);
        
        $jid=$newFileName;
    
        // directory in which the uploaded file will be moved
        $dest_path = $uploadFileDir . $newFileName;

        $line="UNKNOWN-UPLOAD-FAILED";
 
        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            $message ='File is successfully uploaded.';
        }
    }
}

if (isset($_GET['jid'])) {
    $jid=$_GET['jid'];
    if (!preg_match('/^[a-f0-9]+$/', $jid)) {
        echo "bad job ID";
        die;
    } else {  
        $dest_path = $uploadFileDir . $jid;
    }
}

// add job to list of jobs...
if ($jid !== '') { 
    $cookie_name = 'hashcrack_jobs';

    if(!isset($_COOKIE[$cookie_name])) {
        $cookie_value = $jid;
    } else {
        $ocv=$_COOKIE[$cookie_name];
        $cookie_value=$ocv;
        if (strpos($jid,$ocv) === false) {
            $cookie_value=$ocv.",".$jid;            
        }
    }
    
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/'); // 86400 = 1 day
}

$line=fgets(fopen($dest_path,'r'));

$type=regmap($line);

echo "First line of file is <pre style=\"line-height:1\">".htmlspecialchars($line)."</pre>";

            echo "This looks like hash type ".$type;
            echo"<br>";

            $exec="cd ".$hashcrackDir." && python3 hashcrack.py -Z -i $dest_path | grep RUN: | sed 's/RUN://' ";

if (empty($_GET['jid'])) {
    
            echo "<br>We'll do this:<br><pre style=\"line-height:1\">";
                
            $hccmd=rtrim(shell_exec($exec));           

            echo "$hccmd </pre>";         

            file_put_contents($dest_path.".status","waiting to run....\n");
            
            foreach(preg_split("/\n/", $hccmd) as $line){
                $dothis .= $line." --outfile ".$dest_path.".out --status-timer=1 --status >> $dest_path.status 2>&1\n";
            }           

            $runme="#!/bin/bash\ncd ".$hashcatRun."\n".$dothis;

            $runfile=$hashcatWebDir.$jid.".run";
            
            file_put_contents($runfile, $runme);
            $res=`chmod u+x $runfile`;
} else {

    if (!preg_match('/^[a-f0-9]+$/', $jid)) {
        echo "bad job ID"; die;
    } else {

                echo "<br>We're doing this:<br><pre style=\"line-height:1\">";
                 $runfile=$hashcatWebDir.$jid.".run";

                 echo file_get_contents($runfile);
                 echo "</pre>";
    }
}

            //print "$runme";
            print "</pre>";

if (empty($_GET['jid'])) {
    print "<p>Queuing job now...<br>";
    $atq = `tsp $runfile`;
} else {
    if (!preg_match('/^[a-f0-9]+$/', $jid)) {
        echo "bad job ID"; die; 
    } else {        
        print "<p>Not queuing because of GET request - use status &gt; restart if needed. <br>";
    }
}
                    
            echo "<br> <a href=\"upload.php?jid=$jid\">refresh this page</a> without queuing the job again | <a href=\"job.php?jid=$jid\">Status</a> in single window  (also, terminate, restart) | <a href=\"final.php?jid=$jid\">Show cracked</a> in single window | <a href=\"graph-it.php?jid=$jid\">Graph frequency</a> | <a href=\"graph.php?jid=$jid\">Graph quality</a> | <a href=\"joblist.php\">View submitted jobs</a> (from cookie)";

            echo "<hr><h2>CRACKED<h2><iframe src=\"final.php?jid=$jid\" width=100% height=200></iframe>";

            echo "<hr><h2>STATUS<h2><iframe src=\"job.php?jid=$jid\" width=100% height=500></iframe>";

// echo $message;

// log in DB

// redir to monitor page


?>

</body>
</html>
