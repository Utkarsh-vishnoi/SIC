<div class="modal fade" tabindex="-1" role="dialog" id="editClient">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Account</h4>
      </div>
      <div class="modal-body edit_modal">
        <form class="form-awesome" id="editClientForm">

    <div class="form-group">
          <label for="username" class="sr-only">Username</label>
          <input type="text" name="username" id="ed-username" class="form-control" placeholder="Username" required autofocus>
        </div>

    <div class="form-group">
          <label for="password" class="sr-only">Password</label>
          <input type="password" name="password" id="ed-password" class="form-control" placeholder="Password" required>
      </div>

        <div class="form-group">
          <label for="password_confirmation" class="sr-only">Confirm Password</label>
          <input type="password" name="password_confirmation" id="ed-password_confirmation" class="form-control" placeholder="Confirm Password" required>
      </div>
        <input type="hidden" id="ed-token" name="_token" value="{{ Session::token() }}">
        <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" />
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default" id="ed-user-cancel">Cancel</button>
        <button type="button" class="btn btn-primary" id="ed-user-submit">Update</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->