<?php
$token_id= $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

$form_names = $csrf->form_names(array('name', 'email', 'message'), false);
$action=$_REQUEST['action'];
if ($action=="")    /* display the contact form */
    {
    ?>
    <form  action="" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="action" value="submit">
		<input type="hidden" name="<?=$token_id?>" value="<?=$token_value?>">
		Your name:<br>
		<input name="<?=$form_names['name']?>" type="text" value="" size="30"/><br>
		Your email:<br>
		<input name="<?=$form_names['email']?>" type="text" value="" size="30"/><br>
		Your message:<br>
		<textarea name="<?=$form_names['message']?>" rows="7" cols="30"></textarea><br>
		<input type="submit" value="Send email"/>
    </form>
    <?php
    } 
else                /* send the submitted data */
    {
		if(isset($_POST[$form_names['name']], $_POST[$form_names['email']], $_POST[$form_names['message']])) {
			// Check if token id and token value are valid.
			if($csrf->check_valid('post')) {
				// Get the Form Variables.
				$name = $_POST[$form_names['name']];
				$email = $_POST[$form_names['email']];
				$message = $_POST[$form_names['message']];

				if (($name=="")||($email=="")||($message==""))
				{
					echo "All fields are required, please fill <a href=\"\">the form</a> again.";
				}else{
						$from="From: $name<$email>\r\nReturn-path: $email";
						$subject="Message sent using your contact form";
						mail("youremail@yoursite.com", $subject, $message, $from);
						echo "Email sent!";
				}
			}else{
				echo "SCRF Error";
			}
			// Regenerate a new random value for the form.
			$form_names = $csrf->form_names(array('user', 'password'), true);
		}

    }  
?> 
