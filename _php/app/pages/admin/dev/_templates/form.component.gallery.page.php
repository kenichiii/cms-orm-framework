

<form class="template" method="get" action="<?php echo App::getIns()->setAjaxLink(  '_curr', 'component_gallery' ) ?>">    
    Owner Model: <input type="text" name="model">    
    <br>
    <div class="fleft">
    <label><input checked type="checkbox" name="use-view" value="1"><b>view</b></label>
    <div>
            <label><input checked="checked" type="checkbox" name="view[]" value="controller"> - controller</label> <br>
            <label><input checked="checked" type="checkbox" name="view[]" value="templates"> - templates</label> <br>                                                                        
            <label><input checked="checked" type="checkbox" name="view[]" value="js"> - js</label> <br>
            <label><input checked="checked" type="checkbox" name="view[]" value="css"> - css</label> <br>
     </div>         
    </div>

    <br class="clear">
    <input type="submit" value="Generovat">
</form>    