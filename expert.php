x<?php
require_once 'style.php';
require_once 'regmap.php';
require_once 'inc.php';

?>
<div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
<?php

$message = ''; 
if (isset($_POST['uploadBtn']) ) {
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
                
            $line=fgets(fopen($dest_path,'r'));

            $type=regmap($line);

            echo "First line of file is <font face=courier><div style=\"white-space: pre-wrap; font-family:\"Courier New\", Courier; line-height:1\">".htmlspecialchars($line)."</div></font>";

            $error=0; $done=0;

            // upload crib file if present
            if (isset($_FILES['cribFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {

                $fileTmpPath = $_FILES['cribFile']['tmp_name'];

                $cribFile=$dest_path.".crib";

                if(move_uploaded_file($fileTmpPath, $cribFile)) {

                    $exec="cd ".$hashcrackDir." && python3 hashcrack.py -Z $typeoverride  -i $dest_path -d $cribFile | grep RUN: | sed 's/RUN://' ";
                    print "<P>$exec<p>";
                    $done=1;
                }
            }
            
            if (!empty($_POST['mask']) && !empty($_POST['lmask'])) { print "Can't specify mask and lmask $mask<br>"; }
            if (!empty($_POST['mask']) && !empty($_POST['rmask'])) { print "Can't specify mask and rmask $rmask<br>"; }
            if (!empty($_POST['lmask']) && !empty($_POST['rmask'])) { print "Can't specify lmask and rmask $lmask<br>"; }
            
            echo "This looks like hash type ".$type;            
            echo"<br>";

            if (!empty($_POST['type'])) { $typeoverride="-t ".$_POST['type']; } else { $typeoverride=""; }
            if (!empty($_POST['dict'])) { $dictoverride="-d ".$_POST['dict']; } else { $dictoverride=""; }
            if (!empty($_POST['rules'])) { $rulesoverride="-r ".$_POST['rules']; } else { $rulesoverride=""; }

            if ($done==0 && !empty($_POST['mask'])) {
                $mask=$_POST['mask'];                
                $exec="cd ".$hashcrackDir." && python3 hashcrack.py -Z $typeoverride  -i $dest_path --mask $mask | grep RUN: | sed 's/RUN://' ";
                $done=1;
            }
                
            if ($done==0 && !empty($_POST['lmask'])) {
                $lmask=$_POST['lmask']; 
                $exec="cd ".$hashcrackDir." && python3 hashcrack.py -Z $typeoverride  -i $dest_path $dictoverride --lmask $lmask | grep RUN: | sed 's/RUN://' ";
                $done=1;
            }

            if ($done==0 && !empty($_POST['rmask'])) {
                $rmask=$_POST['rmask'];
                $exec="cd ".$hashcrackDir." && python3 hashcrack.py -Z $typeoverride  -i $dest_path $dictoverride --rmask $rmask | grep RUN: | sed 's/RUN://' ";
                $done=1;
            }

            if ($done==0 && !empty($_POST['rdict']) && !empty($_POST['ldict'])) {
                $rdict=$_POST['rdict'];
                $ldict=$_POST['ldict'];
                $exec="cd ".$hashcrackDir." && python3 hashcrack.py -Z $typeoverride  -i $dest_path -d $ldict -e $rdict | grep RUN: | sed 's/RUN://' ";
                $done=1;
            }

            if ($done==0) {
                $exec="cd ".$hashcrackDir." && python3 hashcrack.py -Z $typeoverride $rulesoverride $dictoverride -i $dest_path | grep RUN: | sed 's/RUN://' ";
            }

            echo "<br>We're proposing to do this:<br><font face=courier><div style=\"white-space: pre-wrap;  font-family: \"Courier New\", Courier; line-height:1\">";
                
            $hccmd=rtrim(shell_exec($exec));

            file_put_contents($dest_path.".status","waiting to run....\n");

            foreach(preg_split("/\n/", $hccmd) as $line){
                $dothis .= $line." --outfile ".$dest_path.".out --status-timer=1 --status >> $dest_path.status 2>&1\n";
            }

            $runme="#!/bin/bash\ncd ".$hashcatRun."\n".$dothis;

            $runfile=$hashcatWebDir.$jid.".run";
            
            file_put_contents($runfile, $runme);
            $res=`chmod u+x $runfile`;

            print "$runme";
            print "</div></font>";

            if ($_POST['uploadBtn'] == 'Go') {
                $atq = `tsp $runfile`;

                            echo "<br> <a href=\"upload.php?jid=$jid\">refresh this page</a> without queuing the job again | <a href=\"job.php?jid=$jid\">Status</a> in single window  (also, terminate, restart) | <a href=\"final.php?jid=$jid\">Show cracked</a> in single window | <a href=\"graph-it.php?jid=$jid\">Graph frequency</a> | <a href=\"graph.php?jid=$jid\">Graph quality</a>";
                            
                            echo "<hr><h2>CRACKED<h2><iframe frameBorder=0 src=\"final.php?jid=$jid\" width=100% height=200></iframe>";

            echo "<hr><h2>STATUS<h2><iframe frameBorder=0 src=\"job.php?jid=$jid\" width=100% height=500></iframe>";

            }
            else {
                echo "<br>If that looks OK, hit 'back' on your browser and then 'Go'<br>";
            }
        }
        else
            {
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }

    }
    else
        {
            $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
        }
}
else
    {
        $message = 'There is some error in the file upload. Please check the following error.<br>';
        $message .= 'Error:' . $_FILES['uploadedFile']['error'];
    
print "No params or bad params; maybe you want to <a href=\"submit.php\">submit a job?</a>\n<br>";
    }
?>

</div></div>
</body>
</html>
