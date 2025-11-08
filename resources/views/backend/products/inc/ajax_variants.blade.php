<div class="table-responsive">
    <table class="table table-bordered table-striped mb-0">
        <thead>
            <tr>
                <th><?= $variant_name; ?></th>
                <th><?= __slang($lang, 'price'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($variant_options as $key => $v) : ?>
                <tr>
                    <td><input type="text" class="form-control" name="variants[<?= $key; ?>][<?= $lang; ?>][name]" value="<?= $v; ?>"></td>
                    <td>
                        <div class="ci-input-group input-group-prepand">
                            <input type="text" class="form-control number" name="variants[<?= $key; ?>][<?= $lang; ?>][price]">
                            <div class="input-group">
                                <span><?= __vcountry()->currency_icon; ?></span>
                            </div>
                        </div>

                    </td>
                </tr>
            <?php endforeach ?>
            <input type="hidden" name="variant_name[<?= $lang;?>]" value="<?= $variant_name ?? 'untitled'; ?>">
        </tbody>
    </table>
</div>