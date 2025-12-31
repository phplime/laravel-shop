<?php if(isset($item) && $item->is_variants == 1):?>

<?php
    $variant_details = isset($itemDetails->variants) && !empty($itemDetails->variants) ? json_decode($itemDetails->variants) : [];
?>

<div class="table-responsive">
    <table class="table table-bordered table-striped mb-0">
        <thead>
            <tr>
                <th><?= isset($variant_details->variant_name) ? $variant_details->variant_name:'' ?></th>
                <th><?= __('price'); ?></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($variant_details->variant_options as $key => $v)
                <tr>
                    <td><input type="text" class="form-control" name="variants[<?= $key ?>][<?= $lang->slug ?>][name]" value="<?= $v->name ?>"></td>
                    <td>
                        <div class="ci-input-group input-group-prepand">
                            <input type="text" class="form-control number" name="variants[<?= $key ?>][<?= $lang->slug ?>][price]" value="<?= $v->price ?>">
                            <div class="input-group">
                                <span>$</span>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            <input type="hidden" name="variant_name[<?= $lang->slug ?>]" value="<?= $variant_details->variant_name ?? '' ?>">
        </tbody>
    </table>
</div>
<?php endif; ?>
