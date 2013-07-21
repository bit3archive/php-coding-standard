<?php
/**
 * TYPO3_Sniffs_Scope_AlwaysReturnSniff.
 *
 * PHP version 5
 * TYPO3 version 4
 *
 * @category  Scope
 * @package   BIT3_PHPCS
 * @author    Andy Grunwald <andygrunwald@gmail.de>
 * @author    Tristan Lins <tristan.lins@bit3.de>
 * @copyright 2010 Andy Grunwald
 * @copyright 2013 Tristan Lins
 * @license   http://www.gnu.org/copyleft/gpl.html GNU Public License
 */

/**
 * Checks that a function / method always have a return value if it return
 * something or inherit the doc from parent class.
 *
 * @category  Scope
 * @package   BIT3_PHPCS
 * @author    Andy Grunwald <andygrunwald@gmail.de>
 * @author    Tristan Lins <tristan.lins@bit3.de>
 * @copyright 2010 Andy Grunwald
 * @copyright 2013 Tristan Lins
 * @license   http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @version   Release: @package_version@
 */
class Bit3_Sniffs_Scope_AlwaysReturnSniff extends TYPO3SniffPool_Sniffs_Scope_AlwaysReturnSniff
{
	/**
	 * Processes this sniff, when one of its tokens is encountered.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
	 * @param int                  $stackPtr  The position of the current token in
	 *                                        the stack passed in $tokens.
	 *
	 * @return void
	 */
	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$this->currentFile = $phpcsFile;
        $tokens = $phpcsFile->getTokens();

		/** @var PHP_CodeSniffer_CommentParser_FunctionCommentParser $docComment */
		$docComment = $this->getDocCommentOfFunction($phpcsFile, $stackPtr);

		// constructors and methods with inherited doc does not need a return value
		if ($this->methodName !== '__construct' &&
			$tokens[$this->classToken]['code'] == T_FUNCTION && (
				!$docComment ||
				strpos($docComment->getComment()->getContent(), '{@inheritdoc}') === false)
		) {
			parent::process($phpcsFile, $stackPtr);
		}
	}

}
