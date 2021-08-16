<?php
include '../db/db.php';
mysqli_query($con,"CREATE DATABASE eventribe");
mysqli_select_db($con,'eventribe');
if (mysqli_query($con,"CREATE TABLE pradyut (
    ID int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    uname varchar(255),
    email varchar(255),
    whatsapp varchar(10),
    phone varchar(10),
    city_name varchar(255),
    state_name varchar(255),
    age varchar(10),
    slot varchar(10),
    screenshot varchar(255),
    refral varchar(20),
    consent1 varchar(10),
    consent2 varchar(10),
    consent3 varchar(10)
)")) {
    # code...
echo "pradyut";
}
$uname = $_POST['name'];
$email = $_POST['email'];
$whatsapp = $_POST['whatsapp'];
$phone = $_POST['phone'];
$city_name = $_POST['city'];
$state_name = $_POST['state'];
$age = $_POST['age'];
$refral = $_POST['refral'];
$time = $_POST['time'];
// $screenshot = $_POST['screenshot'];
$work = $_POST['post'];

$email = stripcslashes($email);
$email = mysqli_real_escape_string($con,$email);

// $username = stripcslashes($username);
// $username = mysqli_real_escape_string($con,$username);

$result = mysqli_query($con,"select * from pradyut where email = '$email'") or die("failed to query database".mysqli_error());
$row = mysqli_fetch_array($result);

if($row['email'] == $email) {
    echo '<script type ="text/javascript"> alert("This email is already registered \n Please try with a different email");window.location= "SignUp.php"</script>';
    die();
}elseif (($row['email'] !== $email)) {
    if (isset($work)) {
        // echo "<pre>", print_r($_POST),"</pre>";
        // echo "<pre>", print_r($_FILES),"</pre>";
        // echo "<pre>", print_r($_FILES['profileImage']),"</pre>";
        echo "<pre>", print_r($_FILES['screenshot']['name']),"</pre>";
        //  $product_names = md5(time(). mt_rand(1,99));
        $profileImageName = $email . '_' . $_FILES['screenshot']['name'];

        $path = 'assets/'. $email .'/screenshot/';
        if (!file_exists($path)) {
            # code...
            mkdir($path, 0777,true);
        }else{
            $files = glob($path.'/*'); 
            // Deleting all the files in the list 
            foreach($files as $file){ 
                if(is_file($file)) 
            // Delete the given file 
            unlink($file); 
        }
} 

         $target = 'assets/'. $email .'/screenshot/'. $profileImageName;
                 
        
        move_uploaded_file($_FILES['screenshot']['tmp_name'], $target);



    // code...
   $query = mysqli_query($con," insert into pradyut (uname, email, whatsapp, phone, city_name, state_name, age, slot, screenshot, refral, consent1, consent2, consent3) 
values ('$uname', '$email', '$whatsapp', '$phone', '$city_name', '$state_name', '$age', '$time', '$profileImageName', '$refral', 'I Agree', 'I Agree', 'I Agree')");
  
echo '<script type ="text/javascript"> alert("Registered Successfully");window.location= "index.html"</script>';
    }
}else {
    // code...
    echo '<script type ="text/javascript"> alert("Something went wrong !! Please try again");window.location= "index.html"</script>';
}
 ?>