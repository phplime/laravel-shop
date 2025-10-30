<x-admin-layout>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header flex space-between align-center">
                    <h5 class="card-title">User List</h5>
                    <a href="" class="btn addNewBtn"><i class="fa fa-plus"></i> Add New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Username</th>
                                    <th>Account Type</th>
                                    <th>Date</th>
                                    <th>Overview</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-label="Sl">1</td>
                                    <td data-label="Username">emran</td>
                                    <td data-label="Account Type">user</td>
                                    <td data-label="Date">
                                        <label class="date-label">10 Jan 2025 10:50AM</label>
                                    </td>
                                    <td data-label="Overview">
                                        <a href="" class="label bg-soft-success"><i class="fa fa-check"></i> Paid</a>
                                        <a href="" class="badge badge-danger action_btn"><i class="fa fa-spinner"></i> Pending</a>
                                    </td>
                                    <td data-label="Status">
                                        <a href="" class="label label-soft-default">Active</a>
                                    </td>
                                    <td data-label="Action">
                                        <a href="" class="btn action_btn edit_btn">Edit</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
