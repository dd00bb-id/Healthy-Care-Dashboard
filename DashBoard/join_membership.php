
<form method="POST" action="./DBInsert.php">

<html lang="ko">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 
    <meta charset="utf-8">
    <style>
        body {
            background-color: #bdbcb9;
            font-family: 'Tahoma', sans-serif;
        }
        .box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 60px 80px;
            background-color: #ffffff;
            border: 3px solid #cac7c3;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        h2 {
            color: #000000;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 24px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            height: 50px;
            font-size: 15px;
            border: 1px solid #958f87;
            border-radius: 10px;
            padding-left: 15px;
            margin-bottom: 25px;
            background-color: rgb(240, 240, 240);
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #918b8b;
        }
        input[type="submit"] {
            width: 100%;
            height: 50px;
            font-size: 18px;
            background-color: #4c5660;
            color: white;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #8e9399;
        }
       
    </style>
</head>

<body>
    <div class="box">
        <h2>회원가입</h2>
        <input type="text" name="userName" placeholder="이름 입력" required />
        <br>
        <input type="text" name="userId" placeholder="아이디 입력" required />
        <br>
        <input type="password" name="userPw" placeholder="비밀번호 입력" required />
        <br>
        <input type="submit" value="가입하기"><br>
        </form>
    </div>
</body>
</html>