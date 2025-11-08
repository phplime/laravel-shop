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
        <div class="col-md-8 col-lg-7 ">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> <?= !empty(lang('extras')) ? lang('extras') : 'Extras' ?> /
                        <?= lang('addons') ?></h4>
                    <a href="#addOnModal" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i>
                        <?= lang('add_new') ?></a>
                </div>
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
                                <tr id='1'>
                                    <td class="handle">1</td>
                                    <td class="handle">pizza</td>
                                    <td>
                                        <label class="custom-radio-2"><input type="radio" checked>
                                            <?= lang('single_select') ?></label>
                                        {{-- <label class="custom-checkbox"><input type="checkbox" checked> <?= lang('multiple_select') ?></label> --}}
                                        <div class="mt-5">
                                            <span class="error">*</span> (<?= __('required') ?>)
                                            {{-- (<?= __('optional') ?>) --}}

                                            <div class="mt-5">
                                                <small>
                                                    <?= __('select_minimum') ?> 4 <?= __('options') ?>
                                                    & <?= __('max') ?> 5 <?= __('options') ?>
                                                </small>
                                            </div>

                                            <div class="hidden">
                                                <small>
                                                    <?= __('max_qty') ?> 4 <?= __('items') ?>
                                                </small>
                                            </div>
                                    </td>
                                    <td>
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <th>#</th>
                                                <th><?= lang('name') ?></th>
                                                <th><?= lang('price') ?></th>
                                                <th><?= lang('max_qty') ?></th>
                                                <th><?= lang('action') ?></th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>pizza</td>
                                                <td>$45</td>
                                                <td>4</td>
                                                <td class="text-center">
                                                    <a href="javascript:;" onclick="editAssignExtra(`5`,`$34`,`4`)"
                                                        class="btn btn-info btn-sm"> <i class="fa fa-edit"></i>
                                                        <?= __('edit') ?></a>
                                                    <?= __deleteBtn(1, 'item_extra_list', true) ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <div class="btnGroup">
                                            <a href="javascript:;" onclick="addExtraModal(`1`,`pizza`)"
                                                class="btn btn-secondary btn-sm d-none"><i class="fa fa-plus"></i>
                                                <?= __('add_new') ?> </a>

                                            <a href="javascript:;" onclick="extraListModal(`1`,`pizza`)"
                                                class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i>
                                                <?= __('add') ?> </a>
                                        </div>
                                        <div class="mt-10 btnGroup">
                                            <a href="#editExtraTitleModal_1" data-toggle="modal"
                                                class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                            <a href="<?= url('admin/menu/delete_addons/1') ?>"
                                                class="btn btn-danger btn-sm action_btn"
                                                data-msg="<?= __('want_to_delete') ?>"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="javascript:;" data-id="extra_title_list" id="tables"></a>
                    </div>
                </div>
            </div>

        </div> <!-- create_menu_thumb -->

        <div class="col-md-4 col-lg-5">
            <div class="card singlePage">
                {{-- <?php include VIEWPATH . 'common_layouts/item_details_thumb.php'; ?> </div> --}}
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
                                    <div class="form-group col-md-6">
                                        <label><?= __('title') ?> EN</label>
                                        <input type="text" name="title[en]" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-md-12">
                                        <label for=""><?= lang('type') ?></label>
                                        <div class="">
                                            <label class="custom-radio">
                                                <input type="radio" name="is_single_select" value="1" checked>
                                                <?= lang('single_select') ?>
                                            </label>

                                            <label class="custom-radio">
                                                <input type="radio" name="is_single_select"
                                                    value="0"><?= lang('multiple_select') ?>
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
                            <input type="hidden" name="item_id" value="0">
                            <button type="submit" class="btn btn-secondary"><?= lang('save') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>




        <!----------------------------------------------
                  Edit Extra title
                 ---------------------------------------------->
        <div id="editExtraTitleModal_1" class="modal fade customModal" role="dialog">
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
                                    <div class="form-group col-md-6">
                                        <label><?= __('title') ?></label>
                                        <input type="text" name="title[en]" class="form-control" value="en">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for=""><?= lang('type') ?></label>
                                        <div class="">
                                            <label class="custom-radio">
                                                <input type="radio" name="is_single_select" value="1" checked>
                                                <?= lang('single_select') ?>
                                            </label>
                                            <label class="custom-radio">
                                                <input type="radio" name="is_single_select" value="0">
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
                                                    onchange="showLimit(this)">
                                                <?= lang('is_required') ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 hidden">
                                        <label for=""><?= lang('max_qty') ?></label>
                                        <div class="">
                                            <input type="number" name="max_qty" class="form-control" value="1"
                                                min="0" placeholder="<?= __('max_qty') ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class=" limit_div">
                                    <div class="row" id="">
                                        <div class="form-group col-md-6 ">
                                            <label for=""><?= lang('select_minimum') ?></label>
                                            <div class="">
                                                <input type="number" name="select_limit" value="1"
                                                    class="form-control only_number" min="1">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label for=""><?= lang('select_max_limit') ?></label>
                                            <div class="">
                                                <input type="number" name="select_max_limit" value="0"
                                                    class="form-control number" min="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="item_id" value="0">
                            <input type="hidden" name="extra_title_id" value="0">
                            <button type="submit" class="btn btn-secondary"><i class="fa fa-save"></i>
                                <?= lang('save') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!----------------------------------------------
                  Start edit extra and price
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
                  start	Extra from library
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
                            <div class="">
                                <h4 class="modal-title modalTitle"><?= lang('add_new_extras') ?>
                                    <a href="<?= url('admin/menu/extras') ?>" class="btn btn-secondary">
                                        <i class="fa fa-plus"></i> <?= lang('add_new') ?>
                                    </a>
                                </h4>
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
                                        <tr>
                                            <td>
                                                <label class="custom-checkbox item-center flex gap-5">1<span><input
                                                            type="checkbox" name="extra_id[1]" value="1">
                                                        pizza</span>
                                                </label>
                                            </td>
                                            <td>3</td>
                                            <td>$32</td>
                                            <input type="hidden" name="max_select_qty[1]" value="0">
                                        </tr>
                                    </tbody>

                                </table>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="item_id" value="<?= $id ?? 0 ?>">
                            <input type="hidden" name="extra_title_id" value="0">
                            <?= __submitBtn() ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!----------------------------------------------
                  End	Extra from library
                ---------------------------------------------->


        <?= __header(__('add_new'), url('vendor/products/add_item_addons'), 'add') ?>


        <div class="form-group">
            <label><?= __('addon_name') ?> en</label>
            <input type="text" name="addon_name[en]" class="form-control" value="">
        </div>

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
                {{-- <?= media_files('image', 'single', '') ?> --}}
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

    </div>
@endsection
