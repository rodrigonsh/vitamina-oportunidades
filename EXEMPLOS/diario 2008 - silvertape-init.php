<?php
// SilverTape
// Rodrigo Nishino

$debug = (is_file("../debug"))  ? true : false;
$dev = (is_file("../dev.php"))  ? true : false;

$enableView = true;

require_once("../app/bnCache.class.php");
$sbt = new bnCache("superbannerTopo", "superbannerTopo");
$sb = new bnCache("superbanner", "superbanner");
$dstq = new bnCache("destaque", "destaque");
$blexcl = new bnCache("box-lateral-exclusivo", "box-lateral");

# Start the session and get the session ID
session_start();
$sessid = session_id();
/*if (isset($_SESSION['lastrequest']))
{
	if ( $entry != "admin" &&  (time() - (int) $_SESSION['lastrequest']) < 1  )
	{
		header("HTTP/1.0 429 Too Many Requests");
		$_SESSION['lastrequest'] = time();
		die();
	}


}

$_SESSION['lastrequest'] = time();*/

# Message arrays
$Erros = array();
$Sucessos = array();
$Avisos = array();
$Dumps = array();

$locales = array();

$indexTPL = "index.tpl";

# Debug flag

# Configurations
require_once("../config.inc.php");
if ( $dev ) require_once("../dev.php");

if ( $debug )
{
	error_reporting(E_ALL);
	ini_set('log_errors', 1);
	ini_set('display_errors', 1);
} else {
	ini_set('display_errors', 0);
}



# Module
$s = (isset($_GET['s'])) ? $_GET['s'] : $config['ModuloInicial'];
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// home cacheia por 10 seg ... o resto por 1 min
$cache_time = ( $s == 'home' ) ? 10 : 60;

$isGET = ($_SERVER['REQUEST_METHOD'] === 'GET');
$cacheActive = ($entry == 'index' && !$debug  && $isGET && !isset($_GET['data']) );

$disableCacheFor = ['enquete_votar'];

if ( array_search($s, $disableCacheFor) !== false ) $cacheActive = false;

// Just some vaccine ;D
if ( strlen($s) > 25 ) die("LIGMA");
$commonAttacks = ["'", "=", "[", "]", "."];
foreach($commonAttacks as $token ) { if ( strpos($s, $token) !== false ) die("LIGMA"); }

//error_log("cacheActive?  $cacheActive");

if ( $cacheActive )
{

	if(is_file("../cache/html/$s-$id-time.txt" ))
	{
		$last_cache_time = (int) file_get_contents( "../cache/html/$s-$id-time.txt" ) ;
		$cache_diff =  time() - $last_cache_time;

		if ( $cache_diff < $cache_time )
		{

			if( $s == "noticia" && $id > 0 )
			{
				require_once("../app/noticiaAPI.class.php");
				NoticiaAPI::increaseViews($id);
			}

			$sbtRet = $sbt->renderNext();

			$cached = file_get_contents( "../cache/html/$s-$id-data.txt" );
			
			if( $sbtRet == "" ) $cached = str_replace("[SBT_CLS]", "", $cached);
			else $cached = str_replace("[SBT_CLS]", "superbannerTopo", $cached);
		
			$cached = str_replace("[BN_SBT]", $sbtRet, $cached);
			$cached = str_replace("[BN_SB]", $sb->renderNext(), $cached);
			$cached = str_replace("[BN_DSTQ]", $dstq->renderNext(), $cached);
			$cached = str_replace("[BN_BLEXCL]", $blexcl->renderNext(), $cached);
			
			$_SESSION['enqueteCode'] = uniqid();
			$cached = str_replace("[EnqueteCode]", $_SESSION['enqueteCode'], $cached);
			

			//error_log("Cached: $s #$id");

			die( $cached );

		}
	}

}

error_log("CacheMISS: $s $id $cache_diff");


# PHP Regular Expressions Library <http://sourceforge.net/projects/kpregs/>
require_once("../sys/kpregs.php");

# PHPMailer <http://phpmailer.sf.net>
require_once("../sys/phpmailer/class.phpmailer.php");

# Generic Functions
require_once("../sys/funcoes.php");

require_once("../sys/input.class.php");



if ( $entry == "admin" )
{
  require_once("../sys/htmlTable.php");
  require_once("../sys/funcoes-admin.php");
  require_once("../sys/form.class.php");
  require_once("../sys/form.genericfield.class.php");
  require_once("../sys/form.fieldset.class.php");
  require_once("../sys/form.textfield.class.php");
  require_once("../sys/form.textarea.class.php");
  require_once("../sys/form.datefield.class.php");
  require_once("../sys/form.checkbox.class.php");
  require_once("../sys/form.snfield.class.php");
  require_once("../sys/form.fileinput.class.php");
  require_once("../sys/form.selectfield.class.php");
  require_once("../sys/form.timefield.class.php");
  require_once("../sys/form.passwordfield.class.php");
  require_once("../sys/form.searchid.class.php");

	$Acoes = [];

}



# database
require_once("../sys/sqlobj.php"); # Magos Multimidia
require_once("../sys/sqltable.php"); # Magos Multimidia

$sql = new SqlObj($config['mysql_uri']);

// Checar se o banco de dados foi conectado com sucesso
if ($sql->error != false)
{
	if( $debug )
	{

		die( $sql->error ) ;
	}

	include "erro_tecnico.html";
	die();
}

require_once("app/bnZona.class.php");

$config_itens = $sql->get_arrays("select * from st_config");
foreach($config_itens as $ci) $config[$ci['nome']] = $ci['valor'];

# Sistema de Templates
require_once("../sys/smarty/Smarty.class.php"); # smarty.php.net
$View = new Smarty;
if ( $entry == "admin" )
{
  $View->template_dir = '../admin/views';
  $View->compile_dir = '../admin/views_c';
} else {
  $View->template_dir = '../app/views';
  $View->compile_dir = '../app/views_c';
}

$View->cache_dir = '../cache/smarty';
$View->config_dir = '../sys/smarty/configs';

# Mail System
require_once("../sys/emailer.php"); #Magos Multimidia

# User session
require_once("../sys/User.php");
require_once("../sys/AdminUser.php");

$Admin = new AdminUser($sessid);
$Usuario = new User($sessid);

$AID = $Admin->id;
$UID = $Usuario->id;

$View->assign('AID', $AID);
$View->assign('UID', $UID);


// se chegou até aqui vamos atualizar as exibições
require_once("../app/noticia.class.php");
$noticia = new Noticia(6);
$noticia->update_exibicoes();
