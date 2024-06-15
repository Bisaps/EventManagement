<?php
session_start();
require_once 'Json.class.php';
$db = new Json();

$redirectURL = 'index.php'; 

if (isset($_POST['eventSubmit'])) {
    $id = $_POST['id'];
    $title = trim(strip_tags($_POST['title']));
    $description = trim(strip_tags($_POST['description']));
    $participants = trim(strip_tags($_POST['participants']));
    $start_date = trim(strip_tags($_POST['start_date']));
    $end_date = trim(strip_tags($_POST['end_date']));

    $errorMsg = '';

    if (empty($title)) $errorMsg .= '<p>Please enter the title.</p>';
    if (empty($description)) $errorMsg .= '<p>Please enter the description.</p>';
    if (empty($participants)) $errorMsg .= '<p>Please enter the number of participants.</p>';
    if (empty($start_date)) $errorMsg .= '<p>Please enter the start date.</p>';
    if (empty($end_date)) $errorMsg .= '<p>Please enter the end date.</p>';

    if (empty($errorMsg)) {
        $eventData = array(
            'title' => $title,
            'description' => $description,
            'participants' => $participants,
            'start_date' => $start_date,
            'end_date' => $end_date
        );

        if (!empty($id)) {
            $db->update($eventData, $id);
            $_SESSION['status']['type'] = 'success';
            $_SESSION['status']['msg'] = 'Event data has been updated successfully.';
        } else {
            $db->insert($eventData);
            $_SESSION['status']['type'] = 'success';
            $_SESSION['status']['msg'] = 'Event data has been added successfully.';
        }

        $redirectURL = 'index.php';
    } else {
        $_SESSION['status']['type'] = 'error';
        $_SESSION['status']['msg'] = '<p>Please fill all the mandatory fields.</p>'.$errorMsg;

        $redirectURL = 'addEdit.php?id='.$id.'&error='.urlencode($errorMsg);
    }
}elseif (isset($_GET['action_type']) && $_GET['action_type'] == 'delete') {
    $id = $_GET['id'];
    if (!empty($id)) {
        $db->delete($id);

        $_SESSION['status']['type'] = 'success';
        $_SESSION['status']['msg'] = 'Event data has been deleted successfully.';

        $redirectURL = 'index.php';
    }
}

header('Location: '.$redirectURL);
exit();
?>
