<?php
$addr=$_REQUEST['addr'];
echo "Ping tester: <form><input type='hidden' name='page' value='tools.php'>
<input name='addr' placeholder='www.google.com' value='$addr'></form>";
if(!empty($addr)){
    echo (system("ping $addr"));
}
?> 
