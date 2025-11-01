<x-profile-layout>

    <section class="myProfileSection">
        <div class="container">
            <a href="{{ url('kinbo') }}" class="back-btn"><i class="icofont-arrow-left"></i> Black</a>
            <div class="row">
                <div class="col-md-5 col-lg-4 col-sm-12 mb-lg-0 mb-20">
                    <div class="card">
                        <div class="card-header space-between align-center">
                            <h5 class="card-title">My Profile</h5>
                            <a href="javascript:;" class="btn btn-primary" data-toggle="modal"
                                data-target="#editProfile"><i class="fa fa-edit"></i> Edit</a>
                        </div>
                        <div class="card-body">
                            <div class="customerProfile">
                                <img src="{{ asset('assets/backend/images/avatar.png') }}" alt="img">
                            </div>
                            <div class="customer_profileInfo">
                                <ul class="customer_info_area">
                                    <li>
                                        <b>Name :</b>
                                        <h6>Emran hossain</h6>
                                    </li>
                                    <li>
                                        <b>Email :</b>
                                        <h6>Emran@gmail.com</h6>
                                    </li>
                                    <li>
                                        <b>Phone :</b>
                                        <h6>+8801823463</h6>
                                    </li>
                                    <li>
                                        <b>Gender :</b>
                                        <h6>Male</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- col./ -->
                <div class="col-md-7 col-lg-8 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Order History</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered db-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order ID</th>
                                            <th>Total Amount</th>
                                            <th>Total Qty</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td data-label="#">1</td>
                                            <td data-label="Order ID">#1239809234</td>
                                            <td data-label="Total Amount">$ 100.00</td>
                                            <td data-label="Total Qty">4</td>
                                            <td data-label="Date">20 Jan 2025</td>
                                            <td data-label="Status"><span class="orderStatus pending">Pending</span></td>
                                            <td data-label="Action">
                                                <a href="{{ url('view-order/hgaj76234jha/kinbo') }}" class="btn action_btn btn-outline-info"><i class="fa fa-eye"></i> View</a>
                                                <a href="" class="btn btn-outline-danger action_btn"><i class="fa fa-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- row./ -->
        </div>
    </section>



    <!-- Edit Modal -->
    <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Full Name <span class="error">*</span></label>
                            <input type="text" name="name" class="form-control" value="Emran">
                        </div>
                        <div class="form-group">
                            <label for="">Phone <span class="error">*</span></label>
                            <input type="text" name="phone" class="form-control only_number" value="0189384234">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" value="emran@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="">Profile Image</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Gender</label>
                            <div class="flex align-center gap-10">
                                <label class="custom-radio pointer flex align-center">
                                    <input type="radio" name="gender" value="female" checked>Female
                                </label>
                                <label class="custom-radio pointer flex align-center">
                                    <input type="radio" name="gender" value="male">Male
                                </label>
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

</x-profile-layout>
