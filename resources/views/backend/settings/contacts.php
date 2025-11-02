<div id="mainContent">

    <div class="row">
        <?php $this->load->view('backend/settings/inc/settings_menu.php', ['col' => 'col-lg-8']); ?>
        <div class="col-md-8">
            <?= __startForm(base_url('admin/settings/save_contact_information', 'post')); ?>
            <?= csrf(); ?>
            <div class="card">
                <div class="card-header">
                    <h4><?= __('contacts'); ?></h4>
                </div>
                <?php $contact_info = __settingsJson('contact_info'); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <textarea name="details" class="form-control data_textarea" placeholder="<?= __('contact_info'); ?>"><?= $contact_info['details'] ?? '' ?></textarea>

                            <fieldset class="mt-1rm">
                                <legend><?= __('contacts'); ?></legend>
                                <?php
                                $contact_fields = [
                                    'phone' => ['icon' => 'fas fa-phone', 'type' => 'text', 'label' => 'Phone'],
                                    'email' => ['icon' => 'fas fa-envelope', 'type' => 'email', 'label' => 'Email'],
                                    'whatsapp' => ['icon' => 'fab fa-whatsapp', 'type' => 'text', 'label' => 'WhatsApp'],
                                    'address' => ['icon' => 'fas fa-map-marker-alt', 'type' => 'textarea', 'label' => __('address')],
                                ];
                                ?>

                                <div class="contactInfo">
                                    <?php foreach ($contact_fields as $name => $field): ?>
                                        <div class="form-group">
                                            <?php if ($field['type'] !== 'textarea'): ?>
                                                <div class="ci-input-group input-group-append">
                                                    <div class="input-group">
                                                        <span><i class="<?= $field['icon']; ?>"></i></span>
                                                    </div>
                                                    <input type="<?= $field['type']; ?>"
                                                        name="contact[<?= $name; ?>]"
                                                        class="form-control"
                                                        placeholder="<?= $field['label']; ?>"
                                                        value="<?= isset($contact_info['contact'][$name]) ? esc($contact_info['contact'][$name]) : ''; ?>">
                                                </div>
                                            <?php else: ?>
                                                <label><?= $field['label']; ?></label>
                                                <textarea name="contact[<?= $name; ?>]" class="form-control"><?= isset($contact_info['contact'][$name]) ? esc($contact_info['contact'][$name]) : ''; ?></textarea>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                            </fieldset>
                        </div>
                        <div class="col-md-6">

                            <fieldset class="">
                                <legend><?= __('social'); ?></legend>
                                <?php

                                $social_fields = [
                                    'facebook'  => 'fab fa-facebook',
                                    'instagram' => 'fab fa-instagram',
                                    'twitter'   => 'fab fa-twitter',
                                    'tiktok'    => 'fab fa-tiktok',
                                    'youtube'   => 'fab fa-youtube',
                                    'website'   => 'fas fa-globe',
                                ];
                                ?>

                                <div class="socialMedia">
                                    <?php foreach ($social_fields as $key => $icon): ?>
                                        <div class="form-group">
                                            <div class="ci-input-group input-group-append">
                                                <div class="input-group">
                                                    <span><i class="<?= $icon ?>"></i></span>
                                                </div>
                                                <input type="text"
                                                    name="social_icon[<?= $key ?>]"
                                                    class="form-control"
                                                    placeholder=""
                                                    value="<?= isset($contact_info['social_icon'][$key]) ? esc($contact_info['social_icon'][$key]) : ''; ?>">
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                            </fieldset>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block"><?= __('submit'); ?></button>
                </div>
            </div>
            </form>
        </div>
    </div>

</div>