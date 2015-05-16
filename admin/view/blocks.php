<?php preventDirectAccess("blocks.php"); ?>
<div class="container-wrapper">
    <div class="menucontainer">
        <?php include 'menus.php'; ?>
    </div>
    <div id="ajaxloader"><div class="ajax-loader ajxbg"></div></div>
    <div class="col-md-10 col-md-offset-1">
        <?php for($i=0;$i<count($getBlocks);$i++):?>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><?= $getBlocks[$i]['block_title']; ?></div>
                <div class="panel-body">
                    <form id="block_form_<?= $i; ?>" class="blockform" role="form" autocomplete="off">
                        <div><strong>Block Title</strong></div>
                        <div><input type="text"  class="form-control" maxlength="100" required="required" value="<?= $getBlocks[$i]['block_name']; ?>" name="block_name"></div>
                        <div><strong>Description</strong></div>
                        <div>
                            <textarea name="<?= "block_text".($i+1)?>" rows="10" cols="80" required="required"><?= $getBlocks[$i]['block_text']; ?></textarea>
                        </div>
                        <div><strong>Status</strong></div>
                        <div>
                            <input type="hidden" value="<?= $getBlocks[$i]['block_title']; ?>" name="block_title">
                            <select class="form-control" name="status" id="commonuserstatus" required="required">
                                <option value="" selected="selected">Select Status</option>
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                                <option value="blocked">Blocked</option>
                            </select>
                        </div>
                        <br>
                        <div>
                            <input type="hidden" name="block_name" value="<?= $getBlocks[$i]['block_title']; ?>">
                            <input type="submit" value="Save" class="btn btn-primary btn-block blockbutton" data-id="block_form_<?= $i; ?>" id="block_<?= $i; ?>">
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <?php endfor;?>
        <div class="clearfix"></div>
    </div> 
</div>
<?php

function preventDirectAccess($filename = "") {
    $requesturl = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    if (false !== strpos($requesturl, $filename)) {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
        exit();
    }
}
?>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('block_text1');
    CKEDITOR.replace('block_text2');
    CKEDITOR.replace('block_text3');
    CKEDITOR.replace('block_text4');
    CKEDITOR.replace('block_text5');
    CKEDITOR.replace('block_text6');
    CKEDITOR.replace('block_text7');
</script>
