<?php




$errors = array();


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

   $ok_msg = "Stránka byla v pořádku přesunuta";


   try {

        Page_Grid::getConn()->query("SET AUTOCOMMIT=0");
        Page_Grid::getConn()->query("START TRANSACTION");

        

        $curr = Page_Model::loadById($_POST['currItemId']);
        $curr->set('lastupdate',date('Y-m-d G:i:s'))->update();
        
        if($_POST['prevItemId']!='none') {
            $prev = Page_Model::loadById($_POST['prevItemId']);
            $prev_rank = $prev->getRank()->getValue();
            $prev_parentid = $prev->getParentid()->getValue();
        } elseif( $_POST['nextItemId'] != 'none' ) {
            $next = Page_Model::loadById( $_POST['nextItemId'] );
            $prev = true;
            $prev_rank = 0;
            $prev_parentid = $next->getParentid()->getValue();
        }
        
        if(isset($prev) )
        {
        
        Page_Grid::getConn()->query("update ".$curr->getGrid()->getTableRaw()." set rank=rank+1 where rank > %i and parentid=%i",
                $prev_rank,$prev_parentid
        )    ;

        Page_Grid::getConn()->query("update ".$curr->getGrid()->getTableRaw()." set rank=%i,parentid=%i where id=%i",
                $prev_rank+1,$prev_parentid,$curr->getId()->getValue()
        )    ;
        }
        else {
           
        Page_Grid::getConn()->query("update ".$curr->getGrid()->getTableRaw()." set rank=%i,parentid=%i where id=%i",
                1,$_POST['parentId'],$curr->getId()->getValue()
        )    ;
        }

        
        
        Page_Grid::getConn()->query("COMMIT");
        Page_Grid::getConn()->query("SET AUTOCOMMIT=1");
        
        __c()->clean();
   }
   catch(Exception $e)
   {
       errorException($e);
       
       $err_elems []= array(
                        'elem_id' => 'error',
                        'err_msg' => $e->getMessage()
                        );

        Page_Grid::getConn()->query("ROLLBACK");
        Page_Grid::getConn()->query("SET AUTOCOMMIT=1");

   }

}

$return = array(
  'processed'    => ( count($err_elems) ) ? 'error' : 'ok',
  'ok_msg'       => $ok_msg,
  'data'         => $_POST['currItemId'],
  'err_elements' => $err_elems
);

echo json_encode($return);
