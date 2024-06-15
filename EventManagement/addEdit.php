<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: login.php');
    exit();
}

require_once 'Json.class.php';
$db = new Json();

$eventData = array();
$actionLabel = !empty($_GET['id']) ? 'Edit' : 'Add';

if (!empty($_GET['id'])) {
    $eventData = $db->getSingle($_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $actionLabel; ?> Event</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2><?php echo $actionLabel; ?> Event</h2>
        <form method="post" action="userAction.php">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo !empty($eventData['title']) ? $eventData['title'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" required><?php echo !empty($eventData['description']) ? $eventData['description'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label>Total Participants</label>
                <input type="number" name="participants" class="form-control" value="<?php echo !empty($eventData['participants']) ? $eventData['participants'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control" value="<?php echo !empty($eventData['start_date']) ? $eventData['start_date'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control" value="<?php echo !empty($eventData['end_date']) ? $eventData['end_date'] : ''; ?>" required>
            </div>
            <input type="hidden" name="id" value="<?php echo !empty($eventData['id']) ? $eventData['id'] : ''; ?>">
            <button type="submit" name="eventSubmit" class="btn btn-success">Submit</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
