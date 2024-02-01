<script src="{{ asset('admin/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/fk_a_common.js') }}"></script>
<!-- Common js start -->
<script src="{{ asset('common/toast/iziToast.min.js') }}"></script>
<!-- Common js End -->
<script src="{{ asset('admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('common/bootstrap-fileinput/fileinput.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<script src="{{ asset('common/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/plugins/calculator/calculator.js') }}"></script>
<script src="{{ asset('admin/plugins/printThis.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

@yield('js')
<script>
	@if (Session::has('sess_alert'))
	@php
	$alertData = session::get('sess_alert');
	@endphp
	iziToast.success({
		title: '{!!$alertData['status']!!}',
		message: '{!!$alertData['message']!!}',
		position: 'topRight',
		timeout: 3000,
		transitionIn: 'fadeInDown',
		transitionOut: 'fadeOut',
		transitionInMobile: 'fadeInUp',
		transitionOutMobile: 'fadeOutDown',
	});
	@endif
</script>
</body>
</html>
