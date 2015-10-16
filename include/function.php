<?php
$link=  mysqli_connect("localhost","root","");
if($link===false){
    echo "Error connecting to MYSQ Server";
    exit;
}
 if(mysqli_select_db($link,"books_login")===false){
     echo "No connected to db";
     exit;
}
mysqli_set_charset($link, 'utf8');
mb_internal_encoding('UTF-8');

function insertAuthor($link,$author_esc){
    $q=  mysqli_query($link,
            'INSERT INTO authors (author_name) VALUE ("'.$author_esc.'")');
    if(mysqli_error($link)){
        echo mysqli_error($link);
    }
    
    return true;
}

function authorExist($link,$author_esc){
    $q=  mysqli_query($link,
            'SELECT * FROM authors WHERE author_name="'.$author_esc.'"');
    if(mysqli_error($link)){
        echo mysqli_error($link);
    }
    if(mysqli_num_rows($q)>0){
        return true;
    }
}
function getAllAuthors($link){
    $q=  mysqli_query($link,
            'SELECT * FROM authors');
    if(mysqli_error($link)){
        echo mysqli_error($link);
    }
    $rezult=array();
    while($row=mysqli_fetch_assoc($q)){
        $rezult[]=$row;
    }
    return $rezult;
}
function idAuthorExist($link,$ids){
    if(!is_array($ids)){
        return false;
    }
    $q=  mysqli_query($link,
            'SELECT * FROM authors WHERE author_id IN('.  implode(',', $ids).')');

    if(mysqli_error($link)){
       return false;
    }
    if(mysqli_num_rows($q)==count($ids)){
        return true;
    }
    return false;
}
function isUserExist($link,$username){
    $q=  mysqli_query($link,
            'SELECT * FROM users WHERE username="'.$username.'"');
    if(mysqli_error($link)){
        echo mysqli_error($link);
    }
    if(mysqli_num_rows($q)>0){
        return true;
    }
}
function isUserPassExist($link,$username,$pass){
    $q=  mysqli_query($link,
            'SELECT * FROM users WHERE username="'.$username.'" AND pass="'.$pass.'"' );
    if(mysqli_error($link)){
        echo mysqli_error($link);
    }
    if(mysqli_num_rows($q)>0){
        return true;
    }
}
    function getListBooks($link,$order){
        $q=  mysqli_query($link,
        'SELECT * FROM authors 
        JOIN books_authors as ba ON authors.author_id=ba.author_id 
        JOIN books ON books.book_id=ba.book_id ORDER BY books.book_name '.$order.'');
      if(mysqli_error($link)){
          echo mysqli_error($link);
       }
        $rezult=array();
    while($row=mysqli_fetch_assoc($q)){
        $rezult[]=$row;
    }
    return $rezult;
}
function getUsernameById($link,$user_id){
        $q=  mysqli_query($link,
        'SELECT username FROM users 
       WHERE user_id= '.$user_id.'');
      if(mysqli_error($link)){
          echo mysqli_error($link);
       }
        if(mysqli_num_rows($q)>0){
            $row=  mysqli_fetch_assoc($q);
        }
    return $row;
}
function getCountComments($link,$book_id){
    $q=  mysqli_query($link,
            'SELECT count(counter) FROM comments WHERE book_id='.$book_id);
    if(mysqli_error($link)){
        echo mysqli_error($link);
    }
    if(mysqli_num_rows($q)>0){
    $count=  mysqli_fetch_assoc($q);
    }
    return $count;
}