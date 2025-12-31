<?php if(isset($get_variants) && !empty($get_variants)):?>
<div class="table-responsive">
    <table class="table table-bordered table-striped mb-0">
        <thead>
            <tr>
                <th>{{ $variant_name }}</th>
                <th>{{ __('price') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($get_variants as $key => $v_name)
            <tr>
                <td><input type="text" class="form-control" name="variants[<?= $key; ?>][<?= $lang ?>][name]" value="<?= $v_name ?>"></td>
                <td>
                    <div class="ci-input-group input-group-prepand">
                        <input type="text" class="form-control number" name="variants[<?= $key; ?>][<?= $lang ?>][price]" value="">
                        <div class="input-group">
                            <span>$</span>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
            <input type="hidden" name="variant_name[<?= $lang ?>]" value="{{ $variant_name }}">
        </tbody>
    </table>
</div>
<?php endif; ?>
