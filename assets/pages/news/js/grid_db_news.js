

$(function(){
    $('.paging').first().hide();
    $('.paging').last().hide();
    $('.paging').not(':hidden').first().addClass('pagingFirst');
    $('.pagingInner').centerHorizontaly();
})

