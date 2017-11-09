

<form class="template" method="get" action="<?php echo App::getIns()->setAjaxLink(  '_curr', 'component_filesgrid_admin' ) ?>">    
    Owner Model: <input type="text" name="model">    
    <br>    
    <div class="fleft" style="padding-left: 15px">
    <div>
            <label><input checked="checked" type="checkbox" name="gallery" value="1"> add GALLERY</label> <br>                        
            <label><input checked="checked" type="checkbox" name="docs" value="1"> - add DOCS</label> <br>            
     </div>       
    </div>
    <br class="clear">
    <input type="submit" value="Generovat">
</form>    