    @extends('backend.admin.layouts.app')
    @section('content')
        @php
            $row = isset($package_list[0]) ? (object) $package_list[0] : [];
        @endphp

        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0 mr-5"><?= __('create_plan') ?></h4>
                    </div>
                    <form method="POST" action="{{ url('admin/savePackage') }}" onsubmit="formSubmit(event,this);">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="Name"><?= __('name') ?></label>
                                                <input id="Name" class="form-control" type="text"
                                                    name="package_name" placeholder="<?= __('name') ?>"
                                                    value="<?= isset($row->package_name) ? $row->package_name : '' ?>">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="Name"><?= __('slug') ?></label>
                                                <input id="slug" class="form-control" type="text" name="slug"
                                                    placeholder="<?= __('slug') ?>"
                                                    value="<?= isset($row->slug) ? $row->slug : '' ?>">

                                            </div>
                                        </div>

                                        <div class="row mb-1rm">
                                            <div class="form-group mb-15 col-md-6">
                                                <label for="Name"><?= __('package_type') ?></label>
                                                <div class="ci-input-group packageTypeInput">
                                                    <input type="text" name="duration" id="package_type"
                                                        class="form-control only_number <?= isset($row->package_type) && $row->package_type == 'days' ? '' : 'hidden' ?>"
                                                        value="<?= isset($row->duration) ? $row->duration : 1 ?>">

                                                    <div class="input-group max-w-10rm flex-auto btn-primary">
                                                        <select name="package_type" id="planType"
                                                            class="form-control wd-8rm ci-color">
                                                            <option value=""><?= __('select') ?></option>
                                                            @foreach (duration_type() as $key => $duration)
                                                                <option value="{{ $key }}"
                                                                    {{ isset($row->package_type) && $row->package_type == $key ? 'selected' : '' }}>
                                                                    {{ $duration }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">{{ __('image') }}</label>
                                                <div class="mb-4">
                                                    <?= media_files('image', 'single', '') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="Name"><?= __('price') ?></label>
                                                <input id="price" class="form-control only_number" type="text"
                                                    name="price" placeholder="<?= __('price') ?>"
                                                    value="<?= isset($row->price) ? $row->price : '' ?>">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="Name"><?= __('previous_price') ?></label>
                                                <input id="price" class="form-control only_number" type="text"
                                                    name="previous_price" placeholder="<?= __('previous_price') ?>"
                                                    value="<?= isset($row->previous_price) ? $row->previous_price : '' ?>">
                                            </div>
                                        </div>

                                    </div> <!-- card-content -->
                                    <div class="card-content mt-10">
                                        <hr>
                                        <div class="row mb-1rm">
                                            <div class="col-md-6">
                                                <div class="form-group mb-1rm">
                                                    <label><?= __('store_limit') ?> <span class='error'> * </span></label>
                                                    <input type="number" name="store_limit" class="form-control"
                                                        min="1" step="1"
                                                        value="<?= isset($row->store_limit) ? $row->store_limit : 1 ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="mb-10"><?= __('select_modules') ?></h4>
                                        <ul class="moduleList">
                                            @foreach ($module_list as $module)
                                                <li>
                                                    <label class="custom-checkbox">
                                                        <input type="checkbox" name="module_ids[]"
                                                            value="{{ $module->id }}"
                                                            {{ isset($row->module_ids) && in_array($module->id, json_decode($row->module_ids, true)) ? 'checked' : '' }}>
                                                        &nbsp;
                                                        {{ $module->title }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="card-content mt-2rm">
                                        <label
                                            class="custom-checkbox badge badge-danger d-inline-flex alighn-items-center ">
                                            <input type="checkbox" name="is_private" value="1"
                                                {{ isset($row->is_private) && $row->is_private == 1 ? 'selected' : '' }}>
                                            <?= __('mark_as_private_package') ?>
                                        </label>
                                    </div>

                                </div><!-- col-8 -->
                                <div class="col-md-4">
                                    <div class="card-content">
                                        <ul class="featureList">

                                            @foreach ($feature_list as $feature)
                                                <li>
                                                    <label class="custom-checkbox">
                                                        <span>{{ $loop->iteration }}</span>
                                                        <input type="checkbox" name="feature_id[]"
                                                            value="{{ $feature->id }}"
                                                            {{ isset($row->feature_list) && in_array($feature->id, $row->feature_list->pluck('id')->all()) ? 'checked' : '' }}>
                                                        &nbsp;
                                                        {{ $feature->name }}
                                                    </label>
                                                </li>
                                            @endforeach


                                        </ul>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <?= hidden('id', $row->id ?? 0) ?>
                            <a href="<?= url('admin/package_list') ?>" class="btn btn-default float-left"><?= __('cancel') ?></a>
                            <?= submitBtn() ?>
                        </div>
                    </form>
                </div>

            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('attributes') }}</h4>
                    </div>
                    <div class="card-body module-details d-flex flex-row flex-wrap space-between align-center">
                        <div class="module_features">
                            <fieldset>
                                <legend class="mb-0"><?= __('module_feature') ?></legend>
                                <ul class="d-flex flex-column gap-10">
                                    @foreach ($module_feature_list as $moduleFeature)
                                        <li><i class="icofont-long-arrow-right"></i> {{ $moduleFeature->title }}</li>
                                    @endforeach
                                </ul>
                            </fieldset>
                        </div>

                        <div class="mt-10 module-order-types">
                            <fieldset>
                                <legend class="mb-0"><?= __('order_types') ?></legend>
                                <ul class="d-flex flex-column gap-10">
                                    @foreach ($order_type_list as $order)
                                        <li><i class="icofont-long-arrow-right"></i> {{ $order->title }}</li>
                                    @endforeach


                                </ul>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script>
            $(document).on("change", '[name="package_type"]', function() {
                let val = $(this).val();
                if (val == 'days') {
                    $('[name="duration"]').removeClass('hidden');
                    $('.packageTypeInput').addClass('input-group-prepand');
                } else {
                    $('[name="duration"]').addClass('hidden');
                    $('.packageTypeInput').removeClass('input-group-prepand');
                }
            });
        </script>
    @endsection
