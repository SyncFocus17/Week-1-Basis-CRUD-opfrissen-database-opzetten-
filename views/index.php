<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-list me-2"></i>My Tasks</h1>
    <a href="?page=create" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Task
    </a>
</div>

<?php if (empty($tasks)): ?>
    <div class="text-center py-5">
        <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
        <h3 class="text-muted">No tasks yet!</h3>
        <p class="text-muted">Create your first task to get started.</p>
        <a href="?page=create" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Create First Task
        </a>
    </div>
<?php else: ?>
    <div class="row">
        <?php foreach ($tasks as $task): ?>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100 <?= $task['is_done'] ? 'border-success' : 'border-warning' ?>">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 <?= $task['is_done'] ? 'text-decoration-line-through text-muted' : '' ?>">
                            <?= htmlspecialchars($task['title']) ?>
                        </h6>
                        <span class="badge <?= $task['is_done'] ? 'bg-success' : 'bg-warning' ?>">
                            <?= $task['is_done'] ? 'Done' : 'Pending' ?>
                        </span>
                    </div>
                    <div class="card-body">
                        <?php if ($task['description']): ?>
                            <p class="card-text <?= $task['is_done'] ? 'text-muted' : '' ?>">
                                <?= htmlspecialchars(substr($task['description'], 0, 100)) ?>
                                <?= strlen($task['description']) > 100 ? '...' : '' ?>
                            </p>
                        <?php else: ?>
                            <p class="card-text text-muted fst-italic">No description</p>
                        <?php endif; ?>
                        <small class="text-muted">
                            Created: <?= date('M j, Y', strtotime($task['created_at'])) ?>
                        </small>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="btn-group w-100" role="group">
                            <a href="?page=show&id=<?= $task['id'] ?>" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="?page=edit&id=<?= $task['id'] ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="action" value="toggle">
                                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                <button type="submit" class="btn btn-outline-<?= $task['is_done'] ? 'warning' : 'success' ?> btn-sm">
                                    <i class="fas fa-<?= $task['is_done'] ? 'undo' : 'check' ?>"></i>
                                </button>
                            </form>
                            <form method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Tasks</h5>
                        <h2 class="text-primary"><?= count($tasks) ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h5 class="card-title">Completed</h5>
                        <h2 class="text-success"><?= count(array_filter($tasks, fn($t) => $t['is_done'])) ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>