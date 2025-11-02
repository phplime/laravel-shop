<div class="row">
    <div class="col-md-6">
        <form action="<?= base_url("vendor/pages/add_page") ?>" method="post" onsubmit="formSubmit(event,this);">
            <?= csrf(); ?>
            <div class="card">
                <div class="card-header">
                    <div class="card-title"><?= __('terms_and_condition'); ?></div>
                </div>
                <div class="card-body">
                    <input type="hidden" name="slug" value="terms">
                    <?php $datalag = isset($data->_names) ? $data->_names : []; ?>
                     
                    <?php foreach (shop_language() as  $lang_key => $lang) : ?>
                        <?php
                        $page_details = [];
                        if (!empty($datalag)) :
                            foreach ($datalag as $name_obj) {
                                $page_details[$name_obj->language] = [
                                    'title' => $name_obj->title,
                                    'details' => $name_obj->details,
                                ];
                            }
                        endif;


                        ?>
                        <div class="form-group">
                            <label><?= __('title'); ?> <?= country($lang['country_id'])->flag; ?> <span class="text-danger">*</span> </label>
                            <input type="text" name="title[<?= $lang['slug'] ?>]" class="form-control" placeholder="<?= __('title'); ?>" value="<?= isset($page_details[$lang['slug']]['title']) ? $page_details[$lang['slug']]['title'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label><?= __('details'); ?> <span class="text-danger">*</span></label>
                                <textarea name="details[<?= $lang['slug'] ?>]" id="details_<?= $lang['slug'] ?>" class="form-control textarea"><?= isset($page_details[$lang['slug']]['details']) ? $page_details[$lang['slug']]['details'] : ''; ?></textarea>
                            </div>

                        </div>
                    <?php endforeach; ?>

                </div>
                <div class="card-footer text-right">
                    <?= __hidden('is_modal', 1); ?>
                    <?= __hidden('id', isset($data->id) ? $data->id : 0); ?>
                    <?= __submitBtn(); ?>
                </div>
            </div>
        </form>
    </div>
</div>