@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        @include('backend.vendor_settings.inc.v_settings_menu')
        <div class="col-lg-9 col-xs-12">
            <div class="row">
                <div class="col-md-8">
                    <form action="" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for=""><?= lang('opening_system') ?> </label>
                                    <select name="available_type" class="form-control" onchange="this.form.submit();">
                                        <option value="close"><?= lang('multiple_close') ?></option>
                                        <option value="open" selected><?= lang('multiple_open') ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <form action="" method="post">
                        @csrf
                        <div class=" availableDays">
                            <div class="card">
                                <div class="card-header space-between">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="days[]" checked value="1"> Monday
                                    </label>
                                    <div class="flex-1 text-right  open24">
                                        <label class="custom-checkbox">
                                            <input type="checkbox" name="is_24[1]" value="1"
                                                checked /><?= lang('open_24_hours') ?>
                                        </label>
                                    </div>
                                </div>

                                <div class="card-body showDays_1">
                                    <div class="inputFormArea">
                                        <fieldset class="hidden">
                                            <legend><?= __('reservation_date') ?></legend>
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label><?= lang('start_time') ?></label>
                                                    <div class="ci-input-group input-group-append" direction="ltr">
                                                        <div class="input-group">
                                                            <button class="btn btn-default" type="button">
                                                                <i class="fa fa-clock"></i>
                                                            </button>
                                                        </div>
                                                        <input type="time" name="start_time_1[]" value="10:00"
                                                            class="form-control timepicker">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-5">
                                                    <label><?= lang('end_time') ?></label>
                                                    <div class="ci-input-group input-group-append" direction="ltr">
                                                        <div class="input-group">
                                                            <button class="btn btn-default" type="button">
                                                                <i class="fa fa-clock"></i>
                                                            </button>
                                                        </div>
                                                        <input type="time" name="end_time_1[]" value="23:00"
                                                            class="form-control timepicker">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <fieldset class="">
                                            <legend><?= __('checkout_available_days') ?></legend>
                                            <div class="inputTimeArea" data-id="1">
                                                <div class="row">
                                                    <div class="form-group col-md-5">
                                                        <label><?= lang('start_time') ?></label>
                                                        <div class="ci-input-group input-group-append" direction="ltr">
                                                            <div class="input-group">
                                                                <button class="btn btn-default" type="button">
                                                                    <i class="fa fa-clock"></i>
                                                                </button>
                                                            </div>
                                                            <input type="time" name="start_time_1[]" value="10:00"
                                                                class="form-control timepicker">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-5">
                                                        <label><?= lang('end_time') ?></label>
                                                        <div class="ci-input-group input-group-append" direction="ltr">
                                                            <div class="input-group">
                                                                <button class="btn btn-default" type="button">
                                                                    <i class="fa fa-clock"></i>
                                                                </button>
                                                            </div>
                                                            <input type="time" name="end_time_1[]" value="23:00"
                                                                class="form-control timepicker">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <a href="javascript:;"
                                                            class="remove_time_row btn bg-danger-light opacity_0 mt-30"><i
                                                                class="fa fa-minus-circle"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group addBreaks flex-1">
                                                <a href="#" data-id="1" class="add_time_row primary-color mt-5"><i
                                                        class="fa fa-plus-circle"></i> <?= lang('add_breaks') ?></a>
                                            </div>

                                            <div class="inputTimeArea" data-id="1">
                                                <div class="inputFormArea">
                                                    <div class="row">
                                                        <div class="form-group col-md-5">
                                                            <label><?= lang('start_time') ?></label>
                                                            <div class="ci-input-group input-group-append" direction="ltr">
                                                                <div class="input-group">
                                                                    <button class="btn btn-default" type="button">
                                                                        <i class="fa fa-clock"></i>
                                                                    </button>
                                                                </div>
                                                                <input type="time" name="start_time_1[]"
                                                                    value="10:00" class="form-control timepicker">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-5">
                                                            <label><?= lang('end_time') ?></label>
                                                            <div class="ci-input-group input-group-append"
                                                                direction="ltr">
                                                                <div class="input-group">
                                                                    <button class="btn btn-default" type="button">
                                                                        <i class="fa fa-clock"></i>
                                                                    </button>
                                                                </div>
                                                                <input type="time" name="end_time_1[]" value="10:00"
                                                                    class="form-control timepicker">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <div class="mt-30">
                                                                <a href="javascript:;"
                                                                    class="remove_old_row rowRemove btn bg-danger-light "><i
                                                                        class="icofont-trash"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div><!-- inputTimeArea -->
                                        </fieldset>
                                    </div><!-- inputTimeArea -->
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </div>
                        <div class="col-md-12 mt-10">
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-block "><?= lang('submit') ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div><!-- col-9 -->

    </div>

    <script>
        var remove = `<?= lang('remove') ?>`;
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
@endsection
