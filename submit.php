<?php
require_once 'style.php';
require_once 'inc.php';
?>

<body>

<h1>Hashcrack</h1>

<p>Option 1- &quot;I'm feeling lucky&quot;<p> <!--'-->

<p>Any issues, email or IM jamie.riden@ioactive.co.uk</p>

<p>Currently, anything that looks like MD5/NTLM will be interpreted as MD5; as a workaround, NTLM can be submitted in pwdump format, ie. 'Administrator:500:LM hash:NTLM hash:::'</p>

  <form method="POST" action="upload.php" enctype="multipart/form-data">
    <div class="upload-wrapper">
      <span class="file-name">Pick a hash file for cracking...</span><br>
    <p>
      <label for="file-upload"><input type="file" id="file-upload" name="uploadedFile"></label>
    </div>
 
    <input type="submit" name="uploadBtn" value="Upload" />       
  </form>

<hr>
<h3>Option 2: No, I need fine-grained control (work in progress)</h3>

 <form method="POST" action="expert.php" enctype="multipart/form-data">
    <div class="upload-wrapper">
    <p>
      <label for="file-upload"><input type="file" id="file-upload" name="uploadedFile"></label>
                  Optional type override, e.g 1000, or 'ntlm' for NTLM: <label for="mask"><input type="text" name="type"></label>
<br>At most one mask specified please<br>
Optional mask, e.g. ?d?d?d?d?d: <label for="mask"><input type="text" name="mask"></label>
      Optional left mask: <label for="mask"><input type="text" name="lmask"></label>
      Optional right mask: <label for="mask"><input type="text" name="rmask"></label>
<BR><br>OR, specify dict or rule override</br>


Optional dict override: <select name="dict">
<?php
                  require 'dict.php';
                  ?>
</select>
<br>
Optional rule override: <select name="rules">

<?php
require 'rules.php';
?>
</select>
                  

<br><br>OR, specify left and right dicts<br>
Optional left dict:

<select name="ldict">
<?php
require 'dict.php';
?>
</select>
<br>

Optional right dict:

<select name="rdict">
<?php
require 'dict.php';
?>

</select>
<br>

</div>

    <input type="submit" name="uploadBtn" value="Check">
<input type="submit" name="uploadBtn" value="Go">
  </form>

<?php
print "<h2>Queue</h2>";
print "<pre>Running : ".`tsp -l | grep running | wc -l`."</pre>";
print "<pre>Queued:   ".`tsp -l | grep queued | wc -l`."</pre>";
print "<pre>Finished: ".`tsp -l | grep finished | wc -l`."</pre>";

print "<h2>GPU status</h2><pre>".`nvidia-smi --query-gpu=gpu_name,temperature.gpu,power.draw,utilization.gpu  --format=csv`."</pre>";
?>
</body>
</html>
