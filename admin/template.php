<script type="text/x-tmpl" id="temp-confirm-alert">
<div class="modal fade" id="alertmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header alert alert-warning">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
       <div style="color:red;">Are you sure you want to delete this item?</div><br>
       <form id="datadelete" name="datadelete" action="controller/Action">
             <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
             <input type="hidden" name="method" value="deleteitem">
             <input type="hidden" name="userid" value="">
             <input type="hidden" name="container" value="">
             <input type="submit" class="hidden"> 
       </form>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="yes">Yes</button>
      </div>
    </div>
  </div>
</div>
</script>




