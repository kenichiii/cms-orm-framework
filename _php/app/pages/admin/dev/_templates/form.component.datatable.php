

<form class="template" method="get" action="<?php echo App::getIns()->setAjaxLink(  '_curr', 'component_datatable' ) ?>">    

    dataGrid model: <input type="text" name="model">    
    <br>
    <label><input checked="checked" type="checkbox" name="new" value="new"> - use action new</label> <br>    
    <label><input checked="checked" type="checkbox" name="useTabs" value="1"> - use tabs in edit dialog</label> <br> 
    model Model: <input type="text" name="modelModelClass"> if we use deleted,rank actions<br>    
    form NEW: <input type="text" name="formnew"> if we use new action<br>
    form EDIT: <input type="text" name="formedit"> if we use edit action<br>
    <br>
    <br>
            <label><input checked="checked" type="checkbox" name="gen[]" value="template"> - template</label> <br>                        
            <label><input checked="checked" type="checkbox" name="gen[]" value="ajax"> - ajax</label> <br>            
            <label><input checked="checked" type="checkbox" name="gen[]" value="actions"> - dt actions</label> <br>            
            <label><input checked="checked" type="checkbox" name="gen[]" value="groupactions"> - dt group actions</label> <br>            
            <label><input checked="checked" type="checkbox" name="gen[]" value="pjs"> - phpjs</label> <br>            
            <label><input checked="checked" type="checkbox" name="gen[]" value="templates"> - templates</label> <br>
            
    <br class="clear">
    <input type="submit" value="Generovat">

</form>