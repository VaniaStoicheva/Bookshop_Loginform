 <?php
 session_start();
$title='Вход';
include 'include/header.php';
require 'include/password.php';

if(isset($_GET)&& isset($_GET['username']) && isset($_GET['pass'])){
    
    $username=trim($_GET['username']);
    $pass=trim($_GET['pass']);
    $error=array();
    if(mb_strlen($username)<3){
        $error[]='<p>Името е прекалено късо</p>';
    }
    if(mb_strlen($pass)<3){
        $error[]='<p>Паролата е прекалено къса</p>';
    }
    if(count($error)>0){
        foreach ($error as $er){
            echo $er;
        }
    }
    else{
        $pass=mysqli_real_escape_string($link,$pass);
        $username=  mysqli_real_escape_string($link,$username);
        $q=  mysqli_query($link,
        'SELECT * FROM users WHERE username="'.$username.'"');
        if(mysqli_error($link)){
             echo mysqli_error($link);
                }
        if(mysqli_num_rows($q)>0){
            $row=mysqli_fetch_assoc($q);
            $user_id=$row['user_id'];
            $pass_hash=$row['pass'];
           
            if(password_verify($pass, $pass_hash)){
                  $_SESSION['user_id']=$user_id;
                  $_SESSION['isLoged']=true;
                  $_SESSION['username']=$username;
                  header('Location:index.php');
                  exit;   
                }else{
                    echo '<p>Грешна парола</p>';
                }
      
        }else{
      
            echo '<p>Грешно потребителско име</p>';
    }
}
}
?>
<form method="get">
    <div><label>Име:</label>
        <input type="text" name="username"/></div>
    <div><label>Парола:</label>
    <input type="password" name="pass"/></div>
<div><input type="submit" value="Вход"/></div>
</form>
<br/>
<div><a href="register.php">Регистрация</a></div>
<?php
include 'include/footer.php';






      
