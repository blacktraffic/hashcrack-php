<?php
echo '<option value=""></option>';

foreach (glob($rulesDir."*") as $file) {
    if($file == '.' || $file == '..') continue;

    if ( preg_match('/.rule$/',$file) === 1 ) {
        echo '<option value="'.$file.'">'.$file.'</option>';
    }
}
?>
