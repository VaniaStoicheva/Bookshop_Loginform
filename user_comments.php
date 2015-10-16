<?php
session_start();
$title='Потребител';
include 'include/header.php';

if($_GET['user_id']){
   $user_id=$_GET['user_id'];
 
   $user=  getUsernameById($link, $user_id);
    echo '<pre>Вие четете коментарите на :'.$user['username'].'</pre>';
    
    $q=  mysqli_query($link,
            'SELECT * FROM `comments` as c
    join users  on c.user_id=users.user_id
    join books as b on c.book_id=b.book_id
    where c.user_id='.$user_id);
    if(mysqli_error($link)){
        echo mysqli_error($link);
    }
    if(mysqli_affected_rows($link)==0){
        echo '<p>Няма коментари за тази книга</p>';
    }
    else{
    $rezult=  array();
    while ($row=  mysqli_fetch_assoc($q)){
    $rezult[$row['book_id']]['book_id']=$row['book_id'];
    $rezult[$row['book_id']]['book_name']=$row['book_name'];
    $rezult[$row['book_id']]['comments'][$row['date_time']]=$row['date_time'];
    $rezult[$row['book_id']]['comments'][$row['comments_id']]=$row['comment'];
    }
   
    foreach ($rezult as $row){
        echo '<p><a href="book.php?book_id='.$row['book_id'].'">'.$row['book_name'].'</a></p>';
   
        foreach ($row['comments'] as $rows){
            echo '<textarea rows="2" cols="100">'.$rows.'</textarea>';  
        }
    }
}
}
?>
<div><a href="logout.php">Изход</a></div>
<div><a href="index.php">Списък книги</a></div>
<?php
include 'include/footer.php';
