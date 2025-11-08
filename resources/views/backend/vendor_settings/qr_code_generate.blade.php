@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        @include('backend.vendor_settings.inc.v_settings_menu')
        <div class="col-lg-9 col-xs-12">
            <div class="row">
                <div class="col-md-9 ">
                    <form action="" id="qrCodeForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= __('generate_qr') ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label"><?= __('qrtype') ?></label>
                                    <select name="qrtype" id="qrtype" class="form-control">
                                        <option value="qr">QR</option>
                                        <option value="dinein"><?= __('dinein') ?></option>
                                        <option value="wifi"><?= __('wifi') ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for=" data" class="form-label"><?= __('url') ?></label>
                                    <input type="text" class="form-control" id="data" name="url" value="">
                                </div>
                                <div class="dineinArea hidden">
                                    <div class="form-group">
                                        <label for="table_no" class="form-label"><?= __('select_table') ?></label>
                                        <select name="table_no" class="form-control">
                                            <option value="1">table 1</option>
                                            <option value="2">table 2</option>
                                        </select>
                                        {{-- <p> <?= __('not_found') ?></p> --}}
                                    </div>
                                </div>

                                <div class="wifiArea hidden">
                                    <div class="form-group">
                                        <label><?= __('ssid') ?></label>
                                        <input type="text" class="form-control" id="ssid" name="ssid"
                                            value="">
                                    </div>

                                    <div class="form-group">
                                        <label><?= __('password') ?></label>
                                        <input type="text" class="form-control" id="password" name="password"
                                            value="">
                                    </div>

                                    <div class="form-group">
                                        <label><?= __('security') ?></label>
                                        <select name="wifisecurity" id="wifisecurity" class="form-control">
                                            <option value="wep"> WEP</option>
                                            <option value="wpa" selected> WPA</option>
                                            <option value="nopass">nopass</option>
                                        </select>
                                    </div>
                                </div><!-- wifiArea -->
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="width" class="form-label"><?= __('width') ?></label>
                                        <input type="number" class="form-control" id="width" name="width"
                                            value="300">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="height" class="form-label"><?= __('height') ?></label>
                                        <input type="number" class="form-control" id="height" name="height"
                                            value="300">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="margin" class="form-label"><?= __('margin') ?></label>
                                        <input type="number" class="form-control" id="margin" name="margin"
                                            value="7">
                                    </div>
                                </div>
                            </div>
                        </div><!-- card 1 -->

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= __('logo_or_text_options') ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label"><?= __('select') ?></label>
                                    <select name="logoType" class="form-control">
                                        <option value="logo" selected> <?= __('logo') ?></option>
                                        <option value="text"> <?= __('text') ?></option>
                                    </select>
                                </div>

                                <!-- Logo Options (initially visible) -->
                                <div id="logoOptions" class="">
                                    <div class="form-group">
                                        <label for="logoUpload" class="form-label"><?= __('upload_logo') ?></label>
                                        <input type="file" class="form-control" id="logoUpload" name="logoUpload"
                                            accept="image/*" value="">

                                        <img id="logoPreview"
                                            src="{{ asset('assets/backend/images/default-612x612.jpg') }}"
                                            alt="Logo Preview" style=" max-width: 100px; margin-top: 10px;">
                                        <input type="hidden" name="qrlogo" value="">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="logoSize" class="form-label"><?= __('size') ?> (%)</label>
                                            <input type="number" class="form-control" id="logoSize" name="logoSize"
                                                value="20" min="5" max="50">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="logoMargin" class="form-label"><?= __('margin') ?> (%)</label>
                                            <input type="number" class="form-control" id="logoMargin" name="logoMargin"
                                                value="5" min="0" max="20">
                                        </div>
                                    </div>
                                </div>

                                <!-- Text Options (initially hidden) -->
                                <div id="textOptions" class="">
                                    <div class="form-group">
                                        <label for="centerText" class="form-label"><?= __('text') ?></label>
                                        <input type="text" class="form-control" id="centerText" name="centerText"
                                            placeholder="Enter text" value="content">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="textSize" class="form-label"><?= __('size') ?> (%)</label>
                                            <input type="number" class="form-control" id="textSize" name="textSize"
                                                value="size" min="5" max="40">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="textColor" class="form-label"><?= __('color') ?></label>
                                            <input type="color" class="form-control form-control-color" id="textColor"
                                                name="textColor" value="#000000">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="textFont" class="form-label"><?= __('font') ?></label>
                                        <select class="form-select form-control" id="textFont" name="textFont">
                                            <option value="Arial">
                                                Arial</option>
                                            <option value="Verdana">
                                                Verdana</option>
                                            <option value="Helvetica">
                                                Helvetica</option>
                                            <option value="Times New Roman">
                                                Times New Roman</option>
                                            <option value="Courier New">
                                                Courier New</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= __('dot_options') ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dotsStyle" class="form-label"><?= __('style') ?></label>
                                            <select class="form-select form-control" id="dotsStyle" name="dotsStyle">
                                                <option value="square">
                                                    <?= __('Square') ?></option>
                                                <option value="dots">
                                                    <?= __('Dots') ?></option>
                                                <option value="rounded">
                                                    <?= __('Rounded') ?></option>
                                                <option value="extra-rounded">
                                                    <?= __('extra_rounded') ?></option>
                                                <option value="classy">
                                                    <?= __('classy') ?></option>
                                                <option value="classy-rounded">
                                                    <?= __('classy_rounded') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"><?= __('color') ?></label>
                                            <input type="color" class="form-control form-control-color" id="dotsColor"
                                                name="dotsColor" value="#800080">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- card2 -->

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> <?= __('corners_options') ?> </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cornersSquareStyle" class="form-label"><?= __('style') ?></label>
                                            <select class="form-control" id="cornersSquareStyle"
                                                name="cornersSquareStyle">
                                                <option value="extra-rounded">
                                                    <?= __('extra_rounded') ?></option>
                                                <option value="square">
                                                    <?= __('square') ?></option>
                                                <option value="dot">
                                                    <?= __('dot') ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"><?= __('color') ?></label>
                                            <input type="color" class="form-control form-control-color"
                                                id="cornersSquareColor" name="cornersSquareColor" value="#000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- card3 -->

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= __('background_options') ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label><?= __('background_color') ?></label>
                                    <input type="color" class="form-control form-control-color" id="backgroundColor"
                                        name="backgroundColor" value="#fff">
                                </div>
                            </div>
                        </div><!-- card4 -->
                        <div class="card hidden">
                            <div class="card-header">
                                <h4 class="card-title"><?= __('qr_code_details') ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for=" qrName" class="form-label"><?= __('qr_code_name') ?></label>
                                    <input type="text" class="form-control" id="qrName" name="qrName"
                                        placeholder="My QR Code">
                                </div>
                                <div class="form-group">
                                    <label for=" qrDescription" class="form-label"><?= __('description') ?></label>
                                    <textarea class="form-control" id="qrDescription" name="qrDescription" rows="2"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <input type="hidden" name="id" value="0">
                                <div class="action-buttons d-flex gap-10 justify-content-center">
                                    <!-- <button type="submit" class="btn btn-primary">Generate QR Code</button> -->
                                    <button type="button" id="saveToDbBtn" class="btn btn-info"><i
                                            class="fas fa-save"></i> <?= __('save') ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- col-8 -->
                <div class="col-md-3">
                    <div class="card">
                        <input type="hidden" name="username" value="phplime">
                        <div class="card-body">
                            <div id="qrCode" class="text-center" data-url=""></div>
                            <div id="statusMessage" class="mt-3"></div>
                            <div class="text-center mt-10">
                                <button type="button" id="downloadBtn" class="btn btn-success btn-sm"><i
                                        class="fas fa-download"></i> <?= __('download') ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/backend/plugins/qrcode.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/initQr.js') }}"></script>
@endpush
