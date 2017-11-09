<form class="template" method="get" action="<?php echo App::getIns()->setAjaxLink( '_curr', 'page_form_file' ) ?>">
    <b>Model: </b> <input type="text" name="modelclass"> file name: <input type="text" name="collum" value="file"><br>
    Type: <br> 
            <label><input checked="checked" type="checkbox" name="type[]" value="template"> templates</label> <br>            
            <label><input checked="checked" type="checkbox" name="type[]" value="ajax"> ajax</label> <br>            
            <label><input checked="checked" type="checkbox" name="type[]" value="action"> action</label> <br>            
            <label><input checked="checked" type="checkbox" name="type[]" value="js"> js</label> <br>            
            <label><input checked="checked" type="checkbox" name="type[]" value="css"> css</label> <br>            
    <input type="submit" value="Generovat">
</form>