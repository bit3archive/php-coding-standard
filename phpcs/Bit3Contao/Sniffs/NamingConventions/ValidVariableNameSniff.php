<?php
/**
 * Checks the naming of member variables.
 * All identifiers must use camelCase and start with a lower case letter.
 * Underscore characters are not allowed.
 *
 * Based on the ValidVariableNameSniff from TYPO3 ruleset.
 *
 * @category  NamingConventions
 * @package   BIT3_PHPCS
 * @author    Stefano Kowalke <blueduck@gmx.net>
 * @author    Andy Grunwald <andygrunwald@gmail.com>
 * @author    Tristan Lins <tristan.lins@bit3.de>
 * @copyright 2010 Stefano Kowalke, Andy Grunwald
 * @copyright 2013 bit3 UG
 * @license   http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @link      http://pear.typo3.org
 * @link      https://github.com/bit3/php-coding-standard
 */
class Bit3Contao_Sniffs_NamingConventions_ValidVariableNameSniff extends Bit3_Sniffs_NamingConventions_ValidVariableNameSniff
{
	/**
	 * Contains built-in variables which we don't check
	 *
	 * @var array
	 */
	protected $allowedInbuiltVariableNames = array(
		'GLOBALS',
		'_REQUEST',
		'_SERVER',
		'_REQUEST',
		'_COOKIE',
		'_FILES',
	);

	/**
	 * Contains built-in properties which we don't check
	 *
	 * @var array
	 */
	protected $allowedInbuiltPropertiesNames = array(
		'strTable',
		'strTemplate',
		'blnSubmitInput',
	);
}
