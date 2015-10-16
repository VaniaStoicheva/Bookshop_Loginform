<?php
        $title='Търсене';
        include 'include/header.php';
        ?>
<div><a href="index.php">Списък книги </a>
    <a href="newAuthor.php">Нов автор </a>
    <a href="newBook.php">Нова книга </a>
</div>
        <br/>
<div>
    <form method="get">
    <label>Търсене на книга по име:</label>
    <input type="text" name="book_name"/>
    <input type="submit" value="Търсене"/>
    </form>
</div>
<br/>
<?php
    if(isset($_GET['book_name'])){
    $book_name=trim($_GET['book_name']);
    $book_name=  mysqli_real_escape_string($link,$book_name);
    $q=mysqli_query($link,
            'SELECT * FROM `books` as b '
            . 'JOIN books_authors as ba ON b.book_id=ba.book_id '
            . 'JOIN authors as a ON a.author_id=ba.author_id '
            . 'WHERE book_name="'.$book_name.'"');
    if(mysqli_error($link)){
        echo 'грешка'.mysqli_error($link);
    }
    if(mysqli_affected_rows($link)){
        echo '<p>Търсената книга е открита</p>';
        $rezult=array();
        while($row=  mysqli_fetch_assoc($q)){
         $rezult[$row['book_id']]['book_name']=$row['book_name'];
         $rezult[$row['book_id']]['authors'][$row['author_id']]=$row['author_name'];
            }
        foreach ($rezult as $row){
            echo '<p>'.$row['book_name'].'=> с автори :';
            $data=array();
        foreach ($row['authors'] as $key=>$book){
            $data[]=$book;
        }
        echo implode(' ,', $data);
        }
        echo '</td></tr></table></div>';
    }

    else{
        echo '<p>Няма такава книга</p>';
    }
}
include 'include/footer.php';