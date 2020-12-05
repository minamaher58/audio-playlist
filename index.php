<?php
session_start();
// unset ($_SESSION["userName"]);

interface Download {
    public function downloadFile();
}

class DownloadTrack implements Download {
    function __construct() {
     
        $this->downloadFile();
    }
    // Download Track
    public function downloadFile() {
        if(isset($_GET['file']))
        {
            $file_name = $_GET['file'];
            $file_url =  $file_name;
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: Binary"); 
            header("Content-disposition: attachment; filename=\"".$file_name."\"");
            readfile($file_url);
            exit;
        }
    }
}
$newFile = new DownloadTrack();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leap 13</title>
    <link href="css/style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/04d1f4c46c.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="form-popup" id="myForm">
  <div class="form-container">
    <h1>Login</h1>
    <p id="error"></p>
    <label for="username"><b>Username</b></label>
    <input type="text" id="username" placeholder="Enter UserName">

    <label for="password"><b>Password</b></label>
    <input type="password" id="password" placeholder="Enter Password">

    <input type="hidden" id="trackurl">

    <button  class="btn" onclick="login()">Login</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
   </div>
</div>

</body>

<script src="script.js"></script>
<script>
 getTracks();
 function download(url) {
    var sessionValue = "<?php echo isset($_SESSION['userName']); ?>";
    checkSession(url, sessionValue); 
}
</script>

</html>