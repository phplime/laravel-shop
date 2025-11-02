<div id="mainContent">
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
                    <h4 class="card-title"> <?= !empty(lang('extras')) ? lang('extras') : "Extras"; ?> / <?= lang('addons'); ?></h4>
                    <a href="#addOnModal" data-toggle="modal" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i> <?= lang('add_new') ?></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php if (!empty($getAddons)) : ?>
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
                                    <?php foreach ($getAddons as  $key => $ext) : ?>
                                        <tr id='<?= $ext->id; ?>'>
                                            <td class="handle"><?= $key + 1; ?></td>
                                            <td class="handle"><?= __names($ext->_names, 'title', true); ?></td>
                                            <td>
                                                <?php if ($ext->is_single_select == 1) : ?>
                                                    <label class="custom-radio-2"><input type="radio" checked> <?= lang('single_select'); ?></label>
                                                <?php else : ?>
                                                    <label class="custom-checkbox"><input type="checkbox" checked> <?= lang('multiple_select'); ?></label>
                                                <?php endif; ?>
                                                <div class="mt-5">
                                                    <?php if ($ext->is_required == 1) : ?>
                                                        <span class="error">*</span> (<?= __('required') ?>)
                                                    <?php else : ?>
                                                        (<?= __('optional') ?>)
                                                    <?php endif; ?>
                                                </div>

                                                <div class="mt-5">
                                                    <?php if ($ext->select_limit > 0) : ?>
                                                        <small>
                                                            <?= __('select_minimum') ?> <?= $ext->select_limit == 0 ? 1 : $ext->select_limit; ?> <?= __('options'); ?>

                                                            <?php if ($ext->select_max_limit != 0) : ?>
                                                                & <?= __('max') ?> <?= $ext->select_max_limit != 0 ? "<b>" . $ext->select_max_limit . "</b>"  : ''; ?> <?= __('options'); ?>
                                                            <?php endif; ?>
                                                        </small>

                                                    <?php endif; ?>
                                                </div>

                                                <div class="hidden">
                                                    <?php if ($ext->max_qty >= 1) : ?>
                                                        <small>
                                                            <?= __('max_qty') ?> <?= $ext->max_qty == 0 ? 1 : $ext->max_qty; ?> <?= __('items'); ?>
                                                        </small>

                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <?php if (!empty($ext->extra_list)) : ?>
                                                    <table class="table table-striped table-bordered">
                                                        <tr>
                                                            <th>#</th>
                                                            <th><?= lang('name'); ?></th>
                                                            <th><?= lang('price'); ?></th>
                                                            <th><?= lang('max_qty'); ?></th>
                                                            <th><?= lang('action'); ?></th>
                                                        </tr>

                                                        <?php foreach ($ext->extra_list as  $key1 => $ex) : ?>
                                                            <tr>
                                                                <td><?= $key1 + 1; ?></td>
                                                                <td><?= __names($ex->_extranames, 'addon_name', true); ?></td>
                                                                <td><?= _currency_position(__aExtra($ex, 'price'), _ID()); ?></td>
                                                                <td><?= __aExtra($ex, 'max_qty') == 0 ? '&#8734' : __aExtra($ex, 'max_qty'); ?></td>
                                                                <td class="text-center">
                                                                    <a href="javascript:;" onclick="editAssignExtra(`<?= $ex->item_extra_id; ?>`,`<?= __aExtra($ex, 'price'); ?>`,`<?= __aExtra($ex, 'max_qty'); ?>`)" class="btn btn-info btn-sm"> <i class="fa fa-edit"></i> <?= __('edit'); ?></a>

                                                                    <?= __deleteBtn($ex->item_extra_id, 'item_extra_list', true); ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </table>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="btnGroup">
                                                    <a href="javascript:;" onclick="addExtraModal(`<?= $ext->id; ?>`,`<?= __names($ext->_names, 'title'); ?>`)" class="btn btn-secondary btn-sm d-none"><i class="fa fa-plus"></i> <?= __('add_new'); ?> </a>


                                                    <a href="javascript:;" onclick="extraListModal(`<?= $ext->id; ?>`,`<?= __names($ext->_names, 'title'); ?>`)" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i> <?= __('add'); ?> </a>


                                                </div>
                                                <div class="mt-10 btnGroup">
                                                    <a href="#editExtraTitleModal_<?= $ext->id; ?>" data-toggle="modal" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                                    <a href="<?= base_url("admin/menu/delete_addons/{$ext->id}") ?>" class="btn btn-danger btn-sm action_btn" data-msg="<?= __('want_to_delete'); ?>"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <a href="javascript:;" data-id="extra_title_list" id="tables"></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div> <!-- create_menu_thumb -->

        <div class="col-md-4 col-lg-5">
            <div class="card singlePage">
                <?php include VIEWPATH . "common_layouts/item_details_thumb.php"; ?> </div>
        </div>
    </div>


    <!----------------------------------------------
 Add new Extra title 
---------------------------------------------->
    <div id="addOnModal" class="modal fade customModal" role="dialog">
        <div class="modal-dialog">
            <form action="<?= base_url('vendor/products/add_new_extras') ?>" method="post" enctype="multipart/form-data" onsubmit="formSubmit(event,this)">
                <!-- csrf token -->
                <?= csrf(); ?>
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= lang('add_new_extra_title'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="extrasBody">
                            <div class="row">
                                <?php foreach (shop_language() as  $key => $lang) : ?>
                                    <div class="form-group col-md-6">
                                        <label><?= __('title'); ?> <?= country($lang['country_id'])->flag; ?></label>
                                        <input type="text" name="title[<?= $lang['slug'] ?>]" class="form-control" value="">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="row">

                                <div class="form-group col-md-12">
                                    <label for=""><?= lang('type'); ?></label>
                                    <div class="">
                                        <label class="custom-radio"> <input type="radio" name="is_single_select" value="1" checked> <?= lang('single_select'); ?></label>

                                        <label class="custom-radio"> <input type="radio" name="is_single_select" value="0"><?= lang('multiple_select'); ?></label>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for=""><?= lang('required'); ?></label>
                                    <div class="">
                                        <label class="custom-checkbox"> <input type="checkbox" name="is_required" value="1" onchange="showLimit(this)"><?= lang('is_required'); ?></label>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 hidden">
                                    <label for=""><?= lang('max_qty'); ?></label>
                                    <div class="">
                                        <input type="number" name="max_qty" class="form-control" value="0" min="0" placeholder="<?= __('max_qty') ?>">

                                    </div>
                                </div>
                            </div><!-- row -->
                            <div class="dis_none limit_div" id="">
                                <div class="row ">
                                    <div class="form-group col-md-6 ">
                                        <label for=""><?= lang('select_minimum'); ?></label>
                                        <div class="">
                                            <input type="number" name="select_limit" value="1" class="form-control number" min="1">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 ">
                                        <label for=""><?= lang('select_max_limit'); ?></label>
                                        <div class="">
                                            <input type="number" name="select_max_limit" value="1" class="form-control number" min="0">
                                        </div>
                                    </div>
                                </div><!-- row -->
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="item_id" value="<?= $id ?? 0; ?>">
                        <button type="submit" class="btn btn-secondary"><?= lang('save'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>





    <?php foreach ($getAddons as $key => $row) : ?>
        <!----------------------------------------------
  	Edit Extra title
 ---------------------------------------------->
        <div id="editExtraTitleModal_<?= $row->id ?>" class="modal fade customModal" role="dialog">
            <div class="modal-dialog">
                <form action="<?= base_url('vendor/products/add_new_extras') ?>" method="post" enctype="multipart/form-data" onsubmit="formSubmit(event,this)">
                    <!-- csrf token -->
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><?= lang('edit'); ?> <?= $row->title ?? ''; ?></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="extrasBody">
                                <div class="row">
                                    <?php foreach (shop_language() as  $lang_key => $lang) : ?>
                                        <?php
                                        $title = [];
                                        foreach ($row->_names as $name_obj) {
                                            $title[$name_obj->language] = $name_obj->title;
                                        }
                                        ?>
                                        <div class="form-group col-md-6">
                                            <label><?= __('title'); ?> <?= country($lang['country_id'])->flag; ?></label>
                                            <input type="text" name="title[<?= $lang['slug'] ?>]" class="form-control" value="<?= isset($title[$lang['slug']]) ? $title[$lang['slug']] : ''; ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for=""><?= lang('type'); ?></label>
                                        <div class="">
                                            <label class="custom-radio"> <input type="radio" name="is_single_select" value="1" checked <?= isset($row->is_single_select)  && $row->is_single_select == 1 ? "checked"  : ''; ?>><?= lang('single_select'); ?></label>
                                            <label class="custom-radio"> <input type="radio" name="is_single_select" value="0" <?= isset($row->is_single_select)  && $row->is_single_select == 0 ? "checked"  : ''; ?>><?= lang('multiple_select'); ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for=""><?= lang('required'); ?></label>
                                        <div class="">
                                            <label class="custom-checkbox"> <input type="checkbox" name="is_required" value="1" onchange="showLimit(this)" <?= isset($row->is_required)  && $row->is_required == 1 ? "checked"  : ''; ?>><?= lang('is_required'); ?></label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 hidden">
                                        <label for=""><?= lang('max_qty'); ?></label>
                                        <div class="">
                                            <input type="number" name="max_qty" class="form-control" value="<?= !empty($row->max_qty) ? $row->max_qty : 1; ?>" min="0" placeholder="<?= __('max_qty') ?>">

                                        </div>
                                    </div>
                                </div>


                                <div class="<?= isset($row->is_required)  && $row->is_required == 1 && $row->is_single_select == 0 ? ""  : 'dis_none'; ?> limit_div">
                                    <div class="row" id="">
                                        <div class="form-group col-md-6 ">
                                            <label for=""><?= lang('select_minimum'); ?></label>
                                            <div class="">
                                                <input type="number" name="select_limit" value="<?= !empty($row->select_limit) ? $row->select_limit : 1; ?>" class="form-control only_number" min="1">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label for=""><?= lang('select_max_limit'); ?></label>
                                            <div class="">
                                                <input type="number" name="select_max_limit" value="<?= !empty($row->select_max_limit) ? $row->select_max_limit : 0; ?>" class="form-control number" min="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="item_id" value="<?= $id ?? 0; ?>">
                            <input type="hidden" name="extra_title_id" value="<?= $row->id ?? 0; ?>">
                            <button type="submit" class="btn btn-secondary"><i class="fa fa-save"></i> <?= lang('save'); ?></button>
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
                <form action="<?= base_url('vendor/products/add_extras') ?>" method="post" enctype="multipart/form-data" onsubmit="formSubmit(event,this)">
                    <!-- csrf token -->
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title modalTitle"><?= lang('add_new_extras'); ?></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="extrasBody">
                                <div class="form-group">
                                    <label for=""><?= lang('name'); ?></label>
                                    <input type="text" name="ex_name" class="form-control" placeholder="<?= __('addons-name') ?> " required>
                                </div>

                                <div class="form-group">
                                    <label for=""><?= lang('price'); ?></label>
                                    <input step=".01" type="number" name="ex_price" class="form-control price" required placeholder="0.0">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="ex_id" value="0">
                            <input type="hidden" name="extra_title_id" value="0">
                            <input type="hidden" name="item_id" value="<?= $id ?? 0; ?>">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?= lang('save'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    <?php endforeach; ?>





    <!----------------------------------------------
  	start	Extra from library
 ---------------------------------------------->
    <div id="extraListModal" class="modal fade customModal" role="dialog">
        <div class="modal-dialog">
            <form action="<?= base_url('vendor/products/add_library_extras') ?>" method="post" enctype="multipart/form-data" onsubmit="formSubmit(event,this)">
                <!-- csrf token -->
                <?= csrf(); ?>
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="">
                            <h4 class="modal-title modalTitle"><?= lang('add_new_extras'); ?> <a href="<?= base_url("admin/menu/extras"); ?>" class="btn btn-secondary"><i class="fa fa-plus"></i> <?= lang('add_new'); ?></a></h4>
                            <a href="javascript:;" class="btn btn-info text-right btn-sm addBtn addSidebar" onclick="sidebar(`addSidebar`)"> <i class="fa fa-plus"></i> <?= __('add_new'); ?></a>
                        </div>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped w_100p" id="myTable">
                                <thead>
                                    <tr>
                                        <td><?= __('title'); ?></td>
                                        <td><?= __('max_quantity'); ?></td>
                                        <td><?= __('price'); ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($extras_libraries as $key => $exl) : ?>
                                        <tr>
                                            <td>
                                                <label class="custom-checkbox item-center flex gap-5"><?= $key + 1 ?><span><input type="checkbox" name="extra_id[<?= $exl->id; ?>]" value="<?= $exl->id; ?>"> <?= __names($exl->_names, 'addon_name'); ?></span>
                                                </label>
                                            </td>
                                            <td><?= $exl->max_select_qty == 0 ? '&#8734;' : $exl->max_select_qty ?? 0; ?></td>
                                            <td><?= _currency_position($exl->price, _ID()); ?></td>
                                            <input type="hidden" name="max_select_qty[<?= $exl->id; ?>]" value="<?= $exl->max_select_qty ?? 0;  ?>">
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="item_id" value="<?= $id ?? 0; ?>">
                        <input type="hidden" name="extra_title_id" value="0">
                        <?= __submitBtn(); ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!----------------------------------------------
  			End	Extra from library
---------------------------------------------->


    <?= __header(__('add_new'), base_url('vendor/products/add_item_addons'), 'add'); ?>


    <?php foreach (shop_language() as  $key => $lang) : ?>
        <div class="form-group">
            <label><?= __('addon_name'); ?> <?= country($lang['country_id'])->flag; ?></label>
            <input type="text" name="addon_name[<?= $lang['slug'] ?>]" class="form-control" value="">
        </div>
    <?php endforeach; ?>

    <div class="form-group ">
        <label><?= __('price'); ?></label>
        <div class="ci-input-group input-group-prepand">
            <input type="text" name="price" class="form-control number" placeholder="<?= __('current_price'); ?>" value="">
            <div class="input-group">
                <span>
                    <?= __vcountry()->currency_icon; ?>
                </span>
            </div>
        </div>

    </div>

    <div class="form-group">
        <label><?= __('max_quantity'); ?></label>
        <input type="text" name="max_select_qty" class="form-control" value="0">
    </div>

    <div class="form-group">
        <label><?= __('image'); ?> <?= __get('site_lang'); ?></label>
        <div class="mb-4">
            <?= media_files('image', 'single', ''); ?>
        </div>

    </div>
    <input type="hidden" name="extra_title_id" class="extra_title_id" value="0">
    <?= hidden('id', 0); ?>
    <?= hidden('item_id', $id ?? 0); ?>
    <?= __footer(); ?>

    <!----------------------------------------------
    EDIT ASSIGN EXTRAS
    ---------------------------------------------->

    <?= __header(__('edit'), base_url('vendor/products/edit_assing_extra'), 'extraEdit'); ?>

    <div class="assignExtras">
        <div class="form-group ">
            <label><?= __('price'); ?></label>
            <div class="ci-input-group input-group-prepand">
                <input type="text" name="price" class="form-control number" placeholder="<?= __('current_price'); ?>" value="">
                <div class="input-group">
                    <span>
                        <?= __vcountry()->currency_icon; ?>
                    </span>
                </div>
            </div>

        </div>

        <div class="form-group">
            <label><?= __('max_quantity'); ?></label>
            <input type="text" name="max_select_qty" class="form-control" value="0">
        </div>

        <?= hidden('id', 0); ?>
        <?= hidden('item_id', $id ?? 0); ?>
    </div>
    <?= __footer(); ?>






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