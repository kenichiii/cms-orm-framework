


$(function(){

    $('.<?php echo $grid->getName(); ?>-list-line').each(function(){ $(this).find('.<?php echo $grid->getName(); ?>-item:last').addClass('lastItemInLine') });
    
})

