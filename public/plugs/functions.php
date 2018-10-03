<?php
    function email_exist($connection, $user_email)
    {
        // $conz = new PDO('mysql:host=localhost;dbname=zeepay_rem', 'root', 'root');
        $maili = $connection->prepare("SELECT * FROM users WHERE email = ? ");
        $maili->execute(array($user_email));
        $maili_num = $maili->rowCount();

        return $maili_num;
    }

    function user_check_valid($connection, $user_email, $user_pass)
    {
        $maili = $connection->prepare("SELECT * FROM users WHERE email = ? and passcode = ? ");
        $maili->execute(array($user_email, $user_pass));
        $maili_num = $maili->rowCount();

        return $maili_num;
    }
    

    function passcode_crypt($passcode)
    {
        $one = md5($passcode);
        $two = sha1($one);
        $finall = crypt($two,'muahahah');
        return $finall;
    }
?>