<?php

$result="";
$resultClass="";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $name=trim($_POST['name']);
    $email=trim($_POST['email']);
    $message=trim($_POST['message']);

    if(empty($name) || empty($email) || empty($message)){
        $result="All fields are required!";
        $resultClass="error";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $result = "Invalid email format!";
        $resultClass="error";
    }else{
        $data="Name: $name | Email: $email | Message: $message".PHP_EOL;
        file_put_contents("contact_data.txt", $data, FILE_APPEND);
        
        $result = "Message sent successfully 😊";
        $resultClass = "success";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
       <style>
        body {
            background-color: #2f3640;
            font-family: Arial, sans-serif;
        }

        .form-box {
            width: 380px;
            margin: 100px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            height: 100px;
            resize: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #0984e3;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #74b9ff;
        }

        .success {
            color: green;
            text-align: center;
            font-weight: bold;
            margin-top: 10px;
        }

        .error {
            color: red;
            text-align: center;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-box">
    <h2>Contact Form</h2>

       <form method="post">
           <input type="text" name="name" placeholder="Enter your name">
           <input type="email" name="email" placeholder="Enter your email">
           <textarea name="message" placeholder="Enter your message"></textarea>
           <button type="submit">Submit</button>
       </form>

        <?php if ($result != "") { ?>
        <p class="<?php echo $resultClass; ?>">
            <?php echo $result; ?>
        </p>
    <?php } ?>
    </div>
</body>
</html>