<?php
     

     $id = 0;
     $succ = 'no';
     $err  = array();
     
     try {

        $model = new User_Model();
        
        $model->fromform($_POST);                          
        
        $val = $model->validate(Model_Form::ACTION_NEW);
                                                                                                                                
        if($val->isSucc())
        {
            $id = $model->insert();    
            
            $urgrid = new User_Roles_Grid();
            User_Roles_Grid::getConn()->query('INSERT INTO '.$urgrid->getTableRaw().' (subroleid,roleid,userid) VALUES (%i,%i,%i) '
                         ,intval($_POST['subrole']),AppUserRoles::getIns()->getRole("admin")->getId()->getValue(),$id);
            
            if(isset($_POST['genemail']))
            {
                $mess = "Dobrý den,<br>";
                $mess.= "na servru <a href='". Project::$WEB_URL . '/admin/'."'>".Project::$title ." admin</a> Vám bylo vygenerované nové konto pro přístup do administrace.";
                $mess.= "<br><br><b>Vaše přístupové údaje:</b><br>";
                $mess.= "login: ".$model->getLogin()->getValue().'<br>';
                $mess.= "heslo: ".$_POST['pwd'].'<br>';
                $mess.= '<br><br>';

                
                if(AppMail::sendMail($_POST['email'], 'Nové přístupové údaje '.Project::$title, $mess, Project::$infomail))
                {
                    $succ = 'yes';
                }
                else 
                $val->addError('cantsendemail', 'email', 'Zopakujte prosím akci email se nepodařilo odeslat');
            
            }
            else    $succ = 'yes';
            
            
            
            
            
            __c()->clean();
        }
        else        
        $err = $val->getErrors();
     }
     catch(Exception $e) 
     {  
        errorException($e);
        $err[]= array( 'el' => 'exception','mess'=>'Došlo k nečekanému běhu aplikace. Vaše akce nemohla být přijata.','type'=>'exception');        
     }
                  
        echo json_encode(array(
                'succ' => $succ,
                'id' => $id,
                'errors' => $err
            ));
        
            