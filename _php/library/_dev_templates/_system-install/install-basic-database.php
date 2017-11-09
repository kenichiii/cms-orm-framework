<?php

//first install db tables
$model = new Page_Model();
$pages = $model->getGrid()->createTable();
App::getConn()->query("drop table if exists ".$model->getGrid()->getTableRaw());
App::getConn()->query($pages);

$gpages = $model->getGallery()->createTable();
App::getConn()->query("drop table if exists ".$model->getGallery()->getTableRaw());
App::getConn()->query($gpages);


//settings
$sgrid = new Settings_Grid();
$ss = $sgrid->createTable();
App::getConn()->query("drop table if exists ".$sgrid->getTableRaw());
App::getConn()->query($ss);


//translations
$tgrid = new Translations_Grid();
$tt = $tgrid->createTable();
App::getConn()->query("drop table if exists ".$tgrid->getTableRaw());
App::getConn()->query($tt);

$tagrid = new Translations_Grid(true);
$tta = $tagrid->createTable();
App::getConn()->query("drop table if exists ".$tagrid->getTableRaw());
App::getConn()->query($tta);




//users+roles
$sbgrid = new User_Role_Subrole_Grid();
$sbt = $sbgrid->createTable();
App::getConn()->query("drop table if exists ".$sbgrid->getTableRaw());
App::getConn()->query($sbt);

$rgrid = new User_Role_Grid();
$rt = $rgrid->createTable();
App::getConn()->query("drop table if exists ".$rgrid->getTableRaw());
App::getConn()->query($rt);

$rugrid = new User_Roles_Grid();
$rut = $rugrid->createTable();
App::getConn()->query("drop table if exists ".$rugrid->getTableRaw());
App::getConn()->query($rut);

$sugrid = new User_Subject_Grid();
$sut = $sugrid->createTable();
App::getConn()->query("drop table if exists ".$sugrid->getTableRaw());
App::getConn()->query($sut);

$ugrid = new User_Grid();
$ut = $ugrid->createTable();
App::getConn()->query("drop table if exists ".$ugrid->getTableRaw());
App::getConn()->query($ut);

echo "Project database tables has been written \n";


//generate table pages

/*
 * PUBLIC WEB home+404 for each lang
 */

foreach (Project::$languages as $lang)
{
//home
$model = new Page_Model();
$model->getParentId()->set(0);
$model->getActive()->set(1);
$model->set('deleted',0)->set('lang',$lang)->set('layout','default')
      ->set('showinmenu',0)->set('footermenu',0)->set('type',Page_Model::TYPE_TEXT)       
      ->set('h1','Homepage '.$lang)->set('menuname','Home')
      ->set('pointer',Project::$HOME_PAGE_POINTER)->set('uri',Project::$HOME_PAGE_URI)
     ->setRank()
->insert();

//page 404
$model = new Page_Model();
$model->getParentId()->set(0);
$model->getActive()->set(1);
$model->set('deleted',0)->set('lang',$lang)->set('layout','default')
      ->set('showinmenu',0)->set('footermenu',0)->set('type',Page_Model::TYPE_TEXT)
      ->set('h1','Error 404')->set('menuname','Error 404')
      ->set('pointer',Project::$ERROR404_PAGE_POINTER)->set('uri',Project::$ERROR404_PAGE_URI)
     ->setRank()
->insert();
}


/*
 * ADMIN
 */


foreach (Project::$adminlanguages as $alang)
{
//admin
$model = new Page_Model();
$model->getParentId()->set(0);
$model->getActive()->set(1);
$model->set('deleted',0)->set('lang',$alang)
      ->set('showinmenu',0)->set('footermenu',0)->set('type',Page_Model::TYPE_SYSTEM)
      ->set('h1','Administrace')->set('menuname','Admin')
      ->set('cache',0)  
     ->set('pointer',  Project::$ADMIN_PAGE_POINTER )->set('uri','admin')->set('footermenu',1)
     ->setRank()->set('layout','admin');
$adminid = $model->insert();

//admin WWW stranky
$model = new Page_Model();
$model->getActive()->set(1);
$model->set('deleted',0)->set('lang',$alang)
      ->set('footermenu',0)->set('type',Page_Model::TYPE_SYSTEM)
      ->set('h1','CMS stránky')->set('menuname','CMS')
      ->set('cache',1)->set('access','admin::user')
     ->set('pointer','pages')->set('uri','cms')->set('footermenu',0)
     ->set('parentid',$adminid)->set('showinmenu',1)->set('layout','admin')   
     ->setRank()
->insert();

//DEV
$model = new Page_Model();
$model->getParentId()->set(1);
$model->getActive()->set(1);
$model->set('deleted',0)->set('lang',$alang)
      ->set('showinmenu',1)->set('type','system')
      ->set('h1','Project dev lab')->set('menuname','DEV')->set('layout','admin')
      ->set('cache',1)->set('access','admin::dev')
     ->set('parentid',$adminid)->set('pointer','dev')->set('uri','lab')->set('footermenu',0)
     ->setRank()
->insert();


//admin konta
$model = new Page_Model();
$model->getParentId()->set(1);
$model->getActive()->set(1);
$model->set('deleted',0)->set('lang',$alang)->set('layout','admin')
      ->set('showinmenu',1)->set('type',  Page_Model::TYPE_SYSTEM)
      ->set('h1','Administrátorská konta')->set('menuname','Admin')
      ->set('cache',1)->set('access','admin::admin')
     ->set('parentid',$adminid)->set('pointer','admins')->set('uri','administratorska-konta')->set('footermenu',0)
     ->setRank()
->insert();

//admin account
$model = new Page_Model();
$model->getActive()->set(1);
$model->set('deleted',0)->set('lang',$alang)->set('layout','admin')
      ->set('showinmenu',0)->set('type',  Page_Model::TYPE_TEXT)
      ->set('h1','Administrátorské konto')->set('menuname','Admin konto')
      ->set('cache',1)->set('access','admin::user')
     ->set('parentid',$adminid)->set('pointer','adminaccount')->set('uri','moje-konto')->set('footermenu',0)
     ->setRank()
->insert();

//settings
$model = new Page_Model();
$model->getParentId()->set(1);
$model->getActive()->set(1);
$model->set('deleted',0)->set('lang',$alang)->set('layout','admin')
      ->set('showinmenu',1)->set('type',  Page_Model::TYPE_SYSTEM)
      ->set('h1','Nastavení')->set('menuname','Nastavení')
      ->set('cache',1)->set('access','admin::user')
     ->set('parentid',$adminid)->set('pointer','settings')->set('uri','nastaveni')->set('footermenu',0)
     ->setRank()
->insert(); 

}

echo "Project page structure has been written \n";


/*
 * USER ROLES
 */

$role = new User_Role_Model();
$adminroleid = $role->set('pointer','admin')->set('h1','Admin')->insert();

$subrole = new User_Role_Subrole_Model();
$adminuserid = $subrole->set('roleid',$adminroleid)->set('pointer','user')->set('rank',1)
        ->set('h1', 'Uživatel')->insert();

$subrole = new User_Role_Subrole_Model();
$adminadminid = $subrole->set('roleid',$adminroleid)->set('pointer','admin')->set('rank',2)
        ->set('h1', 'Admin')->insert();

$subrole = new User_Role_Subrole_Model();
$admindevid = $subrole->set('roleid',$adminroleid)->set('pointer','dev')->set('rank',3)
        ->set('h1', 'Vývojář')->insert();

$adminsubject = new User_Subject_Model();
$asid = $adminsubject->set('h1','Vývojový team')->insert();

$adminsubject = new User_Subject_Model();
$osid = $adminsubject->set('h1','Vlastník stránek')->insert();

echo "Project admin user roles system has been written \n";


/**
 *  settings
 */ 

//add google code
$model = new Settings_Model();
$model->set('pointer','GA_CODE')->set('h1','Google analytics html code')
      ->set('type',  Settings_Model::TYP_TEXT)
      ->set('section','web')->set('lang','uni')  
   ->insert();  

//add const
$model = new Settings_Model();
$model->set('pointer','ADMIN_PAGE_ID')->set('h1','Admin page id')
      ->set('type',  Settings_Model::TYP_INT)->set(Settings_Model::TYP_INT,$adminid)  
      ->set('section','const')->set('lang',Project::$languages[0])  
   ->insert();     

//ADMIN NASTAVENI
$model = new Settings_Model();
$model->set('pointer','OWNER_SUBJECT_ID')->set('h1','Web owner user subject id')
      ->set('type',  Settings_Model::TYP_INT)->set(Settings_Model::TYP_INT,$osid)  
      ->set('section','const')->set('lang','uni')  
   ->insert();     

$model = new Settings_Model();
$model->set('pointer','DEV_SUBJECT_ID')->set('h1','Dev team user subject id')
      ->set('type',  Settings_Model::TYP_INT)->set(Settings_Model::TYP_INT,$asid)  
      ->set('section','const')->set('lang','uni')  
   ->insert();     
   

echo "Project constants has been written to settings \n";


/*
 * ADMIN ACCOUNT
 */
$acc = new User_Model();
$accid = $acc->set('subjectid',$asid)->set('email',  Project::$crashmail)->set('login',  Project::$installAuthLogin)
    ->set('pwd',  AppUser::encodePwd(Project::$installAuthPwd))
    ->set('fullname_firstname','Tester')
    ->set('fullname_surname','Webmaster')
        ->insert();

AppUserRoles::getIns()->registerRole("admin","dev",$accid);

echo "\nCREATED ADMIN ACCOUNT: \n\n webmaster / ".Project::$installAuthPwd." \n\n";


__c()->clean();
