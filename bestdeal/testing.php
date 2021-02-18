<?php
include('partials/dbcon.php');
$query='select * from comment';
$result= mysqli_query($con,$query);
if($result){
    while($row=mysqli_fetch_assoc($result)){
        echo '
        <div class="comment">
            <p id="commet">sfsdf on '.$row['commented_on'].'</p>
            <p id="'.$row['comment_id'].'">'.$row['comments'].'</p>
        <button onclick="edit('.$row['comment_id'].')">edit</button>
    </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>comment box</h1>
    <p id="comment">hfkdjshfkjhfuiehuih</p>
    <br>
    <button onclick="edit()">Edit</button>
    <script>
      function edit(a){
          
          var comments= document.getElementById(a).innerHTML;
            console.log(comments);
        
        document.write('<textarea name="comment"  id="textarea" cols="30" rows="10">'+a+'</textarea><b><button type="submit">update</button>');


  
    }
    </script>
</body>

</html>