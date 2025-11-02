  <div class="row">
      <?php $this->load->view('backend/vendor_settings/inc/v_settings_menu.php', ['col' => 'col-lg-12']); ?>
      <div class="<?= __vsettings('menu_style') == 'topmenu' ? "col-lg-9" : "col-lg-9 "; ?> col-xs-12">
          <div class="row">
              <div class="col-md-9 ">
                  <form action="<?= base_url('vendor/settings/save_qr') ?>" id="qrCodeForm" method="post" enctype="multipart/form-data">
                      <?= csrf(); ?>
                      <div class="card">
                          <div class="card-header">
                              <h4 class="card-title"><?= __('generate_qr'); ?></h4>
                              <?php $qrOptions = !empty($qr_data->config) && isJson($qr_data->config) ? json_decode($qr_data->config) : ''; ?>

                          </div>
                          <div class="card-body">
                              <div class="form-group">
                                  <label class="form-label"><?= __('qrtype'); ?></label>
                                  <select name="qrtype" id="qrtype" class="form-control">
                                      <option value="qr" <?= isset($qr_data->qrtype) && $qr_data->qrtype == 'qr' ? 'selected' : ''; ?>>QR</option>
                                      <option value="dinein" <?= isset($qr_data->qrtype) && $qr_data->qrtype == 'dinein' ? 'selected' : ''; ?>><?= __('dinein'); ?></option>
                                      <option value="wifi" <?= isset($qr_data->qrtype) && $qr_data->qrtype == 'wifi' ? 'selected' : ''; ?>><?= __('wifi'); ?></option>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label for=" data" class="form-label"><?= __('url'); ?></label>
                                  <input type="text" class="form-control" id="data" name="url" value="<?= __isset($qr_data, 'url', base_url(auth('username'))) ?? base_url(auth('username')); ?>">
                              </div>
                              <div class="dineinArea hidden">
                                  <?php $table_list = $this->vendor_m->get_vendor_table_list(_ID()); ?>
                                  <div class="form-group">
                                      <label for="table_no" class="form-label"><?= __('select_table'); ?></label>
                                      <?php if (sizeof($table_list) > 0): ?>
                                          <select name="table_no" class="form-control">
                                              <?php foreach ($table_list as $table): ?>
                                                  <option value="<?= _x($table->id) ?>" <?= isset($qr_data->table_no) && $qr_data->table_no == $table->id ? 'selected' : ''; ?>><?= _x($table->table_name); ?></option>
                                              <?php endforeach; ?>
                                          </select>
                                      <?php else: ?>
                                          <p> <?= __('not_found'); ?></p>
                                      <?php endif; ?>
                                  </div>
                              </div>


                              <div class="wifiArea hidden">
                                  <div class="form-group">
                                      <label><?= __('ssid'); ?></label>
                                      <input type="text" class="form-control" id="ssid" name="ssid" value="<?= !empty($qrOptions->wifi->ssid) ? $qrOptions->wifi->ssid : ''; ?>">
                                  </div>

                                  <div class="form-group">
                                      <label><?= __('password'); ?></label>
                                      <input type="text" class="form-control" id="password" name="password" value="<?= !empty($qrOptions->wifi->password) ? $qrOptions->wifi->password : ''; ?>">
                                  </div>

                                  <div class="form-group">
                                      <label><?= __('security'); ?></label>
                                      <select name="wifisecurity" id="wifisecurity" class="form-control">
                                          <option value="wep" <?= isset($qrOptions->wifi->wifisecurity) && $qrOptions->wifi->wifisecurity == "wep" ? "selected" : ""; ?>>WEP</option>
                                          <option value="wpa" <?= isset($qrOptions->wifi->wifisecurity) && $qrOptions->wifi->wifisecurity == "wpa" ? "selected" : ""; ?>>WPA</option>
                                          <option value="nopass" <?= isset($qrOptions->wifi->wifisecurity) && $qrOptions->wifi->wifisecurity == "nopass" ? "selected" : ""; ?>>nopass</option>
                                          </option>
                                      </select>
                                  </div>
                              </div><!-- wifiArea -->
                              <div class="row">
                                  <div class="form-group col-md-4">
                                      <label for="width" class="form-label"><?= __('width'); ?></label>
                                      <input type="number" class="form-control" id="width" name="width" value="<?= __isset($qrOptions, 'width', "300") ?? "300"; ?>">
                                  </div>
                                  <div class="form-group col-md-4">
                                      <label for="height" class="form-label"><?= __('height'); ?></label>
                                      <input type="number" class="form-control" id="height" name="height" value="<?= __isset($qrOptions, 'height', "300") ?? "300"; ?>">
                                  </div>
                                  <div class="form-group col-md-4">
                                      <label for="margin" class="form-label"><?= __('margin'); ?></label>
                                      <input type="number" class="form-control" id="margin" name="margin" value="<?= __isset($qrOptions, 'margin', '7') ?? "7"; ?>">
                                  </div>
                              </div>
                          </div>
                      </div><!-- card 1 -->

                      <div class="card">
                          <div class="card-header">
                              <h4 class="card-title"><?= __('logo_or_text_options'); ?></h4>
                          </div>
                          <div class="card-body">
                              <div class="form-group">
                                  <label class="form-label"><?= __('select'); ?></label>
                                  <select name="logoType" class="form-control">
                                      <option value="logo" <?= isset($qr_data->logoType) && $logoType == "logo" ? "selected" : ""; ?>><?= __('logo'); ?></option>
                                      <option value="text" <?= isset($qr_data->logoType) && $logoType == "text" ? "selected" : ""; ?>><?= __('text'); ?></option>
                                  </select>
                              </div>

                              <!-- Logo Options (initially visible) -->
                              <div id="logoOptions" class="<?= isset($qrOptions->logoType) && $qrOptions->logoType == 'text' ? "hidden" : ""; ?>">

                                  <div class="form-group">
                                      <label for="logoUpload" class="form-label"><?= __('upload_logo'); ?></label>
                                      <input type="file" class="form-control" id="logoUpload" name="logoUpload" accept="image/*" value="">

                                      <img id="logoPreview" src="<?= base_url(isset($qrOptions->logo->path) ? $qrOptions->logo->path : ""); ?>" alt="Logo Preview" style="display:<?= isset($qrOptions->logo->path) && !empty($qrOptions->logo->path) ? "" : "none"; ?>; max-width: 100px; margin-top: 10px;">
                                      <input type="hidden" name="qrlogo" value="<?= isset($qrOptions->logo->path) && !empty($qrOptions->logo->path) ? $qrOptions->logo->path : ""; ?>">
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6 form-group">
                                          <label for="logoSize" class="form-label"><?= __('size'); ?> (%)</label>
                                          <input type="number" class="form-control" id="logoSize" name="logoSize" value="<?= isset($qrOptions->logo->logoSize) && !empty($qrOptions->logo->logoSize) ? $qrOptions->logo->logoSize : "20"; ?>" min="5" max="50">
                                      </div>
                                      <div class="col-md-6 form-group">
                                          <label for="logoMargin" class="form-label"><?= __('margin'); ?> (%)</label>
                                          <input type="number" class="form-control" id="logoMargin" name="logoMargin" value="<?= isset($qrOptions->logo->logoMargin) && !empty($qrOptions->logo->logoMargin) ? $qrOptions->logo->logoMargin : "5"; ?>" min="0" max="20">
                                      </div>
                                  </div>
                              </div>

                              <!-- Text Options (initially hidden) -->
                              <div id="textOptions" class="<?= isset($qrOptions->logoType) && $qrOptions->logoType == 'text' ? "" : "hidden"; ?>">
                                  <div class="form-group">
                                      <label for="centerText" class="form-label"><?= __('text'); ?></label>
                                      <input type="text" class="form-control" id="centerText" name="centerText" placeholder="Enter text" value="<?= __isset($qrOptions, 'content', false); ?>">
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6 form-group">
                                          <label for="textSize" class="form-label"><?= __('size'); ?> (%)</label>
                                          <input type="number" class="form-control" id="textSize" name="textSize" value="<?= __isset($qrOptions, 'size', '15'); ?>" min="5" max="40">
                                      </div>
                                      <div class="col-md-6 form-group">
                                          <label for="textColor" class="form-label"><?= __('color'); ?></label>
                                          <input type="color" class="form-control form-control-color" id="textColor" name="textColor" value="<?= __isset($qrOptions, 'color', '#000000'); ?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="textFont" class="form-label"><?= __('font'); ?></label>
                                      <select class="form-select form-control" id="textFont" name="textFont">
                                          <option value="Arial" <?= isset($qrOptions->text->font) && $qrOptions->text->font == "Arial" ? "selected" : ""; ?>>Arial</option>
                                          <option value="Verdana" <?= isset($qrOptions->text->font) && $qrOptions->text->font == "Verdana" ? "selected" : ""; ?>>Verdana</option>
                                          <option value="Helvetica" <?= isset($qrOptions->text->font) && $qrOptions->text->font == "Helvetica" ? "selected" : ""; ?>>Helvetica</option>
                                          <option value="Times New Roman" <?= isset($qrOptions->text->font) && $qrOptions->text->font == "Times New Roman" ? "selected" : ""; ?>>Times New Roman</option>
                                          <option value="Courier New" <?= isset($qrOptions->text->font) && $qrOptions->text->font == "Courier New" ? "selected" : ""; ?>>Courier New</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                      </div>



                      <div class="card">
                          <div class="card-header">
                              <h4 class="card-title"><?= __('dot_options'); ?></h4>
                          </div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="dotsStyle" class="form-label"><?= __('style'); ?></label>
                                          <select class="form-select form-control" id="dotsStyle" name="dotsStyle">
                                              <option value="square" <?= isset($qrOptions->dotsStyle) && $qrOptions->dotsStyle == "square" ? "selected" : ""; ?>><?= __('Square'); ?></option>
                                              <option value="dots" <?= isset($qrOptions->dotsStyle) && $qrOptions->dotsStyle == "dots" ? "selected" : ""; ?>><?= __('Dots'); ?></option>
                                              <option value="rounded" <?= isset($qrOptions->dotsStyle) && $qrOptions->dotsStyle == "rounded" ? "selected" : ""; ?>><?= __('Rounded'); ?></option>
                                              <option value="extra-rounded" <?= isset($qrOptions->dotsStyle) && $qrOptions->dotsStyle == "extra-rounded" ? "selected" : ""; ?>><?= __('extra_rounded'); ?></option>
                                              <option value="classy" <?= isset($qrOptions->dotsStyle) && $qrOptions->dotsStyle == "classy" ? "selected" : ""; ?>><?= __('classy'); ?></option>
                                              <option value="classy-rounded" <?= isset($qrOptions->dotsStyle) && $qrOptions->dotsStyle == "classy-rounded" ? "selected" : ""; ?>><?= __('classy_rounded'); ?></option>

                                          </select>
                                      </div>


                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="form-label"><?= __('color'); ?></label>
                                          <input type="color" class="form-control form-control-color" id="dotsColor" name="dotsColor" value="<?= __isset($qrOptions, 'dotColor', '#800080'); ?>">
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div><!-- card2 -->

                      <div class="card">
                          <div class="card-header">
                              <h4 class="card-title"> <?= __('corners_options'); ?> </h4>
                          </div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="cornersSquareStyle" class="form-label"><?= __('style'); ?></label>
                                          <select class="form-control" id="cornersSquareStyle" name="cornersSquareStyle">
                                              <option value="extra-rounded" <?= isset($qrOptions->cornersSquareStyle) && $qrOptions->cornersSquareStyle == "classy" ? "selected" : ""; ?>><?= __('extra_rounded'); ?></option>
                                              <option value="square" <?= isset($qrOptions->cornersSquareStyle) && $qrOptions->cornersSquareStyle == "classy" ? "selected" : ""; ?>><?= __('square'); ?></option>
                                              <option value="dot" <?= isset($qrOptions->cornersSquareStyle) && $qrOptions->cornersSquareStyle == "classy" ? "selected" : ""; ?>><?= __('dot'); ?></option>

                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="form-label"><?= __('color'); ?></label>
                                          <input type="color" class="form-control form-control-color" id="cornersSquareColor" name="cornersSquareColor" value="<?= __isset($qrOptions, 'cornersSquareColor', '#000000'); ?>">
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div><!-- card3 -->

                      <div class="card">
                          <div class="card-header">
                              <h4 class="card-title"><?= __('background_options'); ?></h4>
                          </div>
                          <div class="card-body">
                              <div class=">
                                <label for=" backgroundColor" class="form-label"><?= __('background_color'); ?></label>
                                  <input type="color" class="form-control form-control-color" id="backgroundColor" name="backgroundColor" value="<?= __isset($qrOptions, 'backgroundColor', '#ffffff'); ?>">
                              </div>
                          </div>
                      </div><!-- card4 -->



                      <div class="card hidden">
                          <div class="card-header">
                              <h4 class="card-title"><?= __('qr_code_details'); ?></h4>
                          </div>
                          <div class="card-body">
                              <div class="form-group">
                                  <label for=" qrName" class="form-label"><?= __('qr_code_name'); ?></label>
                                  <input type="text" class="form-control" id="qrName" name="qrName" placeholder="My QR Code">
                              </div>
                              <div class="form-group">
                                  <label for=" qrDescription" class="form-label"><?= __('description'); ?></label>
                                  <textarea class="form-control" id="qrDescription" name="qrDescription" rows="2"></textarea>
                              </div>
                          </div>
                      </div>

                      <div class="card">
                          <div class="card-body">
                              <input type="hidden" name="id" value="<?= isset($qr_data->id) ? $qr_data->id : 0; ?>">
                              <div class="action-buttons d-flex gap-10 justify-content-center">
                                  <!-- <button type="submit" class="btn btn-primary">Generate QR Code</button> -->

                                  <button type="button" id="saveToDbBtn" class="btn btn-info"><i class="fas fa-save"></i> <?= __('save'); ?></button>
                              </div>
                          </div>
                      </div>

                  </form>
              </div><!-- col-8 -->
              <div class="col-md-3">
                  <div class="card">
                      <input type="hidden" name="username" value="<?= _vendor('username') ?? auth('username'); ?>">
                      <?php
                        $url = '';
                        if (isset($qr_data->qrtype) && $qr_data->qrtype == 'dinein') {
                            $url = base_url(_vendor('username') . "?table=" . $qr_data->table_no ?? 0);
                        }
                        ?>
                      <div class="card-body">
                          <div id="qrCode" class="text-center" data-url="<?= $url; ?>"></div>
                          <div id="statusMessage" class="mt-3"></div>


                          <div class="text-center mt-10">
                              <button type="button" id="downloadBtn" class="btn btn-success btn-sm"><i class="fas fa-download"></i> <?= __('download'); ?></button>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>

  <script src="<?= asset_url('app/assets/plugins/qrcode.js') ?>"></script>
  <script src="<?= asset_url('app/assets/initQr.js') ?>"></script>