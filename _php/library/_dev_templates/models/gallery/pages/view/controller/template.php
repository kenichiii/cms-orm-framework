[[
    
    $<?php echo $model->getModelName(); ?>_gallery = $bean->getGallery()->orderBy($bean->getGallery()->getAlias('rank').' desc')->getData();