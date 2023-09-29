<?php
require_once 'style.php';
require_once 'inc.php';
?>

<body>

<div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">

<h1>Hashcrack 2 - the biggest one </h1>

<p>Look at <a href="joblist.php">previous jobs I've submitted.</a><p>

<p>Our rules and dicts available for <a href="downloads/"> download here </a><p>

<p>This is the 6 x NVIDIA 4090 rig, around 8 times as fast as the "old" hashcrack/crackathon. Everything has been migrated from the old one afaik.</p>

<p>A small project by jamie.riden@ioactive.com; please get in touch if you have problems or questions.<p>


<p><b>NB: Hashcat does not understand full /etc/shadow files - you just need the first two fields, or "cut -f1,2 -d':'"</b></p>
              <p>You should not mix hash types in the same file; it will identify the type based on the first line it sees, and anything else will be ignored.</p>

<h2>Look up results (if any) for a given hash file</h2>

<p>If you forgot what happened to the job, or something crashed, or whatever, you can view any results by resubmitting here:</p>

  <form method="POST" action="upload-lookup.php" enctype="multipart/form-data">
    <div class="upload-wrapper">
      <span class="file-name">Pick a hash file for automated cracking...</span>
   
      <label for="file-upload"><input class="btn" type="file" id="file-upload" name="uploadedFile"></label>

 
    <input type="submit" name="uploadBtn" class="btn btn-primary" value="Lookup" />
                                                                       </div>
  </form>


<?php
print "<h2>Queue</h2>"; 
print "<pre>Running : ".`tsp -l | grep running | wc -l`."</pre>";
print "<pre>Queued:   ".`tsp -l | grep queued | wc -l`."</pre>";
print "<pre>Finished: ".`tsp -l | grep finished | wc -l`."</pre>";

print "<h2>GPU status</h2>";
// <pre>".`nvidia-smi --query-gpu=gpu_name,temperature.gpu,power.draw,utilization.gpu  --format=csv`."</pre>";

//print "<p><a href=\"stats.php\">GPU temp / fan graph</a></p>";


print "<iframe border=none width=100% height=640 frameBorder=0 src=\"stats.php\">GPU temp / fan graph</iframe>";
?>

<p>
<center>

<img src="./smallbt.png" width=150><br>
        &nbsp;&nbsp;A black traffic production
<p>
A tiny php front-end which runs <a href="https://github.com/blacktraffic/hashcrack">hashcrack</a> for you.
<p><p>

<i><font size=-2>"Numbers is hard and real and they never have feelings<br>
But you push too hard, even numbers got limits,<br>
Why did one straw break the camel's back?<br>
Here's the secret<br>
The million other straws underneath it<br>
It's all mathematics"</font></i>
</center>
                                               </div>
                                                     </div>

</body>
</html>

