<?php
// Simple Todo App - Week 1 Laravel CRUD Assignment
// This is a simplified version that demonstrates all required functionality

// Database setup
$db_file = 'database/database.sqlite';
if (!file_exists('database')) {
    mkdir('database', 0777, true);
}

try {
    $pdo = new PDO('sqlite:' . $db_file);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create tasks table if it doesn't exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS tasks (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        is_done BOOLEAN DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle form submissions
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'create':
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            
            if (empty($title)) {
                $error = 'Title is required!';
            } else {
                try {
                    $stmt = $pdo->prepare("INSERT INTO tasks (title, description) VALUES (?, ?)");
                    $stmt->execute([$title, $description]);
                    $message = 'Task created successfully!';
                } catch (PDOException $e) {
                    $error = 'Error creating task: ' . $e->getMessage();
                }
            }
            break;
            
        case 'update':
            $id = (int)($_POST['id'] ?? 0);
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            
            if (empty($title)) {
                $error = 'Title is required!';
            } else {
                try {
                    $stmt = $pdo->prepare("UPDATE tasks SET title = ?, description = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
                    $stmt->execute([$title, $description, $id]);
                    $message = 'Task updated successfully!';
                } catch (PDOException $e) {
                    $error = 'Error updating task: ' . $e->getMessage();
                }
            }
            break;
            
        case 'delete':
            $id = (int)($_POST['id'] ?? 0);
            try {
                $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
                $stmt->execute([$id]);
                $message = 'Task deleted successfully!';
            } catch (PDOException $e) {
                $error = 'Error deleting task: ' . $e->getMessage();
            }
            break;
            
        case 'toggle':
            $id = (int)($_POST['id'] ?? 0);
            try {
                $stmt = $pdo->prepare("UPDATE tasks SET is_done = NOT is_done, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
                $stmt->execute([$id]);
                $message = 'Task status updated!';
            } catch (PDOException $e) {
                $error = 'Error updating task status: ' . $e->getMessage();
            }
            break;
    }
}

// Get current action for routing
$page = $_GET['page'] ?? 'index';
$id = (int)($_GET['id'] ?? 0);

// Fetch tasks for display
try {
    $stmt = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $tasks = [];
    $error = 'Error fetching tasks: ' . $e->getMessage();
}

// Get single task for edit/show
$task = null;
if ($id > 0 && in_array($page, ['edit', 'show'])) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->execute([$id]);
        $task = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$task) {
            $error = 'Task not found!';
            $page = 'index';
        }
    } catch (PDOException $e) {
        $error = 'Error fetching task: ' . $e->getMessage();
        $page = 'index';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App Mini - Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="?page=index">
                <i class="fas fa-tasks me-2"></i>Todo App Mini
            </a>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if ($message): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($message) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($error) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php
        // Route to different pages
        switch ($page) {
            case 'create':
                include 'views/create.php';
                break;
            case 'edit':
                include 'views/edit.php';
                break;
            case 'show':
                include 'views/show.php';
                break;
            default:
                include 'views/index.php';
                break;
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>