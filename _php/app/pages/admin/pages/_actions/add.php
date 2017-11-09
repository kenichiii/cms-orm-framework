<?php



$data = $_POST;

$errors = array();

$parentId = is_numeric($data['parentId']) ? $data['parentId'] : 0;
   
            

$err_elems = array();
foreach ( $errors as $elem_id=>$elem_err_msg ) {
    $err_elems[] = array(
                    'elem_id' => $elem_id,
                    'err_msg' => $elem_err_msg
                );
}


$ok_msg = "";
$id = "";

if( ! count($err_elems) )
{
    
   $ok_msg = "Stránka byla v pořádku přidána";
   
     
   try {
                      
       $page = new Page_Model();
       
       if($parentId>0)
       {
           $parentPage = Page_Model::loadById($parentId);
            $id   = $page->set('parentid',$parentId)->set('pointer','text_'.time())
                 ->set('menuname',$_POST['title'])->set('h1',$_POST['title'])   
                ->setRank()->set('uri',parse_seo_title($_POST['title']))
               ->set('type',  Page_Model::TYPE_TEXT)->set('lang',$_POST['lang'])
               ->set('access',$parentPage->getAccess()->getValue())     
               ->set('layout',$parentPage->getLayout()->getValue())          
               //->set('showinmenu',$parentPage->getShowInMenu()->getValue())     
                    
               //->set('cache',$parentPage->getCache()->getValue())     
               ->insert();       
           
       }
       else {                  
            $id   = $page->set('parentid',$parentId)->set('pointer','text_'.time())
                 ->set('menuname',$_POST['title'])->set('h1',$_POST['title'])   
                ->setRank()->set('uri',parse_seo_title($_POST['title']))
               ->set('type',  Page_Model::TYPE_TEXT)->set('lang',$_POST['lang'])
               ->insert();       
       }
       
     __c()->clean();
   }
   catch(Exception $e)
   {
       errorException($e);
       
       $err_elems []= array(
                        'elem_id' => 'error',
                       // 'err_msg' => $page->dibiExceptionMessage()
                            'err_msg' => $e->getMessage()
                        );
   }
   
}

$return = array(
  'processed'    => ( count($err_elems) ) ? 'error' : 'ok',
  'ok_msg'       => $ok_msg,
  'data'         => $id,
  'err_elements' => $err_elems
);

echo json_encode($return);
