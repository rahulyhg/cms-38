<?php
//This action hook where other plugins uses it to insert some dynamic stuff. Eg. Submit Button
		do_action( "upg_grip_top");
?>

<?php

//It displays posted user icon with it's link	
if($author_show)
if($user!="")
echo upg_author($author)."<br>";

?>

<div class="pure-g">