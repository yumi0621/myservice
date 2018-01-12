<?php
$host = "localhost";
$user = "root";
$pw = "root";
$dbName = "myservice";

//각 테이블의 클래스 내에서 사용
if($this->dbConnection == null){
    $this->dbConnection = new mysqli($host, $user, $pw, $dbName);
    $this->dbConnection->set_charset("utf8");
}
?>