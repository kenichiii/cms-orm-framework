
$(function() {

       $('#polozkaformnew').pfcAjaxForm({
            onforminit: function(form) {

    form.find("input[name='h1']").keyup(function(){
        form.find("input[name='uri']").val(niceUrl($(this).val()));
    });

       form.find("textarea[name='content']").tinymce({
                        // Location of TinyMCE script
                        script_url : '/assets/libs/tinymce/tinymce.min.js',
        width: 600,
        height: 300,
        language: "cs",
        fullpage_default_encoding: "utf-8",
        entity_encoding:	'raw',
                        plugins : "advlist,autolink,link,image,lists,charmap,preview,hr,anchor,pagebreak,searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table contextmenu directionality template paste textcolor",
                        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | link image | code",
                        menubar: "format insert table edit view" //tools

                });

            },
            succ: function(json,form) {
                    showAlert(json.succMsg,{autohide:false,callback:function(){
                        window.location.href = json.url;
                    ]});     
            }
       });

});

