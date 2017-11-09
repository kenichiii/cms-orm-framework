
<div style="float:left;width:450px;">

<form class="formaction" method="post" action="<?php echo App::getIns()->setActionLink( '_curr', 'project-settings-add' ) ?>">
    <h3>NEW DB SETTINGS ITEM</h3>
    Nadpis: <input type="text" name="h1"><br>
    Pointer: <input type="text" name="pointer"><br>
    Section: <input type="text" name="section"><br>
    Lang: <input type="text" name="lang" value="uni"><br>
    Type: <select name="type">
        <option value="<?php echo Settings_Model::TYP_STRING; ?>">STRING</option>
        <option value="<?php echo Settings_Model::TYP_INT; ?>">INT</option>
        <option value="<?php echo Settings_Model::TYP_TEXT; ?>">TEXT</option>
        <option value="<?php echo Settings_Model::TYP_BIT; ?>">BIT</option>
        <option value="<?php echo Settings_Model::TYP_PRICE; ?>">PRICE</option>
        <option value="<?php echo Settings_Model::TYP_SERIALIZED; ?>">SERIALIZED</option>
    </select><br>
    
    Value: <textarea name="value"></textarea> <br>
    <input type="submit" value="Add to database">
</form>



</div>
<div style="float:left">
    
    
    
<form class="template" method="get" action="<?php echo App::getIns()->setAjaxLink( '_curr', 'page_settings_form_admin' ) ?>">
    <h3>NEW SETTING FORM FOR ADMIN PAGE</h3>
    <b>Pointer: </b> <input type="text" name="pointer"> <br>
    Section title: <input type="text" name="sectiontitle"> <br>
    Item title: <input type="text" name="itemname">
 
    <input type="submit" value="Generovat">
</form>
</div>   


<br class="clear"><br><br>