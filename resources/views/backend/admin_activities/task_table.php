<div class="card">
    <div class="card-header">
        <h4 class="card-title"><?= __('clone'); ?></h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="taskTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>table</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Completed At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?php echo $task['id']; ?></td>
                        <td><?php echo $task['table_name']; ?></td>
                        <td><?php echo $task['status']; ?></td>
                        <td><?php echo $task['created_at']; ?></td>
                        <td><?php echo $task['completed_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>