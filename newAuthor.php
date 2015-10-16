<?php
session_start();
$title='Нов автор';
include 'include/header.php';
 ?>
<div><a href="index.php">Списък книги </a>
    <a href="newAuthor.php">Нов автор </a>
    <a href="newBook.php">Нова книга </a>
</div>
        <br/>
  <div><form method='post' action="">
            Автор: <input type="text" name="author_name"/>
            <input type="submit" value="Въведи"/>
        </form>
  </div>
<?php
 if(isset($_GET['author_id'])){
            $author_id=(int)$_GET['author_id'];
            $_SESSION['author_id']=$author_id;
            header('Location:author_books.php');
            exit;
        }
if($_POST){
     $author_name=trim($_POST['author_name']);
           
     if(mb_strlen($author_name)<3){
             echo '<p>Невалидно име на автора</p>';
        }else
            {
            $author_esc=  mysqli_real_escape_string($link,$author_name);
            if(authorExist($link, $author_esc)){
                echo '<p>Този автор вече съществува в БД.</p>';
            }
            else{
                if(insertAuthor($link, $author_esc)){
                echo '<p>Записа е успешен</p>';
                }
               }
            }
        }
       
$q=  mysqli_query($link,
            'SELECT * FROM authors');
        if(mysqli_errno($link)){
            echo mysqli_error($link);
        }
         $rezult=array();
        while($row=  mysqli_fetch_assoc($q)){
        $rezult[$row['author_id']]['author_id']=$row['author_id'];
        $rezult[$row['author_id']]['author_name']=$row['author_name'];
        }
    ?>
        <table border=1>
            <tr><th>Автори</th></tr>
            <?php
            
                foreach ($rezult as $key=>$value){
               echo '<tr><td><a href="author_books.php?author_id='.$key.'">'.$value['author_name'].'</a></td></tr>';
                    }
                    
                ?>
        </table>
<?php
         include 'include/footer.php';
        ?>

