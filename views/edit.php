<?php if (!$task): ?>
    <div class="alert alert-danger">Task not found!</div>
    <a href="?page=index" class="btn btn-secondary">Back to Tasks</a>
<?php else: ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Task</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Task Title *</label>
                        <input type="text" 
                               class="form-control" 
                               id="title" 
                               name="title" 
                               value="<?= htmlspecialchars($_POST['title'] ?? $task['title']) ?>" 
                               placeholder="Enter task title"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  placeholder="Enter task description (optional)"><?= htmlspecialchars($_POST['description'] ?? $task['description']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" disabled <?= $task['is_done'] ? 'checked' : '' ?>>
                            <label class="form-check-label text-muted">
                                Task Status: <?= $task['is_done'] ? 'Completed' : 'Pending' ?>
                            </label>
                        </div>
                        <small class="text-muted">Use the toggle button on the tasks list to change status.</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="?page=index" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Tasks
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>