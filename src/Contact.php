<!DOCTYPE HTML>  
<html>
<head>

<!--Header linking for customer contact form -->
<meta charset="utf-8"/>
  <meta name="description" content="Development Project Product" />
  <meta name="keywords" content="HTML,Javascript,CSS" />
<link href="stylesdevops.css" rel="stylesheet" type="text/css"/> 
<link href="contact_us.css" rel="stylesheet" type="text/css"/>

<!--error messages colour set to red-->
<style>
.error {color: #FF0000;}
</style>
</head> 
<body>  

<!--Attachment of website logo to the page-->
<header>
  <img id="product_logo" src="logo.png" alt="pdlogo" />
  <h1 class="product_name"> One Stop Movies </h1>
</header>

<hr>

<center>
<h2>Contact Us</h2>
</center>

<center>

<?php
/*-------------------------------------------------------------*/
/* Error handling for customer support form*/
/*-------------------------------------------------------------*/

$name = $name_error = "";
$email = $email_error =  "";
$number = $number_error = "";

if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST') 
{
  if (empty($_POST["name"])) 
  {
    $name_error = "Name is required";
  } 

  else 
  {
    $name = test_input($_POST["name"]);
    
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
    {
      $name_error = "Please use letters only!";
    }
  }
  
  if (empty($_POST["email"])) 
  {
    $email_error = "Email is required";
  } 

  else 
  {
    $email = test_input($_POST["email"]);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      $email_error = "Invalid email format";
    }
  }
    
  if (empty($_POST["number"])) 
  {
    $number = "";
  } 

  else 
  {
    $number = test_input($_POST["number"]);
    
    if (!preg_match("/^[0-9]{10}+$/", $number)) 
    {
      $number_error = "Invalid Number";
    }
  }
}

if(!function_exists('test_input')){
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
}

/*-------------------------------------------------------------*/
/* Backend - Datase adbadition for Iteration 3 */
/*-------------------------------------------------------------*/

if(isset($_POST['submit']) && !isset($name_error))
{
//Database Connection
$conn = new mysqli ('localhost','aadesh','test1234', 'customer_data');

//Connection failure
if($conn->connect_error)
{
  die('Connection Failed : '.$conn->connect_error);
}
else
{
  $stmt = $conn->prepare("insert into customers(name, email, number)
  values(?,?,?)");
  $stmt->bind_param("sss", $_POST['name'], $_POST['email'], $_POST['number']);
  $stmt->execute();
  
  //print submitted confirmation
echo "<div style='width: 300px; height: 45px; 
float: center; 
background: #1B4F72; 
padding: 10px; 
margin-right: 10px; 
border-bottom: 2px solid #e2e2e2; 
text-align: center;
border-radius: 12px;'>";
echo "<br>";
echo "<div style ='font:26px/18px Calibri,tahoma,sans-serif;color:#5DADE2'> Submitted Successfully!</div>";
echo "<br>";

}
}
?>
</center>

<!--Main form of the Customer Contact page-->
<br>
<div class = "container">
<p><span class="error">* Important fields</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

  Name: <span class="error">*</span> <input type="text" name="name" placeholder="John Doe" value="<?php echo $name;?> ">
  <span class="error"><?php echo $name_error;?></span>
  <br><br>

  E-mail: <span class="error">*</span> <input type="text" name="email" placeholder="someone@example.com" value="<?php echo $email;?>">
  <span class="error"><?php echo $email_error;?></span>
  <br><br>

  Mobile: <input type="text" name="number" placeholder="04xx xxx xxx" value="<?php echo $number;?>">
  <span class="error"><?php echo $number_error;?></span>
  <br><br>

  <input type="submit" name="submit" value="Submit">  
</form>
</div>

</body>
</html>




<?php
/*-------------------------------------------------------------*/
/* Individual unit testing run for contact form */
/*-------------------------------------------------------------*/
//Class created with similar error handling to test code
namespace aadesh\Contact;

class Contact
{
public function returnName($name)
{
  if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
  {
      return $name_error = "Please use letters only!";
  }
  if ($name == NULL) 
  {
    return $name_error ='Name is required';
  }
  else
  {
    return "Name is set";
  }
}

public function returnEmail($email)
{
  if($email == '') 
  {
    return $email_error = "Email is required";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
  {
    return $email_error = "Invalid email format";
  } 
  else
  {
    return "Email is set";
  }
}

public function returnNumber($number)
{

  if ($number == '') 
  {
  return NULL;
  } 

  if (!preg_match("/^[0-9]{10}+$/", $number)) 
  {
    return $number_error = "Invalid Number";
  } 

  else
  {
    return "Number is set";
  }
}
}