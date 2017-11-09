

.<?php echo $model->getModelName(); ?>-holder {
    float: left;
    width: 900px;
}

<?php if( $model->isPhotoAble() ) { ?>    
.<?php echo $model->getModelName(); ?>-foto-holder {
    float: right;
    padding-left: 20px;
    padding-bottom: 20px;
}

<?php } ?>

.<?php echo $model->getModelName(); ?>-collum {
    width:820px;
    float: left;
}

.<?php echo $model->getModelName(); ?>-collum-value {
    float: left;
    min-width: 600px;
}

.hasFoto .<?php echo $model->getModelName(); ?>-collum {
    width:455px;
    float: left;
}

.hasFoto .<?php echo $model->getModelName(); ?>-collum-value {
    float: left;
    width: 350px;
}


.<?php echo $model->getModelName(); ?>-collum-title {
    width: 100px;
    float: left;
}


