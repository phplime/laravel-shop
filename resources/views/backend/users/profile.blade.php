@extends('backend.vendor.layouts.app')

@section('content')
    <div class="vendorContent">
        <div class="profileLeftMenu">
            @include('backend.users.profile.profileMenu')
        </div>
        <div class="profilerightMenu">

            <div class="row">

                <div class="col-md-4 mb-15">
                    <div class="card">
                        <div class="card-body text-center p-0">
                            <div class="single_profile">
                                <div class="singleProfileTop">
                                    <div class="imgArea p-r square">

                                        <img src="http://localhost/shop/writeable/uploads/products/thumb/cc368fa0ff63270480c82aab5567eba6.png"
                                            alt="shopLogo" class="profile_img logo-light">

                                        <img src="http://localhost/shop/writeable/uploads/products/thumb/a54955d550d268cd0ac0b5eedeb300ef.png"
                                            alt="shopLogo" class="profile_img logo-dark">

                                        <span class="cardIcon" data-toggle="tooltip" title="vCard">
                                            <i class="icofont-id-card"></i>
                                        </span>
                                    </div>
                                    <div class="profileDetails">
                                        <h4 class="fw-bold">qmenu</h4>
                                        <p> 01745419093</p>
                                    </div>
                                    <div class="mt-5">
                                        <label class="badge primary-light-active"><i class="icofont-diamond"></i>
                                            Restaurant</label>
                                    </div>
                                    <!-- /.mt-5 -->
                                </div>
                                <!-- /.singleProfileTop -->
                                <div class="buttonArea mt-10">
                                    <a href="" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i></a>
                                    <?= __editBtn('', true, ['is_sidebar' => 1, 'class' => 'editmodule_' . 1]) ?>
                                </div>
                            </div>
                            <label class="is_primary badge-success"><i class="icofont-tack-pin"></i> <?= lang('primary') ?>
                                8</label>
                        </div><!-- single_profile -->
                    </div>
                </div>

                {{-- <?php $my_total_vendor = $this->db->get_where('vendor_list', ['user_id' => auth('id')])->num_rows(); ?> --}}

                <div class="col-lg-4">
                    <div class="card">
                        <form method="POST" action="" class="form-submit">
                            @csrf
                            <div class="card-body">
                                <div class="card-content">

                                    <a href="<?= url('vendor/profile/onboarding') ?>">
                                        <div class="create_new_card">
                                            <i class="fa fa-plus"></i>
                                            <h4><?= __('create_new_store') ?></h4>
                                        </div>
                                    </a>

                                </div><!-- card-content -->
                            </div><!-- card-body -->
                        </form><!-- from -->
                    </div><!-- card -->
                </div><!-- col-6 -->

            </div><!-- row -->
        </div><!-- row -->
    </div><!-- profilerightMenu -->
    </div>


    <?= __header(__('add_new'), url('vendor/profile/update_vendor_info'), 'editmodule_1') ?>

    <div class="form-group">
        <label><?= __('module_list') ?> <span class="error">*</span></label>
        <select name="module_id" class="form-control" id="module_id" onchange="changeModule(this.value)">
            <option value=""><?= __('select') ?></option>
            <option value="">shop</option>
        </select>
    </div>

    <div class="form-group">
        <label><?= __('email') ?> <span class="error">*</span></label>
        <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="">
    </div>
    <div class="form-group">
        <label><?= __('phone') ?> <span class="error">*</span></label>
        <div class="ci-input-group input-group-append">
            <div class="input-group">
                <span>
                    <span class="fi fi-us countryIcon"></span> +1
                </span>
            </div>
            <input type="hidden" name="dial_code" value="">
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" value="">
        </div>

    </div>

    <?= hidden('id', 1,) ?>
    <?= __footer() ?>

    <script>
        function changeModule(slug) {
            $('.moduleDetails').slideUp();
            $(`.moduleDetails.${slug}`).slideDown();
        }
    </script>
@endsection
