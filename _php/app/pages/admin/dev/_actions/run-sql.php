<?php



try {
    
$sql = explode(';',$_POST['query']);
$gridclass = $_POST['grid'];

    
  foreach($sql as $k=>$q)  
    if(trim($q)!='')
        $gridclass::getConn()->query($q);

echo "{$gridclass} sql succ done";
__c()->clean();
} catch(Exception $e)
{
    echo $e->getMessage();
}


