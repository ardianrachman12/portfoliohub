<!-- plugins:js -->
<script src="{{ asset('template-admin/vendors/base/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="{{ asset('template-admin/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('template-admin/js/jquery.cookie.js') }}" type="text/javascript"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{ asset('template-admin/js/off-canvas.js') }}"></script>
<script src="{{ asset('template-admin/js/hoverable-collapse.js') }}"></script>
{{-- <script src="{{ asset('template-admin/js/template.js') }}"></script> --}}
<script src="{{ asset('template-admin/js/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset('template-admin/js/dashboard.js') }}"></script>

<!-- Bootstrap JS (pastikan Anda sudah memuat file Bootstrap JS di halaman Anda) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
{{-- <script src="{{asset('template-admin/js/chart.js')}}"></script> --}}

<!-- data table -->
<script src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
@stack('scripts')


<!-- End custom js for this page-->
