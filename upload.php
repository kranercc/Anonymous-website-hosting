<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

function getRealIpAddr(){
  if ( !empty($_SERVER['HTTP_CLIENT_IP']) ) {
   // Check IP from internet.
   $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
   // Check IP is passed from proxy.
   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
   // Get IP address from remote address.
   $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
 }

$client_ip = getRealIpAddr();
$current_Time = time();


function Increment_views()
{
    $servername = "63.250.45.114";
    $username = "admin";
    $password = "Kranenr1pwp@_";
    $dbname = "freehosting";
    
    // Create connection

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE views_table SET total_views = total_views + 1";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
    }
    } else {
    
    }
    $conn->close();

}



function get_results_from_database($ip_to_check)
{
    $servername = "63.250.45.114";
    $username = "admin";
    $password = "Kranenr1pwp@_";
    $dbname = "freehosting";
    
    // Create connection

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT begin_time_of_block FROM ips_and_block_time WHERE ip='$ip_to_check'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
      return $row;            
    }
    } else {
    
      return false;
    }
    $conn->close();
}   


function LogIp($ip, $time)
{
  
  $servername = "63.250.45.114";
    $username = "admin";
    $password = "Kranenr1pwp@_";
  $dbname = "freehosting";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  if(get_results_from_database($ip) == false)
  {
  
    $sql = "INSERT INTO ips_and_block_time (ip, begin_time_of_block) VALUES ('$ip', '$time')";


    if ($conn->query($sql) === TRUE) {

    } else {

    }

    $conn->close();
  }
}



function Delete_User_From_Database($ip)
{
  $servername = "63.250.45.114";
    $username = "admin";
    $password = "Kranenr1pwp@_";
  $dbname = "freehosting";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  
  
  $sql = "DELETE FROM ips_and_block_time WHERE ip='$ip'";
    if ($conn->query($sql) === TRUE) {
  } else {
  }

    $conn->close();
  
}


function check_If_IP_is_blocked($ip, $time)
{

  if(get_results_from_database($ip) == null) {return;}

  $user_db_time = get_results_from_database($ip)['begin_time_of_block'];



  if( get_results_from_database($ip)['begin_time_of_block']){
    if($time - $user_db_time > 900)
    {
      Delete_User_From_Database($ip);
    }


    if($time - $user_db_time < 900)
    {
	echo  $time - $user_db_time;
        header("location:/");
        die();
    }


    
  }


}

/* check for blocked ips  */
check_If_IP_is_blocked($client_ip, $current_Time);


/* log ips */
LogIp($client_ip, $current_Time);




require_once './deps/Extractor.class.php';

function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}


$currentRandomDir = 'uploads/'.generateRandomString();

mkdir("$currentRandomDir");


$target_dir = $currentRandomDir."/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {

  Increment_views();

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    echo "cd $target_dir && python3 ../../unzip.py " . $_FILES["fileToUpload"]["name"];
    system("cd $target_dir && python3 ../../unzip.py " . $_FILES["fileToUpload"]["name"]);

    system("python3 check_for_malicious_0x00001209d99ww99g99gh999.py $target_dir");

  } else {
    echo "failed";
  }
}


header("location:$target_dir");





?>

