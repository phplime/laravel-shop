<?php
if (isset($current_details->variants)) :
    $get_variants = isJson($current_details->variants) ? json_decode($current_details->variants) : [];
elseif (!empty(__tempData('variants_' . $ln['slug']))) :
    $get_variants = __tempData('variants_' . $ln['slug']);
else :
    $get_variants = [];
endif;
?>


<?php if (isset($get_variants) && !empty($get_variants)) : ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped mb-0">
            <thead>
                <tr>
                    <th><?= __isset($get_variants, 'variant_name'); ?></th>
                    <th><?= __slang($ln['slug'], 'price'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($get_variants->variant_options as $key => $v) : ?>
                    <tr>
                        <td><input type="text" class="form-control" name="variants[<?= $key; ?>][<?= $ln['slug']; ?>][name]" value="<?= __isset($v, 'name'); ?>"></td>
                        <td>
                            <div class="ci-input-group input-group-prepand">
                                <input type="text" class="form-control number" name="variants[<?= $key; ?>][<?= $ln['slug']; ?>][price]" value="<?= __isset($v, 'price'); ?>">
                                <div class="input-group">
                                    <span><?= __vcountry()->currency_icon; ?></span>
                                </div>
                            </div>

                        </td>
                    </tr>
                <?php endforeach ?>
                <input type="hidden" name="variant_name[<?= $ln['slug']; ?>]" value="<?= $get_variants->variant_name ?? 'untitled'; ?>">
            </tbody>
        </table>
    </div>
<?php endif; ?>