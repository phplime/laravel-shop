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
                                <tr>
                                    <td data-label="#">1</td>
                                    <td data-label="{{ lang('name') }}">english</td>
                                    <td data-label="{{ lang('slug') }}">en</td>
                                    <td data-label="{{ lang('direction') }}">hello</td>
                                    <td data-label="{{ lang('status') }}">
                                        <?= __status(1, 1, 'language_list') ?>
                                    </td>
                                    <td data-label="{{ lang('action') }}">
                                        <div class="btnGroup">
                                            <a href="" class="btn btn-primary text-right btn-sm"> <i
                                                    class="fa fa-edit"></i> Edit</a>
                                            <a href="" class="btn btn-danger btn-sm action_btn"
                                                data-msg="Are you sure?">
                                                <i class="fa fa-trash"></i> Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.card-body -->
            </div>
        </div>
    </div>

    <?= __header(__('add_new_language'), 'admin/language/add_languages', 'language') ?>
    <div class="form-group mb-0">
        <select class="sidebarSelect form-control" name="country_id" onchange="updateFlag(this)">
            <option value="1" data-src="">Afghanistan</option>
            <option value="2" data-src="">Afghanistan</option>
        </select>

    </div>
    <div class="form-group">
        <label><?= lang('language_name') ?> <span class="error">*</span></label>
        <input type="text" name="language_name" class="form-control" placeholder="<?= lang('name') ?>">
    </div>

    <div class="form-group">
        <label>
            <?= !empty(lang('slug')) ? lang('slug') : 'Language Slug' ?>
            <i class="fa fa-info-circle" title="Language name (slug) must be in english alphabet and can't change"></i>
        </label>
        <input type="text" name="slug" class="form-control" placeholder="Language Slug"
            <?= isset($data['slug']) && !empty($data['slug']) ? 'readonly' : '' ?> value="">
    </div>
    <div class="form-group">
        <label><?= !empty(lang('direction')) ? lang('direction') : 'Direction' ?></label>
        <div class="">
            <select name="direction" id="direction" class="form-control">
                <option value="ltr" <?= isset($data['direction']) && $data['direction'] == 'ltr' ? 'selected' : '' ?>>
                    <?= !empty(lang('ltr')) ? lang('ltr') : 'LTR' ?>
                    (<?= !empty(lang('left_to_right')) ? lang('left_to_right') : 'Left to right' ?>)
                </option>
                <option value="rtl" <?= isset($data['direction']) && $data['direction'] == 'rtl' ? 'selected' : '' ?>>
                    <?= !empty(lang('rtl')) ? lang('rtl') : 'RTL' ?>
                    (<?= !empty(lang('right_to_left')) ? lang('right_to_left') : 'Right to left' ?>)
                </option>
            </select>
        </div>
    </div>
    <?= __footer() ?>
@endsection
