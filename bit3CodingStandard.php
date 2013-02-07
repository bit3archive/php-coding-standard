<?php

/**
 * bit3 Coding Standard
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Tristan Lins <tristan.lins@bit3.de>
 * @copyright 2013 Tristan Lins
 * @license   MIT
 * @link      http://bit3.de
 */

/**
 * bit3 Coding Standard
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Tristan Lins <tristan.lins@bit3.de>
 */
class PHP_CodeSniffer_Standards_Bit3_Bit3CodingStandard
	extends PHP_CodeSniffer_Standards_CodingStandard
{
	public function getIncludedSniffs()
	{
		return array(
			// *** code style, whitespaces ***
			// check cast have a trailing space
			'Generic/Sniffs/Formatting/SpaceAfterCastSniff.php',
			// check control structures always have a codeblock
			'Generic/Sniffs/ControlStructures/InlineControlStructureSniff.php',
			// check for valid EOL character
			'Generic/Sniffs/Files/LineEndingsSniff.php',
			// check opening function brace is on the same line
			// 'Generic/Sniffs/Functions/OpeningFunctionBraceKernighanRitchieSniff.php',
			// check closing brace is correctly indented
			'PEAR/Sniffs/WhiteSpace/ScopeClosingBraceSniff.php',
			// check correct spacing
			'PEAR/Sniffs/Functions/FunctionCallArgumentSpacingSniff.php',
			// 'PEAR/Sniffs/Functions/FunctionCallSignatureSniff.php',
			// check correct class declaration
			'PEAR/Sniffs/Classes/ClassDeclarationSniff.php',
			// check for loop condition spacing
			'Squiz/Sniffs/ControlStructures/ForLoopDeclarationSniff.php',
			// check foreach loop condition spacing
			'Squiz/Sniffs/ControlStructures/ForEachLoopDeclarationSniff.php',
			// check usage of elseif instead of else if
			'Squiz/Sniffs/ControlStructures/ElseIfDeclarationSniff.php',
			// check multiple assignments in one line
			'Squiz/Sniffs/PHP/DisallowMultipleAssignmentsSniff.php',
			// check for spaces around square brackets
			'Squiz/Sniffs/Arrays/ArrayBracketSpacingSniff.php',
			// check for correct array declaration
			'Squiz/Sniffs/Arrays/ArrayDeclarationSniff.php',
			
			// *** code style, cases ***
			// check true,false,null are in lowercase
			'Generic/Sniffs/PHP/LowerCaseConstantSniff.php',
			// check control structure keywords are in lowercase
			'Squiz/Sniffs/ControlStructures/LowercaseDeclarationSniff.php',
			// check buildin functions are in lowercase
			'Squiz/Sniffs/PHP/LowercasePHPFunctionsSniff.php',
			// check class keywords are in lowercase
			'Squiz/Sniffs/Classes/LowercaseClassKeywordsSniff.php',
			
			// *** code style, generic ***
			// check line length
			'Generic/Sniffs/Files/LineLengthSniff.php',
			// check for usage of echo("...") instead of echo "..."
			'Squiz/Sniffs/Strings/EchoedStringsSniff.php',
			// check for usage of double quotes for strings
			'Squiz/Sniffs/Strings/DoubleQuoteUsageSniff.php',
			// check for correct usage of self::
			'Squiz/Sniffs/Classes/SelfMemberReferenceSniff.php',
			// check for closing php tag
			'Zend/Sniffs/Files/ClosingTagSniff.php',
			
			// *** deprecated/forbidden calls ***
			// check for short open tag <?
			'Generic/Sniffs/PHP/DisallowShortOpenTagSniff.php',
			// check for deprecated functions
			'Generic/Sniffs/PHP/ForbiddenFunctionsSniff.php',
			// check usage of eval()
			'Squiz/Sniffs/PHP/EvalSniff.php',
			
			// *** variables ***
			// check for unused function parameters
			'Generic/Sniffs/CodeAnalysis/UnusedFunctionParameterSniff.php',
			// check for inperformant for loop tests
			'Squiz/Sniffs/PHP/DisallowSizeFunctionsInLoopsSniff.php',
			// check for multiple usage of same incrementer in nested loops
			'Generic/Sniffs/CodeAnalysis/JumbledIncrementerSniff.php',
			// check function return values should be assigned before use
			'MySource/Sniffs/PHP/ReturnFunctionValueSniff.php',
			// check new objects are always assigned to a variable
			'Squiz/Sniffs/Objects/ObjectInstantiationSniff.php',
			// check $this is not assigned to another variable than $self
			'MySource/Sniffs/Objects/AssignThisSniff.php',
			// check "good" usage of increment/decrement operator
			'Squiz/Sniffs/Operators/IncrementDecrementUsageSniff.php',
			
			// *** logic ***
			// check the cyclomatic complexity
			'Generic/Sniffs/Metrics/CyclomaticComplexitySniff.php',
			// check for unnecessary final modifiers
			'Generic/Sniffs/CodeAnalysis/UnnecessaryFinalModifierSniff.php',
			// check for incomplete (empty) statements
			'Generic/Sniffs/CodeAnalysis/EmptyStatementSniff.php',
			// check for wrong usage of for loops
			'Generic/Sniffs/CodeAnalysis/ForLoopShouldBeWhileLoopSniff.php',
			// check parameters with default value are only at the end
			'PEAR/Sniffs/Functions/ValidDefaultValueSniff.php',
			// check for unreachable code
			'Squiz/Sniffs/PHP/NonExecutableCodeSniff.php',
			// check usage of "&&" and "||" instead of "and" and "or"
			'Squiz/Sniffs/Operators/ValidLogicalOperatorsSniff.php',
			// check for duplicate parameters in function declaration
			'Squiz/Sniffs/Functions/FunctionDuplicateArgumentSniff.php',
			// check for usage of $this in static methods
			'Squiz/Sniffs/Scope/StaticThisUsageSniff.php',
			// check for class methods scope modifier
			'Squiz/Sniffs/Scope/MethodScopeSniff.php',
			// check for class members scope modifier
			'Squiz/Sniffs/Scope/MemberVarScopeSniff.php',
			
			// *** naming ***
			// check class name and file name are equals
			'Squiz/Sniffs/Classes/ClassFileNameSniff.php',
			// check class naming
			'Squiz/Sniffs/Classes/ValidClassNameSniff.php',
			
			// *** documentation ***
			// check documentation style
			// 'PEAR/Sniffs/Commenting/FileCommentSniff.php',
			// check for obsolet perl-style comments
			'PEAR/Sniffs/Commenting/InlineCommentSniff.php',
			// check class documentation style
			// 'PEAR/Sniffs/Commenting/ClassCommentSniff.php',
			// check function documentation style
			// 'PEAR/Sniffs/Commenting/FunctionCommentSniff.php',
		);
	}
}
