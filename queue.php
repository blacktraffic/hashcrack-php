<?php
require_once 'style.php';
require_once 'inc.php';

?>

<body>

<div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">

<h1>Jobs in queue</h1>

<pre>
<?php

echo `tsp -l`;


if (isset($_GET['kill_id'])) {
    // get details of the uploaded file
    $kill_id = $_GET['kill_id'];

    if (!preg_match('/^[a-f0-9]+$/', $kill_id)) {

        echo "bad job ID";

    } else {

        print '<BR><pre style="line-height:1.1;">';
        print "Killing task ID $kill_id</pre>";
        print `tsp -k $kill_id`;
        print "</pre><BR>";
    }

}
?>

</pre>
</body>
</html>

