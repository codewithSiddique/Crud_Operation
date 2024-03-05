<?php
        $insert = false;
        $update = false;
        $delete = false;
        $server="localhost";
        $username="root";
        $password="";
        $database="iNotes";
        $con = mysqli_connect($server,$username,$password,$database);
        $insert = false;
        if(!$con){
          die("connection to the database has failed". mysqli_connect_error($con));
        }else{
          //echo"connection to the database has successed";
        };
        //delete record
        if(isset($_GET['delete'])){
          $N_Id = $_GET['delete'];
          $delete = true;
          $sql = "DELETE FROM `addnote` WHERE `N_Id` = $N_Id";
          $result = mysqli_query($con,$sql);
        }

        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          if(isset($_POST['N_IdEdit'])){
              //update record
              $N_Id=$_POST['N_IdEdit'];
              $Name = $_POST['nameEdit'];
              $Description = $_POST['descriptionEdit'];
              $sql = "UPDATE `addnote` SET `Name` = '$Name' , `Description` = '$Description' WHERE `N_Id` = $N_Id;";
              $result= mysqli_query($con,$sql);

              if($result){
                $update = true;
              }
              else{
               // echo "data has not submitted successfully" .mysqli_error($con);
              }
          } else {
              $name=$_POST['name'];
              $description=$_POST['description'];
              $sql = "INSERT INTO `addnote` ( `Name`, `Description`) VALUES ('$name', '$description');";
              $result= mysqli_query($con,$sql);
      
              if($result){
                  $insert = true;
              }
             
          }
      } else {
          echo "Data has not been submitted successfully" . mysqli_error($con);
      }
        
      
      ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css"></link>

  <title>P_Notes</title>

</head>

<body>
        <!-- Edit Modal -->
       <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
  Edit Modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Update Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- // forms -->

      <form action="index.php" method="POST">
        <input type="hidden" name="N_IdEdit" id="N_IdEdit">
      <div class="form-group">
        <label for="exampleInputName">Name</label>
        <input type="text" name="nameEdit" class="form-control" id="nameEdit">
      </div>
      <div class="form-group">
        <label for="exampleInputDescription">Description</label>
        <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>

      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <?php
  if($insert == true){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Congratulations! </strong> Data has inserted successfully.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
  }
?>

<?php
  if($update == true){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Congratulations! </strong> Data has updated successfully.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
  }
?>

<?php
  if($delete == true){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Congratulations! </strong> Data has been Deleted successfully.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
  }
?>



  <!-- Form is add -->
  <div class="container my-4">
    <h2>Add a Note</h2>
    <form action="index.php" method="POST">
      <div class="form-group">
        <label for="exampleInputName">Name</label>
        <input type="text" name="name" class="form-control" id="name">
      </div>
      <div class="form-group">
        <label for="exampleInputDescription">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>

      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

 </div>

  <div class="container">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S_ID</th>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

      <?php
    $sql = "SELECT * FROM `addnote`";
    $result = mysqli_query($con,$sql);
    $sid=0;
    while($row = mysqli_fetch_assoc($result)){
      $sid++;
      echo "<tr>
      <th scope='row'>".$sid."</th>
      <td>".$row['Name'] ."</td>
      <td>". $row['Description']."</td>
      <td> <button class='edit btn btn-sm btn-primary' id=".$row['N_Id'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['N_Id'].">Delete</button>  </td>
    </tr>";
    }

  ?>
    
      </tbody>
    </table>
  </div>




  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script>
      $(document).ready( function () {
    $('#myTable').DataTable();
} );
    // let table = new DataTable('#myTable');
    // </script>

  <!-- /Modal Edit function -->

     <script>
      // update javascript
      edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element)=>{
        element.addEventListener("click",(e)=>{
        console.log("edit");
        tr = e.target.parentNode.parentNode;
      //console.log(tr);
       name = tr.getElementsByTagName("td")[0].innerText;
        description= tr.getElementsByTagName("td")[1].innerText;
        console.log(name, description);
        nameEdit.value = name;
        descriptionEdit.value = description;
        N_IdEdit.value= e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');
        
      })
    })

   // delete javascript
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element)=>{
      element.addEventListener("click",(e)=>{
        console.log("deleted ");
        N_Id = e.target.id.substr(1);
        if(confirm("Are you sure you want to delete this Record")){
          console.log("Yes");
          window.location = `/CRUD_OPERATION/index.php?delete=${N_Id}`;
        }else{
          console.log("no");
        }
      })
    })
   

  </script>
</body>

</html>
