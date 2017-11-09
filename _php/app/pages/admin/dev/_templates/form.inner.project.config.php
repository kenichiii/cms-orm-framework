

                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Title:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="title" value="<?php echo Project::$title ?>">
                    </div>            
                </div>  
                <br class="clear">  

                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Name:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="name" value="<?php echo Project::$name ?>">
                    </div>            
                </div>  
                <br class="clear">                  
                
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Web URL:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <?php
                                if(Project::$WEB_URL=='http://www.yoursitename.com')
                                {
                                        $ssl = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? true:false;
                                        $sp = strtolower($_SERVER['SERVER_PROTOCOL']);
                                        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');    
                                        $site = $protocol.'://'. $_SERVER['HTTP_HOST'];
                                }
                        ?>
                        <input type="text" name="weburl" value="<?php echo Project::$WEB_URL=='http://www.yoursitename.com'?$site:Project::$WEB_URL ?>">
                    </div>            
                </div>  
                <br class="clear">                  
                  
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        ENV:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <select name="image">
                            <option <?php echo Project::$image == IMAGE_LOCAL ? 'selected="selected"' : '' ?> value="<?php echo IMAGE_LOCAL ?>">localhost</option>
                            <option <?php echo Project::$image == IMAGE_DEV ? 'selected="selected"' : '' ?> value="<?php echo IMAGE_DEV ?>">DEV</option>
                            <option <?php echo Project::$image == IMAGE_PROD ? 'selected="selected"' : '' ?> value="<?php echo IMAGE_PROD ?>">PROD</option>
                        </select>
                    </div>            
                </div>  
                <br class="clear">                                  
                
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Web languages:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="langs" value="<?php echo implode(',',Project::$languages) ?>">
                    </div>            
                </div>  
                <br class="clear">                  
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Admin Languages:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="adminlangs" value="<?php echo implode(',',Project::$adminlanguages) ?>">
                    </div>            
                </div>  
                <br class="clear"> 
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Dev language:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="devlang" value="<?php echo Project::$DEV_TRANS_LANG ?>">
                    </div>            
                </div>  
                <br class="clear"> 
                
                <br>                  
                <b>Database</b>
                <br class="clear">                                                                          
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        db Hostname:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="db_hostname" value="<?php echo Project::$databaseConfig['host'] ?>">
                    </div>            
                </div>  
                <br class="clear">                       

                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        db Username:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="db_username" value="<?php echo Project::$databaseConfig['username'] ?>">
                    </div>            
                </div>  
                <br class="clear">                          
                
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        db Password:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="db_password" value="<?php echo Project::$databaseConfig['password'] ?>">
                    </div>            
                </div>  
                <br class="clear">                                          

                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        db Database:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="db_database" value="<?php echo Project::$databaseConfig['database'] ?>">
                    </div>            
                </div>  
                <br class="clear"> 
                
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        DB prefix :
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="db_prefix" value="<?php echo Project::$databasePrefix ?>">
                    </div>            
                </div>
                <br class="clear"> 
                
                
                <br>
                <b>Mails</b>
                <br class="clear">                                                                          
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Info mail:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="infoemail" value="<?php echo Project::$infomail ?>">
                    </div>            
                </div>  
                <br class="clear">                                                          

                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Crash mail:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="crashemail" value="<?php echo Project::$crashmail ?>">
                    </div>            
                </div>                  
                <br class="clear">                                                                          
                <br>
                <b>Passwords</b>  
                <br class="clear"> 
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Dev auth pwd:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="basicauthpwd" value="<?php echo Project::$basicAuthPwd ?>">
                    </div>            
                </div>  
                <br class="clear">                
                
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Install auth login:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="installauthlogin" value="<?php echo Project::$installAuthLogin ?>">
                    </div>            
                </div>  
                <br class="clear">                
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Install auth pwd:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="installauthpwd" value="<?php echo Project::$installAuthPwd ?>">
                    </div>            
                </div>  
                <br class="clear">
                <br>
                <b>Magick thumbs</b>
                <br class="clear">
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Allowed sizes:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="povolenerozmery" value='<?php echo '"'.implode('","',Project::$allowedThumbs).'"' ?>'>
                    </div>            
                </div>  
                <br class="clear">                                
                <br>
                <b>HTACCESS</b>
                <br class="clear">
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Allowed files:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="allowedfiles" value='<?php echo Project::$allowedFiles ?>'>
                    </div>            
                </div>  
                <br class="clear">                                
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Force WWW:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input <?php echo Project::$htaccess_force_www ? 'checked':''; ?> type="radio" name="htaccess_force_www" value="yes" id="hfwano"><label for="hfwano">YES</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input <?php echo Project::$htaccess_force_www==false ? 'checked':''; ?> type="radio" name="htaccess_force_www" value="no" id="hfwne"><label for="hfwne">NO</label>
                    </div>            
                </div>  
                <br class="clear">                                                
                               
                <br>
                <b>PHP settings</b>                
                <br class="clear">                                                                          
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        display_errors:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="displayerrors" value="<?php echo Project::$displayErrors ?>">
                    </div>            
                </div>  
                <br class="clear">                                                          
                                
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        error_reporting:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="errorreportimg" value="<?php echo Project::$errorReporting == 32767 ? 'E_ALL' : Project::$errorReporting ?>">
                    </div>            
                </div>  
                <br class="clear"> 

                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        upload_max_filesize:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="upload_max_filesize" value="<?php echo Project::$upload_max_filesize ?>">
                    </div>            
                </div>  
                <br class="clear"> 

                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        post_max_size:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="post_max_size" value="<?php echo Project::$post_max_size ?>">
                    </div>            
                </div>  
                <br class="clear">                 

                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        date_default_timezone:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="default_timezone" value="<?php echo Project::$default_timezone ?>">
                    </div>            
                </div>  
                <br class="clear">                                 

                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        session.cache_expire:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="session_cache_expire" value="<?php echo Project::$session_cache_expire ?>">
                    </div>            
                </div>  
                <br class="clear">                                 
                
                                        
                <br>                                                                                
                  <div>
                      <input type="submit" value="Generate config file">
                  </div>
              