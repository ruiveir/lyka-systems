  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js" charset="utf-8"></script>

  <!-- SBAdmin JavaScript-->
  <script src="{{asset('/js/sb-admin-2.min.js')}}"></script>

  <!-- Chart JS -->
  <script src="{{asset('/vendor/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('/js/demo/chart-area-demo.js')}}"></script>
  <script src="{{asset('/js/demo/chart-pie-demo.js')}}"></script>

  <!-- DataTables JavaScript-->
  <script src="{{asset('/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Individual Scripts -->
  @yield('scripts')
