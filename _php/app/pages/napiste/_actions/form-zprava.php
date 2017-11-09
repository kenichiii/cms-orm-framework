<?php
     

     $id = 0;
     $succ = 'no';
     $err  = array();
     
     try {

        $model = new Napiste_Model();
        
        $model->fromform($_POST);
        
        $model->set('created',Date('Y-m-d G:i:s',time()));
           
        
        
        $val = $model->validate(Model_Form::ACTION_NEW);
                                                                                                                                
        if($val->isSucc())
        {
            $id = $model->insert();                        
            
            
            
                $mess = "Dobrý den,<br>";
                $mess.= "na servru <a href='". Project::$WEB_URL . '/admin/'."'>".Project::$title ."</a> Vám byl zaslán nový dotaz.";
                $mess.= "<br><br><b>Osobní údaje:</b><br>";
                $mess.= "Jméno: ".$model->getJmeno()->getValue().'<br>';
                $mess.= "Email: ".$model->getEmail()->getValue().'<br>';
                if($model->getTelefon()->getValue()){ $mess.= "Telefon: ".$model->getTelefon()->getValue().'<br>'; } 
                $mess.= '<br><br>';
                $mess.= '<b>Zpráva:</b><br>';
                $mess.= $model->getZprava()->getValue();
                
                if(AppMail::sendMail(AppSettings::getBySection("web")->CONTACT_FORM_RECEPIENT, 'Nová zpráva z '.Project::$title, $mess, Project::$infomail))
                {
                    $succ = 'yes';
                }
                else 
                $val->addError('cantsendemail', 'email', 'Zopakujte prosím akci email se nepodařilo odeslat');
                
            
            __c()->clean();
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
                'id' => $id,
                'url' => App::getIns()->setLink('home'),
                'errors' => $err
            ));
        
                 