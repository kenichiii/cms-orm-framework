<?php

function modelspk2array($arrayModels)
{
  $export = array();
  
  if(isset($arrayModels[0]))  
  {
      $pk = $arrayModels[0]->getGrid()->getPrimaryKeyRaw();
      foreach($arrayModels as $key=>$model)
          $export []= $model->{"get{$pk}"}()->getValue();
          
      return $export;    
  }
  else return array();        
}
