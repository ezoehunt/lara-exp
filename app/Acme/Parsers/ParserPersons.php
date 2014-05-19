<?php namespace Acme\Parsers;

use Person;
use Acme\Library\Common as Common;

class ParserPersons {

/*================================================*/
/*                  PARSE PERSONS                 */
/* return data array                              */
/*================================================*/
    public function parsePeople($file) 
    {
        $array = json_decode($file,true);
        //$importArray = array();

        for ($i=0; $i<count($array); $i++) {
            $countImported = count($array);

            // Remove data we're not using for this insert
            unset($array[$i]['terms']);
            unset($array[$i]['leadership_roles']);
            unset($array[$i]['family']);
            unset($array[$i]['other_names']);
            unset($array[$i]['id']['thomas']);
            unset($array[$i]['id']['house_history']);
            unset($array[$i]['id']['ballotpedia']);

            // Some Historical Persons had 2 Bioguides to 
            // account for name changes - we don't need them. 
            if (isset($array[$i]['id']['bioguide_previous'])) {
                unset($array[$i]['id']['bioguide_previous']);
            }

            // Create official_full for Historical who dont have it
            if (!isset($array[$i]['name']['official_full'])) {
                $official_full = $array[$i]['name']['first'];
                if (isset($array[$i]['name']['middle'])) {
                    $official_full .= ' '.$array[$i]['name']['middle'];
                }
                $official_full .= ' '.$array[$i]['name']['last'];
                if (isset($array[$i]['name']['suffix'])) {
                    $official_full .= ' ,'.$array[$i]['name']['suffix'];
                }
                $array[$i]['name']['official_full'] = $official_full;
            }

            // Add import count
            $importArray['countimported'] = $countImported;

            // Create consistent array structure for PDO
            $importArray[$i] = Person::$arrayStructurePersons;

            foreach ($array[$i] as $mainKey => $mainValue) {
                // Map column names + tweak some data
                foreach ($mainValue as $k => $v) {
                    $newKey = Common::mapColumnNames($k,Person::$mapPersons);
                    $newValue = $v;

                    if (gettype($v) == 'string') {
                        $newValue = htmlentities($v, ENT_QUOTES);
                    }
                    elseif (gettype($v) == 'integer') {
                        $newValue = $v;
                    }
                    if ($k == 'fec') {
                        $newValue = json_encode($v);
                    }
                    if ($k == 'birthday') {
                        $newValue = date('Y-m-d', strtotime($v));
                    }
                    $importArray[$i][$newKey] = $newValue;
                    // Add slug
                    $importArray[$i]['slug'] = Common::sluggify($importArray[$i]['firstname'].' '.$importArray[$i]['lastname'].' '.$importArray[$i]['bioguideid']);
                }            
            }
        }
        //echo '<pre>';
        //print_r($importArray);
        //echo '</pre>';
        return $importArray;
    }

}

// EOF
