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
class MeetingsHook
{
	
	public static function ReplaceGlobalTeam(Meeting $bean, $event, $args)
	{
		$GLOBALS['log']->warn("######## Entering ReplaceGlobalTeam");
		// only new records
		if ($bean->date_entered != $bean->date_modified) {
			$GLOBALS['log']->warn(">>>>> Existing record. Exit");
			return;
			exit;
		}
		global $current_user;
		$objTeamSet = new TeamSet();
		$teams_bean = $objTeamSet->getTeams($bean->team_set_id);
		$objTeams = new Team();
		$teams_user = $objTeams->get_teams_for_user($current_user->id);		
		$private_team_id = '';
		foreach ($teams_user as $t) {
			if ( ($t->private) && ($t->associated_user_id==$current_user->id) ) {
				$private_team_id = $t->id;
				$GLOBALS['log']->warn(">>>>> Private team id: ".$private_team_id);
				break;
			}
		}
		if ($private_team_id != '') {
			$bean->load_relationship('teams');
			$bean->team_id = $private_team_id;
			$bean->teams->replace(array($private_team_id));
			$bean->save();
		}
		$GLOBALS['log']->warn("######## Exiting RemoveGlobalTeam");
	}
		
}

?>
