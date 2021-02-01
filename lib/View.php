<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title></title>

    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Task</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signin.php">Log in</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Register</a>
        </li>
      </ul>
    </div>
  </nav>

<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);


if (isset($_GET['pageno'])) {

  $pageno = $_GET['pageno'];
} else {

  $pageno = 1;
}

$size_page = 4;

$offset = ($pageno-1) * $size_page;

$count_sql = "SELECT COUNT(*) FROM tasks";

$res = $mysqli->query($count_sql);

$total_rows = $res->fetch_array()[0];

$total_pages = ceil($total_rows / $size_page);

$new_sql = "SELECT * FROM tasks LIMIT $offset, $size_page";

$res_data = $mysqli->query($new_sql);

while($crow = $res_data->fetch_array()){

?>

  <div class="wrapper">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="page-header clearfix">
                      <h2 class="pull-left">Tasks Details</h2>
                <a href="http://localhost:8888/MVC-tasks/views/create_view.php" class="btn btn-success pull-right">Add New Task</a>
                  </div>
             <?php
                  require_once "config/config.php";
                          echo "<table class='table table-bordered table-striped'>";
                              echo "<thead>";
                                  echo "<tr>";
                                      echo "<th>#</th>";
                                      echo "<th>Name</th>";
                                      echo "<th>E-mail</th>";
                                      echo "<th>Task</th>";
                                      echo "<th>Action</th>";
                                  echo "</tr>";
                              echo "</thead>";
                              echo "<tbody>";
                             while($crow = $res_data->fetch_array()){
                                  echo "<tr>";
                                      echo "<td>" . $crow['id'] . "</td>";
                                      echo "<td>" . $crow['name'] . "</td>";
                                      echo "<td>" . $crow['email'] . "</td>";
                                      echo "<td>" . $crow['task'] . "</td>";
                                      echo "<td>";
                                          echo "<a href='http://localhost:8888/MVC-tasks/views/read_view.php?id=". $crow['id'] ."' title='View Task' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                          echo "<a href='http://localhost:8888/MVC-tasks/views/update_view.php?id=". $crow['id'] ."' title='Update Task' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                          echo "<a href='http://localhost:8888/MVC-tasks/views/delete_view.php?id=". $crow['id'] ."' title='Delete Task' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                      echo "</td>";
                                  echo "</tr>";
                              }
                              echo "</tbody>";
                          echo "</table>";
                }
                  ?>
              </div>
          </div>
      </div>
  </div>

  <ul class="pagination" style="position: relative; left: 600px;">
      <li><a href="?pageno=1">First</a></li>
      <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
          <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
      </li>
      <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
          <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
      </li>
      <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
  </ul>

</body>
<footer>

</footer>
</html>
