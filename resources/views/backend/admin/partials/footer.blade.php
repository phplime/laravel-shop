</div>
</div><!-- content -->
</div><!-- content-wrapper./ -->

<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer><!-- main-footer -->

</div><!-- wrapper -->




<script src="{{ asset('assets/plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
<!-- Admin js -->
<script src="{{ asset('assets/backend/js/adminlte.js') }}"></script>
<!-- select2 -->
<script src="{{ asset('assets/backend/plugins/select2/select2.main.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/select2/select-2.main.js') }}"></script>

<script src="{{ asset('assets/backend/plugins/datatables/datatables.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/date/daterangepicker.js') }}"></script>
<!-- summernote js -->
<script src="{{ asset('assets/backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/date/moment.min.js') }}"></script>
<!-- nice select -->
<script src="{{ asset('assets/backend/plugins/niceselect/jquery.nice-select.min.js') }}"></script>
<!-- sweetalert -->
<script src="{{ asset('assets/backend/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/plugins/notify/notify.main.js') }}"></script>


<!-- main js -->
<script src="{{ asset('global/ajaxJs.js') }}"></script>
<script src="{{ asset('global/admin.main.js') }}"></script>

<div class="defaultSidebar theme-1">
    <div class="sidebarWrapper">
        <div class="sidebar_header">
            <h4 class="title"></h4>
            <a href="javascript:;" class="hideSidebar"><i class="icofont-close-line-squared-alt"></i></a>
        </div>
        <div class="sidebarContent">

        </div>
    </div>
</div><!-- defaultSidebar -->



@if (session('success'))
    <script>
        new Notify({
            status: 'success',
            title: "{{ __('success') }}",
            text: "{{ session('success') }}",
            effect: 'slide',
            speed: 300,
            autoclose: true,
            showCloseButton: true,
            gap: 20,
            distance: 20,
            customClass: 'ci-notify',
            type: 'filled', // or 'outline'
        });
    </script>
@endif

@if (session('error'))
    <script>
        new Notify({
            status: 'error',
            title: "{{ __('error') }}",
            text: "{{ session('error') }}",
            effect: 'slide',
            speed: 300,
            autoclose: true,
            showCloseButton: true,
            gap: 20,
            distance: 20,
            customClass: 'ci-notify',
            type: 'filled', // or 'outline'
        });
    </script>
@endif


<?= view('media_layouts/uploader', ['userId' => !empty(user('id')) ? user('id') : (!empty(user('id')) ? user('id') : '0'), 'vendorId' => !empty(user('vendor_id')) ? user('vendor_id') : '0', 'role' => !empty(user('user_login')) ? 'user' : 'admin']) ?>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<script>
    $(document).ready(function() {
        $('.dataTable, .data-table').DataTable();
    });
</script>


<script>
    if ($('.singeSelect').length > 0) {

        $(document).ready(function() {
            new Selectr('.singeSelect', {
                renderOption: myRenderFunction,
                multiple: false,
                customClass: 'customSelect-2'
            });
        });


        function myRenderFunction(option) {
            var template = [
                "<div class='selectImg'><img src='", option.dataset.src, "'><span>",
                option.textContent,
                "</span></div>"
            ];
            return template.join('');
        }

        function updateFlag(select) {

            var selectedOption = select.options[select.selectedIndex];
            var flagUrl = selectedOption.dataset.src;
            select.style.backgroundImage = "url('" + flagUrl + "')";
        }
    }
</script>
@yield('scripts')
