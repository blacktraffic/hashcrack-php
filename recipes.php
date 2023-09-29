<?php
require_once 'style.php';
require_once 'inc.php';
?>

<body>

<div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">

<h1>Hashcrack 2 - Recipes!</h1>

<p>Look at <a href="joblist.php">previous jobs I've submitted.</a><p>

<h2>Recipe 1- &quot;I'm feeling lucky&quot;<p> <!--'--></h2>

<p>Update: NTLM is assumed for that shape of hash now - if you have MD5, a. what year is it? b. you need to override manually with type 0.</p> 

  <form method="POST" action="upload.php" enctype="multipart/form-data">
    <div class="upload-wrapper">
      <span class="file-name">Pick a hash file for automated cracking...</span>
   
      <label for="file-upload"><input class="btn" type="file" id="file-upload" name="uploadedFile"></label>

 
    <input type="submit" name="uploadBtn" class="btn btn-primary" value="Go" />
                                                                       </div>
  </form>

<hr>
<h2>Recipe 2 - Full DESCRYPT, or all NTLM up to 8 chars</h2>

I need to search all of descrypt space, I realise this might take best part of a week. (It is recommended to try option 1 before this, it might be a simple password.)
<p>Alternatively, this will cover all ASCII NTLM up to 8 chars, and will take about 10 hours to do so.

 <form method="POST" action="expert.php" enctype="multipart/form-data">
     <div class="upload-wrapper">
       Pick a hash file for automated cracking...

      <label for="file-upload"><input class="btn" type="file" id="file-upload" name="uploadedFile"></label>
Full descrypt mask: <label class="btn" for="mask"><input type="text" value="?a?a?a?a?a?a?a?a" name="mask"></label>
    <input type="submit" name="uploadBtn" class="btn btn-primary" value="Go" />
    <br>
                                                                       </div>
  </form>

<hr>

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

