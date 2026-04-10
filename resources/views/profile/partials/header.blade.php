   <!-- Bootstrap 4 -->
   <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/bootstrap.min.css') }}">
   <!-- font-awesome -->
   <link rel="stylesheet" href="{{ asset('assets/plugins/fontAwesome/css/all.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/plugins/fontAwesome/css/fontawesome.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/plugins/icofont.css') }}">

   <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
   <!-- animation -->
   <link rel="stylesheet" href="{{ asset('assets/backend/plugins/animate/animate.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/backend/plugins/animate/aos.css') }}">

   <link rel="stylesheet" href="{{ asset('global/reset.css?t='.time()) }}">
   <link rel="stylesheet" href="{{ asset('global/theme_1.style.css?t='.time()) }}">
   <!-- Responsive.css -->
   <link rel="stylesheet" href="{{ asset('global/responsive.css?t='.time()) }}">

   <!-- js -->
   <script src="{{ asset('assets/plugins/jquery.main.js') }}"></script>
   <script src="{{ asset('assets/plugins/axios.main.js') }}"></script>
   <script src="{{ asset('global/utilities.js?t=' . time()) }}"></script>


   <script>
      let base_url = `{{ url('/') }}/`;
      let _csrf = `{{ csrf_token() }}`;
      let appLanguage = `{{ app()->getLocale() }}`;
      let vendorSlug = `{{ $vendor->username ?? '' }}`;
      let vendorId = `{{ $vendor->id ?? '' }}`;
      let currencySymbol = `{{ country(__config('currency'))->currency_icon ?? '$' }}`;
      let select_at_least = `{{ __('Select at least') }}`;
      let options = `{{ __('options') }}`;
      let requiredCount = `{{ __('required_count') }}`;
   </script>