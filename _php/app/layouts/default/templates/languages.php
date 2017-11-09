
      <div class="web-language-chooser">
<?php foreach (Project::$languages as $key=>$lang) { ?>
          <a <?php echo $lang==App::getIns()->getLang()?'web-lang-active':''; ?> href="<?php echo Project::$WEB_URL; ?>/<?php echo $key==0?'':$lang; ?>"><?php echo $lang; ?></a> 
          <?php if(isset(Project::$languages[$key+1])) echo "| "; ?>
<?php } ?>
     </div>   




