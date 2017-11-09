<?php

    AppUser::logout();
       
    AppAlert::set("Vaše odhlášení proběhlo vpořádku");
    
    reloadPage( App::getIns()->setLink(Project::$ADMIN_PAGE_POINTER) );

    