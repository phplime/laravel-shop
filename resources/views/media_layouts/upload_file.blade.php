
<div class="image-drop rounded">
    <span class="fw-semibold"><?= lang("choose_image");?></span>
    <!-- choose media -->
    <div class="product-thumb show-selected-files mt-3">
        <?php if(!empty($value)):?>
            <?php $myImg = $this->admin_m->get_my_selected_image($value);?>
            <?php foreach($myImg as $key=> $img):?>
                <div class="avatar avatar-xl selected-file">
                    <img class="rounded-circle" src="<?= base_url($img->thumb) ;?>" alt="">
                    <span class="remove" onclick="removeSelectedFile(this, '<?= $img->id;?>')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></span>
                </div>
            <?php  endforeach;?>
        <?php endif;?>
        <div class="avatar avatar-xl cursor-pointer choose-media"  onclick="showMediaManager(this)" data-selection="<?= $type ;?>">
            <input type="hidden" name="<?= $name ;?>" value="<?=$value;?>">
            <div class="no-avatar rounded-circle">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></span>
            </div>
        </div>
    </div>
    <!-- choose media -->
</div>
