@extends('backend.vendor.layouts.app')
@section('content')
    <style>
        .itemHeader {
            margin-bottom: 13px;
            width: 100%;
        }

        .itemImg img {
            height: 100%;
            width: 100%;
        }

        .card.singlePage .modal-footer,
        .card.singlePage .itemComments {
            display: none;
        }



        .card.singlePage .singleItem {
            max-height: 90dvh;
            overflow-x: hidden;
            overflow-y: auto;
            scroll-behavior: smooth;
        }
    </style>
    <div class="row">
        <div class="col-md-8 col-lg-8 ">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> <?= __('extras') ?> /
                        <?= __('addons') ?></h4>
                    <a href="#addOnModal" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i>
                        <?= lang('add_new') ?></a>
                </div>
                <?php if($get_addons->isNotEmpty()):?>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class='table table-striped table-bordered  data_tables'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= __('title') ?></th>
                                    <th><?= __('type') ?></th>
                                    <th width="50%"><?= __('extras') ?></th>
                                    <th width="15%"><?= __('action') ?></th>
                                </tr>
                            </thead>
                            <tbody id="sortable" class="sortable sorting">
                                @foreach ($get_addons as $key => $extra)
                                    <tr id='1'>
                                        <td class="handle">{{ $key+1 }}</td>
                                        <td class="handle"><?= __names($extra->names, 'title', true) ?></td>
                                        <td>
                                            <?php if ($extra->is_single_select == 1) : ?>
                                                <label class="custom-radio-2">
                                                    <input type="radio" checked> <?= lang('single_select') ?>
                                                </label>
                                            <?php else: ?>
                                                <label class="custom-checkbox">
                                                    <input type="checkbox" checked> <?= lang('multiple_select') ?>
                                                </label>
                                            <?php endif; ?>
                                            <div class="mt-5">
                                                <?php if($extra->is_required == 1):?>
                                                    <span class="error">*</span> (<?= __('required') ?>)
                                                <?php else: ?>
                                                    (<?= __('optional') ?>)
                                                <?php endif; ?>
                                            </div>

                                            <div class="mt-5">
                                                <?php if ($extra->select_limit > 0) : ?>
                                                    <small>
                                                        <?= __('select_minimum') ?> <?= $extra->select_limit == 0 ? 1 : $extra->select_limit; ?> <?= __('options'); ?>

                                                        <?php if ($extra->select_max_limit != 0) : ?>
                                                            & <?= __('max') ?> <?= $extra->select_max_limit != 0 ? "<b>" . $extra->select_max_limit . "</b>"  : ''; ?> <?= __('options'); ?>
                                                        <?php endif; ?>
                                                    </small>
                                                <?php endif; ?>
                                            </div>

                                            <div class="hidden">
                                                <?php if ($extra->max_qty >= 1) : ?>
                                                    <small>
                                                        <?= __('max_qty') ?> <?= $extra->max_qty == 0 ? 1 : $extra->max_qty; ?> <?= __('items'); ?>
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if(isset($extra->extra_list) && $extra->extra_list->isNotEmpty()):?>
                                                <table class="table table-striped table-bordered m-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th><?= lang('name') ?></th>
                                                            <th><?= lang('price') ?></th>
                                                            <th><?= lang('max_qty') ?></th>
                                                            <th><?= lang('action') ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($extra->extra_list as $key1 => $ext)
                                                        <tr>
                                                            <td>{{ $key1+1 }}</td>
                                                            <td><?= __names($ext->extranames, 'addon_name', true) ?></td>
                                                            <td>{{ __aExtra($ext, 'price') }}</td>
                                                            <td><?= __aExtra($ext, 'max_qty') == 0 ? '&#8734' : __aExtra($ext, 'max_qty'); ?> </td>
                                                            <td class="text-center">
                                                                <a href="javascript:;" onclick="editAssignExtra(`<?= $ext->item_extra_id ?>`,`<?= $ext->price ?>`,`<?= $ext->max_select_qty ?>`)"
                                                                    class="btn btn-info btn-sm"> <i class="fa fa-edit"></i>
                                                                    <?= __('edit') ?></a>
                                                                <?= __deleteBtn($ext->item_extra_id , 'item_extra_list', true) ?>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btnGroup">
                                                <a href="javascript:;" onclick="addExtraModal(`<?= $extra->id ?>`,`<?= __names($extra->names, 'title') ?>`)"
                                                    class="btn btn-secondary btn-sm d-none"><i class="fa fa-plus"></i>
                                                    <?= __('add_new') ?> </a>

                                                <a href="javascript:;" onclick="extraListModal(`<?= $extra->id ?>`,`<?= __names($extra->names, 'title') ?>`)"
                                                    class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i>
                                                    <?= __('add') ?> </a>
                                            </div>
                                            <div class="mt-10 btnGroup">
                                                <a href="#editExtraTitleModal_<?= $extra->id ?>" data-toggle="modal"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <?= __deleteBtn($extra->id, 'vendor_extra_title_list', true) ?>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="javascript:;" data-id="extra_title_list" id="tables"></a>
                    </div>
                </div>
                <?php endif; ?>
            </div>

        </div> <!-- create_menu_thumb -->

        <div class="col-md-4 col-lg-5">
            <div class="card singlePage">
                {{-- <?php include VIEWPATH . 'common_layouts/item_details_thumb.php'; ?> </div> --}}
            </div>
        </div>

    </div>


    <!----------------------------------------------
                Add new Extra title
            ---------------------------------------------->
    <div id="addOnModal" class="modal fade customModal" role="dialog">
        <div class="modal-dialog">
            <form action="<?= url('vendor/products/add_new_extras') ?>" method="post" enctype="multipart/form-data"
                onsubmit="formSubmit(event,this)">
                <!-- csrf token -->
                @csrf
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= lang('add_new_extra_title') ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="extrasBody">

                            <div class="row">
                                @foreach (shop_language() as $lang)
                                <div class="form-group col-md-6">
                                    <label><?= __('title') ?> <?= country($lang->country_id)->flag ?></label>
                                    <input type="text" name="title[<?= $lang->slug ?>]" class="form-control" value="">
                                </div>
                                @endforeach
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for=""><?= __('type') ?></label>
                                    <div class="">
                                        <label class="custom-radio">
                                            <input type="radio" name="is_single_select" value="1" checked>
                                            <?= __('single_select') ?>
                                        </label>
                                        <label class="custom-radio">
                                            <input type="radio" name="is_single_select"
                                                value="0"><?= __('multiple_select') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for=""><?= lang('required') ?></label>
                                    <div class="">
                                        <label class="custom-checkbox">
                                            <input type="checkbox" name="is_required" value="1"
                                                onchange="showLimit(this)"><?= lang('is_required') ?>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 hidden">
                                    <label for=""><?= lang('max_qty') ?></label>
                                    <div class="">
                                        <input type="number" name="max_qty" class="form-control" value="0"
                                            min="0" placeholder="<?= __('max_qty') ?>">
                                    </div>
                                </div>
                            </div><!-- row -->
                            <div class="dis_none limit_div" id="">
                                <div class="row ">
                                    <div class="form-group col-md-6 ">
                                        <label for=""><?= lang('select_minimum') ?></label>
                                        <div class="">
                                            <input type="number" name="select_limit" value="1"
                                                class="form-control number" min="1">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label for=""><?= lang('select_max_limit') ?></label>
                                        <div class="">
                                            <input type="number" name="select_max_limit" value="1"
                                                class="form-control number" min="0">
                                        </div>
                                    </div>
                                </div><!-- row -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="item_id" value="<?= $item_id ?>">
                        <button type="submit" class="btn btn-secondary"><?= lang('save') ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <!----------------------------------------------
                Edit Extra title
                ---------------------------------------------->
    @foreach ($get_addons as $extra)
    <div id="editExtraTitleModal_<?= $extra->id ?>" class="modal fade customModal" role="dialog">
        <div class="modal-dialog">
            <form action="<?= url('vendor/products/add_new_extras') ?>" method="post" enctype="multipart/form-data"
                onsubmit="formSubmit(event,this)">
                <!-- csrf token -->
                @csrf
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= lang('edit') ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="extrasBody">

                            <div class="row">
                                @foreach (shop_language() as $lang)

                                <?php
                                    $title = [];
                                    foreach ($extra->names as $key => $value) {
                                        $title[$value->language] = $value->title;
                                    }
                                ?>

                                <div class="form-group col-md-6">
                                    <label><?= __('title') ?> <?= country($lang->country_id)->flag ?></label>
                                    <input type="text" name="title[<?= $lang->slug ?>]" class="form-control" value="<?= $title[$lang->slug] ?>">
                                </div>

                                @endforeach
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for=""><?= lang('type') ?></label>
                                    <div class="">
                                        <label class="custom-radio">
                                            <input type="radio" name="is_single_select" value="1" <?= ($extra->is_single_select == 1) ? 'checked':'' ?> >
                                            <?= lang('single_select') ?>
                                        </label>
                                        <label class="custom-radio">
                                            <input type="radio" name="is_single_select" value="0" <?= ($extra->is_single_select == 0) ? 'checked':'' ?>>
                                            <?= lang('multiple_select') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for=""><?= lang('required') ?></label>
                                    <div class="">
                                        <label class="custom-checkbox">
                                            <input type="checkbox" name="is_required" value="1"
                                                onchange="showLimit(this)"  <?= ($extra->is_required == 1) ? 'checked':'' ?>>
                                            <?= lang('is_required') ?>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 hidden">
                                    <label for=""><?= lang('max_qty') ?></label>
                                    <div class="">
                                        <input type="number" name="max_qty" class="form-control" value="<?= $extra->max_qty ?>"
                                            min="0" placeholder="<?= __('max_qty') ?>">
                                    </div>
                                </div>
                            </div>

                            <div class=" limit_div <?= ($extra->is_single_select == 1) ? 'hidden':'' ?>">
                                <div class="row" id="">
                                    <div class="form-group col-md-6 ">
                                        <label for=""><?= lang('select_minimum') ?></label>
                                        <div class="">
                                            <input type="number" name="select_limit" value="<?= $extra->select_limit ?>"
                                                class="form-control only_number" min="1">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label for=""><?= lang('select_max_limit') ?></label>
                                        <div class="">
                                            <input type="number" name="select_max_limit" value="<?= $extra->select_max_limit ?>"
                                                class="form-control number" min="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="item_id" value="<?= $item_id ?>">
                        <input type="hidden" name="extra_title_id" value="<?= $extra->id ?>">
                        <button type="submit" class="btn btn-secondary"><i class="fa fa-save"></i>
                            <?= lang('save') ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach


    <!----------------------------------------------
                edit extra and price
                --------------------------------------------->

    <div id="addExtraModal" class="modal fade customModal" role="dialog">
        <div class="modal-dialog">
            <form action="<?= url('vendor/products/add_extras') ?>" method="post" enctype="multipart/form-data"
                onsubmit="formSubmit(event,this)">
                <!-- csrf token -->
                @csrf
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title modalTitle"><?= lang('add_new_extras') ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="extrasBody">
                            <div class="form-group">
                                <label for=""><?= lang('name') ?></label>
                                <input type="text" name="ex_name" class="form-control"
                                    placeholder="<?= __('addons_name') ?> " required>
                            </div>

                            <div class="form-group">
                                <label for=""><?= lang('price') ?></label>
                                <input step=".01" type="number" name="ex_price" class="form-control price"
                                    required placeholder="0.0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="ex_id" value="0">
                        <input type="hidden" name="extra_title_id" value="0">
                        <input type="hidden" name="item_id" value="0">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                            <?= lang('save') ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!----------------------------------------------
                Extra from library
                ---------------------------------------------->
    <div id="extraListModal" class="modal fade customModal" role="dialog">
        <div class="modal-dialog">
            <form action="<?= url('vendor/products/add_library_extras') ?>" method="post"
                enctype="multipart/form-data" onsubmit="formSubmit(event,this)">
                <!-- csrf token -->
                @csrf
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="4">
                            <h4 class="modal-title modalTitle">sds</h4>
                            <a href="javascript:;" class="btn btn-info text-right btn-sm addBtn addSidebar"
                                onclick="sidebar(`addSidebar`)">
                                <i class="fa fa-plus"></i> <?= __('add_new') ?>
                            </a>
                        </div>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped w_100p" id="myTable">
                                <thead>
                                    <tr>
                                        <td><?= __('title') ?></td>
                                        <td><?= __('max_quantity') ?></td>
                                        <td><?= __('price') ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($extras_libraries as $key => $extra)
                                        <tr>
                                            <td>
                                                <label class="custom-checkbox item-center flex gap-5">
                                                    {{ $key+1 }}
                                                    <span>
                                                        <input type="checkbox" name="addon_id[<?= $extra->id ?>]" value="<?= $extra->id ?>">
                                                        <?= __names($extra->ln_data, 'addon_name') ?>
                                                    </span>
                                                </label>
                                            </td>
                                            <td><?= $extra->max_select_qty == 0 ? '&#8734;' : $extra->max_select_qty ?? 0; ?></td>
                                            <td>$ {{ $extra->price }}</td>
                                            <input type="hidden" name="max_select_qty[<?= $extra->id ?>]" value="{{ $extra->max_select_qty }}">
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="item_id" value="<?= $item_id ?? 0 ?>">
                        <input type="hidden" name="extra_title_id" value="0">
                        <?= __submitBtn() ?>
                    </div>
                </div>
            </form>
        </div>
    </div>


        <!----------------------------------------------
                  Add Item Addons Area
                ---------------------------------------------->

    <?= __header(__('add_new'), url('vendor/products/add_item_addons'), 'add') ?>


        @foreach (shop_language() as $lang)
        <div class="form-group">
            <label><?= __('addon_name') ?> <?= country($lang->country_id)->flag ?> <?= __required() ?></label>
            <input type="text" name="addon_name[<?= $lang->slug ?>]" class="form-control" value="">
        </div>
        @endforeach

        <div class="form-group ">
            <label><?= __('price') ?></label>
            <div class="ci-input-group input-group-prepand">
                <input type="text" name="price" class="form-control number"
                    placeholder="<?= __('current_price') ?>" value="">
                <div class="input-group">
                    <span>
                        $
                    </span>
                </div>
            </div>

        </div>

        <div class="form-group">
            <label><?= __('max_quantity') ?></label>
            <input type="text" name="max_select_qty" class="form-control" value="0">
        </div>

        <div class="form-group">
            <label><?= __('image') ?></label>
            <div class="mb-4">
                <?= media_files('image', 'single', '') ?>
            </div>

        </div>
        <input type="hidden" name="extra_title_id" class="extra_title_id" value="0">
        <?= hidden('id', 0) ?>
        <?= hidden('item_id', 0) ?>
    <?= __footer() ?>



    <!----------------------------------------------
                EDIT ASSIGN EXTRAS
                ---------------------------------------------->

    <?= __header(__('edit'), url('vendor/products/edit_assing_extra'), 'extraEdit') ?>
        <div class="assignExtras">
            <div class="form-group ">
                <label><?= __('price') ?></label>
                <div class="ci-input-group input-group-prepand">
                    <input type="text" name="price" class="form-control number"
                        placeholder="<?= __('current_price') ?>" value="">
                    <div class="input-group">
                        <span>
                            $
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label><?= __('max_quantity') ?></label>
                <input type="text" name="max_select_qty" class="form-control" value="0">
            </div>

            <?= hidden('id', 0) ?>
            <?= hidden('item_id', 0) ?>
        </div>
    <?= __footer() ?>






    <script>
        function editAssignExtra(id, price, qty) {
            sidebar('extraEditSidebar');
            $('.assignExtras [name="price"]').val(price);
            $('.assignExtras [name="max_select_qty"]').val(qty);
            $('.assignExtras [name="id"]').val(id);
        }

        function addExtraModal(id, name) {
            $('#addExtraModal').modal('show');
            $('#addExtraModal [name="extra_title_id"]').val(id);
            $('#addExtraModal .modalTitle').text(name);
        }
    </script>

    <script>
        function extraListModal(id, name) {
            $('#extraListModal').modal('show');
            $('#extraListModal [name="extra_title_id"]').val(id);
            $('#extraListModal .modalTitle').text(name);
            $('.extra_title_id').val(id);
        }

        function showLimit($this) {
            if ($($this).is(':checked')) {
                let is_single_select = $('[name="is_single_select"]:checked').val();
                if (is_single_select == 1) {
                    $('.limit_div').slideUp();
                } else {
                    $('.limit_div').slideDown();
                }
            } else {
                $('.limit_div').slideUp();
            }
        }


        $('[name="is_single_select"]').on('change', function() {
            if ($(this).val() == 1) {
                $('.limit_div').slideUp();
            } else {
                $('.limit_div').slideDown();
            }
        });
    </script>

@endsection
