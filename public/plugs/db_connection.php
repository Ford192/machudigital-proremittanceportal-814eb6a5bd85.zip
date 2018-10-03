<?php

    try {

        $do_connect = new PDO('mysql:host=localhost;dbname=zeepay_rem', 'remote_root', 'root');
        $do_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);;

        // foreach($dbh->query('SELECT * from FOO') as $row) {
        //     print_r($row);
        // }
        // $dbh = null;
        $my_connection = mysqli_connect('localhost','remote_root','root', 'zeepay_rem') or die();
    }
    catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

?>
