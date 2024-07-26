<?php
//Connecting to database
$insert = false;
$update= false;
$delete= false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

// INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES ('1', 'Go to buy Milk', 'Hey Shalini,Go and buy milk and once done delete this note.', current_timestamp());

//create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
  die("Sorry we failed to connect: " . mysqli_connect_error());

}
// echo $_GET['update'];
// echo $_POST['snoEdit'];
// exit();

if(isset($_GET['delete'])){
  $sno=$_GET['delete'];
  $delete=true;
  $sql="DELETE FROM `notes` WHERE `sno`= $sno";
  $result=mysqli_query($conn,$sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['snoEdit'])) {
    // echo "yes";
    // exit();
    //Update the record
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];

    //sql query to be executed
    $sql = "UPDATE `notes` SET `title`='$title' ,`description`='$description' WHERE `notes`.`sno`=$sno;";
    $result = mysqli_query($conn, $sql);
    if($result){
      $update=true;
    }

  } else {
    $title = $_POST["title"];
    $description = $_POST["description"];

    //sql query to be executed
    $sql = "INSERT INTO `notes` (`title`,`description`) VALUES('$title','$description')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      // echo "Record has been successfully inserted <br>";
      $insert = true;
    } else {
      echo "Record has not been successfully inserted <br>";

    }
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <title>myNotes - Easy notes taking in myNote App</title>

</head>

<body>

  <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Exit modal
</button> -->

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Edit this Note</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/CRUD/index.php" method="post">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="my-3">
              <h2>Add a Note</h2>
              <label for="title" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
              <div class="mb-3">
                <label for="desc" class="form-label">Notes Description</label>
                <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
              </div>
            </div>
            <!-- <div class="mb-3 form-check">
              </div> -->
            <!-- <button type="submit" class="btn btn-primary">Update Note</button> -->
          </div>
          <div class="modal-footer d-block mr-auto" >
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="/CRUD/logo.svg" height="28px" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
        aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
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

  <?php
  if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success </strong> Your note have been inserted successfully!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
  }
  ?>
  <?php
  if ($delete) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success </strong> Your note have been deleted successfully!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
  }
  ?>
  <?php
  if ($update) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success </strong> Your note have been updates successfully!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
  }
  ?>

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
  <div class="container" my-4>

    <!-- 
          inside php://$sql = "SELECT * FROM `notes`";
        //$result = mysqli_query($conn,$sql);
        //while($row=mysqli_fetch_assoc($result)){
          //echo $row['sno'].".Hello".$row['title']."Desc is".$row['description'];
          //echo "<br>";
        //} -->

    <table class="table" id="myTable">
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
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo "<tr>
            <th scope='row'>" . $sno . "</th>
            <td>" . $row['title'] . "</td>
            <td>" . $row['description'] . "</td>
            <td><button class='edit btn btn-sm btn-primary' id=" . $row['sno'] . "> Edit </button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button></td>
          </tr>";

        }



        //   echo $row['sno'].".Hello".$row['title']."Desc is".$row['description'];
        //   echo "<br>";
        // }
        ?>


      </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
  </div>
  <hr>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ",);
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');

      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ",);
       sno=e.target.id.substr(1,);

        
        if(confirm("Are you sure you want to delete this note!!")){
          console.log("yes");
          window.location=`/crud/index.php?delete=${sno}`;
          //TODO:Create a form and use post request to submit a form
        }
        else{
          console.log("No");
        }

      })
    })
  </script>
</body>

</html>