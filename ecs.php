<?php

/**
 * ADOdb easy-coding-standard config file.
 *
 * @see https://github.com/easy-coding-standard/easy-coding-standard
 *
 * This file is part of ADOdb, a Database Abstraction Layer library for PHP.
 *
 * @package ADOdb
 * @link https://adodb.org Project's web site and documentation
 * @link https://github.com/ADOdb/ADOdb Source code and issue tracker
 *
 * The ADOdb Library is dual-licensed, released under both the BSD 3-Clause
 * and the GNU Lesser General Public Licence (LGPL) v2.1 or, at your option,
 * any later version. This means you can use it in proprietary products.
 * See the LICENSE.md file distributed with this source code for details.
 * @license BSD-3-Clause
 * @license LGPL-2.1-or-later
 *
 * @copyright 2025 Damien Regad, Mark Newnham and the ADOdb community
 */

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;

/** @noinspection PhpUnhandledExceptionInspection */
return ECSConfig::configure()
	->withRootFiles()
	->withPaths([
		__DIR__ . '/datadict',
		__DIR__ . '/drivers',
		__DIR__ . '/lang',
		__DIR__ . '/pear',
		__DIR__ . '/perf',
		__DIR__ . '/scripts',
		__DIR__ . '/session',
		__DIR__ . '/tests',
	])

	// PSR-12
	->withPreparedSets(psr12:false, arrays:true)

	// Additional, ADOdb-specific rules
	->withEditorConfig()
	->withRules([
		NoUnusedImportsFixer::class,
	])

	// add sets - group of rules, from easiest to more complex ones
	// uncomment one, apply one, commit, PR, merge and repeat
	//->withPreparedSets(
	//      spaces: true,
	//      namespaces: true,
	//      docblocks: true,
	//      arrays: true,
	//      comments: true,
	//)
;
