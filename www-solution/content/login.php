<?php
$token_id= $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

$form_names = $csrf->form_names(array('name', 'pass'), false);

function verify_login($name,$pass){
    //A1 - taktiez bacha na sqli a radsej pouzit prepared statements ako v search
    global $db;
    $stmt = $db->stmt_init();
    //$sql = $db->query("SELECT id,name,password FROM admins WHERE name='".$db->real_escape_string($name)."' AND password='".hash("sha512",$pass)."' LIMIT 1");
    $sql = "SELECT id,name,password FROM admins WHERE name=? AND password=? LIMIT 1";
    $stmt = $db->prepare($sql);
    if (  false === $stmt  ) {
        die('prepare() failed: ' . htmlspecialchars($db->error));
    }

    $rc = $stmt->bind_param('ss',$name,$pass1);
    $pass1 = hash("sha512",$pass);

    if ( false===$rc ){
        die('bind_param() failed: ' . htmlspecialchars($stmt->error));
    }

    $rc = $stmt->execute();
    if ( false===$rc ) {
        die('execute() failed: ' . htmlspecialchars($stmt->error));
    }

    //$data = $sql->fetch_array();
    $stmt->bind_result($id, $name2, $pass2);
    while($stmt->fetch()){
            $_SESSION['id']  = $id;
            $_SESSION['name'] = $name2;
            $_SESSION['session_id'] = session_id();
            return true;
    }
    $stmt->free_result();
    $stmt->close();
    return false;
}

if(@$_POST['logIN']){
	if(isset($_POST[$form_names['name']], $_POST[$form_names['pass']])) {
		// Check if token id and token value are valid.
		if($csrf->check_valid('post')) {
			// Get the Form Variables.
			$name = $_POST[$form_names['name']];
			$pass = $_POST[$form_names['pass']];

			if(verify_login($name,$pass)) {
				header('LOCATION: index.php');
			}else{
				$error = "Wrong name or password!! Pls try it again!!";
			}
		}
        else{
			echo "CSRF Error";
		}
		// Regenerate a new random value for the form.
		$form_names = $csrf->form_names(array('user', 'password'), true);
	}

}
?>

<?if(!isLogin()){?>
<div style="width:20%;">
    <?=@$error?>
    <form method="post" name="login">
		<input type="hidden" name="<?=$token_id?>" value="<?=$token_value?>">
        <label>Meno</label>
        <input name="<?=$form_names['name']?>" value="" type="text" placeholder="LamaCoder" autofocus />
        <label>Heslo</label>
        <input name="<?=$form_names['pass']?>" value="" type="password" placeholder="********" />
        <br />
        <button class="button" name="logIN" value="1">Prihlasiť</button>
    </form>
</div>
<?}else{?>
    <div style="width:20%;">
        <?=@$error?>
        <a href="./?page=logout.php"><button class="button">Odhlásiť sa</button></a>
    </div>
<?}?>
