
      <div class="admin-language-chooser">
          Jazyk: &nbsp;&nbsp;
<?php foreach (Project::$adminlanguages as $key=>$lang) { ?>
          <a class="button-link-after <?php echo $lang==App::getIns()->getLang()?'web-lang-active':''; ?>" href="<?php echo Project::$WEB_URL.'/'.Project::$ADMIN_PAGE_URI; ?>/<?php echo $key==0?'':$lang; ?>/"><?php echo $lang; ?></a> 
          <?php if(isset(Project::$languages[$key+1])) echo "| "; ?>
<?php } ?>
     </div>   




