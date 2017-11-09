



$(function() {

       $('#<?php echo $this->getName(); ?>').pfcAjaxForm({
            onforminit: function(form) {
               <?php 
               foreach($this->getModel()->getModel() as $key=>$child) { 
                if($child->isMixed()) printMixedJquery ($child,$this);
                elseif($child->isPrimitive()&&!$child->isPrimaryKey())
                    echo $child->getTemplate('form/new/js','jquery',$this);                             
               } 
               ?>                          
            },
            succ: function(json,form) {
                    showAlert(json.succMsg,{autohide:false,callback:function(){
                        window.location.href = json.url;
                    ]});                    
            }
       });
});


<?php 
               foreach($this->getModel()->getModel() as $key=>$child) { 
                if($child->isMixed()) printMixedJs ($child);
                elseif($child->isPrimitive()&&!$child->isPrimaryKey())
                    echo $child->getTemplate('form/edit','js',$this);                             
               } 
               ?>  


 