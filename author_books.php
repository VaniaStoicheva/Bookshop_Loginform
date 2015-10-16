<?php
session_start();
$title='Книги от автор';
include 'include/header.php';

if(isset($_GET['author_id'])){
    $author_id=(int)$_GET['author_id'];
        if(!idAuthorExist($link, $author_id)){
         $q=  mysqli_query($link, 
           'SELECT * FROM `books_authors` as ba '
                . 'INNER JOIN books as b ON ba.book_id=b.book_id '
                . 'INNER JOIN books_authors as bba ON bba.book_id=ba.book_id '
                . 'INNER JOIN authors as a ON bba.author_id=a.author_id  where ba.author_id='.$author_id);
            if(mysqli_error($link)){
                echo 'Невалидно име на автор!';
            echo mysqli_error($link);
        }
        echo '<div><table border="1"><tr><th>Книга</th><th>Автори</th></tr>';
        $rezult=array();
        while($row=  mysqli_fetch_assoc($q)){
         $rezult[$row['book_id']]['book_name']=$row['book_name'];
         $rezult[$row['book_id']]['authors'][$row['author_id']]=$row['author_name'];
            }
        foreach ($rezult as $book_id=>$row){
            echo '<tr><td><a href="book.php?book_id='.$book_id.'">'.$row['book_name'].'</a></td><td>';
            $data=array();
        foreach ($row['authors'] as $key=>$rows){
            $data[]='<a href="author_books.php?author_id='.$key.'">'.$rows.'</a>';
        }
        echo implode(' ,', $data);
        }
        echo '</td></tr></table></div>';
    }
    else{
            echo '<p>Невалиден автор</p>';
      }
}else{
    header('Location:index.php');
    exit;
}
?>
<div><a href="index.php">Списък книги</a></div>
<div><a href="newAuthor.php">Нов автор</a>
    <a href="newBook.php">Нова книга</a></div>
 <?php
include 'include/footer.php';
        
