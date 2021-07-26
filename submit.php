<?php
require_once 'style.php';
require_once 'inc.php';
?>

<body>

<div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">

<center><h1>Hashcrack</h1></center>

<center>     <p>Any issues, email or IM jamie.riden@ioactive.co.uk</p></center>

<h2>Option 1- &quot;I'm feeling lucky&quot;<p> <!--'--></h2>

<p>Currently, anything that looks like MD5/NTLM will be interpreted as MD5; as a workaround, NTLM can be submitted in pwdump format, ie. 'Administrator:500:LM hash:NTLM hash:::'</p>

  <form method="POST" action="upload.php" enctype="multipart/form-data">
    <div class="upload-wrapper">
      <span class="file-name">Pick a hash file for automated cracking...</span>
   
      <label for="file-upload"><input class="btn" type="file" id="file-upload" name="uploadedFile"></label>

 
    <input type="submit" name="uploadBtn" class="btn btn-primary" value="Go" />
                                                                       </div>
  </form>

<hr>
<h2>Option 2: No, I need fine-grained control</h2>

 <form method="POST" action="expert.php" enctype="multipart/form-data">
    <div class="upload-wrapper">
    <p>
         Pick a hash file for automated cracking...

      <label for="file-upload"><input class="btn" type="file" id="file-upload" name="uploadedFile"></label>


                                                                       <p>
                                                                            Optional crib file, e.g. containing company name, main office, etc. If you choose this, use a short wordlist, and big rules, e.g. nsav2dive.rule.

      <label for="file-upload"><input class="btn" type="file" id="file-upload" name="cribFile"></label>

                                                                       <p>
                  Optional type override, e.g 1000, or 'ntlm' for NTLM: <label for="mask"><input type="text" name="type"></label>
                                                                                                                 <p><br>At most crib, OR one mask specified please : <br>
Optional mask, e.g. ?d?d?d?d?d: <label class="btn" for="mask"><input type="text" name="mask"></label><br>

                                                                                     OR dict plus left OR right masks :<br>
      Optional left mask: <label for="mask"><input type="text" name="lmask"></label><br>
      Optional right mask: <label for="mask"><input type="text" name="rmask"></label>
<BR><br>OR, specify dict and/or rule override if required</br>


Optional dict override: <select class="btn btn-default" name="dict">
<?php
                  require 'dict.php';
                  ?>
</select>
<br>Optional rule override: <select class="btn btn-default" name="rules">

<?php
require 'rules.php';
?>
</select>
                  

<br><br>OR, specify left and right dicts<br>
Optional left dict:

<select class="btn btn-default" name="ldict">
<?php
require 'dict.php';
?>
</select>

Optional right dict:

<select class="btn btn-default" name="rdict">
<?php
require 'dict.php';
?>

</select>
<br>

</div>

    <input type="submit" name="uploadBtn" value="Check" class="btn btn-success" >
<input type="submit" name="uploadBtn" value="Go" class="btn btn-primary" >
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

