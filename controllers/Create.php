<?php
require_once "../config/config.php";
require_once "../models/create_model.php";
$name = $email = $task = "";
$name_err = $email_err = $task_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
$input_name = trim($_POST["name"]);
if(empty($input_name)){
$name_err = "Please enter a name.";
}elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
$name_err = "Please enter a valid name.";
}else{
$name = $input_name;
}

$email_address = trim($_POST["email"]);
if(empty($email_address)){
$email_err = "Please enter an address.";
}else{
$email = $email_address;
}

$input_task = trim($_POST["task"]);
if(empty($input_task)){
$task_err = "Please enter the task amount.";
}elseif(!ctype_digit($input_task)){
$task_err = "Please enter a positive integer value.";
}else{
$task = $input_task;
}


if(empty($name_err) && empty($email_err) && empty($task_err)){
$result = new Show_Model();
 $result->insert();
}
}
?>
