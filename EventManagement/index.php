<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: login.php');
    exit();
}

require_once 'Json.class.php';
$db = new Json();

$status = !empty($_SESSION['status']) ? $_SESSION['status'] : null;
unset($_SESSION['status']); 

$filters = array(
    'title' => isset($_GET['title']) ? trim($_GET['title']) : '',
    'start_date' => isset($_GET['start_date']) ? trim($_GET['start_date']) : '',
    'end_date' => isset($_GET['end_date']) ? trim($_GET['end_date']) : ''
);

$events = $db->getFilteredRows($filters);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Management</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Events</h2>
        <?php if ($status): ?>
        <div class="alert alert-<?php echo $status['type']; ?>">
            <?php echo $status['msg']; ?>
        </div>
        <?php endif; ?>
        <a href="addEdit.php" class="btn btn-success">Add Event</a>
        <a href="logout.php" class="btn btn-danger my-2 my-sm-0">Logout</a>
        <form method="get" action="index.php" class="form-inline my-2">
            <input type="text" name="title" placeholder="Title" class="form-control mr-2" value="<?php echo $filters['title']; ?>">
            <input type="date" name="start_date" class="form-control mr-2" value="<?php echo $filters['start_date']; ?>">
            <input type="date" name="end_date" class="form-control mr-2" value="<?php echo $filters['end_date']; ?>">
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Participants</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($events)): ?>
                <?php foreach ($events as $index => $event): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $event['title']; ?></td>
                    <td><?php echo $event['description']; ?></td>
                    <td><?php echo $event['participants']; ?></td>
                    <td><?php echo $event['start_date']; ?></td>
                    <td><?php echo $event['end_date']; ?></td>
                    <td>
                        <a href="addEdit.php?id=<?php echo $event['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="userAction.php?action_type=delete&id=<?php echo $event['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr><td colspan="7">No events found...</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
