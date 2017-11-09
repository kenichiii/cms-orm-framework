
#vypnutí magic quotes
php_flag magic_quotes_gpc Off

RewriteEngine on

RewriteCond %{REQUEST_URI} ^<?php echo $webfolder; ?>/docs/_cache/img
RewriteCond %{DOCUMENT_ROOT}%{REQUEST_URI} !-f  
RewriteRule ^(.+)\.jpg$ index.php?<?php echo Project::$MAGICK_THUMB_GET_NAME; ?>=$1 [L]

<?php if($htaccess_force_www=='yes') { ?>

RewriteCond %{REQUEST_METHOD} !=POST
RewriteCond %{HTTP_HOST} !^www\.
RewriteCond %{HTTP_HOST} ([^.]+\.[^.]+)$
RewriteRule ^(.*) http://www.%1/$1 [R=301,QSA,L,NE]

<?php } ?>

# -- pravidlo na osetreni odkazu zadanych bez koncoveho lomitka --
# pokud se nejedna o pozadavek na soubor
RewriteCond %{REQUEST_URI} !\..*$
# a pozadavek neni zakonceny lomitkem
RewriteCond %{REQUEST_URI} [^/]$
# k pozadavku se prida lomitko a presmeruje se
RewriteRule ^(.+)$ /$1/ [L,R=301,QSA]

RewriteRule !\.(<?php echo $allowedfiles; ?>)$ index.php