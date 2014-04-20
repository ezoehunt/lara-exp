<?php namespace Acme\Utilities;

class PersonUtilities {

	public static function makeDisplayName($person)
	{
		if ($person->name == 'null') {
			$displayName = $person->firstname;
			if ($person->middlename != 'null') {
			    $displayName .= ' '.$person->middlename;
			}
			$displayName .= ' '.$person->lastname;
			if ($person->namemod != 'null') {
			    $displayName .= ' '.$person->namemod;
			}
		}
		else {
			$displayName = $person->name;
		}
		return $displayName;
	}


}