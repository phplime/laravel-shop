<div class="row">
    <?php $this->load->view('backend/vendor_settings/inc/v_settings_menu.php', ['col' => 'col-lg-12']); ?>
    <div class="<?= __vsettings('menu_style') == 'topmenu' ? "col-lg-12" : "col-lg-9 "; ?> col-xs-12">
        <div class="row">
            <div class="col-md-8">
                <form action="<?= base_url('vendor/settings/add_available_type'); ?>" method="post">
                    <?= csrf(); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for=""><?= lang('opening_system'); ?> </label>
                                <select name="available_type" class="form-control" onchange="this.form.submit();">
                                    <option value="close" <?= __vsettings('available_type') == "close" ? "selected" : ""; ?>><?= lang('multiple_close'); ?></option>
                                    <option value="open" <?= __vsettings('available_type') == "open" ? "selected" : ""; ?>><?= lang('multiple_open'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?= __startForm(base_url('vendor/settings/add_available_days'), 'post'); ?>
                <?= csrf(); ?>

                <div class=" availableDays">
                    <?php $days = get_days(); ?>
                    <?php foreach ($days as $key => $day) : ?>
                        <?php $my_days = $this->vendor_m->get_available_days($key, _ID()); ?>
                        <?php $getTimes = $this->vendor_m->get_time_config($my_days['id'] ?? 0); ?>
                        <div class="card">
                            <div class="card-header space-between">
                                <label class="custom-checkbox"> <input type="checkbox" name="days[]" <?= isset($my_days['days']) && html_escape($my_days['days']) == $key ? "checked" : ''; ?> value="<?= $key; ?>" checked> <?= $day; ?> </label>
                                <div class="flex-1 text-right  open24">
                                    <label class="custom-checkbox"><input type="checkbox" name="is_24[<?= $key ?>]" value="1" <?= isset($my_days['is_24']) && html_escape($my_days['is_24']) == 1 ? "checked" : ''; ?> /><?= lang('open_24_hours'); ?></label>
                                </div>
                            </div>


                            <div class="card-body showDays_<?= $key; ?>">

                                <div class="inputFormArea">
                                    <fieldset class="hidden">
                                        <legend><?= __('reservation_date'); ?></legend>
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label><?= lang('start_time'); ?></label>
                                                <div class="ci-input-group input-group-append" direction="ltr">
                                                    <div class="input-group">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="fa fa-clock"></i>
                                                        </button>
                                                    </div>
                                                    <input type="time" name="start_time_<?= $key ?>[]" value="<?= !empty($my_days['reservation_start_time']) ? $my_days['reservation_start_time'] : '10:00' ?>" class="form-control timepicker">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label><?= lang('end_time'); ?></label>
                                                <div class="ci-input-group input-group-append" direction="ltr">
                                                    <div class="input-group">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="fa fa-clock"></i>
                                                        </button>
                                                    </div>
                                                    <input type="time" name="end_time_<?= $key ?>[]" value="<?= !empty($my_days['reservation_end_time']) ? $my_days['reservation_end_time'] : '23:00' ?>" class="form-control timepicker">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="">
                                        <legend><?= __('checkout_available_days'); ?></legend>
                                        <div class="inputTimeArea" data-id="<?= $key; ?>">
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label><?= lang('start_time'); ?></label>
                                                    <div class="ci-input-group input-group-append" direction="ltr">
                                                        <div class="input-group">
                                                            <button class="btn btn-default" type="button">
                                                                <i class="fa fa-clock"></i>
                                                            </button>
                                                        </div>
                                                        <input type="time" name="start_time_<?= $key ?>[]" value="<?= !empty($my_days['start_time']) ? $my_days['start_time'] : '10:00' ?>" class="form-control timepicker">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-5">
                                                    <label><?= lang('end_time'); ?></label>
                                                    <div class="ci-input-group input-group-append" direction="ltr">
                                                        <div class="input-group">
                                                            <button class="btn btn-default" type="button">
                                                                <i class="fa fa-clock"></i>
                                                            </button>
                                                        </div>
                                                        <input type="time" name="end_time_<?= $key ?>[]" value="<?= !empty($my_days['end_time']) ? $my_days['end_time'] : '23:00' ?>" class="form-control timepicker">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <a href="javascript:;" class="remove_time_row btn bg-danger-light opacity_0 mt-30"><i class="fa fa-minus-circle"></i></a>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group addBreaks flex-1">
                                            <?php if (__vsettings('available_type') == 'close') : ?>
                                                <a href="#" data-id="<?= $key; ?>" class="add_time_row primary-color mt-5"><i class="fa fa-plus-circle"></i> <?= lang('add_breaks'); ?></a>
                                            <?php else : ?>
                                                <a href="#" data-id="<?= $key; ?>" class="add_time_row primary-color mt-5"><i class="fa fa-plus-circle"></i> <?= lang('add_opening_slots'); ?></a>
                                            <?php endif; ?>
                                        </div>

                                        <?php if (isset($getTimes) && !empty($getTimes)) : ?>
                                            <?php foreach ($getTimes as  $keys => $times) : ?>
                                                <div class="inputTimeArea" data-id="<?= $key; ?>">
                                                    <div class="inputFormArea">
                                                        <div class="row">
                                                            <div class="form-group col-md-5">
                                                                <label><?= lang('start_time'); ?></label>
                                                                <div class="ci-input-group input-group-append" direction="ltr">
                                                                    <div class="input-group">
                                                                        <button class="btn btn-default" type="button">
                                                                            <i class="fa fa-clock"></i>
                                                                        </button>
                                                                    </div>
                                                                    <input type="time" name="start_time_<?= $keys ?>[]" value="<?= !empty($times->start_time) ? $times->start_time : '' ?>" class="form-control timepicker">
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-5">
                                                                <label><?= lang('end_time'); ?></label>
                                                                <div class="ci-input-group input-group-append" direction="ltr">
                                                                    <div class="input-group">
                                                                        <button class="btn btn-default" type="button">
                                                                            <i class="fa fa-clock"></i>
                                                                        </button>
                                                                    </div>
                                                                    <input type="time" name="end_time_<?= $keys ?>[]" value="<?= !empty($times->end_time) ? $times->end_time : '' ?>" class="form-control timepicker">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <div class="mt-30">
                                                                    <a href="javascript:;" class="remove_old_row rowRemove btn bg-danger-light "><i class="icofont-trash"></i> </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div><!-- inputTimeArea -->
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </fieldset>
                                </div><!-- inputTimeArea -->


                            </div><!-- card-body -->
                        </div><!-- card -->
                    <?php endforeach; ?>
                </div>
                <div class="col-md-12 mt-10">
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary btn-block "><?= lang('submit'); ?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>


    </div><!-- col-9 -->

</div>

<script>
    var remove = `<?= lang('remove'); ?>`;
    $(document).on('click', '[name="days[]"]', function(event) {
        let val = $(this).val()
        if ($(this).is(':checked')) {
            $('.showDays_' + val).slideDown();

        } else {
            $('.showDays_' + val).slideUp();
        }
    });

    $(document).on('click', '.remove_old_row', function(event) {
        event.preventDefault();
        if (confirm(are_you_sure)) {
            $(this).closest('.inputTimeArea').remove();
        }
        return false;

    });


    $(document).ready(function() {
        // Handle click event on the "Add Breaks" link
        $('.add_time_row').click(function(e) {
            e.preventDefault();

            // Get the data-id attribute to identify the inputTimeArea
            var dataId = $(this).data('id');

            // Clone the inputTimeArea with the corresponding data-id
            var clonedInputTimeArea = $('.inputTimeArea[data-id="' + dataId + '"]:first').clone();
            clonedInputTimeArea.find('input[type="text"]').val(''); // Clear input values
            clonedInputTimeArea.find('.addBreaks').remove(); // Clear input values
            clonedInputTimeArea.find('.remove_time_row').removeClass('opacity_0'); // Clear input values

            $('.inputTimeArea[data-id="' + dataId + '"]:last').after(clonedInputTimeArea);

            // Attach a click event to the new remove link
            clonedInputTimeArea.find('.remove_time_row').click(function(e) {
                e.preventDefault();
                if (confirm(are_you_sure)) {
                    $(this).closest('.inputTimeArea').remove();
                }
                return false;
            });

            // $('.timepicker').timepicker({
            //     showInputs: false,
            //     defaultTime: '10:00',
            //     format: 'hh:mm',
            //     use24hours: true,
            //     showMeridian: false,
            //     minuteStepping: 10,
            // });
        });

    });
</script>