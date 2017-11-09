<?php

$grid = new $_GET['grid']();

$dt = array();

$dt['class'] = preg_replace('/(\_Model)$/', '_Datatable', $grid->getModelClassName());
$dt['htmlID'] = $grid->getModel()->getModelName().'_datatable';
$dt['tableRaw'] = $grid->getTableRaw();
$dt['table'] = $grid->getTable();
$dt['collums'] = 'array("'.implode('","',$grid->getCollums()).'")';
$dt['pk'] = $grid->getAlias($grid->getModel()->getPrimaryKey()->getCollum());
$dt['where'] = null;
foreach($grid->getModel()->getModel()as$coll=>$child)
{
    if($child->isModel()&&$cd=$child->isDeletedAble())
    {
        $dt['where'] .= $dt['where']===null ? ' WHERE ' : ' and ';
        $dt['where'] .= $child->getGrid()->getAlias($cd->getCollum()).'=0 ';
    }
}
if($md=$grid->getModel()->isDeletedAble())
{
        $dt['where'] .= $dt['where']===null ? ' WHERE ' : ' and ';
        $dt['where'] .= $grid->getAlias($md->getCollum()).'=0 ';    
}

if($mr=$grid->getModel()->isRankAble())
{
        $dt['orderBy'] = ' ORDER BY '.$grid->getAlias($mr->getCollum())." ".$mr->getSorting();
}
elseif($md=$grid->getModel()->isDateAble())
{
        $dt['orderBy'] = ' ORDER BY '.$grid->getAlias($md->getCollum())." DESC, "
                .$grid->getAlias($grid->getModel()->getPrimaryKey()->getCollum()).' DESC';    
}
else    $dt['orderBy'] = ' ORDER BY '.$grid->getAlias($grid->getModel()->getPrimaryKey()->getCollum()).' DESC';    


$dt['models'] = array();
foreach($grid->getModel()->getModel()as$c=>$child)
{
  if($child->isPrimitive())  
  {
    $cm='none';  
    if($child instanceof Model_Primitive_Int||$child instanceof Model_Primitive_Decimal) $cm = 'key';
    if($child instanceof Model_Primitive_Varchar||$child instanceof Model_Primitive_Text) $cm = 'text';
    if($child instanceof Model_Primitive_Bit) $cm = 'bit';
    if($child instanceof Model_Primitive_Enum) $cm = 'select';
    if($child instanceof Model_Primitive_Date) $cm = 'date';
    if($child instanceof Model_Primitive_Datetime) $cm = 'datetime';
        
    $rd = '';
    if($child instanceof Model_Extended_Photo) $rd = 'render'.$child->getCollum();
    if($child instanceof Model_Extended_Price) $rd = 'render'.$child->getCollum();
    if($child instanceof Model_Primitive_Text) $rd = 'render'.$child->getCollum();
    
    $dt['model'] []= array(
        'collum'=>$child->getCollum(),
        'title'=>$child->getTitle(),
        'model'=>$cm,
        'where'=>$grid->getAlias($child->getCollum()),
        'render'=>$rd
    );
  }
  elseif($child->isMixed()) {
      foreach($child->getCollumsInArray()as$coll=>$value)
      {
            $cm = 'none';
            if($grid->getModel()->get($coll) instanceof Model_Primitive_Int||$grid->getModel()->get($coll) instanceof Model_Primitive_Decimal) $cm = 'key';
            if($grid->getModel()->get($coll) instanceof Model_Primitive_Varchar||$grid->getModel()->get($coll) instanceof Model_Primitive_Text) $cm = 'text';
            if($grid->getModel()->get($coll) instanceof Model_Primitive_Bit) $cm = 'bit';
            if($grid->getModel()->get($coll) instanceof Model_Primitive_Enum) $cm = 'select';
            if($grid->getModel()->get($coll) instanceof Model_Primitive_Date) $cm = 'date';
            if($grid->getModel()->get($coll) instanceof Model_Primitive_Datetime) $cm = 'datetime';
            

            $rd = '';
            if($grid->getModel()->get($coll) instanceof Model_Extended_Photo) $rd = 'render'.$coll;
            if($grid->getModel()->get($coll) instanceof Model_Extended_Price) $rd = 'render'.$coll;
            if($grid->getModel()->get($coll) instanceof Model_Primitive_Text) $rd = 'render'.$coll;
            
            $dt['model'] []= array(
                'collum'=>$coll,
                'title'=> $grid->getModel()->get($coll)->getTitle(),
                'model'=>$cm,
                'where'=>$grid->getAlias($coll),
                'render'=>$rd
            );
          
      }
  }
  elseif($child->isModel()) {
      foreach($child->getCollumsInArray()as$coll=>$value)
      {
            $cm = 'none';
            if($child->get($coll) instanceof Model_Primitive_Int||$child->get($coll) instanceof Model_Primitive_Decimal) $cm = 'key';
            if($child->get($coll) instanceof Model_Primitive_Varchar||$child->get($coll) instanceof Model_Primitive_Text) $cm = 'text';
            if($child->get($coll) instanceof Model_Primitive_Bit) $cm = 'bit';
            if($child->get($coll) instanceof Model_Primitive_Enum) $cm = 'select';
            if($child->get($coll) instanceof Model_Primitive_Date) $cm = 'date';
            if($child->get($coll) instanceof Model_Primitive_Datetime) $cm = 'datetime';
            

            $rd = '';
            if($child->get($coll) instanceof Model_Extended_Photo) $rd = 'render'.$child->getModelName().'_'.$coll;
            if($child->get($coll) instanceof Model_Extended_Price) $rd = 'render'.$child->getModelName().'_'.$coll;
            if($child->get($coll) instanceof Model_Primitive_Text) $rd = 'render'.$child->getModelName().'_'.$coll;
            
            $dt['model'] []= array(
                'collum'=> $child->getModelName().'_'.$coll,
                'title'=> $child->get($coll)->getTitle(),
                'model'=> $cm,
                'where'=> $child->getGrid()->getAlias($coll),
                'render'=>$rd
            );
          
      }
  }  
}

echo json_encode($dt);

