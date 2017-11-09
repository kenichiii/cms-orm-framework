

$(function(){
         
           showConfirm('Zobrazit error',function(){
               showAlert('Toto je error',{mtype:'err',callback:function(){
                 showAlert('OK do confirmu',{modal:true,autohide:false,buttonText:"DALE",callback:function(){
                     showConfirm("posledni?",function(){});    
                 }})      
               }});
           })
       
})