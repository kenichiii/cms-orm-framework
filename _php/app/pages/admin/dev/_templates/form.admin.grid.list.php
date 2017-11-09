<form class="template" method="get" action="<?php echo App::getIns()->setAjaxLink(  '_curr', 'grid_admin' ) ?>">    
    Grid: <input type="text" name="class">        
    <br>    
    <label><input checked="checked" type="checkbox" name="useTabs" value="1"> - use tabs in edit dialog</label> <br> 
    model Model: <input type="text" name="modelModelClass"> <br>    
    form NEW: <input type="text" name="formnew"> <br>
    form EDIT: <input type="text" name="formedit"> <br>
    <br>
    <br>    
    <div class="fleft" style="padding-left: 15px">
    <label><input checked type="checkbox" name="use-admin" value="1"><b>admin</b></label>
    <div>
            <label><input checked="checked" type="checkbox" name="admin[]" value="templates"> - templates</label> <br>                        
            <label><input checked="checked" type="checkbox" name="admin[]" value="ajax"> - ajax</label> <br>            
            <label><input checked="checked" type="checkbox" name="admin[]" value="action"> - action</label> <br>            
            <label><input checked="checked" type="checkbox" name="admin[]" value="js"> - js</label> <br>            
            <label><input checked="checked" type="checkbox" name="admin[]" value="css"> - css</label> <br>            
     </div>       
    </div>
    <br class="clear">
    <input type="submit" value="Generovat">
</form>    