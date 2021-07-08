<?php
echo '<option value=""></option>';

foreach (glob($dictDir."*") as $file) {
    if($file == '.' || $file == '..') continue;

    if ( preg_match('/.txt$/',$file) === 1 ) {
        echo '<option value="'.$file.'>'.$file.'</option>';
    }
}
?>

