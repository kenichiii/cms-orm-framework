[[

    $succ = 'yes';
    $err  = array();
    
if(isset($_FILES['files']['name']))
{
  foreach($_FILES['files']['name'] as $key=>$filename)
   {

      $model = new <?php echo $formedit->getModelClass() ?>();                
   
        if ($_FILES["files"]["error"][$key] > 0)
        {
            $err[]= array( 'el' => $_FILES["files"]["name"][$key],'mess'=>($_FILES["files"]["error"][$key]==1)?'Vložený soubor je příliš velký':"Error ".$_FILES["files"]["error"][$key],'type'=>'toobigfile');
            $succ = 'no';
        }                 
        elseif(!$model->getGrid()->isValidFile($_FILES['files']['name'][$key])) 
        {
            $err[]= array( 'el' => $_FILES["files"]["name"][$key],'mess'=>'Nevalidní přípona(typ) souboru','type'=>'notvalidfileext');
            $succ = 'no';        
        }
        else
        {
        
           try 
           {
               
                $model->fromform($_POST);

                $filecoll = $model->getGrid() instanceof Model_Component_Gallery_Grid ? 'photo' : 'file';

                $model->set('h1',$filename)                
                      ->set('active',0);

                <?php
                           if($formedit->getModel()->isRankAble())
                           {
                ?>
                            $model->setRank();        
                <?php                  
                           }           
                ?>          


                           $id = $model->insert();     
                
                
                    $targetPath = PUBLIC_PATH .'/'. $model->getGrid()->getDir().'/';
                    if(!is_dir($targetPath))
                    {
                        mkdir($targetPath,0777,true);
                    }

                    $pies = explode('.',$filename);    
                    $ext = end($pies);    
                    $newFileName = (isset($_POST['ownerid'])?$_POST['ownerid'].'_'.$id.'_':$id.'_').parse_seo_title($filename).'_'.time().'.'.strtolower($ext);
                    $targetFile =  str_replace('//','/',$targetPath) . $newFileName;

                    if( ! move_uploaded_file($_FILES["files"]["tmp_name"][$key],$targetFile) )
                    {
                        $err[]= array( 'el' => $_FILES["files"]["name"][$key],'mess'=>"Nepodařilo se přesunout soubor",'type'=>'uplnotmoved');
                        $succ = 'no';                    
                        $model->getGrid()->deleteByPK($id);
                    }
                    else {            
                        $model->set($filecoll,$newFileName)->set('active',1)->update();
                    }       
         }
         catch(Exception $e) 
         {        
              errorException($e);
                $err[]= array( 'el' => $_FILES["files"]["name"][$key],'mess'=>"Nepodařilo se data o souboru uložit do databáze",'type'=>'exception');
                $succ = 'no';        

         }
                                      
      } //end else valid ext,filesize
      
   } //endforeach  
                                                                                                                    
   __c()->clean();
   
 } //end isset FILES 
 else $succ = 'no';        
 
   echo json_encode(array(
                'succ' => $succ,  
                'succMsg'=>'Soubory byly nahrány na server',
                'errors' => $err
            ));
        
    
