
<?php
session_start();
$conn = mysqli_connect('localhost', 'root', 'admin#2024', 'Trumpcard');


$userId = $_POST['userId'];
$userPw = $_POST['userPw'];

$sql = "SELECT * FROM USERDATA WHERE uid = ?";
$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $userId);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($userPw == $row['password']) {
        $_SESSION['userName'] = $row['name'];
        header("Location: main.php");
        exit();
    } else {
        echo "<h1>아이디나 비밀번호가 잘못되었습니다.</h1>";
        echo "<meta http-equiv='refresh' content='3; url=./login.html'>", "<h4>3초 뒤에 로그인 페이지로 이동합니다.</h4>";
    }
} else {
    echo "<h1>아이디나 비밀번호가 잘못되었습니다.</h1>";
    echo "<meta http-equiv='refresh' content='3; url=./login.html'>", "<h4>3초 뒤에 로그인 페이지로 이동합니다.</h4>";
}

$stmt->close();
$conn->close();
?>
