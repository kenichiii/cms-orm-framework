<?php

    
     $succ = 'no';
     $err  = array();
     
     try {

    $email = new Model_Extended_Email();
    $email->setName('email')->fromform($_POST);
                           
        $val = $email->validate();
                                                                                                                                
        if($val->isSucc())
        {
            $ugrid = new User_Grid();
            $user = $ugrid->setDeletedCond()
                    ->where('and '.$ugrid->getAlias('email').'=%s',$email->getValue())
                    ->getSingle();
            
            if($user instanceof User_Model)
            {
                $pmodel = new Model_Extended_Password();
                $password = $pmodel->generatePassword();
                $user->fromform(array('pwd'=>$password));
                $user->update();
                
                $mess = "Dobrý den,<br>";
                $mess.= "na servru <a href='". Project::$WEB_URL . '/admin/'."'>".Project::$title ."</a> Vám bylo vygenerované nové heslo pro přístup do administrace.";
                $mess.= "<br><br><b>Vaše přístupové údaje:</b><br>";
                $mess.= "login: ".$user->getLogin()->getValue().'<br>';
                $mess.= "heslo: ".$password.'<br>';
                $mess.= '<br><br>';

                
                if(AppMail::sendMail($_POST['email'], 'Nové přístupové údaje '.Project::$title, $mess, Project::$infomail))
                {
                    $succ = 'yes';
                }
                else 
                $val->addError('cantsendemail', 'email', 'Zopakujte prosím akci email se nepodařilo odeslat');
                
            }
            else {
                $val->addError('nonexistingemail', 'email', 'Takový email se v databázi nenachází');
            }
        }
    
        $err = $val->getErrors();
     }
     catch(Exception $e) 
     {  
        errorException($e);
        $err[]= array( 'el' => 'exception','mess'=>'Došlo k nečekanému běhu aplikace. Vaše akce nemohla být přijata.','type'=>'exception');        
     }
                  
        echo json_encode(array(
                'succ' => $succ,
                'errors' => $err
            ));
        
                
    

