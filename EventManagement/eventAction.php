<?php 
session_start(); 
require_once 'Json.class.php'; 
$db = new Json(); 
$redirectURL = 'index.php'; 

if(isset($_POST['eventSubmit'])){ 
    $id = $_POST['id']; 
    $title = trim(strip_tags($_POST['title'])); 
    $description = trim(strip_tags($_POST['description'])); 
    $participants = trim(strip_tags($_POST['participants'])); 
    $start_date = trim(strip_tags($_POST['start_date'])); 
    $end_date = trim(strip_tags($_POST['end_date'])); 

    $id_str = ''; 
    if(!empty($id)){ 
        $id_str = '?id='.$id; 
    } 

    $errorMsg = ''; 
    if(empty($title)){ 
        $errorMsg .= '<p>Please enter event title.</p>'; 
    } 
    if(empty($description)){ 
        $errorMsg .= '<p>Please enter event description.</p>'; 
    } 
    if(empty($participants)){ 
        $errorMsg .= '<p>Please enter total number of participants.</p>'; 
    } 
    if(empty($start_date)){ 
        $errorMsg .= '<p>Please enter start date.</p>'; 
    } 
    if(empty($end_date)){ 
        $errorMsg .= '<p>Please enter end date.</p>'; 
    } 

    $eventData = array( 
        'title' => $title, 
        'description' => $description, 
        'participants' => $participants, 
        'start_date' => $start_date, 
        'end_date' => $end_date 
    ); 

    $sessData['eventData'] = $eventData; 

    if(empty($errorMsg)){ 
        if(!empty($_POST['id'])){ 
            $update = $db->update($eventData, $_POST['id']); 
            if($update){ 
                $sessData['status']['type'] = 'success'; 
                $sessData['status']['msg'] = 'Event data has been updated successfully.'; 
                unset($sessData['eventData']); 
            } else { 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Some problem occurred, please try again.'; 
                $redirectURL = 'addEdit.php'.$id_str; 
            } 
        } else { 
            $insert = $db->insert($eventData); 
            if($insert){ 
                $sessData['status']['type'] = 'success'; 
                $sessData['status']['msg'] = 'Event data has been added successfully.'; 
                unset($sessData['eventData']); 
            } else { 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Some problem occurred, please try again.'; 
                $redirectURL = 'addEdit.php'.$id_str; 
            } 
        } 
    } else { 
        $sessData['status']['type'] = 'error'; 
        $sessData['status']['msg'] = '<p>Please fill all the mandatory fields.</p>'.$errorMsg; 
        $redirectURL = 'addEdit.php'.$id_str; 
    } 

    $_SESSION['sessData'] = $sessData; 
} elseif(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])) { 
    $delete = $db->delete($_GET['id']); 
    if($delete){ 
        $sessData['status']['type'] = 'success'; 
        $sessData['status']['msg'] = 'Event data has been deleted successfully.'; 
    } else { 
        $sessData['status']['type'] = 'error'; 
        $sessData['status']['msg'] = 'Some problem occurred, please try again.'; 
    } 
    $_SESSION['sessData'] = $sessData; 
} 

header("Location:".$redirectURL); 
exit(); 
?>
