<div class="modal fade" tabindex="-1" role="dialog" id="addClient">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add a client</h4>
      </div>
      <div class="modal-body">
<form class="form-awesome" id="addClientForm">

    <div class="form-group">
          <label for="username" class="sr-only">Username</label>
          <input type="text" name="username" id="add-username" class="form-control" placeholder="Username" required autofocus>
        </div>

    <div class="form-group">
          <label for="password" class="sr-only">Password</label>
          <input type="password" name="password" id="add-password" class="form-control" placeholder="Password" required>
      </div>

        <div class="form-group">
          <label for="password_confirmation" class="sr-only">Confirm Password</label>
          <input type="password" name="password_confirmation" id="add-password_confirmation" class="form-control" placeholder="Confirm Password" required>
      </div>
        <input type="hidden" id="add-token" name="_token" value="{{ Session::token() }}">
        <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" />
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="add-user-cancel">Cancel</button>
        <button type="button" class="btn btn-primary" id="add-user-submit">Add</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->