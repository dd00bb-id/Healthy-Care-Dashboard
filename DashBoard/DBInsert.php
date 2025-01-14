
<?php
$conn = mysqli_connect('localhost', 'root', 'admin#2024');

$sql = "CREATE DATABASE IF NOT EXISTS Trumpcard";
mysqli_query($conn, $sql);
mysqli_select_db($conn, 'Trumpcard');

$sql = "CREATE TABLE IF NOT EXISTS USERDATA      (
    name VARCHAR(20) NOT NULL,
    uid VARCHAR(20) NOT NULL,
    password VARCHAR(20) NOT NULL,
    PRIMARY KEY (uid)
) DEFAULT CHARSET=utf8;";
mysqli_query($conn, $sql);
if (isset($_POST['userName'], $_POST['userId'], $_POST['userPw'])) {
    $userName = $_POST['userName'];
    $uid = $_POST['userId'];
    $userPw = $_POST['userPw'];

    $sql = "INSERT INTO USERDATA (name, uid, password) VALUES ('{$userName}', '{$uid}', '{$userPw}')";}
mysqli_query($conn, $sql);
echo "<meta http-equiv='refresh' content='3; url=./login.html'>", "<h1>회원 가입되었습니다.</h1>", "<h4>3초 뒤에 로그인 페이지로 이동합니다.</h4>";
?>