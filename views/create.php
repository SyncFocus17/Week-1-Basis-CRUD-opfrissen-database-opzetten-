<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-plus me-2"></i>Create New Task</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="action" value="create">
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Task Title *</label>
                        <input type="text" 
                               class="form-control" 
                               id="title" 
                               name="title" 
                               value="<?= htmlspecialchars($_POST['title'] ?? '') ?>" 
                               placeholder="Enter task title"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  placeholder="Enter task description (optional)"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="?page=index" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Tasks
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Create Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>