<?php
/**
 * Verifies that control statements conform to their coding standards.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   BIT3_PHPCS
 * @author    Tristan Lins <tristan.lins@bit3.de>
 * @copyright 2013 bit3 UG
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @link      https://github.com/bit3/php-coding-standard
 */

/**
 * Verifies that control statements conform to their coding standards.
 *
 * @category  ControlStructures
 * @package   BIT3_PHPCS
 * @author    Tristan Lins <tristan.lins@bit3.de>
 * @copyright 2013 bit3 UG
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @link      https://github.com/bit3/php-coding-standard
 */
class Bit3_Sniffs_ControlStructures_ControlSignatureSniff extends PHP_CodeSniffer_Standards_AbstractPatternSniff
{
	/**
	 * Constructs a PEAR_Sniffs_ControlStructures_ControlSignatureSniff.
	 */
	public function __construct()
	{
		parent::__construct(true);

	}

	/**
	 * Returns the patterns that this test wishes to verify.
	 *
	 * @return array(string)
	 */
	protected function getPatterns()
	{
		return array(
			'do {EOL...}EOL...while (...);EOL',
			'while (...) {EOL',
			'for (...) {EOL',
			'if (...) {EOL',
			'foreach (...) {EOL',
			'}EOL...else if (...) {EOL',
			'}EOL...elseif (...) {EOL',
			'}EOL...else {EOL',
			'do {EOL',
		);

	}
}
