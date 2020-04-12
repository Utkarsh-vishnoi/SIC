@extends('templates.template')

@section('title', 'Manage Administrator - ')

@section('content')
	<div class="container">

		<h1>Manage Administrators<a data-toggle="modal" data-target="#addAdmin" class="pull-right btn btn-primary">Add an admin</a></h1>
		<div class="table-responsive">
            <table class="table table-striped" id="adminsTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name (If Specified)</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Status</th>
                  <th>Manage</th>
                </tr>
              </thead>
              <tbody>
              @foreach($admins as $individual)
                @include('others.table.admins-table')
              @endforeach
              </tbody>
            </table>
          </div>
	</div>
	@include('others.modals.admin.add')
	@include('others.modals.admin.edit')
	@include('others.modals.admin.delete')
@stop

@section('styles')

.form-awesome {
  max-width: 500px;
  padding: 15px;
}

.form-awesome .form-awesome-heading {
  margin-bottom: 10px;
}

.form-awesome .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-awesome .form-control:focus {
  z-index: 2;
}
.form-awesome input[type="text"] {
  margin-bottom: -1px;
}
.form-awesome input[type="password"] {
  margin-bottom: -1px;
}
.form-awesome input[name="password_confirmation"] {
  margin-bottom: 10px;
}
.terminated {
	color:#F00;
}

.activated {
	color: #5cb85c;
}

.well-warning {
	color: #796620;
	background-color: #f8eec7;
	border-color: #f2e09a;
	padding-top: 10px;
	padding-left: 10px;
	border-style: solid;
	border-width: 1px 0;
}

.fname {
	padding-left: 0;
	padding-right: 7.5px;
}

.lname {
	padding-right: 0;
	padding-left: 7.5px;
}
@endsection

@section('post-scripts')
	$(document).ready(function() {

		$('#add-user-submit').click(function() {addAdmin();});

		$('#addAdminForm').submit(function(e) { e.preventDefault();addAdmin(); });

		$("#addAdmin").on("hidden.bs.modal", function() {
			document.querySelector("#addAdminForm").reset();
			$(".help-block").remove();
			$(".form-group").removeClass("has-error");
		});

		$("#editAdmin").on("hidden.bs.modal", function() {
			document.querySelector("#editAdminForm").reset();
			$(".help-block").remove();
			$(".form-group").removeClass("has-error");
		});

		$('#adminsTable').on("click", '.acc-edit', function() {edAdmin(this);});

		$('#adminsTable').on("click", '.acc-remove', function() {delAdmin(this);});

		var ad_id;

		function delAdmin(that){
			ad_id = $(that).parent().next().val();
			$(".del-username").text($("tr.row-"+ad_id+" > td.tb-username").text());
			$('#del-username').on('keyup', function() {
				if($(this).val() == $(".del-username").text())
				{
					$("#del-user-submit").removeClass('disabled');
				}
				else
				{
					$("#del-user-submit").addClass('disabled');
				}
			});
		}

		function edAdmin(that){
			ad_id = $(that).parent().next().val();
			$("#ed-username").val($("tr.row-"+ad_id+"  td.tb-username").text());
			$("#ed-fname").val($("tr.row-"+ad_id+"  .tb-first_name").val());
			$("#ed-lname").val($("tr.row-"+ad_id+"  .tb-last_name").val());
			$("#ed-email").val($("tr.row-"+ad_id+"  td.tb-email").text());
		}

		$("#del-user-submit").click(function() {deleteAdmin();});

		$('#ed-user-submit').click(function() {editAdmin();});

		$('#editAdminForm').submit(function(e) { e.preventDefault();editAdmin(); });

		$('#deleteAdminForm').submit(function(e) { e.preventDefault();deleteAdmin(); });

		$("#deleteAdmin").on("hidden.bs.modal", function() {
			document.querySelector("#deleteAdminForm").reset();
		});

		$('#adminsTable').on("click", '.acc-disable', function() {terminateAdmin(this);});

		$('#adminsTable').on("click", '.acc-enable', function() {activateAdmin(this);});

		function deleteAdmin() {
			$.ajax({
				url: '{{ route("adminroles.deleteAdmin") }}',
				type: 'post',
				data: {
					id: ad_id,
					_token: $('#del-token').val()
				},
				success: function(response) {
					$("tr.row-"+ad_id).remove();
					$.notify(response, 'success');
					$("#deleteAdmin").modal('hide');
					autoNumber();
				},
				error: function(response) {
					logger(response);
					$.notify("Some error occured. The error message is logged in to the console.", "error");
				}
			});
		}

		function activateAdmin(that){
			ad_id = $(that).parent().next().val();
			$.ajax({
				url: '{{ route("adminroles.statusAdmin") }}',
				type: 'post',
				data: {
					id: ad_id,
					method: "activate",
					_token: $('#ed-token').val()
				},
				success: function(response) {
					$(that).attr("class", "btn btn-xs btn-warning acc-disable").attr("title", "Temporary disable this Account").html("Deactivate");
					$(that).parent().prev().attr("class", "tb-status activated").html("Activated");
					$.notify(response, 'success');
				},
				error: function(response) {
					logger(response);
					$.notify("Some error occured. The error message is logged in to the console.", "error");
				}
			});
		}

		function terminateAdmin(that){
			ad_id = $(that).parent().next().val();
			$.ajax({
				url: '{{ route("adminroles.statusAdmin") }}',
				type: 'post',
				data: {
					id: ad_id,
					method: "terminate",
					_token: $('#ed-token').val()
				},
				success: function(response) {
					$(that).attr("class", "btn btn-xs btn-success acc-enable").attr("title", "Enable this account").html("Activate");
					$(that).parent().prev().attr("class", "tb-status terminated").html("Terminated");
					$.notify(response, 'success');
				},
				error: function(response) {
					logger(response);
					$.notify("Some error occured. The error message is logged in to the console.", "error");
				}
			});
		}

		function editAdmin() {
			$.ajax({
				url: '{{ route("adminroles.updateAdmin") }}',
				type: 'post',
				data: {
					id: ad_id,
					username: $('#ed-username').val(),
					email: $('#ed-email').val(),
					first_name: $('#ed-username').val(),
					last_name: $('#ed-username').val(),
					password: $('#ed-password').val(),
					password_confirmation: $('#ed-password_confirmation').val(),
					_token: $('#ed-token').val()
				},
				success: function(response) {
					$("body").append($("<script />", {
						html: response,
						id: "dynamic_script"
					}));
					$('span').remove( ".help-block" );
					$(".has-error").removeClass();
					$('#editAdmin').modal('hide');
					$("tr.row-"+ad_id+" > td.tb-username").text(laravel.admin.username);
					$("tr.row-"+ad_id+" > td.tb-name").text(laravel.admin_name);
					$("tr.row-"+ad_id+" > td.updated_at").text(laravel.admin.updated_at);
					document.querySelector("#editAdminForm").reset();
				},
				error: function(response) {
					if(response.status = 422)
					{
						var errors = response.responseJSON;
						$('span').remove( ".help-block" );
						$(".has-error").removeClass();
						$.each(errors, function(key, value) {
							$('#ed-' + key).parent().removeClass('has-error');
							$('#ed-' + key).parent().addClass('has-error');
							$('#ed-' + key).parent().append('<span class="help-block">' + value + '</span>');
						});
					}
					else
					{
						logger(response);
						$.notify("Some error occured. The error message is logged in to the console.", "error");
					}
					document.querySelector("#editAdminForm").reset();
				}
			});
		}

		function addAdmin() {
			$.ajax({
				url: '{{ route("admin.addAdmin") }}',
				type: 'post',
				data: {
					username: $('#add-username').val(),
					email: $('#add-email').val(),
					first_name: $('#add-fname').val(),
					last_name: $('#add-lname').val(),
					password: $('#add-password').val(),
					password_confirmation: $('#add-password_confirmation').val(),
					_token: $('#add-token').val()
				},
				success: function(response) {
					$('span').remove( ".help-block" );
					$(".has-error").removeClass();
					$("body").append($("<script />", {
						html: response,
						id: "dynamic_script"
					}));
					$('#adminsTable').loadTemplate(app_url + "/build/templates/admin-user-table.php",
					{
			            username: laravel.admin.username,
			            email: laravel.admin.email,
			            getNameOrUsername: laravel.getNameOrUsername,
			            first_name: laravel.admin.first_name,
			            last_name: laravel.admin.last_name,
			            created_at: laravel.admin_created_at,
			            updated_at: laravel.admin_updated_at,
			            status: laravel.admin.acc_terminated ? 'tb-status terminated' : 'tb-status activated',
			            status_val: laravel.admin.acc_terminated ? 'Terminated' : 'Activated',
			            id: laravel.admin.id,
			            default_login_url: laravel.admin_login_route,
			            tr: "row-" + laravel.admin.id,
			            status_button_class: laravel.admin.acc_terminated ? 'btn btn-xs btn-success acc-enable' : 'btn btn-xs btn-warning acc-disable',
			            status_button_text: laravel.admin.acc_terminated ? 'Activate' : 'Deactivate'
        			},
        			{
        				append: true,
        				success: function() {
        					autoNumber();
        					document.querySelector("#addAdminForm").reset();
							$('#addAdmin').modal('hide');
							$.notify("Admin added succesfully", "success");
        				},
        				afterInsert: function($elem, $data) {
        					$($elem[0].tagName+".row-"+$data.id+" td:last-of-type > a")[0].title = "Login as "+$data.username;
        					$($elem[0].tagName+".row-"+$data.id+" td:last-of-type > button.acc-edit")[0].title = "Edit "+$data.username+"'s Account Details";
        					if($data.status_val == "Terminated")
        					{
								$($elem[0].tagName+".row-"+$data.id+" td:last-of-type > button.acc-enable")[0].title = "Enable this Account";
        					}
        					else if($data.status_val == "Activated")
        					{
        						$($elem[0].tagName+".row-"+$data.id+" td:last-of-type > button.acc-disable")[0].title = "Temporary disable this Account";
        					}
        				},
        				errorMessage: "There was a problem with the page. Please report the problem to the administrator."
        			});

				},
				error: function(response) {
					if(response.status = 422)
					{
						var errors = response.responseJSON;
						$('span').remove( ".help-block" );
						$(".has-error").removeClass();
						$.each(errors, function(key, value) {
							$('#add-' + key).parent().removeClass('has-error');
							$('#add-' + key).parent().addClass('has-error');
							$('#add-' + key).parent().append('<span class="help-block">' + value + '</span>');
						});
						logger(response);
					}
					else
					{
						logger(response);
						$.notify("Some error occured. The Error is logged in the console", "error");
					}
				}
			});
		}
	});
@stop