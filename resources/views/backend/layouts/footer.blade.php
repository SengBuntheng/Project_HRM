<footer class="main-footer">
    <strong>Copyright &copy; 2025-2026 <a href="https://adminlte.io">SU30</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('assets/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets/dist/js/pages/dashboard.js')}}"></script>

<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

@stack('scripts')

<!-- <script>
$(function () {

    @if(session('toast_success'))
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Success',
            body: @json(session('toast_success')),
            autohide: true,
            delay: 3000,
            icon: 'fas fa-check-circle'
        });
    @endif

    @if(session('toast_error'))
        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Error',
            body: @json(session('toast_error')),
            autohide: true,
            delay: 3000,
            icon: 'fas fa-times-circle'
        });
    @endif

});
</script> -->

<div id="toast-data" data-errors='@json($errors->all())' data-success='@json(session('toast_success'))'></div>

<script>
$(function () {
    const toastDataEl = document.getElementById('toast-data');
    const errorMessages = toastDataEl ? JSON.parse(toastDataEl.dataset.errors || '[]') : [];
    const toastSuccess = toastDataEl ? JSON.parse(toastDataEl.dataset.success || 'null') : null;

    if (Array.isArray(errorMessages) && errorMessages.length > 0) {
        let errorHtml = '<ul style="margin:0;padding-left:18px;">';
        errorMessages.forEach(function (msg) {
            errorHtml += '<li>' + msg + '</li>';
        });
        errorHtml += '</ul>';

        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Validation Error',
            body: errorHtml,
            autohide: true,
            delay: 6000,
            icon: 'fas fa-times-circle'
        });
    }

    if (toastSuccess) {
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Success',
            body: toastSuccess,
            autohide: true,
            delay: 3000,
            icon: 'fas fa-check-circle'
        });
    }
});
</script>



</body>
</html>
