

$(function(){
    
        $('.genmenu').click(function(){
            $('.genmenu-window,.form-window').hide();
            $('#output').hide();
            $($(this).attr('href')).show();
            
            return false;
        })
    
    
        var options = {
	        success: templata,
                dataType: 'json'
        };
       
       $('.template').ajaxForm(options);

            var options1 = {
	        success: formactionAction    
        };
       
       $('.formaction').ajaxForm(options1);
    
    
       $('.form').click(function(){
           
           $('.form-window').removeClass('active').hide();           
           if($(this).attr("id")=="layout-new")$('.genmenu-window').hide();
           $('#'+$(this).attr("id")+"-form").addClass('active').show();                            
           
           
           
           return false;
       });       
       
       $('.form-window').hide();
       
       //gallery
       $("#component-gallery-form input[name='use-view']").click(function(){
           if(this.checked) $("#component-gallery-form .view").show();
           else $("#component-gallery-form .view").hide();
       })
       $("#component-gallery-form input[name='use-admin']").click(function(){
           if(this.checked) $("#component-gallery-form .admin").show();
           else $("#component-gallery-form .admin").hide();
       })
    
    
        $("#project-config-link-login").unbind('click').click(function(){
            var that = this;
            $.post(that.href,{login:$("#idconfiglogin").val(),pwd:$("#idconfigpwd").val()},function(res){
                $("#project-config-link").trigger('click');
            });
            
            return false;
        });
        
       
       /* model form */
       
       model_form_static();
       
       
       /* end model form */
})

function templata(json)
{
     $("#output").show();   
     $("#output .header").html('<b>Files:</b> ');
     $("#output .files").html('');
     $('#output .mainactions').html('');
      $('#output .report').html('');
     $('.form-window').removeClass('active').hide();               

     
              if(json.generator=='model'||json.generator=='grid'||json.generator=='form'||json.generator=='datatablemodel') 
              {
                  $('#output .mainactions').html('<button class="write-models">WRITE ALL FILES</button>');
              }                      
              else if(json.generator=='grid_sql') 
              {
                  $('#output .mainactions').html('<button class="run-sql-queries">RUN ALL SQL QUERIES</button>');
              }
              else if(json.generator=='page_form_action') //we dealing new page 
              {
                  var pidselect = '<div class="new-page-form">Parent:'+$("#page-parentid-select-html").html();
                  var pageform = pidselect + ' H1:<input type="text" name="h1" value="'+json.page.title+'">';
                      pageform+= ' Pointer:<input type="text" name="pointer" value="'+json.page.pointer+'">';
                      pageform+= ' <label><input type="checkbox" name="showinmenu" value="1">ShowInMenu</label>';
                      pageform+= '<button class="create-page">CREATE PAGE</button> </div>';
                  
                  $('#output .mainactions').html(pageform+'<button class="write-page hidden">WRITE ALL PAGE FILES</button>');
              }
              else if(json.generator=='page_component_gallery') 
              {       
                if($("#page-component-gallery-form input[name='use-view']").val()==1)
                {
                    $('#output .mainactions').html('VIEW PAGE:'+$("#page-parentid-select-html").html()+'<button class="write-gallery">WRITE GALLERY</button><br>');
                }
             }
              else if(json.generator=='component_gallery') 
              {
                if($("#component-gallery-form input[name='use-admin']").val()==1)
                {
                   $('#output .mainactions').append('ADMIN PAGE:'+$("#page-parentid-select-html").html()+'<button class="write-gallery-admin">WRITE GALLERY ADMIN</button>');
                }
              }  
              else if(json.generator=='component_datatable')
              {
                $('#output .mainactions').append('PAGE:'+$("#page-parentid-select-html").html()+'<button class="write-datatable-component">WRITE DATATABLE</button>');                                    
              }
              else if(json.generator=='page_form_foto')
              {
                $('#output .mainactions').append('PAGE:'+$("#page-parentid-select-html").html()+'<button class="write-form-foto">WRITE FORM</button>');                                    
              }
    
    
     var code;
     for(i=0;i<json.files.length;i++)
     {                  
         code = json.files[i].code.replace('</textarea>','[[/textarea]]');
         
         code = code.replace('</textarea>','[[/textarea]]');
         
         $("#output .header").append(' <a class="outfilehead" href="#ofile-'+i+'">['+json.files[i].name+']</a> ');         
         $("#output .files").append('<div id="ofile-'+i+'" class="outfilecode hidden"><div>'+json.files[i].lang+': '+json.files[i].name+'</div><div class="actions"></div><div class="code"><textarea rows="80" cols="160">'+code+'</textarea></div></div>');              

        if(json.generator=='model'||json.generator=='grid'||json.generator=='form'||json.generator=='datatablemodel') 
            {
                $('#ofile-'+i+' .actions').html('<button id="'+json.files[i].name+'" class="write-model">WRITE MODEL</button>');
            }
        else if(json.generator=='grid_sql') 
            {
                  $('#ofile-'+i+' .actions').html('<button id="'+json.files[i].name+'" class="run-sql">RUN SQL</button>');
            }
        if(json.generator=='page_form_action') 
            {
                $('#ofile-'+i+' .actions').html('<button id="'+json.files[i].name.replace('/','XaXXXaX')+'" class="write-page-part hidden">WRITE PAGE PART</button>');
            }                                             
        if(json.generator=='component_gallery'||json.generator=='page_component_gallery') 
            {
                $('#ofile-'+i+' .actions').html('<button id="'+json.files[i].name.replace('/','XaXXXaX')+'" class="write-gallery-part hidden">WRITE GALLERY PART</button>');
            }                                     
        if(json.generator=='component_datatable') 
            {
                $('#ofile-'+i+' .actions').html('<button id="'+json.files[i].name.replace('/','XaXXXaX')+'" class="write-datatable-part hidden">WRITE DATATABLE PART</button>');
            }                                     
        if(json.generator=='page_form_foto') 
            {
                $('#ofile-'+i+' .actions').html('<button id="'+json.files[i].name.replace('/','XaXXXaX')+'" class="write-form-part hidden">WRITE FORM PART</button>');
            }                                 
            
     }
           
  
             if(json.generator=='model'||json.generator=='grid'||json.generator=='form'||json.generator=='datatablemodel') 
              {
                    $('.write-model').unbind('click').click(function(){
                       $.post($("#write-model-link").val(),{model:$(this).attr('id'),content:$(this).parent().parent().find('textarea').val()},function(res){
                          $('#output .report').append('<div>'+res+'</div>');
                       })
                        return false;
                    });
                    
                     $('.write-models').unbind('click').click(function(){
                       $(this).parent().parent().find('.actions button.write-model').trigger('click');                       
                       return false;
                    });                                                            
              }                      
              else if(json.generator=='page_form_action') //we dealing new page 
              {
                    $('.create-page').unbind('click').click(function(){
                       var parentid = $(this).parent().find("select[name='parentid']").val(); 
                       var h1 = $(this).parent().find("input[name='h1']").val(); 
                       var pointer = $(this).parent().find("input[name='pointer']").val(); 
                       var showinmenu = $(this).parent().find("input[name='showinmenu']").val(); 
                       
                       var div = $(this).parent();
                       
                       $.post($("#create-page-link").val(),{parentid:parentid,h1:h1,pointer:pointer,showinmenu:showinmenu},function(json){
                          if(json.id&&json.id>0)
                          {
                              $('#output .report').append('<div>Page was successfully created under ID '+json.id+'</div>');
                              
                              div.hide();
                              
                              $('.write-page').show().unbind('click').click(function(){
                                    
                                     $('.write-page-part').trigger('click');   
                                    
                                     return false;                              
                              });
                              
                              $('.write-page-part').show().unbind('click').click(function(){
                                    var content = $(this).parent().parent().find('textarea').val();
                                        content = content.replace('[[/textarea]]','</textarea>');                                        
                                    
                                    $.post($("#write-page-part-link").val(),{id:json.id,file:$(this).attr('id').replace('XaXXXaX','/'),content:content},function(res){
                                       $('#output .report').append('<div>'+res+'</div>');
                                    })
                                    
                                     return false;                              
                              });
                              
                          }
                          else
                           alert(json.err);                          
                       
                       },'json');
                       
                       
                        return false;
                    });
                
              }
              else if(json.generator=='grid_sql')
              {
                  
                              $('.run-sql-queries').show().unbind('click').click(function(){
                                    
                                     $('.run-sql').trigger('click');   
                                    
                                     return false;                              
                              });
                              
                              $('.run-sql').show().unbind('click').click(function(){
                                    var content = $(this).parent().parent().find('textarea').val();
                                    var file = $(this).attr('id').replace('XaXXXaX','/');
                                  
                                    $.post($("#run-sql-link").val(),{query:content,grid:file},function(res){
                                       $('#output .report').append('<div>'+res+'</div>');
                                    })
                                    
                                     return false;                              
                              });                  
              }
              else if(json.generator=="component_gallery"||json.generator=="page_component_gallery")
              {
                  
                             $('.write-gallery').show().unbind('click').click(function(){
                                    
                                     $('.write-gallery-part').each(function(){
                                    var file = $(this).attr('id').replace('XaXXXaX','/');
                                    var page = file.substring(0,4);
                                    if(page=='view') 
                                         $(this).trigger('click');
                                     });   
                                    
                                     return false;                              
                              });

                             $('.write-gallery-admin').show().unbind('click').click(function(){
                                    
                                     $('.write-gallery-part').each(function(){
                                    var file = $(this).attr('id').replace('XaXXXaX','/');
                                    var page = file.substring(0,5);
                                    if(page=='admin') 
                                         $(this).trigger('click');
                                     });   
                                    
                                     return false;                              
                              });        
                  
                  
                        $('.write-gallery-part').show().unbind('click').click(function(){
                                    var content = $(this).parent().parent().find('textarea').val();
                                        content = content.replace('[[/textarea]]','</textarea>');                                        
                                    var file = $(this).attr('id').replace('XaXXXaX','/');
                                    var page = file.substring(0,5);
                                    var id;
                                    if(page=='admin') id = $('.write-gallery-admin').prev().val();
                                    else id = $('.write-gallery').prev().val();
                                    
                                    if(id=='0'){ alert(page+' gallery must have page'); return false;}
                                    $.post($("#write-component-part-link").val(),{name:'gallery',id:id,file:file,content:content},function(res){
                                       $('#output .report').append('<div>'+res+'</div>');
                                    })
                                    
                                     return false;                              
                              });

              }
              else if(json.generator=="component_datatable")
              {
                  
                             $('.write-datatable-component').show().unbind('click').click(function(){
                                    
                                     $('.write-datatable-part').each(function(){
                                    var file = $(this).attr('id').replace('XaXXXaX','/');
                                    var page = file.substring(0,5);
                                    
                                         $(this).trigger('click');
                                     });   
                                    
                                     return false;                              
                              });        
                  
                  
                        $('.write-datatable-part').show().unbind('click').click(function(){
                                    var content = $(this).parent().parent().find('textarea').val();
                                        content = content.replace('[[/textarea]]','</textarea>');                                        
                                    var file = $(this).attr('id').replace('XaXXXaX','/');
                                    
                                    var id = $('.write-datatable-component').prev().val();
                                    
                                    
                                    if(id=='0'){ alert('datatable must have page'); return false;}
                                    $.post($("#write-component-part-link").val(),{name:'datatable',id:id,file:file,content:content},function(res){
                                       $('#output .report').append('<div>'+res+'</div>');
                                    })
                                    
                                     return false;                              
                              });
                      
              }    
              else if(json.generator=="page_form_foto")
              {
                  
                             $('.write-form-foto').show().unbind('click').click(function(){                                    
                                     $('.write-form-part').each(function(){
                                        var file = $(this).attr('id').replace('XaXXXaX','/');                                
                                         $(this).trigger('click');
                                     });   
                                    
                                     return false;                              
                              });        
                  
                  
                        $('.write-form-part').show().unbind('click').click(function(){
                                    var content = $(this).parent().parent().find('textarea').val();
                                        content = content.replace('[[/textarea]]','</textarea>');                                        
                                    var file = $(this).attr('id').replace('XaXXXaX','/');
                                    
                                    var id = $('.write-form-foto').prev().val();
                                    
                                    
                                    if(id=='0'){ alert('datatable must have page'); return false;}
                                    $.post($("#write-component-part-link").val(),{name:'formfoto',id:id,file:file,content:content},function(res){
                                       $('#output .report').append('<div>'+res+'</div>');
                                    })
                                    
                                     return false;                              
                              });
                      
              }    

    
    
    
    
    
              $('.outfilehead').unbind('click').click(function(){
                $('.outfilecode').hide();
                $('.outfilehead').removeClass('active');
                $(this).addClass('active');
                $($(this).attr('href')).show();
                return false;
            });    
}

function formactionAction(res)
{
    if(res=='done') showAlert('Succ save');
    else showAlert(res,{mtype:'err'});
}


function model_form_static()
{
       model_form_active();
       
       $('#model-model-form .collum_next').click(function(){
           var html = $('#model-model-form .collum').html();

           $('#model-model-form .collums ul').append('<li class="added">'+html+'</li>');
           $('#model-model-form .collums ul li:last').find("input[type='text']").val('');
           $('#model-model-form .collums ul li:last').find("input[type='checkbox']").attr('checked',false);
           model_form_active();
           
              $('#model-model-form .collums ul li').removeClass('odd');
              $('#model-model-form .collums ul li:odd').addClass('odd');                               
           return false;
       })
       
       $('.rel_next').click(function(){
           var html = $('#model-model-form .rel').html();
                      
           $('#model-model-form .rels ul').append('<li class="added">'+html+'</li>');
           $('#model-model-form .rels ul li:last').find("input[type='text']").val('');
           $('#model-model-form .rels ul li:last').find("input[type='checkbox']").attr('checked',false);
           model_form_active();
           
              $('#model-model-form .rels ul li').removeClass('odd');
              $('#model-model-form .rels ul li:odd').addClass('odd');          
           
           return false;
       })       
       
       $('.model-reset').click(function(){
           $('#model-model-form .hidden').hide();
           $('#model-model-form li.added').remove();
           $('#model-model-form').find("input[type='text']").val('');
           $('#model-model-form').find("input[type='checkbox']").attr('checked',false);
           
           return false;
       })
 
      $('#model-datatable-form .datatablecollum_next').click(function(){
           var html = $('#model-datatable-form .datatablecollum').html();

           $('#model-datatable-form .datatablecollums ul').append('<li class="added">'+html+'</li>');
           $('#model-datatable-form .datatablecollums ul li:last').find("input[type='text']").val('');
           $('#model-datatable-form .datatablecollums ul li:last').find("input[type='checkbox']").attr('checked',false);
           model_form_active();

              $('#model-datatable-form .datatablecollums ul li').removeClass('odd');
              $('#model-datatable-form .datatablecollums ul li:odd').addClass('odd');          
          
           return false;
       })
       
       $('.datatableaction_next').click(function(){
           var html = $('#model-datatable-form .datatableaction').html();
                      
           $('#model-datatable-form .datatableactions ul').append('<li class="added">'+html+'</li>');
           $('#model-datatable-form .datatableactions ul li:last').find("input[type='text']").val('');
          
           model_form_active();
           
                         $('#model-datatable-form .datatableactions ul li').removeClass('odd');
                         $('#model-datatable-form .datatableactions ul li:odd').addClass('odd');
           
           return false;
       })       
  
       $('.datatablegroupaction_next').click(function(){
           var html = $('#model-datatable-form .datatablegroupaction').html();
                      
           $('#model-datatable-form .datatablegroupactions ul').append('<li class="added">'+html+'</li>');
           $('#model-datatable-form .datatablegroupactions ul li:last').find("input[type='text']").val('');
          
           model_form_active();
           
                         $('#model-datatable-form .datatablegroupactions ul li').removeClass('odd');
                         $('#model-datatable-form .datatablegroupactions ul li:odd').addClass('odd');
                      
           return false;
       })     
    
       $('#creategrid').click(function(){
           
           if(this.checked)
           
               $('#creategrid-form').show();
           
           else $('#creategrid-form').hide(); 
           
       })       
       
       $('#createformnew').click(function(){
           
           if(this.checked)
           
               $('#createformnew-form').show();
           
           else $('#createformnew-form').hide(); 
           
       })
       
       $('#createformedit').click(function(){
           
           if(this.checked)
           
               $('#createformedit-form').show();
           
           else $('#createformedit-form').hide(); 
                     
       })       
       
        $('#nestedindexes').click(function(){
            if(this.checked) $("#model-model-form input[name='grid_extends']").val('NestedGrid');
            else if($("#model-model-form input[name='grid_extends']").val()=='NestedGrid') $("#model-model-form input[name='grid_extends']").val('Grid');
        })       
        
       $('#addgallery').click(function(){
           
           if(this.checked)
           
               $('#predefined-gallery-form').show();
           
           else $('#predefined-gallery-form').hide(); 
                     
       })           

       $('#gallery-createformnew').click(function(){
           
           if(this.checked)
           
               $('#gallery-createformnew-form').show();
           
           else $('#gallery-createformnew-form').hide(); 
           
       })
       
       $('#gallery-createformedit').click(function(){
           
           if(this.checked)
           
               $('#gallery-createformedit-form').show();
           
           else $('#gallery-createformedit-form').hide(); 
                     
       })       

        
       $('#adddocs').click(function(){
           
           if(this.checked)
           
               $('#predefined-docs-form').show();
           
           else $('#predefined-docs-form').hide(); 
                     
       })                 
       
       $('#docs-createformnew').click(function(){
           
           if(this.checked)
           
               $('#docs-createformnew-form').show();
           
           else $('#docs-createformnew-form').hide(); 
           
       })
       
       $('#docs-createformedit').click(function(){
           
           if(this.checked)
           
               $('#docs-createformedit-form').show();
           
           else $('#docs-createformedit-form').hide(); 
                     
       })       
       
       $("#dtcreatefromgrid").click(function(){
          if(this.checked)
          {
              $("#dtcreatefromgrid_form").show();
              $("#datatablemodelform").hide();
          }
          else {
              $("#dtcreatefromgrid_form").hide();
              $("#datatablemodelform").show();              
          }          
       });
       
       $("#dtcreatefromgrid_btn").click(function(){
           $.get(this.href,{grid:$("#dtcreatefromgrid_grid").val()},function(json){
               
             $("#datatablemodelform").find("input[name='class']").val(json.class);
             $("#datatablemodelform").find("input[name='htmlID']").val(json.htmlID);
             $("#datatablemodelform").find("input[name='tableRaw']").val(json.tableRaw);
             $("#datatablemodelform").find("textarea[name='table']").val(json.table);
             $("#datatablemodelform").find("textarea[name='collums']").val(json.collums);
             $("#datatablemodelform").find("input[name='where']").val(json.where);
             $("#datatablemodelform").find("input[name='orderBy']").val(json.orderBy);
             $("#datatablemodelform").find("input[name='primaryKey']").val(json.pk);

           var html = $('#model-datatable-form .datatablecollum').html();
             
           $('#model-datatable-form .datatablecollums li.added').remove();    
               
             for(i=0;i<json.model.length;i++)  
             {
                $('#model-datatable-form .datatablecollums ul').append('<li class="added">'+html+'</li>');
                $('#model-datatable-form .datatablecollums ul li:last').find("input[type='text']").val('');                
                $('#model-datatable-form .datatablecollums ul li:last').find("input[name='collum_name[]']").val(json.model[i].collum);
                $('#model-datatable-form .datatablecollums ul li:last').find("input[name='collum_title[]']").val(json.model[i].title);
                $('#model-datatable-form .datatablecollums ul li:last').find("input[name='collum_render[]']").val(json.model[i].render);
                $('#model-datatable-form .datatablecollums ul li:last').find("input[name='collum_where[]']").val(json.model[i].where);
                $('#model-datatable-form .datatablecollums ul li:last').find("select[name='collum_model[]'] option[value='"+json.model[i].model+"']").attr('selected','selected');
                $('#model-datatable-form .datatablecollums ul li:last').find("select[name='collum_filter[]'] option[value='"+json.model[i].model+"']").attr('selected','selected');
                $('#model-datatable-form .datatablecollums ul li:last').prepend('<a href="#" class="dtremovemodel">[DROP]</a> &nbsp; &nbsp; &nbsp; &nbsp;');
             }
             
             $(".dtremovemodel").click(function(){
                 $(this).parent().fadeOut().remove();
                    $('#model-datatable-form .datatablecollums ul li').removeClass('odd');
                    $('#model-datatable-form .datatablecollums ul li:odd').addClass('odd');                 
                 return false;
             });
             
              $('#model-datatable-form .datatablecollums ul li').removeClass('odd');
              $('#model-datatable-form .datatablecollums ul li:odd').addClass('odd');
             
             $("#datatablemodelform").show();                
             
           },'json');
           return false;
       });
       
}

function model_form_active()
{
        
    $("#model-model-form input[name='class']").unbind('keyup').keyup(function(){
        var model = $(this).val() + '_Model';
        var grid = $(this).val() + '_Grid';
        var formnew = $(this).val() + '_Form_New';
        var formedit = $(this).val() + '_Form_Edit';
        
        var gallerymodel = $(this).val() + '_Gallery_Model';
        var gallerygrid = $(this).val() + '_Gallery_Grid';        
        var galleryfnew = $(this).val() + '_Gallery_Form_New';
        var galleryfedit = $(this).val() + '_Gallery_Form_Edit';
        
        var docsmodel = $(this).val() + '_Docs_Model';
        var docsgrid = $(this).val() + '_Docs_Grid';
        var docsfnew = $(this).val() + '_Docs_Form_New';
        var docsfedit = $(this).val() + '_Docs_Form_Edit';
        
        
        $("#model-model-form input[name='grid']").val(grid);
        $("#model-model-form input[name='form_new_class']").val(formnew);
        $("#model-model-form input[name='form_edit_class']").val(formedit);
        $("#model-model-form input[name='grid_model']").val(model);
        $("#model-model-form input[name='form_new_model']").val(model);
        $("#model-model-form input[name='form_edit_model']").val(model);
        
        $("#model-model-form input[name='gallery_model']").val(gallerymodel);
        $("#model-model-form input[name='gallery_grid']").val(gallerygrid);
        $("#model-model-form input[name='gallery_form_new_class']").val(galleryfnew);
        $("#model-model-form input[name='gallery_form_edit_class']").val(galleryfedit);
        $("#model-model-form input[name='gallery_form_new_model']").val(gallerymodel);
        $("#model-model-form input[name='gallery_form_edit_model']").val(gallerymodel);                
        
        $("#model-model-form input[name='docs_model']").val(docsmodel);
        $("#model-model-form input[name='docs_grid']").val(docsgrid);
        $("#model-model-form input[name='docs_form_new_class']").val(docsfnew);
        $("#model-model-form input[name='docs_form_edit_class']").val(docsfedit);
        $("#model-model-form input[name='docs_form_new_model']").val(docsmodel);
        $("#model-model-form input[name='docs_form_edit_model']").val(docsmodel);        
    })

    $("#model-model-form input[name='title']").unbind('keyup').keyup(function(){
        var name = niceName($(this).val());
        $(this).parent().find("input[name='name']").val(name);
        $("#model-model-form input[name='form_new_name']").val(name+'formnew');
        $("#model-model-form input[name='form_edit_name']").val(name+'formedit');        
        $("#model-model-form input[name='gallery_dir']").val('docs/'+name+'/gallery');
    })

    $("#model-model-form input[name='name']").unbind('keyup').keyup(function(){
        var name = niceName($(this).val());
        $(this).val(name);
        $("#model-model-form input[name='grid_table']").val(':db:'+name);
        $("#model-model-form input[name='grid_alias']").val(name.substring(0,1)+name.substring(2,3));
        $("#model-model-form input[name='form_new_name']").val(name+'formnew');
        $("#model-model-form input[name='form_edit_name']").val(name+'formedit');
        
        $("#model-model-form input[name='gallery_model_name']").val(name+'_gallery');
        $("#model-model-form input[name='gallery_dir']").val('docs/'+name+'/gallery');
        $("#model-model-form input[name='gallery_table']").val(':db:'+name+'_gallery');
        $("#model-model-form input[name='gallery_alias']").val(name.substring(0,1)+name.substring(2,3)+'gl');
        $("#model-model-form input[name='gallery_form_new_name']").val(name+'galleryformnew');
        $("#model-model-form input[name='gallery_form_edit_name']").val(name+'galleryformedit');        
        
        $("#model-model-form input[name='docs_model_name']").val(name+'_docs');
        $("#model-model-form input[name='docs_dir']").val('docs/'+name+'/docs');
        $("#model-model-form input[name='docs_table']").val(':db:'+name+'_docs');
        $("#model-model-form input[name='docs_alias']").val(name.substring(0,1)+name.substring(2,3)+'dc');
        $("#model-model-form input[name='docs_form_new_name']").val(name+'docsformnew');
        $("#model-model-form input[name='docs_form_edit_name']").val(name+'docsformedit');        
    })
    
    $("#model-model-form input[name='collum_title[]']").unbind('keyup').keyup(function(){
        var name = niceName($(this).val());
        $(this).parent().find("input[name='collum_name[]']").val(name);       
    })
    
    $("#model-model-form input[name='collum_name[]']").unbind('keyup').keyup(function(){
        var name = niceName($(this).val());
        $(this).val(name);
    })
    
    $("#model-model-form input[name='rel_title[]']").unbind('keyup').keyup(function(){
        var name = niceName($(this).val());
        $(this).parent().find("input[name='rel_name[]']").val(name);
    })

    $("#model-model-form input[name='grid_table']").unbind('keyup').keyup(function(){        
        $("#model-model-form input[name='docs_table']").val(name+'_docs');
        $("#model-model-form input[name='gallery_table']").val(name+'_gallery');
    })    
}










