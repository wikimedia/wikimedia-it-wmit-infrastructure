<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|    'connectionString' Hostname, database, port and database type for 
|     the connection. Driver example: mysql. Currently supported:
|                 mysql, pgsql, mssql, sqlite, oci
|    'username' The username used to connect to the database
|    'password' The password used to connect to the database
|    'tablePrefix' You can add an optional prefix, which will be added
|                 to the table name when using the Active Record class
|
*/

/**
 * WARNING :)
 *
 * THIS IS A **PUBLIC** CONFIGURATION FILE
 *
 * This file is about Wikimedia Italia LimeSurvey
 *
 * More information:
 *
 *  https://phabricator.wikimedia.org/T274837
 *
 * The passwords are in fabula.wikimedia.it in this file:
 */
require '/var/www/limesurvey/config-secret.php';

/**
 * Redirect Wikimania 2021 traffic from old survey to the new one
 *  https://meta.wikimedia.org/wiki/Talk:Wikimania_2021/Call_for_volunteers#confusing_question
 *  https://meta.wikimedia.org/wiki/Special:PermaLink/21137123#confusing_question
 *  https://phabricator.wikimedia.org/T274837
 * TODO: Disable after April 2021
 */
if( $_SERVER['REQUEST_URI'] === '/index.php?r=survey/index&sid=272925&lang=en' ) {
	http_response_code( 302 );
	header( "Location: https://survey.wikimedia.it/index.php?r=survey/index&sid=856642&lang=en" );
	exit;
}

return array(

	'components' => array(
		'db' => array(
			'connectionString' => 'mysql:host=localhost;port=3306;dbname=limesurvey;',
			'emulatePrepare' => true,
			'username' => 'limesurvey',
			'charset' => 'utf8mb4',
			'tablePrefix' => 'lime_',

			// MySQL password
			// see config-secret.php
			'password' => $WMI_LIMESURVEY_PRODUCTION_PASSWORD,
		),
		
		 'session' => array (
			'sessionName'=>'LS-PISXODTDESYBCTOAO'
			// Uncomment the following lines if you need table-based sessions.
			// Note: Table-based sessions are currently not supported on MSSQL server.
			// 'class' => 'application.core.web.DbHttpSession',
			// 'connectionID' => 'db',
			// 'sessionTableName' => '{{sessions}}',
		 ),
		
		'urlManager' => array(
//
// TODO: fix PATH_INFO in PHP_FPM
//   /etc/httpd/sites-enabled/it-wikimedia-survey-ssl.conf
//
//			'urlFormat' => 'path',
			'urlFormat' => 'get',
			'rules' => array(
				// You can add your own rules here
			),
			'showScriptName' => true,
		),
	
	),
	// For security issue : it's better to set runtimePath out of web access
	// Directory must be readable and writable by the webuser
	//
	// TODO:
	// Note that in WMI LimeSurvey that directory is not accessible in any way via
	// an Apache deny rule but let's remember to move this outside for additional hardening.
	//  -- [[User:Valerio Bozzolan]], lun 22 feb 2021, 01:42:13, CET
//	'runtimePath' => '/var/www/limesurvey/runtime',
	// Use the following config variable to set modified optional settings copied from config-defaults.php
	'config'=>array(

	// debug: Set this to 1 if you are looking for errors. If you still get no errors after enabling this
	// then please check your error-logs - either in your hosting provider admin panel or in some /logs directory
	// on your webspace.
	// LimeSurvey developers: Set this to 2 to additionally display STRICT PHP error messages and get full access to standard templates
		'debug'=>0,
		'debugsql'=>0, // Set this to 1 to enanble sql logging, only active when debug = 2
		// Update default LimeSurvey config here
	)
);
/* End of file config.php */
/* Location: ./application/config/config.php */