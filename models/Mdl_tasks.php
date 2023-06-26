<?php
class Mdl_Tasks {
    private $servername = HOST;
    private $username = USER;
    private $password = PASSWORD;
    private $dbname = DATABASE;
    private $conn;

    function __construct() {
        $servername = $this->servername;
        $username = $this->username;
        $password = $this->password;
        $dbname = $this->dbname;
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function insert_task($task_title) {
        $sql = "INSERT INTO tasks (task_title) VALUES ('$task_title')";

        if ($this->conn->query($sql) === TRUE) {
            return "New record created successfully";
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    function read_task($task_id) {
        $sql = "SELECT * FROM tasks WHERE id = $task_id";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $task = array(
                'id' => $row['id'],
                'task_title' => $row['task_title']
            );
            return $task;
        } else {
            return "No record found";
        }
    }

    function update_task($task_id, $task_title) {
        $sql = "UPDATE tasks SET task_title = '$task_title' WHERE id = $task_id";

        if ($this->conn->query($sql) === TRUE) {
            return "Record updated successfully";
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    function delete_task($task_id) {
        $sql = "DELETE FROM tasks WHERE id = $task_id";

        if ($this->conn->query($sql) === TRUE) {
            return "Record deleted successfully";
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    function fetch_all_tasks() {
        $sql = "SELECT * FROM tasks";
        $result = $this->conn->query($sql);
        $tasks = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $task = array(
                    'id' => $row['id'],
                    'task_title' => $row['task_title']
                );
                $tasks[] = $task;
            }
        }

        return $tasks;
    }

    function __destruct() {
        $this->conn->close();
    }
}