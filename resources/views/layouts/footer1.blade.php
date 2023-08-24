
<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
<!-- JQUERY JS -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<!-- BOOTSTRAP JS -->
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{asset('assets/plugins/bootstrap-daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/plugins/input-mask/jquery.mask.min.js')}}"></script>
<script src="{{asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2.js')}}"></script>
<script src="{{asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
<script src="{{asset('assets/plugins/time-picker/jquery.timepicker.js')}}"></script>
<script src="{{asset('assets/plugins/time-picker/toggles.min.js')}}"></script>
<script src="{{asset('assets/plugins/intl-tel-input-master/intlTelInput.js')}}"></script>
<script src="{{asset('assets/plugins/intl-tel-input-master/country-select.js')}}"></script>
<script src="{{asset('assets/plugins/intl-tel-input-master/utils.js')}}"></script>
<script src="{{asset('assets/plugins/jQuerytransfer/jquery.transfer.js')}}"></script>
<script src="{{asset('assets/plugins/multi/multi.min.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/date-picker.js')}}"></script>
<script src="{{asset('assets/plugins/date-picker/jquery-ui.js')}}"></script>
<script src="{{asset('assets/plugins/input-mask/jquery.maskedinput.js')}}"></script>
<script src="{{asset('assets/plugins/pickr-master/pickr.es5.min.js')}}"></script>
<script src="{{asset('assets/js/picker.js')}}"></script>
<script src="{{asset('assets/plugins/multipleselect/multiple-select.js')}}"></script>
<script src="{{asset('assets/plugins/multipleselect/multi-select.js')}}"></script>
<script src="{{asset('assets/js/formelementadvnced.js')}}"></script>
<script src="{{asset('assets/js/form-elements.js')}}"></script>












<!-- SPARKLINE JS-->
<script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script>
<!-- Sticky js -->
<script src="{{ asset('assets/js/sticky.js') }}"></script>
<!-- CHART-CIRCLE JS-->
<script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>
<!-- PIETY CHART JS-->
<script src="{{ asset('assets/plugins/peitychart/jquery.peity.min.js') }}"></script>
<script src="{{ asset('assets/plugins/peitychart/peitychart.init.js') }}"></script>
<!-- SIDEBAR JS -->
<script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>
<!-- Perfect SCROLLBAR JS-->
<script src="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/plugins/p-scroll/pscroll.js') }}"></script>
<script src="{{ asset('assets/plugins/p-scroll/pscroll-1.js') }}"></script>
<!-- INTERNAL CHARTJS CHART JS-->
<script src="{{ asset('assets/plugins/chart/Chart.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/chart/rounded-barchart.js') }}"></script>
<script src="{{ asset('assets/plugins/chart/utils.js') }}"></script>
<!-- INTERNAL SELECT2 JS -->
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
<!-- INTERNAL Data tables js-->
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<!-- INTERNAL APEXCHART JS -->
<script src="{{ asset('assets/js/apexcharts.js') }}"></script>
<script src="{{ asset('assets/plugins/apexchart/irregular-data-series.js') }}"></script>
<!-- C3 CHART JS -->
<script src="{{ asset('assets/plugins/charts-c3/d3.v5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/charts-c3/c3-chart.js') }}"></script>
<!-- CHART-DONUT JS -->
<script src="{{ asset('assets/js/charts.js') }}"></script>
<!-- INTERNAL Flot JS -->
<script src="{{ asset('assets/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.fillbetween.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/chart.flot.sampledata.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/dashboard.sampledata.js') }}"></script>
<!-- INTERNAL Vector js -->
<script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- SIDE-MENU JS-->
<script src="{{ asset('assets/plugins/sidemenu/sidemenu.js') }}"></script>
<!-- INTERNAL INDEX JS -->
<script src="{{ asset('assets/js/index1.js') }}"></script>
<!-- Color Theme js -->
<script src="{{ asset('assets/js/themeColors.js') }}"></script>


@if(!isset($themePage))
<script src="{{ asset('assets/js/custom.js') }}"></script>
@endif
@if(isset($themePage))
   <!-- CUSTOM JS -->
   <script src="{{asset('assets/js/custom1.js')}}"></script>
   @endif
<!-- CUSTOM JS -->

   <!-- Switcher js -->
   <script src="{{asset('assets/switcher/js/switcher.js')}}"></script>

     <!-- DEFAULT CALENDAR JS-->
     <script src="{{asset('assets/plugins/calendar/underscore-min.js')}}"></script>
     <script src="{{asset('assets/plugins/calendar/moment.js')}}"></script>
     <script src="{{asset('assets/plugins/calendar/calendar.js')}}"></script>
     <script src="{{asset('assets/plugins/calendar/defaultcalendar.js')}}"></script>
 
</body>
</html>
