<div class="modal fade" tabindex="-1" role="dialog" id="qrcode">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Help</h4>
      </div>
      <div class="modal-body">
          @if (isset($qrcode))
          <img src="{{ $qrcode }}" class="center-block">
          <p>Scan QR code with your GOOGLE AUTHENTICATOR app.</p>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default">OK</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->