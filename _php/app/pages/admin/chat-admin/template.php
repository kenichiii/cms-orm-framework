
        
                    <article>
                                    <header> 
                                        <h1 class="current-page-title"><?php echo App::getIns()->currentPage()->getH1()->getValue(); ?></h1>
                                    </header>    
                                    <div class="current-page-text-content">
                                        
                                      
                                      <div id="online-chat-admin">
                                      
                                      	<div id="online-chat-admin-left-panel">
                                        	<i>ONLINE UŽIVATELÉ</i>
                                            <ul id="online-chat-admin-connected-users">
                                            
                                            </ul>
                                        </div>
                                      
                                        <div id="online-chat-admin-conversation-window"></div>
                                        
                                        <div id="online-chat-admin-new-message-panel">
                                        	<form action="<?php echo App::getIns()->setActionLink('chat-admin','admin-response'); ?>" method="post">
                                              <input type="hidden" name="chat_id" value="">
                                              <textarea name="message"></textarea>
                                              <button>ODESLAT</button>
                                            </form>                                        	
                                        </div>
                                        
                                      </div>
                                      
                                      
                                      
                                      
                                      
                                      
                                      
                                      
                                      
                                    </div>
                                                
                    </article>  
                    
            