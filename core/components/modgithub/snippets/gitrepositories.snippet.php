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
 * Get Repository List
 * @package modgithub
 */
$mgh = $modx->getService('modgithub','MGH',$modx->getOption('mgh.base_path',null,$modx->getOption('core_path').'components/modgithub/').'model/modgithub/',$scriptProperties);
if (!($mgh instanceof MGH)) return '';

$tpl = $modx->getOption('tpl', $scriptProperties, 'gitRepositoryListItem');
$wrapper = $modx->getOption('wrapper', $scriptProperties, false);
$cache = $modx->getOption('cache', $scriptProperties, true);
$ttl = $modx->getOption('ttl', $scriptProperties, 60);
$ignore = explode(',', $modx->getOption('mgh.ignore', null, 'modgithub'));

$repositories = $mgh->getRepositories($cache, $ttl);
$output = '';
foreach ($repositories as $repository) {
    if (in_array($repository['name'], $ignore)) continue;
    $output .= $mgh->getChunk($tpl, $repository);
}

if ($wrapper) {
    $output = $mgh->getChunk($wrapper, array('data' => $output));
}

return $output;