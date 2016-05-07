<!DOCTYPE html>
<html>
<head>
  <title>type diary</title>
    <link rel='stylesheet' href='style.css' />
  <style type="text/css">
       label{ width: 200px; vertical-align: top; text-align: right; display:inline-block; }
        textarea{width: 400px; height: 400px;}
  </style>
</head>
<body>
  <?php include 'connect.php'; ?>
  <?php include 'function.php'; ?>
  <?php include 'header.php';?>

  <div class='container'>
    <h3>Post a diary</h3>
    <form action="post_diary.php" method="post" enctype='multipart/form-data'>
        <label for="title">Title: </label>
        <input id="title" name="title" type="text" required></input>*<br/>

        <label for="text">Text: </label>
        <textarea name="text" required></textarea><br/>

        <label>Figure:</label>
        <input type="file" name="userfile1"></input><br/>

        <label>Multimedia:</label>
        <input type="file" name="userfile2"></input><br/>

        <label>Activity: </label>
        <select name="activity" required>
             <?php
                    if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
                    $query1 = "select * from activity";
                    $result = $conn->query($query1); 
                    while($row = $result->fetch_assoc()){
                    $name = $row['name'];
                    $aid = $row['a_id'];
                    echo "<option value='$aid'>".$aid." ".$name."</option>";
                    }
            ?>
        </select>
        <a href="activity.php">or create a new activity</a><br/>

        <label>Visibility: </label>
        <input type="radio" name="visibility" value="1" required>all</input>
        <input type="radio" name="visibility" value="2" required>FOF</input>
        <input type="radio" name="visibility" value="3" required>friend</input>
        <input type="radio" name="visibility" value="4" required>only me</input><br/>

        <input type="submit" name="submit" value="submit"></input>

    </form>
</body>
</html>