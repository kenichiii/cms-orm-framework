

function customMenu() {
            return            {"create" : {
					"separator_before"	: false,
					"separator_after"	: true,
					"label"				: "Nová podstránka",
					"action"			: function (obj) { this.create(obj); }
				},
                                 "remove" : {
					"separator_before"	: false,
					"icon"				: false,
					"separator_after"	: false,
					"label"				: "Smazat stránku",
					"action"			: function (obj) { 
                                                                              var that = this;
                                                                              
                                                                              showConfirm('Opravdu smazat stránku?',function(){
                                                                              
                                                                                  if(that.is_selected(obj)) { that.remove(); } else { that.remove(obj); } 
                                                                              }) 
                                                                     
                                                                            }
                                                }
                                }
}                                    


  $(function(){
  
                                  $("#newrootpage").unbind('click').click(function() {
                                        $('#tree').jstree("deselect_all");
                                        $("#tree").jstree("create", null, "last", { "attr" : { "rel" : 'page' } });
                                  });
  
  
     $("#clearcache").click(function(){
       $.get(this.href,{},function(res){
           if(res=="ok")
           {
               showAlert('Cache byla vyčištena');
           }
           else showAlert(res,{mtype:'err'});
       })
       return false;
   });
  
    $("#view-lang").change(function(){
        $("#tree").jstree('refresh',-1);
        $("#page-window").html('Vyberte stránku k zobrazení');
    });
  
  
      $("#tree")        
	.jstree({ 
		// List of active plugins
		"plugins" : [ 
			"themes","json_data","ui","crrm","dnd","search","types","contextmenu" 
		],
                "contextmenu": {items: customMenu},
		// I usually configure the plugin that handles the data first
		// This example uses JSON as it is most common
		"json_data" : { 
			// This tree is ajax enabled - as this is most common, and maybe a bit more complex
			// All the options are almost the same as jQuery's AJAX (read the docs)
			"ajax" : {
				// the URL to fetch the data
				"url" : $('#admin-pages-tree-url').val(),
				// the `data` function is executed in the instance's scope
				// the parameter is the node being loaded 
				// (may be -1, 0, or undefined when loading the root nodes)
				"data" : function (n) { 
					// the result is fed to the AJAX request `data` option
					return { 
						"operation" : "getChildren", 
                                                "lang" : $("#view-lang").val(),
						"id" : n.attr ? n.attr("id").replace("node_","") : 0 
					}; 
				}
			}
		},
		
		// Using types - most of the time this is an overkill
		// read the docs carefully to decide whether you need types
		"types" : {
			// I set both options to -2, as I do not need depth and children count checking
			// Those two checks may slow jstree a lot, so use only when needed
			"max_depth" : -2,
			"max_children" : -2,
			// I want only `drive` nodes to be root nodes 
			// This will prevent moving or creating any other type as a root node
			"valid_children" : [ "page" ],
			"types" : {
				// The default type
				"default" : {
					// I want this type to have no children (so only leaf nodes)
					// In my case - those are files
					"valid_children" : "page"
					
				},
                                "page" : {
					// I want this type to have no children (so only leaf nodes)
					// In my case - those are files
					"valid_children" : "page"
					
				}
			}
		},
		// UI & core - the nodes to initially select and open will be overwritten by the cookie plugin
/*
		// the UI plugin - it handles selecting/deselecting/hovering nodes
		"ui" : {
			// this makes the node with ID node_4 selected onload
			"initially_select" : [ "node_4" ]
		},
*/
		// the core plugin - not many options here
		"core" : { 
			// just open those two nodes up
			// as this is an AJAX enabled tree, both will be downloaded from the server
//			"initially_open" : [ "node_2" , "node_3" ] 
		}
	})
        	.bind("create.jstree", function (e, data) {
                    
                   if($('#content').tinymce()!=null) {
                        $('#content').tinymce().remove()
                    }
		$.post(
			$("#admin-pages-add-url").val(), 
			{ 
				"operation" : "createNode", 
				"parentId" : data.rslt.parent.attr ? data.rslt.parent.attr("id").replace("node_","") : 0, 
				"position" : data.rslt.position,
				"title" : data.rslt.name,
				"type" : data.rslt.obj.attr("rel"),
                                "lang" : $("#view-lang").val()
			}, 
			function (r) {
				if(r.processed == 'ok') {
					$(data.rslt.obj).attr("id", "node_" + r.data)
                                        .attr("rel", "page");
                                            
                                            //loadPage(r.data);
                                        // $('#tree').jstree(true)
                                         //   .select_node("node_" + r.data);   
                                         $("#node_"+r.data).find('a').trigger('click');
                                    
                                          showAlert(r.ok_msg);
				}
				else {
                                    showAlert('error',{mtype:'err'});
				}
			}, 'json'
		);
	})
        	.bind("move_node.jstree", function (e, data) {
		data.rslt.o.each(function (i) {
                    
                        var prev =  $(this).prev().is('li') ? $(this).prev().attr("id").replace("node_","") : 'none';
                        var next = $(this).next().is('li') ? $(this).next().attr("id").replace("node_","") : 'none';
                    
			$.ajax({
				async : false,
				type: 'POST',
                                dataType: 'json',
				url: $("#admin-pages-update-url").val(),
				data : { 
					"operation" : "move_node", 
					"currItemId" : $(this).attr("id").replace("node_",""), 
					"prevItemId" : prev, 
                                        "nextItemId" :  next,
                                        "parentId" : data.rslt.np.attr("id").replace("node_","")
				},
				success : function (r) {
                                    if(r.processed == 'ok') {
                                          
                                            loadPage(r.data);
                                            showAlert(r.ok_msg);
                                    }      	
		   		 		                  else {
                                    if ( typeof(json.err_elements) == 'object' ) {
                                      for ( var i=0;i<json.err_elements.length;i++ ) {
                                        if ( json.err_elements[i].elem_id ) {
                                            showAlert( json.err_elements[i].err_msg, {mtype:'err'}  );
                                        }
                                      }
                                    }
                            
                                
				
						
				}
                                }
			});
		});
	})
        	.bind("remove.jstree", function (e, data) {
		data.rslt.obj.each(function () {
                    if($('#content').tinymce()!=null) {
                        $('#content').tinymce().remove()
                    }
                        $.post(
                          $('#admin-pages-delete-url').val(),
                          {"pageId" : this.id.replace("node_","")}, function (r) {
					if(r != 'error') {
                                            $("#page-window").html('Vyberte stránku k zobrazení');
                                            
                                            //data.inst.refresh();
                                            
                                            showAlert('Stránka byla smazána.');
					}
                                        else {                                                           				
                                            showAlert('Došlo k erroru, zopakujte prosím akci',{mtype:'err'})
                                        }
				}
                         
                        );
                        
                        
   
		});
	})
        .bind("select_node.jstree", function (event, data) {
	            // `data.rslt.obj` is the jquery extended node that was clicked                    

                    if($('#content').tinymce()!=null) {
                        $('#content').tinymce().remove()
                    }

            
                    $("#page-window").html('<br><br><br>Nahrávám stránku ...');
                    if(data.rslt.obj.attr("id") == undefined)
                    {
                        $("#page-window").html('<br><br><br>Stránka neexistuje v databázi');
                    }
                    else
                    loadPage(data.rslt.obj.attr("id").replace("node_",""));
	        });


  
  }); //end jquery ready


function loadPage(id,inittab)
{
                    if($('#content').tinymce()!=null) {
        $('#content').tinymce().remove()                                        
                    }
    $.get($("#admin-pages-page-url").val(),{id:id},function(html){
        
        $("#page-window").html(html);
        activate_page_listeners();
        if(inittab!=undefined) $("#"+inittab).trigger('click');
    })
}

function activate_page_listeners()
{
    activateFotoFormListener();
    gallerypageadmin();
    
                                 $("#pageformedit input[name='h1']").unbind('keyup').keyup(function(){                                        
                                        $("#page-window h2").html($(this).val());
                                    })
                                    
    simpletabs();                                
    
    
    	var options = {
	        success: formpageformedit,
	        dataType:  'json'
        };
       
       $('#pageformedit').ajaxForm(options);
       
    	var options2 = {
	        success: formpageformeditsystem,
	        dataType:  'json'
        };
       
       $('#pageformeditsystem').ajaxForm(options2);
       
    	var options3 = {
	        success: formpageformeditcontent,
	        dataType:  'json'
        };
       
       $('#contentForm').ajaxForm(options3);
       
       
              
       $('#content').tinymce({
                        // Location of TinyMCE script
                        script_url : '/assets/libs/tinymce/tinymce.min.js',
        width: 800,
        height: 250,
        language: "cs",
        fullpage_default_encoding: "utf-8",
        entity_encoding:	'raw',
                        // General options
                        //theme : "advanced",
                        plugins : "advlist,autolink,link,image,lists,charmap,preview,hr,anchor,pagebreak,searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table contextmenu directionality template paste textcolor",
                        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | link image | code",
                        menubar: "format insert table edit view" //tools


                         //Example content CSS (should be your site CSS)
                        //content_css : "/css/content.css"
/*
                        // Drop lists for link/image/media/template dialogs
                        template_external_list_url : "lists/template_list.js",
                        external_link_list_url : "lists/link_list.js",
                        external_image_list_url : "lists/image_list.js",
                        media_external_list_url : "lists/media_list.js",

                        // Replace values for the template plugin
                        template_replace_values : {
                                username : "Some User",
                                staffid : "991234"
                        }
                        */
                });
                
       $("#create-page-folder,#create-page-assets-folder").unbind('click').click(function(){
           $.get(this.href,{},function(res){
              if(res=='done') showAlert('Adresář byl vpořádku založen');
              else showAlert('Došlo k erroru. Zopakujte akci prosím',{mtype:'err'})
           });
           return false;
       })
}


function formpageformedit(json)
{
 $('#pageformedit').find(".form_err").remove();   
    
 if( json.succ == 'yes' ) {
        loadPage(json.id,"tab-menu-system");
        $("#tree").jstree('refresh',-1);
        showAlert("Vaše údaje byly v pořádku uloženy");        
 }
 else {
      window.scrollTo(0,0);
      
        $('#pageformedit').find('span.error') 
        .after('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>'); 
                                    
                                    if ( typeof(json.errors) == 'object' ) 
                                    {
                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
                                        if ( json.errors[i].el ) 
                                        {
                                          $('#pageformedit').find("input[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#pageformedit').find("select[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#pageformedit').find("." + json.errors[i].el )                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                        }
                                      }
                                    } 
                            
    }
}

function formpageformeditsystem(json)
{
 $('#pageformeditsystem').find(".form_err").remove();   
    
 if( json.succ == 'yes' ) {        
        loadPage(json.id,"tab-menu-system");
        showAlert("Vaše údaje byly v pořádku uloženy");
 }
 else {
      window.scrollTo(0,0);
      
        $('#pageformeditsystem').find('span.error') 
        .after('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>'); 
                                    
                                    if ( typeof(json.errors) == 'object' ) 
                                    {
                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
                                        if ( json.errors[i].el ) 
                                        {
                                          $('#pageformeditsystem').find("input[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#pageformeditsystem').find("select[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#pageformeditsystem').find("." + json.errors[i].el )                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                        }
                                      }
                                    } 
                            
    }
}
  
function formpageformeditcontent(json)
{
 $('#contentForm').find(".form_err").remove();   
    
 if( json.succ == 'yes' ) {
        showAlert("Vaše údaje byly v pořádku uloženy");
 }
 else {
      window.scrollTo(0,0);
      
        $('#contentForm').find('span.error') 
        .after('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>'); 
                                    
                                    if ( typeof(json.errors) == 'object' ) 
                                    {
                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
                                        if ( json.errors[i].el ) 
                                        {
                                           $('#contentForm').find("input[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                           $('#contentForm').find("select[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                           $('#contentForm').find("." + json.errors[i].el )                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                        }
                                      }
                                    } 
                            
    }
}

         



