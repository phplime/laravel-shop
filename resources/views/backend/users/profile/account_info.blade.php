@extends('backend.vendor.layouts.app')
@section('content')
<div class="vendorContent">
    <div class="profileLeftMenu">
        @include('backend.users.profile.profileMenu')
    </div>
    <div class="profilerightMenu">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ url('login/update_account_info') }}" method="post">
                            @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= __('account_information'); ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= __('name'); ?> <?= __required(); ?></label>
                                            <input type="text" name="name" class="form-control" value="" <?= __required(true); ?>>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= __('email'); ?> <?= __required(); ?></label>
                                            <input type="text" name="email" class="form-control" value="" <?= __required(true); ?>>
                                        </div>
                                    </div>

                                </div><!-- row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group  mb-0">
                                            <label><?= lang("country"); ?> <?= __required(); ?></label>
                                            {{-- <?php country_list($u_info->country_id); ?> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label><?= __('phone'); ?></label>
                                        <div class="ci-input-group input-group-append">
                                            <div class="input-group">
                                                <span> + </span> <input type="text" name="dial_code" class="form-control max-w-60" value="<?= "xxx"; ?>">
                                            </div>
                                            <input type="text" name="phone" class="form-control phone" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <?= __submitBtn() ?>
                            </div>
                        </div>
                        </form>
                    </div>
                </div><!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= __('account_security'); ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="header">
                                    <h4>
                                            <i class="fas fa-check-circle text-success"></i>
                                            {{-- <i class="icofont-close-line-circled text-danger"></i> --}}

                                        <?= __('twofactor_authentication'); ?>
                                    </h4>
                                </div>

                                <div class="mt-2rm bb-solid-1 soft-border-color">
                                    <ul>
                                        <li class="flex bb-dashed-1 py-1rm soft-border-color">
                                            <b class="wd-10rm"><?= __('otp_preference'); ?></b>
                                            <span class="flex-1"><?= __('email') ?></span>
                                            <a href="javascript:;" class="sidebar" onclick='sidebar(`otpSidebar`)'><?= __('edit'); ?></a>
                                        </li>

                                        <li class="flex py-1rm ">
                                            <b class="wd-10rm"><?= __('email'); ?></b> <span class="flex-1">sd</span> </a>
                                        </li>

                                            <li class="flex py-1rm ">
                                                <b class="wd-10rm"><?= __('phone'); ?></b> <span class="flex-1">01919821479</span> </a>
                                            </li>


                                        <li class="flex  justify-conten-end pb-1rm">
                                            <a href="<?= url("login/twofa_status/0"); ?>" class="action_btn" data-msg="<?= __("turn_off_towfactor_auth"); ?>"><?= __('turn_off_towfactor_auth'); ?></a>

                                            <a href="<?= url("login/twofa_status/1"); ?>" class="action_btn" data-msg="<?= __("turn_on_towfactor_auth"); ?>"><?= __('turn_on_towfactor_auth'); ?></a>
                                        </li>
                                    </ul>
                                </div>


                                    <div class="pt-1rm">
                                        <div class="header">
                                            <h4><?= __('your_session'); ?></h4>
                                            <p><?= __('twofa_session_message'); ?></p>
                                        </div>
                                        <div class="sessionContent mt-2rm">

                                                <div class="singleDevice d-flex align-center gap-2rm">
                                                    <div class="max-w-80">
                                                            <i class="icofont-ui-touch-phone fz-2rm"></i>
                                                            <i class="icofont-laptop fz-2rm"></i>
                                                    </div>
                                                    <div class="deviceInfo">
                                                        <h4>Windows 10</h4>
                                                        <small><i class="fas fa-check-circle"></i> <?= __('current_session'); ?></small>
                                                        <p>Unknown Address</p>
                                                        <?= __('last_login'); ?> : <?= '12 Apr, 2025 - 10:32 pm' ?>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- col-md-8 -->
        </div>
    </div>
</div>

<?= __header(__('otp_preference'), url(''), 'otps'); ?><?= __footer(); ?>

<?= __header(__('otp_preference'), url('login/change_otp_preference'), 'otp'); ?>
<div class="form-group">
    <label class="custom-radio">
    <input type="radio" name="otp_preference" value="email">
    <?= __('email'); ?>
    </label>
</div>

<?= __footer(); ?>

@endsection
