<?php
class Tasks extends Framework {

    function index() {
        //attempt to fetch tasks

        if(isset($_SESSION['success_msg'])) {
            $data['success_msg'] = $_SESSION['success_msg'];
            unset($_SESSION['success_msg']);
        }

        $Mdl_tasks = new Mdl_tasks();
        $data['tasks'] = $Mdl_tasks->fetch_all_tasks();
        $this->view('tasks_home', $data);
    }

    function create() {
        $update_id = (int) segment(3);

        if (isset($_SESSION['errors'])) {
            $data['errors'] = $_SESSION['errors'];
        }

        if ((!isset($_POST['submit'])) && ($update_id>0)) {
            //fetch the task title from the database
            $Mdl_tasks = new Mdl_tasks();
            $task_record = $Mdl_tasks->read_task($update_id);
            $data['task_title'] = $task_record['task_title'];
        } else {
            $data['task_title'] = (isset($_POST['task_title'])) ? $_POST['task_title'] : '';
        }
      
        $data['form_location'] = BASE_URL.'tasks/submit';

        if ($update_id>0) {
            $data['form_location'].= '/'.$update_id;
        }

        $data['update_id'] = $update_id;
        $data['headline'] = ($update_id>0) ? 'Update Record' : 'Create Record';
        $this->view('tasks_create', $data);
    }

    function submit() {
        $update_id = segment(3, 'int');
        $finish_url = BASE_URL.'tasks';
        $submit = $_POST['submit'];

        $Mdl_tasks = new Mdl_tasks();

        if($submit === 'Delete') {
            //delete the task
            $Mdl_tasks->delete_task($update_id);
            $_SESSION['success_msg'] = 'The task was successfully deleted';
            redirect($finish_url);
        }

        $task_title = trim($_POST['task_title']);
        $task_title_len = strlen($task_title);

        if($task_title_len<3) {
            $errors[] = 'The task title must be greater than two characters';
        }

        if (isset($errors)) {
            $_SESSION['errors'] = $errors;
            $this->create();
        } else {

            if ($update_id>0) {
                $Mdl_tasks->update_task($update_id, $task_title);
                $_SESSION['success_msg'] = 'The task was successfully updated';
            } else {
                $Mdl_tasks->insert_task($task_title);
                $_SESSION['success_msg'] = 'The task was successfully added';
            }

            redirect($finish_url);
        }
    }

}