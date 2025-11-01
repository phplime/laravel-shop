<x-profile-layout>

    <section class="checkoutSection">
        <div class="container">
            <a href="{{ url('kinbo') }}" class="back-btn"><i class="icofont-arrow-left"></i> Black</a>
            <div class="row">
                <div class="col-md-12 col-lg-8 col-sm-12">

                    <div class="card">
                        <div class="card-header">
                            <div class="guestLogin">
                                <label class="custom-checkbox m-0">
                                    <input type="checkbox" name="is_guest_login" class="" value="1">
                                    <span>Login as Guest</span>
                                </label>
                            </div>
                        </div>
                        <div class="card-body checkout_loginBody">
                            @include('profile.pages.checkout_login')
                        </div>
                    </div>

                    @include('profile.pages.checkout_leftContent')

                </div><!-- col./ -->
                <div class="col-md-12 col-lg-4 col-sm-12">
                    @include('profile.pages.checkout_rightContent')
                </div>
            </div><!-- row./ -->
        </div>
    </section>


    <!-- Add Address Modal -->
    <div class="modal fade" id="add_address" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Shopping Address</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Address <span class="error">*</span></label>
                            <textarea name="address" class="form-control" cols="3" rows="3" placeholder="Address shopping..."></textarea>
                        </div>
                        <div class="form-group mb-0">
                            <label for="">Address Label</label>
                            <div class="addressLabel_area">
                                <label class="address_label_btn active">
                                    <i class="fa-solid fa-house-chimney"></i> Home
                                    <input type="radio" name="address_label" class="d-none" value="home"
                                        checked>
                                </label>
                                <label class="address_label_btn">
                                    <i class="icofont-briefcase fz-20"></i> Office
                                    <input type="radio" name="address_label" class="d-none" value="office">
                                </label>
                                <label class="address_label_btn">
                                    <i class="icofont-folder-plus"></i> Others
                                    <input type="radio" name="address_label" class="d-none" value="others">
                                </label>
                            </div>
                            <div class="form-group other_labelInput mt-15" style="display: none">
                                <input type="text" name="other_label" class="form-control"
                                    placeholder="Others label">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary"><i class="icofont-hand-drag1"></i>&nbsp; Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Terms Modal  -->
    <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terms and Conditions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis beatae a, rem non rerum sapiente
                    eaque doloribus itaque ad at dolores fuga magni quam minima ratione alias repudiandae quas
                    necessitatibus! Officiis possimus, incidunt eos atque ducimus blanditiis neque et quidem ab dolorem
                    ex explicabo ratione tempore odit alias, mollitia laudantium, suscipit aperiam natus repellat
                    commodi itaque deserunt sit aspernatur! Quos, corporis magnam! Voluptatem delectus, deserunt debitis
                    ex nostrum earum non asperiores odit excepturi soluta porro, vero, commodi laborum pariatur rem quod
                    error unde beatae natus inventore mollitia sapiente! Animi unde odit officia saepe inventore iste
                    beatae minus numquam excepturi nihil?
                </div>
            </div>
        </div>
    </div>


</x-profile-layout>
