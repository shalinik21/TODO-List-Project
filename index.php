<?php
//Connecting to database
  $servername="localhost";
  $username="root";
  $password="";
  $database="notes";

  // INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES ('1', 'Go to buy Milk', 'Hey Shalini,Go and buy milk and once done delete this note.', current_timestamp());

  //create a connection
  $conn=mysqli_connect($servername,$username,$password,$database);
  if(!$conn){
    die("Sorry we failed to connect: ".mysqli_connect_error());
    
  }

  if($_SERVER['REQUEST_METHOD']=='POST'){
    $title=$_POST["title"];
    $description=$_POST["description"];

    //sql query to be executed
    $sql="INSERT INTO `notes` (`title`,`description`) VALUES('$title','$description')";
    $result=mysqli_query($conn,$sql);

    if($result){
      echo "Record has been successfully inserted <br>";
    }
    else{
      echo "Record has not been successfully inserted <br>";

    }
  }
  // else{
  //   echo "Connection was successful<br>";
  // }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>myNotes - Easy notes taking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">myNotes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
          <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact Us</a>
            </li>
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Link
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" aria-disabled="true">Link</a>
            </li> -->
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>

    <div class="container my-4 ">
      <h2>Add a note</h2>
      <form action="/CRUD/index.php" method="POST">
        <div class="form-group">
          <label for="title">Note Title</label>
          <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
          <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
        </div>
        <div class="form-group">
          <label for="desc" class="form-label">Note Description</label>
          <!-- <input type="password" class="form-control" id="exampleInputPassword1"> -->
          <div class="mb-3">
            <!-- <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label> -->
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div>
        </div>
      
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <div class="container">
       
        <!-- 
          inside php://$sql = "SELECT * FROM `notes`";
        //$result = mysqli_query($conn,$sql);
        //while($row=mysqli_fetch_assoc($result)){
          //echo $row['sno'].".Hello".$row['title']."Desc is".$row['description'];
          //echo "<br>";
        //} -->
      
      <table class="table">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
          echo "<tr>
            <th scope='row'>". $row['sno'] ."</th>
            <td>". $row['title'] ."</td>
            <td>". $row['description'] ."</td>
            <td>Actions</td>
          </tr>";
        }
        //   echo $row['sno'].".Hello".$row['title']."Desc is".$row['description'];
        //   echo "<br>";
        // }
      ?>
    
    
  </tbody>
</table>
    </div>
  </body>
</html>