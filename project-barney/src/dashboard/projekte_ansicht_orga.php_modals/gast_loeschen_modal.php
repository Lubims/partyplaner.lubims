<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">Gast entfernen?</h4>
  <label for="modal-switch" class="close" data-dismiss="modal" aria-label="Close" style="display: flex; align-items: center;">
    <span aria-hidden="true">&times;</span>
  </label>
</div>
<form class="form-inline" method="post" action="projekte_ansicht_orga.php_modals\gast_loeschen.php">
  <input type="hidden" name="projektid" value="<?php echo $_GET['projektid']; ?>"/>
  <div class="modal-body" style="display: inline">
    <table style="width: 100%; float: center">
      <tr>
        <td width=50%>
          <button type="submit" name="signup_submit" class="btn btn-danger" style="width:100%">Ja</button>
        </td>
        <td width=50%>
          <label for="modal-switch" class="btn btn-outline-primary" data-dismiss="modal">Nein</label>
        </td>
      </tr>
    </table>
  </div>
</form>
