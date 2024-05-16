  <!-- latest jquery-->


  <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }} "></script>

  <!-- feather icon js-->
  <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
  <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
  <!-- Sidebar jquery-->
  <script src="{{ asset('assets/js/config.js') }}"></script>
  <!-- Bootstrap js-->
  <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
  <!-- Plugins JS start--> 
  <script src="{{ asset('assets/js/prism/prism.min.js') }}"></script>
  <script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
  <script src="{{ asset('assets/js/custom-card/custom-card.js') }}"></script>
  <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
  <script src="{{ asset('assets/js/height-equal.js') }}"></script>


  <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
  <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
  <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
  <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
  {{-- <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/js/bookmark/jquery.validate.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/js/contacts/custom.js')}}"></script> --}}

  <!-- Plugins JS Ends-->
  <!-- Theme js-->
  <script src="{{ asset('assets/js/script.js') }}"></script>
  <script src="{{ asset('assets/js/theme-customizer/customizer.js') }}"></script>


      <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('assets/js/rating/jquery.barrating.js') }}"></script>
      <script src="{{ asset('assets/js/rating/rating-script.js') }}"></script>
      <script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
      <script src="{{ asset('assets/js/product-list-custom.js') }}"></script>
      <script src="{{ asset('assets/js/ecommerce.js') }}"></script>

      <script src="{{ asset('assets/js/sidebar-menu.js')}}"></script>      

    <script>
      document.addEventListener('DOMContentLoaded', function() {
          const option1 = document.getElementById('radioinline1');
          const option2 = document.getElementById('radioinline2');
          const block = document.getElementById('blockToToggle');
  
          option1.addEventListener('change', function() {
              if (this.checked) {
                  block.style.display = 'block';
              }
          });
  
          option2.addEventListener('change', function() {
              if (this.checked) {
                  block.style.display = 'none';
              }
          });
      });
  </script>
  
  <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>

  <script src="{{ asset('assets/js/time-picker/jquery-clockpicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/time-picker/highlight.min.js') }}"></script>
    <script src="{{ asset('assets/js/time-picker/clockpicker.js') }}"></script>

    {{-- <script src="{{ asset('assets/js/notify/index.js') }}"></script> --}}
    @if(session('success'))
    <script>
     'use strict';
      var success= '{{ session('success') }}';
        var notify = $.notify('<i class="fa fa-bell-o"></i><strong> '+ success +'</strong>', {
            type: 'theme',
            allow_dismiss: true,
            delay: 5000,
        });
    </script>
    @endif