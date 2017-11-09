

<form class="template" method="get" action="<?php echo App::getIns()->setAjaxLink(  '_curr', 'model_datatable' ) ?>">    
    
<input type='checkbox' id='dtcreatefromgrid'> <label for='dtcreatefromgrid'>create from grid</label>
<div class='hidden' id="dtcreatefromgrid_form">
    Grid: <input name="fromGrid" type='text' id='dtcreatefromgrid_grid'> <a  id='dtcreatefromgrid_btn' href="<?php echo App::getIns()->setAjaxLink(  '_curr', 'model_datatable_grid_helper' ) ?>">CREATE</a>
</div>

<div  id='datatablemodelform'>
    <b>Class:</b> <input type="text" name="class">_Datatable extends <input type="text" name="extends" value="Model_Component_Datatable_dataGrid">    
    <br>
      - htmlID: <input type="text" name="htmlID">
    rowClass: <input type="text" name="rowClass"> perPage: <input type="text" name="perPage" value="15">
    <br>
      - tableRaw: <input type="text" name="tableRaw"  value=':db:'>
    table: <textarea name="table">:db:</textarea>
    <br>
      - collums: <textarea name="collums">array("*")</textarea>
      <br>
      - primaryKey: <input type="text" name="primaryKey" value="id">
    where: <input type="text" name="where" value=" WHERE 1=1 ">
    orderBy: <input type="text" name="orderBy" value=" ORDER BY id DESC ">
    limit: <input type="text" name="limit" value="">
    groupBy: <input type="text" name="groupBy" value="">
    <br>      <br>
      - <b>model:</b>
    <div class="datatablecollums">
        <ul>
        
        <li class="datatablecollum">
            Collum: <input type="text" name="collum_name[]">
            Title: <input type="text" name="collum_title[]">
            Model: <select name="collum_model[]">
                    <option value="none">none</option>
                    <option value="text">text</option>
                    <option value="datetime">datetime</option>
                    <option value="date">date</option>
                    <option value="key">key</option>
                    <option value="select">select</option> 
                    <option value="bit">bit</option> 
                   </select>
            Filter: <select name="collum_filter[]">
                    <option value="none">none</option>
                    <option value="text">text</option>
                    <option value="datetime">datetime</option>
                    <option value="date">date</option>
                    <option value="key">key</option>
                    <option value="bit">bit</option>                
                    <option value="select">select</option>
                   </select>            
            <br>
            not sortable: <input type="text" name="collum_sortable[]" value="0">
            table: <input type="text" name="collum_table[]">
            render: <input type="text" name="collum_render[]">
            where: <input type="text" name="collum_where[]">
            customFunction: <input type="text" name="collum_customFunction[]">
        </li>    
        </ul>
        <div><a class="datatablecollum_next" href="#">+ add next collum</a></div>
    </div>          
      <br>
      - <b>actions</b>:
    <div class="datatableactions">        
        <label><input type='checkbox' checked="chekcked" name='createactionedit' id="createactionedit" value='1'> create action edit title <input type="text" name="actionedit_title" value="Upravit"></label> 
        <label><input type='checkbox' checked="chekcked" name='createactiondelete' id="createactiondelete" value='1'> create action delete title <input type="text" name="actiondelete_title" value="Smazat"></label>
        <label><input type='checkbox'  name='createactionrank' id="createactionrank" value='1'> create rank up/down actions</label>
        <ul>        
        <li class="datatableaction">
            Name: <input type="text" name="action_name[]">
            Title: <input type="text" name="action_title[]">
            Class: <input type="text" name="action_class[]">
            Pointer: <input type="text" name="action_pointer[]" value="_curr">
            Icon: <input type="text" name="action_icon[]"> <a href="http://api.jqueryui.com/theming/icons/" class="_blank">ui icons list</a>
        </li>    
        </ul>
        <div><a class="datatableaction_next" href="#">+ add next action</a></div>
    </div>                
    <br>
      - <b>group actions</b>:
    <div class="datatablegroupactions">        
        <ul>        
        <li class="datatablegroupaction">
            Name: <input type="text" name="groupaction_name[]">
            Title: <input type="text" name="groupaction_title[]">
        </li>    
        </ul>
        <div><a class="datatablegroupaction_next" href="#">+ add next action</a></div>
    </div>                

      
      
    <br class="clear">
    <input type="submit" value="Generovat">
    
    
    </div>
</form>