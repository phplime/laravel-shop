@extends('backend.admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-10 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= lang('package_list') ?></h5>
                    <div class="card-tools">
                        <?= __addBtn(url('admin/create-package')) ?>
                    </div>
                </div>
                <div class="card-body table-style">
                    <div class="card-content">
                        <div class="table-responsive responsiveTable">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= __('name') ?></th>
                                        <th><?= __('slug') ?></th>
                                        <th><?= __('type') ?></th>
                                        <th><?= __('price') ?></th>
                                        <th><?= __('modules') ?></th>
                                        <th><?= __('features') ?></th>
                                        <th><?= __('status') ?></th>
                                        <th><?= __('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($package_list as $key => $row)
                                        <tr id="hide_1">
                                            <td data-label="#">{{ $key + 1 }}</td>
                                            <td data-label="<?= __('name') ?>">{{ $row['package_name'] }}</td>
                                            <td data-label="<?= __('slug') ?>">{{ $row['slug'] }}</td>
                                            <td data-label="<?= __('type') ?>">{{ $row['package_type'] }}</td>
                                            <td data-label="<?= __('price') ?>">
                                                {{ $row['price'] }}
                                                @if (!empty($row['previous_price']))
                                                    <span class="previous_price">{{ $row['previous_price'] }}</span>
                                                @endif
                                            </td>
                                            <td data-label="<?= __('modules') ?>">
                                                <div class="d-flex flex-row flex-wrap gap-10 align-start">
                                                    @foreach ($row['module_list'] as $module)
                                                        <label
                                                            class="label badge-soft-success">{{ $module['name'] }}</label>
                                                    @endforeach

                                                </div>
                                            </td>
                                            <td data-label="<?= __('features') ?>">
                                                <ul class="d-flex gap-10 flex-column">
                                                    @foreach ($feature_list as $feature)
                                                        @php
                                                            $checked = in_array(
                                                                $feature->id,
                                                                $row['feature_list']->pluck('id')->all(),
                                                            )
                                                                ? 'check text-success'
                                                                : 'times text-danger';
                                                        @endphp
                                                        <li class="fz-14 p-5 d-flex gap-10 align-center"> <i
                                                                class="fas fa-<?= $checked ?>"></i>
                                                            {{ $feature->name }}</label>
                                                    @endforeach

                                                </ul>

                                            </td>
                                            <td data-label="<?= __('status') ?>">
                                                <?= __status($row['id'], $row['status'], 'package_list') ?>
                                                @if ($row['is_default'] == 1)
                                                    <a href="javascript:;" class="badge bg-info-light-active ml-5"><i
                                                            class="icofont-ui-lock"></i> <?= lang('default') ?></a>
                                                @else
                                                    <a href="" class="badge bg-info-light ml-5 action_btn"><i
                                                            class="icofont-ui-unlock"></i> <?= lang('make_default') ?></a>
                                                @endif
                                            </td>
                                            <td class="btnGroup" data-label="<?= __('action') ?>">
                                                <?= __editBtn(url('admin/edit-package/' . $row['slug'])) ?>
                                                <?= __deleteBtn($row['id'], 'package_list', true) ?>
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
@endsection
