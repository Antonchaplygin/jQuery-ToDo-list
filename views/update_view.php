<?php
require_once "../config/config.php";
$name = $email = $task = "";
$name_err = $email_err = $task_err = "";

if(isset($_POST["id"]) && !empty($_POST["id"])){
$id = $_POST["id"];
$input_name = trim($_POST["name"]);
if(empty($input_name)){
$name_err = "Please enter a name.";
}elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
$name_err = "Please enter a valid name.";
}else{
$name = $input_name;
}

$input_email = trim($_POST["email"]);
if(empty($input_email)){
$email_err = "Please enter your e-mail.";
}else{
$email = $input_email;
}

$input_task = trim($_POST["task"]);
if(empty($input_task)){
$task_err = "Please enter a task.";
}elseif(!ctype_digit($input_task)){
$task_err = "Please enter a positive integer value.";
}else{
$task = $input_task;
}

if(empty($name_err) && empty($email_err) && empty($task_err)){
$sql = "UPDATE tasks SET name=?, email=?, task=? WHERE id=?";

if($stmt = $mysqli->prepare($sql)){
$stmt->bind_param("sssi", $param_name, $param_email, $param_task, $param_id);
$param_name = $name;
$param_email = $email;
$param_task = $task;
$param_id = $id;

if($stmt->execute()){
header("location: index.php");
exit();
}else{
echo "Something went wrong. Please try again later.";
}
}

mysqli_close($stmt);
}

mysqli_close($mysqli);

}else{

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
$id =  trim($_GET["id"]);
$sql = "SELECT * FROM tasks WHERE id = ?";

if($stmt = $mysqli->prepare($sql)){
$stmt->bind_param("i", $param_id);
$param_id = $id;

if($stmt->execute()){
$result = $stmt->get_result();

if($result->num_rows == 1){
$row = $result->fetch_array(MYSQLI_ASSOC);
$name = $row["name"];
$email = $row["email"];
$task = $row["task"];
}else{
header("location: error.php");
exit();
}
}else{
echo "Oops! Something went wrong. Please try again later.";
}
}
mysqli_close($stmt);
mysqli_close($mysqli);
}else{
header("location: error.php");
exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Task</h2>
                    </div>
                    <p>Please edit the input values and submit to update the task.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>E-mail</label>
                            <textarea name="email" class="form-control"><?php echo $email; ?></textarea>
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($task_err)) ? 'has-error' : ''; ?>">
                            <label>Task</label>
                            <input type="text" name="task" class="form-control" value="<?php echo $task; ?>">
                            <span class="help-block"><?php echo $task_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
