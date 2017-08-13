<?php 
if (isset($js) && is_array($js)) { 
    foreach ($js as $script) {
        echo "<script type=\"text/javascript\" src=\"$script\"></script>";
    }
}
?>
