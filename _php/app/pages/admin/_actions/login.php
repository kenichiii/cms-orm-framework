<?php


    $succ = 'no';
    $err  = array();
    
    try
     {

        if( $id = AppUser::login( $_POST['login'], $_POST['password'] ))
        {

           if(access(array('admin'=>'user'))) 
           {
               $succ = 'yes';
               AppAlert::set("Vaše údaje byly v pořádku ověřeny");
           }
        }
        
     }
     catch(Exception $e) 
     {  
       if(preg_match('/^(SQLSTATE\[HY000\])/',$e->getMessage()))
       {
           __c()->clean();
            if( $id = AppUser::login( $_POST['login'], $_POST['password'] ))
            {

               if(access(array('admin'=>'user'))) 
               {
                   $succ = 'yes';
                   AppAlert::set("Vaše údaje byly v pořádku ověřeny");
               }
            }           
       }
       else {
        errorException($e);
        $err[]= array( 'el' => 'exception','mess'=>'Došlo k nečekanému běhu aplikace. Vaše akce nemohla být přijata.'.$e->getCode() . $e->getMessage(),'type'=>'exception');        
       }
     }
     
     
        echo json_encode(array(
                'succ' => $succ,
                'errors' => $err
            ));


