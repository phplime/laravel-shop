@extends('backend.admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('feature_list') ?></h5>
                    <div class="card-tools">
                        <?= __addbtn('', __('add_new'), ['is_sidebar' => 1, 'class' => 'add_feature']) ?>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-content">
                        <div class="table-responsive responsiveTable">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= __('title') ?></th>
                                        <th><?= __('slug') ?></th>
                                        <th><?= __('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feature_list as $key => $row)
                                        <tr id="hide_1">
                                            <td data-label="{{ __('#') }}">{{ $key + 1 }}</td>
                                            <td data-label="{{ __('title') }}">{{ $row->name }}</td>
                                            <td data-label="{{ __('slug') }}">{{ $row->slug }}</td>
                                            <td data-label="{{ __('action') }}">
                                                <div class="btnGroup">
                                                    <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'edit_feature_' . $row->id]) ?>
                                                    <?= __deleteBtn($row->id, 'feature_list', true) ?>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= __header(__('add_new'), url('admin/add_new_feature'), 'add_feature') ?>
    <div class="form-group">
        <label for="">{{ __('title') }}</label>
        <input type="text" name="name" class="form-control" placeholder="{{ __('title') }}">
    </div>
    <div class="form-group">
        <label for="">{{ __('slug') }}</label>
        <input type="text" name="slug" class="form-control" placeholder="{{ __('slug') }}">
    </div>
    <?= __footer(['hidde:id' => $data->id ?? 0]) ?>

    @foreach ($feature_list as $key => $feature)
        <?= __header(__('add_new'), url('admin/add_new_feature'), 'edit_feature_' . $feature->id) ?>
        <div class="form-group">
            <label for="">{{ __('title') }}</label>
            <input type="text" name="name" class="form-control" placeholder="{{ __('title') }}"
                value="{{ $feature->name ?? '' }}">
        </div>
        <div class="form-group">
            <label for="">{{ __('slug') }}</label>
            <input type="text" name="slug" class="form-control" placeholder="{{ __('slug') }}"
                value="{{ $feature->slug ?? '' }}">
        </div>
        <?= __footer(['hidde:id' => $feature->id ?? 0]) ?>
    @endforeach
@endsection
