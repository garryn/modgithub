<?php
/**
 * modGitHub
 *
 * Copyright 2010 by Garry Nutting <garry@modx360.com>
 *
 * This file is part of modGitHub, a GitHub Integration Helper for MODx
 * Revolution.
 *
 * modGitHub is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * modGitHub is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * modGitHub; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package modgithub
 */
/**
 * @package modgithub
 * @subpackage build
 */
$snippets = array();

/* general snippets */
$snippets[1]= $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
    'id' => 1,
    'name' => 'gitRepositories',
    'description' => 'List GitHub Repositories.',
    'snippet' => getSnippetContent($sources['snippets'].'gitrepositories.snippet.php'),
),'',true,true);
$properties = include $sources['properties'].'gitrepositories.properties.php';
$snippets[1]->setProperties($properties);
unset($properties);

return $snippets;