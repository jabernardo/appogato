<?php 
if (isset($css) && is_array($css)) {
    foreach ($css as $style) {
        echo "<link rel=\"stylesheet\" href=\"$style\" defer>";
    }
}
?>
