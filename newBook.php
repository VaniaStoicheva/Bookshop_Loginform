<?php
        $title='Книги';
        include 'include/header.php';
        ?>
<div><a href="index.php">Списък книги </a>
    <a href="newAuthor.php">Нов автор </a>
    <a href="newBook.php">Нова книга </a></div>
        <br/>
        <?php
        if($_POST ){
            $book_name=trim($_POST['book_name']);
            if(!isset($_POST['authors'])){
                $_POST['authors']='';
            }
            $authors=$_POST['authors'];
            $error=array();
            if(mb_strlen($book_name)<3){
                $error[]= '<p>Името е прекалено късо!</p>';
            }
            if(!is_array($authors) || count($authors)===0){
                $error[]='<p>Невалидни автори<p>';
            }
            
            if(!idAuthorExist($link, $authors)){
                    $error[]='<p>Невалиден автор</p>';
                }
            
            if(count($error)>0){
                foreach ($error as $er){
                    echo '<p>'.$er.'</p>';
                }
            }
            else{
                $book_name=  mysqli_real_escape_string($link,$book_name);
                mysqli_query($link,
                        'INSERT INTO books (book_name) VALUE ("'.$book_name.'")');
                if(mysqli_error($link)){
                    echo mysqli_error($link);
                }
                $id=  mysqli_insert_id($link);
                foreach ($authors as $author_id){
                mysqli_query($link,
                        'INSERT INTO books_authors (book_id,author_id) VALUE ('.$id.','.$author_id.')');
                if(mysqli_error($link)){
                    echo 'error';
                }
            }
            echo '<p>Книгата е добавена</p>';
        }
        }   
$authors=  getAllAuthors($link);
        if($authors===false){
            echo 'грешка';
        }
 ?>

<form method="post">
    <div><input type='text' name='book_name'/></div>
    <div><select name='authors[]' multiple style="width:200">
        <?php
        foreach ($authors as $author){
        echo '<option value="'.$author['author_id'].'">'.$author['author_name'].'</option>';
        }
        ?>
        </select></div>
    <div> <input type='submit' value='Въведи новата книга'/></div>
</form>

        <?php
               
        include 'include/footer.php';
        