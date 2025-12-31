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
<script src="{{ asset('assets/backend/plugins/bootstrapToggle.js') }}"></script>
<script src="{{ asset('assets/plugins/notify/notify.main.js') }}"></script>


<!-- main js -->
<script src="{{ asset('global/ajaxJs.js?t='.time()) }}"></script>
<script src="{{ asset('global/admin.main.js?t='.time()) }}"></script>

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

<script>
    // Theme Toggle Functionality
    (function() {
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const body = document.body;

        // Get saved theme from localStorage or default to light
        const savedTheme = localStorage.getItem('theme') || 'theme-light';
        if (savedTheme == 'theme-dark') {
            body.classList.remove('theme-light');
            body.classList.remove('light');
        } else {
            body.classList.remove('theme-dark');
            body.classList.remove('dark');
        }
        // Apply saved theme on page load
        body.classList.add(savedTheme);
        updateIcon(savedTheme);

        // Toggle theme on button click
        if (themeToggle) {
            themeToggle.addEventListener('click', function(e) {
                e.preventDefault();

                // Toggle between theme-dark and theme-light
                if (body.classList.contains('theme-dark')) {
                    body.classList.remove('theme-dark');
                    body.classList.remove('dark');
                    body.classList.add('theme-light');
                    localStorage.setItem('theme', 'theme-light');
                    updateIcon('theme-light');
                } else {
                    body.classList.remove('theme-light');
                    body.classList.remove('light');
                    body.classList.add('theme-dark');
                    localStorage.setItem('theme', 'theme-dark');
                    updateIcon('theme-dark');
                }
            });
        }

        function updateIcon(theme) {
            if (theme === 'theme-dark') {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        }
    })();
</script>

@yield('scripts')