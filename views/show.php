<?php if (!$task): ?>
    <div class="alert alert-danger">Task not found!</div>
    <a href="?page=index" class="btn btn-secondary">Back to Tasks</a>
<?php else: ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0 <?= $task['is_done'] ? 'text-decoration-line-through text-muted' : '' ?>">
                    <i class="fas fa-eye me-2"></i><?= htmlspecialchars($task['title']) ?>
                </h4>
                <span class="badge <?= $task['is_done'] ? 'bg-success' : 'bg-warning' ?> fs-6">
                    <?= $task['is_done'] ? 'Completed' : 'Pending' ?>
                </span>
            </div>
            <div class="card-body">
                <?php if ($task['description']): ?>
                    <div class="mb-4">
                        <h6>Description:</h6>
                        <p class="card-text <?= $task['is_done'] ? 'text-muted' : '' ?>">
                            <?= nl2br(htmlspecialchars($task['description'])) ?>
                        </p>
                    </div>
                <?php else: ?>
                    <div class="mb-4">
                        <p class="text-muted fst-italic">No description provided for this task.</p>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6">
                        <h6>Created:</h6>
                        <p class="text-muted"><?= date('F j, Y \a\t g:i A', strtotime($task['created_at'])) ?></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Last Updated:</h6>
                        <p class="text-muted"><?= date('F j, Y \a\t g:i A', strtotime($task['updated_at'])) ?></p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <div class="d-flex justify-content-between">
                    <a href="?page=index" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Tasks
                    </a>
                    <div>
                        <a href="?page=edit&id=<?= $task['id'] ?>" class="btn btn-primary me-2">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <form method="POST" class="d-inline me-2">
                            <input type="hidden" name="action" value="toggle">
                            <input type="hidden" name="id" value="<?= $task['id'] ?>">
                            <button type="submit" class="btn btn-<?= $task['is_done'] ? 'warning' : 'success' ?>">
                                <i class="fas fa-<?= $task['is_done'] ? 'undo' : 'check' ?> me-2"></i>
                                <?= $task['is_done'] ? 'Mark as Pending' : 'Mark as Done' ?>
                            </button>
                        </form>
                        <form method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this task?')">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $task['id'] ?>">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-2"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>