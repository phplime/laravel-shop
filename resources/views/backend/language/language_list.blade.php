@extends('backend.admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= lang('language_list') ?></h5>
                    <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'language']) ?>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= !empty(lang('name')) ? lang('name') : 'name' ?></th>
                                    <th><?= !empty(lang('slug')) ? lang('slug') : 'slug' ?></th>
                                    <th><?= !empty(lang('direction')) ? lang('direction') : 'direction' ?></th>
                                    <th><?= !empty(lang('status')) ? lang('status') : 'status' ?></th>
                                    <th><?= !empty(lang('action')) ? lang('action') : 'action' ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($language_list as $key => $row)
                                    <tr>
                                        <td data-label="#">{{ $key + 1 }}</td>
                                        <td data-label="{{ lang('name') }}">{{ $row->language_name }}</td>
                                        <td data-label="{{ lang('slug') }}">{{ $row->slug }}</td>
                                        <td data-label="{{ lang('direction') }}">{{ $row->direction }}</td>
                                        <td data-label="{{ lang('status') }}">
                                            <?= __status($row->id, $row->status, 'language_list') ?>
                                        </td>
                                        <td data-label="{{ __('action') }}">
                                            <div class="btnGroup">
                                                <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_language_' . $row->id]) ?>
                                                <?= __deleteBtn($row->id, 'language_list', true) ?>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.card-body -->
            </div>
        </div>
    </div>

    <?= __header(__('add_new_language'), url('admin/add_new_language'), 'language') ?>
    <div class="form-group mb-0">
        <select class="sidebarSelect form-control" name="country_id" onchange="updateFlag(this)">
            @foreach ($country_list as $country)
                <option value="{{ $country->id }}" data-src="">{{ $country->name }}</option>
            @endforeach

        </select>

    </div>
    <div class="form-group">
        <label><?= lang('language_name') ?> <span class="error">*</span></label>
        <input type="text" name="language_name" class="form-control" placeholder="<?= lang('name') ?>">
    </div>

    <div class="form-group">
        <label>
            <?= !empty(lang('slug')) ? lang('slug') : 'Language Slug' ?>
            <i class="fa fa-info-circle" title="@lang('slug_info')"></i>
        </label>
        <input type="text" name="slug" class="form-control" placeholder="Language Slug" value="">
    </div>
    <div class="form-group">
        <label><?= !empty(lang('direction')) ? lang('direction') : 'Direction' ?></label>
        <div class="">
            <select name="direction" id="direction" class="form-control">
                <option value="ltr">
                    <?= !empty(lang('ltr')) ? lang('ltr') : 'LTR' ?>
                    (<?= !empty(lang('left_to_right')) ? lang('left_to_right') : 'Left to right' ?>)
                </option>
                <option value="rtl">
                    <?= !empty(lang('rtl')) ? lang('rtl') : 'RTL' ?>
                    (<?= !empty(lang('right_to_left')) ? lang('right_to_left') : 'Right to left' ?>)
                </option>
            </select>
        </div>
    </div>
    <?= __footer() ?>


    @foreach ($language_list as $key => $lang)
        <?= __header(__('edit'), url('admin/add_new_language'), 'edit_language_' . $lang->id) ?>
        <div class="form-group mb-0">
            <select class="sidebarSelect form-control" name="country_id" onchange="updateFlag(this)">
                @foreach ($country_list as $country)
                    <option value="{{ $country->id }}" data-src=""
                        {{ isset($lang->id) && $lang->id == $country->id ? 'selected' : '' }}>{{ $country->name }}
                    </option>
                @endforeach

            </select>

        </div>
        <div class="form-group">
            <label><?= lang('language_name') ?> <span class="error">*</span></label>
            <input type="text" name="language_name" class="form-control" placeholder="<?= lang('name') ?>"
                value="{{ !empty($lang->language_name) ? $lang->language_name : '' }}">
        </div>

        <div class="form-group">
            <label>
                <?= !empty(lang('slug')) ? lang('slug') : 'Language Slug' ?>
                <i class="fa fa-info-circle" title="@lang('slug_info')"></i>
            </label>
            <input type="text" name="slug" class="form-control" placeholder="Language Slug"
                value="{{ !empty($lang->slug) ? $lang->slug : '' }}">
        </div>
        <div class="form-group">
            <label><?= !empty(lang('direction')) ? lang('direction') : 'Direction' ?></label>
            <div class="">
                <select name="direction" id="direction" class="form-control">
                    <option value="ltr" {{ isset($lang->direction) && $lang->direction == 'ltr' ? 'selected' : '' }}>
                        @lang('ltr')
                        (@lang('left_to_right'))
                    </option>
                    <option value="rtl" {{ isset($lang->direction) && $lang->direction == 'rtl' ? 'selected' : '' }}>
                        @lang('rtr')
                        (@lang('right_to_left'))
                    </option>
                </select>
            </div>
        </div>
        <?= __footer(['hidden:id' => $lang->id ?? 0]) ?>
    @endforeach
@endsection
