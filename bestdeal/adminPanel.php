<?php
session_start();
if(isset($_SESSION['email']) && $_SESSION['email']!="admin@admin.com"){
    header("location:index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- datatables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>


    <title>Contacter</title>
</head>

<body>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="form-group">
                            <label for="title">link</label>
                            <input type="text" class="form-control" id="linkEdit" name="linkEdit" aria-describedby="emailHelp">
                        </div>
                        
                        <div class="form-group">
                            <label for="title">page</label>
                            <input type="number" min=0 class="form-control" id="pageEdit" name="pageEdit" aria-describedby="emailHelp">
                        </div>

                        <div class="form-group">
                            <label for="title">category</label>
                            <input type="text" class="form-control" id="cateEdit" name="cateEdit" aria-describedby="emailHelp">
                        </div>

                        <div class="form-group">
                            <label for="title">source</label>
                            <input type="text" class="form-control" id="sourceEdit" name="sourceEdit" aria-describedby="emailHelp">
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  
    <?php
    include 'partials/_nav.php';
    include 'partials/dbcon.php';
  
    if (!$con) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Sorry!!</strong> Connection failed
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
    }
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $delete = true;
        $sql = "DELETE FROM `scapinglink` WHERE `scapinglink`.`id` = $id";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Congratulation!</strong> Data has been deleted
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry!!</strong> Data has not been be deleted!!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (isset($_POST['snoEdit'])) {
            extract($_POST);
            
            // Update the record
            // Sql query to be executed
            $sql = "UPDATE `scapinglink` SET `url` = '$linkEdit', `page` = '$pageEdit', `cate` = '$cateEdit', `source` = '$sourceEdit' WHERE `scapinglink`.`id` = $snoEdit;";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $update = true;
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Congratulation!</strong> Data has been updated
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
            } else {
                echo "We could not update the record successfully" . mysqli_error($con);
            }
        } else {
            //getting data from form
            extract($_POST);
            // echo $link.$cate;
            $sql = "INSERT INTO `scapinglink` (`id`, `url`, `page`, `cate`, `date`, `source`) VALUES (NULL, '$link', '$page', '$cate', current_timestamp(), '$source');            ";
            $result =  mysqli_query($con, $sql);
            if ($result) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Congratulation!</strong> Data has been inserted
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sorry!!</strong> Connection failed!!!Something went wrong WE are on mantaianace
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>' . mysqli_error($con);
            }
        }
    }
    ?> 


    <div class="container mt-4">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h2>Add Link</h2>

            <div class="form-group">
                <label for="title">Link of website</label>
                <input type="text" name="link" class="form-control" id="title" aria-describedby="title" placeholder="Enter the link of the websile">
                <small id="title" class="form-text text-muted"></small>
            </div>

            <div class="form-group">
                <label for="title">Total page Number</label>
                <input type="number" min=0 name="page" class="form-control" id="title" aria-describedby="title" placeholder="Enter total number of page">
                <small id="title" class="form-text text-muted"></small>
            </div>

            <div class="form-group">
                <label for="title">category</label>
                <input type="text" name="cate" class="form-control" id="title" aria-describedby="title" placeholder="Enter the category for eg:-smartphone,printer,clothes etc.....">
                <small id="title" class="form-text text-muted"></small>
            </div>

            <div class="form-group">
                <label for="title">Source</label>
                <input type="text" name="source" class="form-control" id="title" aria-describedby="title" placeholder="Enter the source for eg:-daraz,thulo,sastodeal etc.......">
                <small id="title" class="form-text text-muted"></small>
            </div>
                
            <button type="submit" class="btn btn-primary mb-4">Submit</button>
        </form>
    </div>
    <div class="container">

        <table class="table mt-3" id="myTable">
            <thead>
                <tr class="bg-dark text-white">
                    <th scope="col">sn</th>
                    <th scope="col">link</th>
                    <th scope="col">page</th>
                    <th scope="col">category</th>
                    <th scope="col">source</th>
                    <th scope="col">date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `scapinglink`";
                $result = mysqli_query($con, $sql);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    echo "<tr>
            <th scope='row'>" . $sno . "</th>
            <td>" . $row['url'] . "</td>
            <td>" . $row['page'] . "</td>
            <td>" . $row['cate'] . "</td>
            <td>" . $row['source'] . "</td>
            <td>" . $row['date'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=" . $row['id'] . ">Edit</button> 
            <button class='delete btn btn-sm btn-primary' id=d" . $row['id'] . ">Delete</button>  </td>
          </tr>";
                }
                ?>

        </table>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <!-- for the datatable -->
    <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ,e.target.parentNode.parentNode");
                tr = e.target.parentNode.parentNode;
                link = tr.getElementsByTagName("td")[0].innerText;
                page = tr.getElementsByTagName("td")[1].innerText;
                cate = tr.getElementsByTagName("td")[2].innerText;
                source = tr.getElementsByTagName("td")[3].innerText;

                console.log(link , cate ,source ,page);
                linkEdit.value = link;
                cateEdit.value = cate;
                snoEdit.value = e.target.id;
                sourceEdit.value = source;
                pageEdit.value = page;
                
                // console.log(e.target.id)
                $('#editModal').modal('toggle');
            })
        })

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ");
                sno = e.target.id.substr(1);
                console.log(sno);


                if (confirm("Are you sure you want to delete this note!")) {
                    console.log(sno);
                    window.location = `adminsPanel.php?delete=${sno}`;
                    // TODO: Create a form and use post request to submit a form
                } else {
                    console.log("no");
                }
            })
        })
    </script>
</body>

</html>