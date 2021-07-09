<?php
require_once 'style.php';
require_once 'inc.php';

$filepath=$uploadFileDir.$jid.".status";

$outp = shell_exec("python3 ".$wwwroot."/gputemp.py");

print `cat $uploadFileDir/temp.html`;

?>
