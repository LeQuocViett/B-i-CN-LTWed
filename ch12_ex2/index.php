<?php
// Bắt đầu session, sống 1 năm
$lifetime = 365 * 24 * 60 * 60;
session_set_cookie_params($lifetime, '/');
session_start();

// Nếu chưa có tasks thì khởi tạo
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = array();
}

$errors = array();
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'add':
        $new_task = filter_input(INPUT_POST, 'newtask');
        if (empty($new_task)) {
            $errors[] = 'The new task cannot be empty.';
        } else {
            $_SESSION['tasks'][] = $new_task;
        }
        break;

    case 'delete':
        $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
        if ($task_index === NULL || $task_index === FALSE) {
            $errors[] = 'The task cannot be deleted.';
        } else {
            unset($_SESSION['tasks'][$task_index]);
            $_SESSION['tasks'] = array_values($_SESSION['tasks']); // reset index
        }
        break;
}

include('task_list.php');
?>
