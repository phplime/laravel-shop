<div class="row">
    <div class="col-md-6">
        <form action="" id="cloneForm" method="post">
            <?= csrf(); ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?= __('clone'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"><?= __('main_shop'); ?></label>
                        <select name="old_vendor_id" class="form-control">
                            <option value=""><?= __('select'); ?></option>
                            <?php foreach ($vendor_list as $shop): ?>
                                <option value="<?= $shop->id; ?>"><?= $shop->username; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name"><?= __('new_shop'); ?></label>
                        <select name="new_vendor_id" class="form-control">
                            <option value=""><?= __('select'); ?></option>
                            <?php foreach ($vendor_list as $shop): ?>
                                <?php if ($shop->id != _ID()): ?>
                                    <option value="<?= $shop->id; ?>"><?= $shop->username; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <?= __submitBtn(); ?>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div id="taskTableContainer">
            <?php $this->load->view('backend/admin_activities/task_table', ['tasks' => $tasks]); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div id="progressMessage"></div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function processNextTask() {
            $.ajax({
                url: '<?php echo site_url("admin/queue/process_next_task"); ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#progressMessage').html(response.message);
                        $('#taskTableContainer').html(response.table_html);
                        setTimeout(processNextTask, 1000); // Process next task after 1 second
                    } else if (response.status === 'completed') {
                        $('#progressMessage').text('All tasks completed');
                    } else {
                        $('#progressMessage').text('Error processing task');
                    }
                },
                error: function() {
                    $('#progressMessage').text('Error processing task');
                }
            });
        }

        $('#cloneForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo site_url("admin/queue/start_clone"); ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#taskTableContainer').html(response.table_html);
                        processNextTask();
                    } else {
                        $('#progressMessage').text('Error starting clone process');
                    }
                },
                error: function() {
                    $('#progressMessage').text('Error starting clone process');
                }
            });
        });
    });
</script>