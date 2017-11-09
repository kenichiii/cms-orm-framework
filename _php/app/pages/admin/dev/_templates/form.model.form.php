

<form class="template" method="get" action="<?php echo App::getIns()->setAjaxLink( '_curr', 'model_form' ) ?>">
    Class: <input type="text" name="class"> Extends: <input type="text" name="extends" value="Model_Form"> 
    <br>
    Title: <input type="text" name="title"> 
    Name: <input type="text" name="name">
    <br>
    Model: <input type="text" name="model">
    
    Action: <input type="text" name="action" value="new">
    
    <div>
        <input type="submit" value="Generate form">
    </div>    
</form>    