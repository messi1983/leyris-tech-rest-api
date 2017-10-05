<?php
namespace AppBundle\Constants;
 

/** 
 * Contient les constantes de l'applications
 * @author Messi
 */
class Constants
{ 
	/** restrict time format. */
	const RESTRICT_TIME_FORMAT = 'H:i';
	
	/** Default date format. */
	const DEFAULT_DATE_FORMAT = 'Y-m-d';
	
	/** date time format. */
	const FRENCH_DATE_FORMAT = 'd/m/Y';
	
	/** date time format. */
	const DATE_TIME_FORMAT = 'Y-m-d H:i:s';
	
	/** date time format with day. */
	const DATE_FORMAT_WITH_DAY = 'D d/m/Y';
	
	/** date time format with day. */
	const DATE_TIME_FORMAT_WITH_DAY = 'D d/m/Y H:i:s';
	
	/** Nb max entities by page. */
	const DEFAULT_NB_MAX_ENTITIES_BY_PAGE = 2;
	
	/** space char. */
	const BLANC = ' ';
	
	/** comma char. */
	const COMMA = ',';
	
	/** opening parenthesis. */
	const OPENING_PARENTHESIS = '(';
	
	/** closing parenthesis. */
	const CLOSING_PARENTHESIS = ')';
	
	/** POST method. */
	const METHOD_POST = 'POST';
	
	/** service gestion des droits. */
	const SECURITY_CONTEXT = 'security.context';
	
	/** role admin. */
	const ROLE_ADMIN = 'ROLE_ADMIN';
	
	/** request. */
	const REQUEST = 'request';
	
	/** session.*/
	const SESSION = 'session';
	
	/** action Publish. */
	const ACTION_PUBLISH = 'PUBLISH';
	
	/** action suppress. */
	const ACTION_SUPPRESS = 'SUPPRESS';
	
	/** form input publication. */
	const FORM_INPUT_PUBLICATION = 'publication';
	
	/** locale fr. */
	const LOCALE_FR = 'fr';
	
	/** locale en. */
	const LOCALE_EN = 'en';
	
	/** empty string. */
	const EMPTY_STRING = '';
	
	/** file read only mode. */
	const FILE_READ_ONLY_MODE = 'r';
	
	/** file read/write mode. */
	const FILE_READ_WRITE_MODE = 'r+';
	
	/** state finished. */
	const STATE_FINISHED = 'Termine';
	
	/** state current. */
	const STATE_CURRENT = 'En cours';
	
	/** state current. */
	const STATE_UNKNOWN = 'Sans';
	
	public static $DATETIME_TYPE_CONF = [
           'widget' => 'single_text',
           'format' => 'yyyy-MM-dd HH:mm:ss',
           'input'  => 'datetime',
//         'view_timezone' => 'Australia/Adelaide',
//         'model_timezone' => 'Etc/UTC'
        ];
}
?>
