


    <div class="logged-user-box fright">
        <input type="hidden" id="logged-user-data-link" value="<?php echo App::getIns()->setAjaxLink(Project::$ADMIN_PAGE_POINTER,'logged-user-data')?>">  
      Přihlášen\a: <b class="logged-user-element">Nahrávám...</b>  
      | <a id="admin-my-account-btn" class="button-link-after" href="<?php echo App::getIns()->setAjaxLink('adminaccount','my-account'); ?>">Moje konto</a>
      | <a id="admin-my-password-btn" class="button-link-after" href="<?php echo App::getIns()->setAjaxLink('adminaccount','my-password'); ?>">Změna hesla</a>  
      | <a class="button-link-after" href="<?php echo App::getIns()->setActionLink(Project::$ADMIN_PAGE_POINTER,'logout') ?>">ODHLÁSIT</a>  
    </div>    