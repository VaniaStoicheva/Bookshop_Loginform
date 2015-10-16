
 <?php
session_start();
$title='Списък';
include 'include/header.php';
?>

<div><a href="newAuthor.php">Нов автор</a></div>
<div><a href="newBook.php">Нова книга</a></div>
<div><a href="search.php">Търсене на книга по име</a></div>
<br/>
<?php
if(isset($_SESSION['username'])){
    echo '<p>Здравей '.$_SESSION['username'].'</p>';
}
if(isset($_GET['order'])){
    $order=($_GET['order']=='asc')?'asc':'desc';
}

if(isset($_GET['author_id'])){
    $author_id=(int)$_GET['author_id'];
    $author_id=  mysqli_real_escape_string($author_id);
    $_SESSION['author_id']=$author_id;
    header('Location:author_books.php');
    exit;
}
if(!isset($_GET['order'])){
    $order='';
}
$q=  mysqli_query($link,
        'SELECT * FROM authors 
        JOIN books_authors as ba ON authors.author_id=ba.author_id 
        JOIN books ON books.book_id=ba.book_id 
       JOIN comments AS c ON books.book_id = c.book_id
        ORDER BY books.book_name '.$order.'');
      if(mysqli_error($link)){
          echo mysqli_error($link);
       }
      $neworder=($order=='asc')?'desc':'asc';
      
?>
<table border="1">
    <tr><th><a href="index.php?order=<?php echo $neworder;?>">Книга</a></th>
        <th><a href="index.php?order=<?php echo $neworder;?>">Автори</a></th>
        <th>Коментари</th></tr>
    <?php
$result=array();
while($row= mysqli_fetch_assoc($q)){
 $rezult[$row['book_id']]['book_name']=$row['book_name'];
 $rezult[$row['book_id']]['authors'][$row['author_id']]=$row['author_name'];
}

foreach ($rezult as $book_id=>$row){
     echo '<tr><td><a href="book.php?book_id='.$book_id.'">'.$row['book_name'].'</a></td>'
          . '<td>';
     $data=array();
          foreach ($row['authors'] as $author_id=>$value){
              $data[]='<a href="author_books.php?author_id='.$author_id.'">'.$value.'</a>';
          }
          echo implode(', ', $data);
          echo '</td>';
             $counter=  getCountComments($link, $book_id);
             $count=$counter['count(counter)'];
          echo '<td>'.$count.'</td></tr>';
}
  echo '</table><br/>';
  ?>
<div><a href="login.php">Вход</a></div>
<div><a href="register.php">Регистрация</a></div>
<div><a href="logout.php">Изход</a></div>
<?php
include 'include/footer.php';
        ?>
   
