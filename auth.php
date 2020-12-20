<?php
    session_start();
   
    class Authentication {
        function __construct() {
            $this->authenticate();
        }

        public function authenticate() {
            $request = file_get_contents('php://input');
            $array = json_decode($request,true);
            $url = 'api url here?username='. $array['username'] .'&password=' . $array['password'];
        
            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST'
                )
            );
            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            $login = json_decode($result, true);
        
            if ($login['login']) {
                $_SESSION["userName"] = $array["username"];
                echo "true";
            } else {
                echo "false";
            }
        }
    }
  
    $userAuth = new Authentication();
?>
