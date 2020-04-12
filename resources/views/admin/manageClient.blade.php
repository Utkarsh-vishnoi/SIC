@extends('templates.template')

@section('title', 'Manage Clients - ')

@section('content')
	<div class="container">

		<h1>Manage Clients<a data-toggle="modal" data-target="#addClient" class="pull-right btn btn-primary">Add a client</a></h1>
		<div class="table-responsive">
            <table class="table table-striped" id="clientsTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Created</th>
                  <th>Updated</th>
                  <th>Status</th>
                  <th>Manage</th>
                </tr>
              </thead>
              <tbody>
              @foreach($clients as $individual)
                @include('others.table.clients-table')
              @endforeach
              </tbody>
            </table>
          </div>
	</div>
	@include('others.modals.client.add')
	@include('others.modals.client.edit')
	@include('others.modals.client.delete')
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
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-awesome input[type="password"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-awesome input[name="password_confirmation"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
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
@endsection

@section('post-scripts')
	$(document).ready(function() {

		$('#add-user-submit').click(function() {addClient();});

		$('#addClientForm').submit(function(e) { e.preventDefault();addClient(); });

		$("#addClient").on("hidden.bs.modal", function() {
			document.querySelector("#addClientForm").reset();
			$(".help-block").remove();
			$(".form-group").removeClass("has-error");
		});

		$("#editClient").on("hidden.bs.modal", function() {
			document.querySelector("#editClientForm").reset();
			$(".help-block").remove();
			$(".form-group").removeClass("has-error");
		});

		$('#clientsTable').on("click", '.acc-edit', function() {edClient(this);});

		$('#clientsTable').on("click", '.acc-remove', function() {delClient(this);});

		var cl_id;

		function delClient(that){
			cl_id = $(that).parent().next().val();
			$(".del-username").text($("tr.row-"+cl_id+" > td.tb-username").text());
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

		function edClient(that){
			cl_id = $(that).parent().next().val();
			$("#ed-username").val($("tr.row-"+cl_id+" > td.tb-username").text());
		}

		$("#del-user-submit").click(function() {deleteClient();});

		$('#ed-user-submit').click(function() {editClient();});

		$('#editClientForm').submit(function(e) { e.preventDefault();editClient(); });

		$("#deleteClient").on("hidden.bs.modal", function() {
			document.querySelector("#deleteClientForm").reset();
		});

		$('#clientsTable').on("click", '.acc-disable', function() {terminateClient(this);});

		$('#clientsTable').on("click", '.acc-enable', function() {activateClient(this);});

		function deleteClient() {
			$.ajax({
				url: '{{ route("adminroles.deleteClient") }}',
				type: 'post',
				data: {
					id: cl_id,
					_token: $('#del-token').val()
				},
				success: function(response) {
					$("tr.row-"+cl_id).remove();
					$.notify(response, 'success');
					$("#deleteClient").modal('hide');
					autoNumber();
				},
				error: function(response) {
					logger(response);
					$.notify("Some error occured. The error message is logged in to the console.", "error");
				}
			});
		}

		function activateClient(that){
			cl_id = $(that).parent().next().val();
			$.ajax({
				url: '{{ route("adminroles.statusClient") }}',
				type: 'post',
				data: {
					id: cl_id,
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

		function terminateClient(that){
			cl_id = $(that).parent().next().val();
			$.ajax({
				url: '{{ route("adminroles.statusClient") }}',
				type: 'post',
				data: {
					id: cl_id,
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

		function editClient() {
			$.ajax({
				url: '{{ route("adminroles.updateClient") }}',
				type: 'post',
				data: {
					id: cl_id,
					username: $('#ed-username').val(),
					password: $('#ed-password').val(),
					password_confirmation: $('#ed-password_confirmation').val(),
					_token: $('#ed-token').val()
				},
				success: function(response) {
					$('span').remove( ".help-block" );
					$(".has-error").removeClass();
					$('#editClient').modal('hide');
					$("tr.row-"+cl_id+" > td.tb-username").text($('#ed-username').val());
					document.querySelector("#editClientForm").reset();
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
					document.querySelector("#editClientForm").reset();
				}
			});
		}

		function addClient() {
			$.ajax({
				url: '{{ route("admin.addClient") }}',
				type: 'post',
				data: {
					username: $('#add-username').val(),
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
					$('#clientsTable').loadTemplate(app_url + "/build/templates/client-user-table.php",
					{
			            username: laravel.client.username,
			            created_at: laravel.client_created_at,
			            updated_at: laravel.client_updated_at,
			            status: laravel.client.acc_terminated ? 'tb-status terminated' : 'tb-status activated',
			            status_val: laravel.client.acc_terminated ? 'Terminated' : 'Activated',
			            id: laravel.client.id,
			            default_login_url: laravel.client_login_route,
			            tr: "row-" + laravel.client.id,
			            status_button_class: laravel.client.acc_terminated ? 'btn btn-xs btn-success acc-enable' : 'btn btn-xs btn-warning acc-disable',
			            status_button_text: laravel.client.acc_terminated ? 'Activate' : 'Deactivate'
        			},
        			{
        				append: true,
        				success: function() {
        					autoNumber();
        					document.querySelector("#addClientForm").reset();
							$('#addClient').modal('hide');
							$.notify("Client added succesfully", "success");
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