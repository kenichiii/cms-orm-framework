

<form class="template" method="get" action="<?php echo App::getIns()->setAjaxLink( '_curr', 'page_form_model' ) ?>">
    <b>Form class: </b> <input type="text" name="form"> <br>
    Type: <br> 
            <label><input checked="checked" type="checkbox" name="type[]" value="template"> template</label> <br>            
            <label><input checked="checked" type="checkbox" name="type[]" value="controller"> controller</label> <br>            
            <label><input checked="checked" type="checkbox" name="type[]" value="ajax"> ajax</label> <br>            
            <label><input checked="checked" type="checkbox" name="type[]" value="action"> action</label> <br>            
            <label><input checked="checked" type="checkbox" name="type[]" value="js"> js</label> <br>            
            <label><input checked="checked" type="checkbox" name="type[]" value="css"> css</label> <br>            
            <label><input checked="checked" type="checkbox" name="type[]" value="pjs"> pjs</label> <br>            
            <label><input checked="checked" type="checkbox" name="type[]"  value="pcss"> pcss</label> <br>            
          
    <input type="submit" value="Generovat">
</form>