

<form class="template" method="get" action="<?php echo App::getIns()->setAjaxLink( '_curr', 'model_grid' ) ?>">
    Class: <input type="text" name="class"> Extends: <input type="text" name="extends" value="Model_Grid"> 
    Title: <input type="text" name="title"> 
    Model: <input type="text" name="model">
    
    Table: <input type="text" name="table" value=':db:'> Alias: <input type="text" name="alias"> 

    <div>
        <input type="submit" value="Generate grid">
    </div>    
</form>    