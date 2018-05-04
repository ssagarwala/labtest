<?php session_start(); 
$conName = check_input($_POST['conName']);
$email    = check_input($_POST['email']);
$telephone =check_input($_POST['telephone']);
$contactMe = stripslashes($_POST['contactMe']);

$myemail="info@dlabtest.com";
$subject="Contact from website";

if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
{
    $email='';
}   

include_once 'securimage/securimage.php';
$securimage = new Securimage();
if ($securimage->check($_POST['captcha_code']) == false) {
  // the code was incorrect
  // you should handle the error so that the form processor doesn't continue

  // or you can use the following code if there is no validation or you do not know how
  header('Location:errorpage.html');
  echo "The security code entered was incorrect.<br /><br />";
  echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
  exit;
}
/* Let's prepare the message for the e-mail */

$message .="\n";
$message .="\n";
$message = "Hello! Request to be cobtacted has been submitted by:" ;
$message .="\n";
$message .= "Contact name :     ".$conName;
$message .="\n";
$message .="Email address :   " .$email;
$message .="\n";
$message .="Phone Number :   " .$telephone;
$message .="\n";
$message .="Message : ".$contactMe;


			


/* Send the message using mail() function */
mail($myemail,$subject,$message);

/* Redirect visitor to the thank you page */
header('Location:thanks.html');
exit();
function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>