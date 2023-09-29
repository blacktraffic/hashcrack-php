
<?php
require_once 'style.php';
require_once 'regmap.php';
require_once 'inc.php';

?>
<div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
<?php

$message = '';
$dest_path='';

if (isset($_POST['uploadBtn'])) {

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
            $message ='File is successfully uploaded for analysis.';
            print "$message\n<br><br>";
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

echo "First line of file is <font face=courier><div style=\"white-space: pre-wrap; font-family:\"Courier New\", Courier; line-height:1\">".htmlspecialchars($line)."</div></font>";

if (strstr(htmlspecialchars($line), ':::')){
    echo "<b>If this is a shadow file, you need just the first two fields; do a cut -f 1,2 -d':'. Hashcat will parse pwdump data but NOT full shadow files.</b><p>";
}

            echo "This looks like hash type ".$type;
            echo"<br>";

            $exec="cd ".$hashcrackDir." && python3 hashcrack.py -Z -i $dest_path | grep RUN: | sed 's/RUN://' ";

if (empty($_GET['jid'])) {
    
            echo "<br>We would have done this:<br><font face=courier><div style=\"white-space: pre-wrap; font-family:\"Courier New\", Courier; line-height:1\">";
                
            $hccmd=rtrim(shell_exec($exec));           

            echo "$hccmd </div></font>";         

 } else {

    if (!preg_match('/^[a-f0-9]+$/', $jid)) {
        echo "bad job ID"; die;
    } else {

                echo "<br>We're doing this:<br><font face=courier><div style=\"white-space: pre-wrap; font-family:\"Courier New\", Courier; line-height:1\">";
                 $runfile=$hashcatWebDir.$jid.".run";

                 echo file_get_contents($runfile);
                 echo "</div></font>";
    }
}

            //print "$runme";
            print "</pre>";


echo "<p><p><b>Please bookmark this link <br> <a href=\"upload-lookup.php?jid=$jid\">upload.php?jid=$jid</a></b> if you want to check on the job later on.</b><p>";  

            echo "<h2>STATUS</h2><br> <a href=\"upload.php?jid=$jid\">refresh this page</a> without queuing the job again | <a href=\"job.php?jid=$jid\">Status</a> in single window  (also, terminate, restart) | <a href=\"final.php?jid=$jid\">Show cracked</a> in single window | <a href=\"graph-it.php?jid=$jid\">Graph frequency</a> | <a href=\"graph.php?jid=$jid\">Graph quality</a> | <a href=\"joblist.php\">View submitted jobs</a> (from cookie)";

            echo "<hr><h2>CRACKED<h2><iframe frameBorder=0 src=\"final.php?jid=$jid\" width=100% height=200></iframe>";

            echo "<hr><h2>STATUS<h2><iframe frameBorder=0 src=\"job.php?jid=$jid\" width=100% height=500></iframe>";

// echo $message;

// log in DB

// redir to monitor page


?>
</div></div>
</body>
</html>
