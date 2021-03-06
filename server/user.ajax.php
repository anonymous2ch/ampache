<?php

/* vim:set softtabstop=4 shiftwidth=4 expandtab: */
/**
 *
 * LICENSE: GNU General Public License, version 2 (GPLv2)
 * Copyright 2001 - 2015 Ampache.org
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License v2
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 */

/**
 * Sub-Ajax page, requires AJAX_INCLUDE
 */
if (!defined('AJAX_INCLUDE')) {
    exit;
}

$user_id = intval($_REQUEST['user_id']);

switch ($_REQUEST['action']) {
    case 'flip_follow':
        if (Access::check('interface', 25) && AmpConfig::get('sociable')) {
            $fuser = new User($user_id);
            if ($fuser->id > 0 && $user_id !== $GLOBALS['user']->id) {
                $GLOBALS['user']->toggle_follow($user_id);
                $results['button_follow_' . $user_id] = $fuser->get_display_follow();
            }
        }
    break;
    default:
        $results['rfc3514'] = '0x1';
    break;
} // switch on action;

// We always do this
echo xoutput_from_array($results);
