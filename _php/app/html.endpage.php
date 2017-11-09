
<?php
           /**
            * last place to improvize without caching 
            */


          // defined(APP_USE_SUPERCACHE_FOR_HTML_PAGE)&&APP_USE_SUPERCACHE_FOR_HTML_PAGE
          // defined(APP_USE_CACHE_FOR_HTML_PAGE)    
?>

<?php
    if($msg = AppAlert::get())
    {
      ?>
      <script>
        showAlert("<?php echo addslashes($msg); ?>");
      </script>
      <?php
    }
?>

  </body>
</html>
