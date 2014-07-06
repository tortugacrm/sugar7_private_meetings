<?php
/*
 *  This file is part of 'Private Meetings'.
 *
 *  'Private Meetings' is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation.
 *
 *  'Private Meetings' is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with 'Private Meetings'.  If not, see http://www.gnu.org/licenses/gpl.html.
 *
 * Copyright November 2013 Olivier Nepomiachty - All rights reserved.
 */

global $sugar_flavor;		

$manifest =array(
        'acceptable_sugar_flavors' => array('PRO','CORP','ENT','ULT'),
        'acceptable_sugar_versions' => array(
            'exact_matches' => array(),
            'regex_matches' => array('7\\.[0-9]\\.[0-9]$'),
        ),
	  'readme'=>'readme.txt',
	  'key'=>'',
	  'author' => 'Olivier Nepomiachty',
	  'description' => 'New meetings will be in the user\'s private team',
	  'icon' => '',
	  'is_uninstallable' => false,
	  'name' => 'Meetings Private Team',
	  'published_date' => '2013-11-22 0800',
	  'type' => 'module',
	  'version' => '1.0.0.0'
);
		  
		  
$installdefs =array(
    'id' => 'PrivateMeetings2013',
    'copy' => array(
        0 => array(
		  'from' => '<basepath>/Files/custom/modules/Meetings/meetings.php',
		  'to' => 'custom/modules/Meetings/meetings.php',
        ),
    ),
    'logic_hooks' => array(
        array(
			 'module'  => 'Meetings',
			 'hook'    => 'after_save',
			 'order'   => 98,
			 'description' => 'Meetings private team',
			 'file'   => 'custom/modules/Meetings/meetings.php',
			 'class'   => 'MeetingsHook',
			 'function'  => 'ReplaceGlobalTeam',
        ),
    ),
);		  
		  

