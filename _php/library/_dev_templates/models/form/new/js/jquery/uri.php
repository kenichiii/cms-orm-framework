
<?php 
   $h1=$form->getModel()->isH1Able(); 
   if($h1) { 
?>

    form.find("input[name='<?php echo $h1->getCollum(); ?>']").keyup(function(){
        form.find("input[name='<?php echo $this->getCollum(); ?>']").val(niceUrl($(this).val()));
    });
    
<?php } ?>    