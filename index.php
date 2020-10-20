<!DOCTYPE html>
<lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, viewport-fit=cover"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Anonymous Website Hosting</title>
    <link rel="shortcut icon" href="img/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
<?php

function get_view_count()
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

    $sql = "SELECT * FROM views_table";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      return $row['total_views'];            

    }
    } else {
    
      return false;
    }
    $conn->close();
}  


 ?>
    <!-- Navigation bar -->
    <div id="navigation-sticky">
      <nav class="navbar navbar-dark navbar-expand-lg sticky-top">
        <div class="container">
          <a href="index.html" class="navbar-brand"><img src="logo.png" alt="LogoPlaceholder" title="Logo"/></a>
            <!--placeholder for ip-->
	  <p class="lead2">Total Uploads: <?php echo get_view_count(); ?> </p>
          <a href="#" target="_blank" class="btn btn-outline-dark btn-md">Donate</a>
        </div>
      </div>
    </nav>
    <!-- Main view -->
    <div class="main-view">
    <div class="col-12 text-center mt-5">
      <h1 class="display-4 pt-4">Anonymous Website Hosting</h1>
      <div class="border-top border-dark w-75 mx-auto my-3"></div>
      
      <p class="main-view-p"><b>Why should you choose anonymous website hosting?</b></p>
      <p class="main-view-p"><b>No IP logs</b> are being kept after the <b>checks</b> have been made</p>
      <p class="main-view-p">Your code gets ran <b>on the server</b>, be it php or html which lets you <br>present your
        work to the world without the need to host your own website
      </p>
      <p class="main-view-p"> Your code is hosted for <b>5 minutes</b> and then you need to wait <b>10 minutes</b> to post
        something again </p>
      <p class="main-view-p"> Your file gets uploaded <b>via a proxy</b> so your ISP never knows what you uploaded, only 
        that you visited this website* <a style="color:red">WIP</a> </p>
      
      
      
      
    </div>
    <!-- Upload Form -->
     <div class="container mt-5">
      <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="row py-4">
          <div class="col-md-6 my-lg-auto">

            <label class="btn btn-outline-dark btn-md main-view-btn-load" type="file" name="fileToUpload" id="fileToUpload">
              <input type="file" name="fileToUpload" id="fileToUpload" style="display: none;">
              Choose File
            </label>
          </div>
          <div class="col-md-6 my-lg-auto">
            <button type="submit" value="Upload Image" name="submit" class="btn btn-outline-dark btn-md main-view-btn-upload">Upload File</button>
          </div>
            
        </div>
      </form>  
      </div>
    </div>

    <!-- Start Footer -->
    <footer class="main-footer">
      <div class="container">
        <div class="row justify-content-center text-center ">
          <div class="col-md-9">
            <img src="logoX.png" alt="LogoPlaceholder" style="max-width: 250px; margin:1rem 0">
          </div>
        </div>
      </div>
    </footer>

    <!-- End Footer -->
  </body>

</html>
