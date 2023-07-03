<?php 

try{

    $server_name = "localhost";
    $dbname = "blog";
    $dbuser = "root";
    $dbpassword ="";

    $dsn = "mysql:localhost=$server_name;dbname=$dbname";

    $conn = new PDO($dsn,$dbuser,$dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    


}catch(PDOException $e){

    echo "Connection Failed:" .$e->getMessage();



};

?>