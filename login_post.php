<!-- <?php
include("connection.php");
if(isset($_POST['submit'])){
    $First_name=stripslashes($_POST['First_name']);
    $Last_name=stripslashes($_POST['Last_name']);
    $Email=stripslashes($_POST['email']);
    $Password=$_POST['password'];

}

// $First_name=htmlentities(mysqli_real_escape_string($conn,$_POST['First_name']));
// $Last_name=htmlentities(mysqli_real_escape_string($conn,$_POST['Last_name']));
// $Email=htmlentities(mysqli_real_escape_string($conn,$_POST['Email'])); // real escape string  function utiliser pour pas inclure un // dans les inputs
// $Password=htmlentities(mysqli_real_escape_string($conn,$_POST['password']));




$First_name = mysqli_real_escape_string($conn, $First_name);
$Last_name = mysqli_real_escape_string($conn, $Last_name);
$Email = mysqli_real_escape_string($conn, $Email);


if(empty($First_name)){
    $first_name_error='Please enter your name <br>';
    $err_s=1;
}else if(strlen($First_name)<6){
    $first_name_error='your first name need to have a minimum of 6 letters <br> ';
    $err_s=1;

}else if(filter_var($First_name,FILTER_VALIDATE_INT)){

    $first_name_error='Please enter a validate name not a number <br>';
    $err_s=1;
}





if(empty($Last_name)){
    $Last_name_error='Please enter your Last name <br>';
    $err_s=1;
}else if(strlen($Last_name)<6){
    $Last_name_error='your first Last name need to have a minimum of 6 letters <br> ';
    $err_s=1;

}else if(filter_var($Last_name,FILTER_VALIDATE_INT)){

    $Last_name_error='Please enter a validate Last name not a number <br>';
    $err_s=1;
}




if(empty($Email)){
    $Email_error='Please enter your email <br>';
    $err_s=1;
    include('login.php');
} else if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
    $Email_error='Please enter a valid  email <br>';
    $err_s=1;
    include('login.php');
}




if(empty($Password)){
    $Password_error='Please enter a password <br>';
    $err_s=1;
    include('login.php');
}else if(strlen($Password)<6){
    $Password_error='your password name need to have a minimum of 6 letters <br>';
    $err_s=1;
    include('login.php');
}


else{
    if($err_s==0){
       include('side_membre.php');
    }
    else 
    include('login.php');
    
}



?> -->


<?php
include("connection.php");

if (isset($_POST['submit'])) {
    $First_name = stripslashes($_POST['First_name']);
    $Last_name = stripslashes($_POST['Last_name']);
    $Email = stripslashes($_POST['Email']);
    $Password = $_POST['password'];
}

// Create a PDO connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Use prepared statements to insert data
$stmt = $conn->prepare("INSERT INTO your_table_name (First_name, Last_name, Email, Password) VALUES (?, ?, ?, ?)");
$stmt->bindParam(1, $First_name);
$stmt->bindParam(2, $Last_name);
$stmt->bindParam(3, $Email);
$stmt->bindParam(4, $Password);

if (empty($First_name) || empty($Last_name) || empty($Email) || empty($Password)) {
    // Handle empty fields
    $err_s = 1;
    include('login.php');
} else {
    // Execute the prepared statement
    $stmt->execute();
    include('side_membre.php');
}
?>
