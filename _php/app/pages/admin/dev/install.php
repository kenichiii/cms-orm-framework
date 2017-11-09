<?php

    if(isset($_POST['generate-pages']))
    {
        require "pages/admin/dev/_actions/install-database.php";
        exit;
    }

    if(isset($_POST['clear-cache']))
    {
        require "pages/admin/dev/_actions/cache-clear.php";
        exit;
    }
    
    
    if(count($_POST)&&!isset($_POST['login']))
    {
        require "pages/admin/dev/_actions/project-config.php";
        exit;
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		
    <title>Project installation</title>
                
           	<link type="text/css" href="../assets/libs/jquery_ui/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">			                                                		        
                                                                                
                <link type="text/css" href="../assets/layouts/common/css/layout.css" rel="stylesheet">
                <style>
                    

.formPrimitiveCell input.idate { width: 70px !important;}
.formPrimitiveCell select.idatetime { width: 30px !important;}

.formPrimitiveTitle {
    width: 180px;
}

.formPrimitiveCell input[type='text'], .formPrimitiveCell select, .formPrimitiveCell textarea {
    width: 550px;
    border: 1px solid #22697d;
    padding: 5px;
}

.formPrimitiveRow {
    padding-bottom: 10px;
}

                </style>
                                                                                                                                                                                                 
    </head>
    <body>
        
               
        <header>
        
               <h1>Project installation</h1>
        
        </header>
      
                     
       <section>                   
              <h2>Project config</h2>  

              <form id="project-config" method="post">
       
                <?php require_once 'pages/admin/dev/_templates/form.inner.project.config.php'; ?>                                                      
              </form>  
              
              <div style="float: left;padding-right: 60px;">
              <h2>Project Pages</h2>  
              <div>
                  <button id="generate-pages">Generate basic database</button>
              </div>   
              </div>
              
              <div style="float: left;padding-right: 60px;">
              <h2>Clear cache</h2>  
              <div>
                  <button id="clear-cache">Clear cache</button>
              </div>                 
              </div>
              <br class="clear">
              <div><br><a id='href-home' href='#'>homepage</a></div>
              
              <br>
              
       </section>    
           
                               
    <!-- javascript  -->    
                <script type="text/javascript" src="../assets/libs/jquery/jquery-1.6.2.min.js"></script>
                
                <script type="text/javascript" src="../assets/libs/jquery_ui/jquery-ui-1.8.16.custom.min.js"></script>
                
                <script type="text/javascript" src="../assets/libs/jquery_form/jquery.form.js"></script>
                
                
                <script type="text/javascript" src="../assets/layouts/common/js/functions.js"></script>
                <script type="text/javascript" src="../assets/layouts/common/js/control.js"></script>        
                
                <script>
                
                                
                    $(function() {
                                $("input[name='title']").unbind('keyup').keyup(function(){
                                        var name = niceName($(this).val());
                                        $("input[name='name']").val(name);                                        
                                    })
                                    
                            $('#href-home').click(function(){
                                window.location.href = $("input[name='weburl']").val();
                                return false;
                            })
                            
                            var options = {
                                    success: formprojectconfig
                            };

                           $('#project-config').ajaxForm(options);


                           $("#generate-pages").click(function(){
                              
                              $.post(window.location.href,{'generate-pages':'true'},function(res){
                                        alert(res);
                              });
                              
                              return false;
                           });
                           $("#clear-cache").click(function(){
                              
                              $.post(window.location.href,{'clear-cache':'true'},function(res){
                                        if(res=='ok')
                                            alert('Cache was cleared');
                                        else alert(res);
                              });
                              
                              return false;
                           });                           
                    });

                    function formprojectconfig(res)
                    {
                        if(res=='done') alert('Project config file was successfully written');
                        else alert(res);
                    }
                
                
                                                                                                
                </script>
                
                
    
    </body>
</html>