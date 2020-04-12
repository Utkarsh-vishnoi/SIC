<script type="text/javascript">
$(document).ready(function() {
	@if(Session::has('info'))
		$.notify("{{ Session::get('info') }}", "info");
	@endif
	@if(Session::has('error'))
		$.notify("{{ Session::get('error') }}", "error");
	@endif
	@if(Session::has('warning'))
		$.notify("{{ Session::get('warning') }}", "warning");
	@endif
	@if(Session::has('success'))
		$.notify("{{ Session::get('success') }}", "success");
	@endif
});
</script>