

$(function(){
    $('.grid_db_reference-list-line').each(function(){ $(this).find('.grid_db_reference-item:last').addClass('lastItemInLine') });
    $('.paging').first().hide();
    $('.paging').last().hide();
    $('.paging').not(':hidden').first().addClass('pagingFirst');
    $('.pagingInner').centerHorizontaly();    
})