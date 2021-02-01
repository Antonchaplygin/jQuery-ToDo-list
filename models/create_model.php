<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require "../lib/Model.php";

class Show_Model extends Model {

  public function insert() {

            $sql = "INSERT INTO tasks (name, email, task) VALUES (?, ?, ?)";
            if($stmt = $this->db->prepare($sql)) {

            $stmt->bind_param("sss",$param_name, $param_email, $param_task);
            $param_name = $name;
            $param_email = $email;
            $param_task = $task;

            if($stmt->execute()) {
            header("location: index.php");
            exit();
            }else{
            printf("Ошибка: %s.\n", $stmt->error);
            }
            $stmt->close();
            $mysqli->close();
            }

        }
}

?>
