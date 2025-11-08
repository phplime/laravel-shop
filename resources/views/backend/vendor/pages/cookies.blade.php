@extends('backend.vendor.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="<?= url('vendor/pages/add_page') ?>" method="post" onsubmit="formSubmit(event,this);">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><?= __('cookies') ?></div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="slug" value="cookies">
                        <div class="form-group">
                            <label><?= __('title') ?> <span class="text-danger">*</span> </label>
                            <input type="text" name="title[en]" class="form-control" placeholder="<?= __('title') ?>"
                                value="">
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label><?= __('details') ?> <span class="text-danger">*</span></label>
                                <textarea name="details[en]" id="details_en" class="form-control textarea">

                                </textarea>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer text-right">
                        <?= hidden('is_modal', 1) ?>
                        <?= hidden('id', 0) ?>
                        <?= __submitBtn() ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
