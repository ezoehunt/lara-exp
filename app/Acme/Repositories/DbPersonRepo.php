<?php namespace Acme\Repositories;

// DB Eloquent-specific implementation

use Person;
use Acme\Library\Common as Common;
use Acme\Library\DatabasePDO;
use Acme\Repositories\DbBaseRepo;

class DbPersonRepo extends DbBaseRepo implements PersonRepoInterface {

    /**
     * @var Person
    */
    protected $model;

    function __construct(Person $model)
    {
        $this->model = $model;
    }
	

	/* Model-specific Functions */
    public function getBySlug($slug)
	{
		return $this->model->where('slug', '=', $slug)->firstOrFail();
	}

    public function getByBioguide($bioguideid)
    {
        return $this->model->where('bioguideid', '=', $bioguideid);
    }

/*================================================*/
/*           PREP INSERT PERSONS DATA             */
/*  Persons / Terms / Roles / Relations / Social  */
/*  return data array  (data to insert)           */
/*================================================*/
    public function prepInsertData($array, $tableName)
    {
        $toInsert = array();

        foreach ($array as $data) {
            // Confirm Persons dont already exist
            if ($tableName == 'persons') {
                $bioguideid = $data['bioguideid'];
                $personID = $this->getByBioguide($bioguideid)->pluck('id');

                if (is_null($personID)) {
                    $toInsert[] = $data;
                }
            }
            // Bc fields are not unique and they can change 
            // at any time, there's not a reliable way to 
            // test Old vs New values. So not checking for
            // Terms, Exec Terms, Roles, or Relations
            /*elseif ($tableName == 'person_terms') {
                // Assign current
                if (isset($data['enddate']) AND $data['enddate'] >= date('Y-m-d')) {
                    $data['current'] = '1';
                }
                $toInsert[] = $data;
            }
            elseif ($tableName == 'person_roles' OR $tableName = 'person_relations') {
                $toInsert[] = $data;
            }*/
        }
        //echo '<pre>';
        //print_r($toInsert);
        //echo '</pre>';
        return $toInsert;
    }
    
/*================================================*/
/*             COUNT INSERT DATA                  */
/* return integer (count of inserted)             */
/*================================================*/
    public function countInsertData($array, $tableName, $type)
    {
        for ($i=0; $i<count($array); $i++) {
            // Persons
            if (isset($array[$i]['bioguideid']) AND $type == 'people') {
                $countit[] = count($array[$i]['lastname']);
            }
            // Executives
            if (isset($array[$i]['bioguideid']) AND $type == 'executive') {
                $countit[] = count($array[$i]['bioguideid']);
            }
            // Terms
            if (isset($array[$i]['role_type'])) {
                $countit[] = count($array[$i]['role_type']);
            }
            // Roles
            if (isset($array[$i]['title'])) {
                $countit[] = count($array[$i]['title']);
            }
            // Relations
            if (isset($array[$i]['relation'])) {
                $countit[] = count($array[$i]['relation']);
            }
        }
        if (isset($countit)) {
            $countData = array_sum($countit);
        }
        else {
            $countData = '0';
        }
        //echo '<pre>';
        //var_dump($countData);
        //echo '</pre>';
        return $countData;
    }

/*================================================*/
/*             INSERT PERSONS (PDO)               */
/* MUCH MUCH faster than Query Builder or ORM     */
/* return integer (count of items inserted)       */
/*================================================*/
    public function storePeoplePDO($rows)
    {
        // Manual PDO doesnt automatically update dates
        // in DB so do manually at end of transaction
        $returnIDs = array();

        $database = new DatabasePDO();
        $database->beginTransaction();

        // Use arrayStructure as column variables
        $columnArray = Person::$arrayStructurePersons;

        // Prepare data + query
        foreach ($columnArray as $column => $data) {
            $colNames[] = $column;
            $colValues[] = ':'.$column;
        }
        $query = 'INSERT INTO persons ('.implode(', ', $colNames).') VALUES ('.implode(', ', $colValues).')';

        $database->query($query);

        // Execute query
        foreach ($rows as $row) {
            $keys = array_keys($row);
            $values = array_values($row);
            
            // Bind each row
            foreach ($row as $key => $value) {
                $database->bind($key, $value);
            }
            $database->execute();
            $returnIDs[] = $database->lastInsertId();
        }

        // Touch created_at + updated_at for each affected Person
        if (isset($returnIDs)) {
            foreach ($returnIDs as $id) {
                $newquery = "UPDATE persons SET created_at = date('Y-m-d:H:i:s'), updated_at = date('Y-m-d:H:i:s') WHERE id = $id";
                $database->query($newquery);
                $database->execute();
            }
        }
        $database->endTransaction();
        
        if (!is_null($returnIDs)) {
            $countIDs = count($returnIDs);
            return $countIDs;  
        }
        else {
            return false;
        }
    }


    
	
}

//EOF