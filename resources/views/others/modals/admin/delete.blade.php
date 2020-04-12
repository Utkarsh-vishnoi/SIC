<div class="modal fade" tabindex="-1" role="dialog" id="deleteAdmin">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Are you ABSOLUTELY sure?</h4>
      </div>
      <div class="well-warning">
        <p>Unexpected bad things will happen if you don’t read this!</p>
      </div>
      <div class="modal-body delete_modal">
        <form class="form-awesome" id="deleteAdminForm">
          <p>This action <strong>CANNOT</strong> be undone. This will permanently delete the user <strong class="del-username"></strong>.

          <p>Please type in the name of the user to confirm deletion.</p>

    <div class="form-group">
          <span></span>
          <input type="text" name="username" id="del-username" class="form-control" placeholder="" required autofocus>
        </div>
        <input type="hidden" id="del-token" name="_token" value="{{ Session::token() }}">
        <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" />
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default" id="del-user-cancel">Cancel</button>
        <button type="button" class="btn btn-danger disabled" id="del-user-submit">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->