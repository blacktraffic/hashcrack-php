

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

$runfile="sleep 86400; # paused for manual job";
$atq = `tsp $runfile`;

?>