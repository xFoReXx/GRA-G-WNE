<?php
    if(isset($_REQUEST['action']) && isset($_REQUEST['email']) && isset($_REQUEST['password']))
    {
            $action = $_REQUEST['action'];
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];

            $db = new mysqli('localhost', 'root', '','registerandlogin');
            if ($db->errno)
            {
                throw new RuntimeException('mysqli connection error: ' . $db->error);
            }
            
            if($action == 'register')
            {
                $query = $db->prepare("INSERT INTO user (id, email, password) VALUES (NULL, ?, ?)");
                $query->bind_param('ss', $email, $password);
                $result = $query->execute();
                if($result)
                {
                    echo "konto utworzono poprawnie.";
                }
                else
                {
                    echo "błąd podczas tworzenia konta";
                }
            }
        }
    ?>
    