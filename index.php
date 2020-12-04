<?php
session_start();
// unset ($_SESSION["userName"] );

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
            // echo '<script>document.getElementById("myForm").style.display = "none"; </script>'; 
            readfile($file_url);
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
  <form action="auth.php" method="post" class="form-container">
    <h1>Login</h1>

    <label for="email"><b>Username</b></label>
    <input type="text" placeholder="Enter UserName" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <input type="hidden" id="trackurl" name="url" >

    <button type="submit" class="btn" onClick="window.parent.location.reload();window.close()">Login</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

</body>
<script src="script.js"></script>

<script>
 function login(url) {
    var sessionValue = "<?php echo isset($_SESSION['userName']); ?>";
    checkSession(url, sessionValue); 
}
</script>

</html>