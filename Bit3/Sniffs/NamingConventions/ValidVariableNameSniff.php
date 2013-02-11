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
class Bit3_Sniffs_NamingConventions_ValidVariableNameSniff extends PHP_CodeSniffer_Standards_AbstractVariableSniff
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
	 * Processes class member variables.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
	 * @param int                  $stackPtr  The position of the current token in the stack passed in $tokens.
	 *
	 * @return void
	 */
	protected function processMemberVar(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$memberProps = $phpcsFile->getMemberProperties($stackPtr);
		if (empty($memberProps) === true) {
			return;
		}
		$this->processVariableNameCheck($phpcsFile, $stackPtr, 'member ');
	}

	/**
	 * Processes normal variables.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile The file where this token was found.
	 * @param int                  $stackPtr  The position where the token was found.
	 *
	 * @return void
	 */
	protected function processVariable(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$this->processVariableNameCheck($phpcsFile, $stackPtr);
	}

	/**
	 * Processes variables in double quoted strings.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile The file where this token was found.
	 * @param int                  $stackPtr  The position where the token was found.
	 *
	 * @return void
	 */
	protected function processVariableInString(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		// We don't care about variables in strings.
		return;
	}

	/**
	 * Proceed the whole variable name check.
	 * Checks if the variable name has underscores or is written in lowerCamelCase.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile The file where this token was found.
	 * @param int                  $stackPtr  The position where the token was found.
	 * @param string               $scope     The variable scope. For example "member" if variable is a class property.
	 *
	 * @return void
	 */
	protected function processVariableNameCheck(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $scope = '')
	{
		$tokens       = $phpcsFile->getTokens();
		$variableName = ltrim($tokens[$stackPtr]['content'], '$');
		// There are some historic builtin TYPO3 vars we don't care here.
		// if we found such vars, we leave the sniff here.
		if (in_array($variableName, $this->allowedInbuiltVariableNames)) {
			return;
		}

		$hasUnderscores   = stripos($variableName, '_');
		$isLowerCamelCase = PHP_CodeSniffer::isCamelCaps($variableName, false, true, true);
		if ($hasUnderscores !== false) {
			$messageData = array($scope, $variableName);
			$error       = 'Underscores are not allowed in the %svariablename "$%s".';

			switch ($variableName) {
				case '_POST':
				case '_GET':
					$messageData = array($variableName, $variableName);
					$error       = 'Direct access to "$%s" is not allowed; Please use t3lib_div::%s or t3lib_div::_GP instead';
					break;
				default:
					$messageData[] = $this->buildExampleVariableName($variableName);
					$error .= 'Use lowerCamelCase for identifier instead e.g. "$%s"';
			}

			$phpcsFile->addError($error, $stackPtr, 'VariableNameHasUnderscoresNotLowerCamelCased', $messageData);

		}
		else if ($isLowerCamelCase === false) {
			$pattern                     = '/([A-Z]{1,}(?=[A-Z]?|[0-9]))/e';
			$replace                     = "ucfirst(strtolower('\\1'))";
			$variableNameLowerCamelCased = preg_replace($pattern, $replace, $variableName);

			$messageData = array(ucfirst($scope), lcfirst($variableNameLowerCamelCased), $variableName);
			$error       = '%svariablename must be lowerCamelCase; expect "$%s" but found "$%s"';
			$phpcsFile->addError($error, $stackPtr, 'VariableIsNotLowerCamelCased', $messageData);
		}
		if (preg_match('#^(var|int|str|flt|bln|obj|res)([A-Z].*)$#', $variableName, $match)) {
			$messageData = array(ucfirst($scope), lcfirst($match[2]), $variableName);
			$error = '%svariablename must not contain a type prefix; expect "$%s" but found "$%s"';
			$phpcsFile->addError($error, $stackPtr, 'VariableHasTypePrefix', $messageData);
		}
	}

	/**
	 * Returns a modified variable name.
	 * e.g. $my_small_variable => $mySmallVariable
	 *
	 * @param string $variableName Variable name
	 *
	 * @return string
	 */
	protected function buildExampleVariableName($variableName)
	{
		$nameParts = $this->trimExplode('_', $variableName, true);
		$newName   = $this->strToLowerStringIfNecessary(array_shift($nameParts));
		foreach ($nameParts as $part) {
			$newName .= ucfirst(strtolower($part));
		}

		return $newName;
	}

	/**
	 * If the incomming $namePart is not camel cased, the string will be lowercased.
	 *
	 * @param string $namePart Part of a variable name (normal string)
	 *
	 * @return string
	 */
	protected function strToLowerStringIfNecessary($namePart)
	{
		if (PHP_CodeSniffer::isCamelCaps($namePart, false, true, true) === false) {
			$namePart = strtolower($namePart);
		}

		return $namePart;
	}

	/**
	 * explode()-function with trim() for every element.
	 *
	 * @param string $delim             The boundary string.
	 * @param string $string            The input string
	 * @param bool   $removeEmptyValues true if empty values should be removed, false otherwise
	 * @param int    $limit             Limit of elements which will be returned
	 *
	 * @return array
	 */
	protected function trimExplode($delim, $string, $removeEmptyValues = false, $limit = 0)
	{
		$explodedValues = explode($delim, $string);

		$result = array_map('trim', $explodedValues);

		if ($removeEmptyValues) {
			$temp = array();
			foreach ($result as $value) {
				if ($value !== '') {
					$temp[] = $value;
				}
			}
			$result = $temp;
		}

		if ($limit != 0) {
			if ($limit < 0) {
				$result = array_slice($result, 0, $limit);
			}
			elseif (count($result) > $limit) {
				$lastElements = array_slice($result, $limit - 1);
				$result       = array_slice($result, 0, $limit - 1);
				$result[]     = implode($delim, $lastElements);
			}
		}

		return $result;
	}
}
