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
$properties = array(
    array(
        'name' => 'tpl',
        'desc' => 'List Item Chunk',
        'type' => 'textfield',
        'options' => '',
        'value' => 'git.repository.listitem',
    ),
    array(
        'name' => 'wrapper',
        'desc' => 'List Item Wrapper Chunk',
        'type' => 'textfield',
        'options' => '',
        'value' => 'git.repository.listwrapper',
    ),
    array(
        'name' => 'cache',
        'desc' => 'Use Cache',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => true,
    ),
    array(
        'name' => 'ttl',
        'desc' => 'Time To Live',
        'type' => 'textfield',
        'options' => '',
        'value' => '60',
    ),
);
return $properties;