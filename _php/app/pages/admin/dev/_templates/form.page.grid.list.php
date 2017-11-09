



<form class="template" method="get" action="<?php echo App::getIns()->setAjaxLink( '_curr', 'page_grid_list' ) ?>">
    should have h1,uri<br>
    <b>Grid: </b> <input type="text" name="class"> <br>
    detail pointer <input type="text" name="detail"> <br>
    Type: <br> 
            <label><input checked="checked" type="checkbox" name="type[]" value="template"> template</label> <br>            
            <label><input checked="checked" type="checkbox" name="type[]" value="controller"> controller</label> <br>            
            <label><input checked type="checkbox" name="type[]" value="css"> css</label> <br>            
            <label><input checked type="checkbox" name="type[]" value="js"> js</label> <br> 
            
            <label><input disabled type="checkbox" name="type[]" value="ajax"> ajax</label> <br>            
            <label><input disabled type="checkbox" name="type[]" value="action"> action</label> <br>            
                       

            <label><input disabled type="checkbox" name="type[]" value="pjs"> pjs</label> <br>            
            <label><input disabled type="checkbox" name="type[]"  value="pcss"> pcss</label> <br>            
          
    <input type="submit" value="Generovat">
</form>




