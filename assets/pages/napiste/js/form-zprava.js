


$(function() {

      $('#zpravaformnew').pfcAjaxForm({
           onforminit: function(form) {
                $('#zprava').tinymce({
                                    // Location of TinyMCE script
                                    script_url : '/assets/libs/tinymce/tinymce.min.js',
                    width: 600,
                    height: 200,
                    language: "cs",
                    fullpage_default_encoding: "utf-8",
                    entity_encoding:	'raw',
                    statusbar : false,
                                    plugins : "",
                                    toolbar: "undo redo  | bold italic  | bullist numlist |  code",
                                    menubar: "edit" //tools

                    });
               
           },
           succ: function(json,form) {
                 $("#new-zprava-holder").animate({'opacity':0},275,function(){
                        $(this).css('display','none');
                        $("#napisteSendBox")
                        .css('opacity',0)
                        .css('display','block')                    
                        .animate({'opacity':1},275,function(){
                            $("#napisteFormRefresh").unbind('click')
                                .bind('click',function(e){
                                   e.preventDefault();
                                   
                                       $("#napisteSendBox").animate({'opacity':0},275,function(){
                                            $(this).css('display','none');
                                           $("#new-zprava-holder").find("input[type='text']").val('');
                                           $('#zprava').html('');
                                           $("#new-zprava-holder")
                                            .css('opacity',0)
                                            .css('display','block')                    
                                            .animate({'opacity':1},275,function(){});                   
                                        });
                                });
                        });                   
                    });               
           }    
            
        });       
});


  


         