<?php


     $succ = 'no';
     $mess  = '';
     $pointer = '';
     
     try {

            $sett = Settings_Model::loadByPK($_POST['id']);

            $sett->set($sett->getType()->getValue(),$_POST['value']);

            $sett->update();

            $pointer = $sett->getPointer()->getValue();

            __c()->clean();

            $succ = 'yes';
            
            $mess = "Nastavení bylo v pořádku uloženo";
            
      }
     catch(Exception $e) 
     {  
        errorException($e);
        $mess = 'Došlo k nečekanému běhu aplikace. Vaše akce nemohla být přijata.';        
     }
                  
        echo json_encode(array(
                'succ' => $succ,
                'pointer' => $pointer,
                'mess' => $mess
            ));
        
        