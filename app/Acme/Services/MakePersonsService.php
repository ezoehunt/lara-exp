<?php namespace Acme\Services;

use Request;
use Acme\Library\Common as Common;
use Acme\Parsers\ParserPersons as Parser;
use Acme\Repositories\DbPersonRepo;
use Acme\Repositories\PersonRepoInterface;

class MakePersonsService extends DbPersonRepo implements PersonRepoInterface {

    /**
     * @var PersonRepoInterface
     * @var Acme\Parsers\ParserPersons
    */
    protected $repo;
    protected $parser;

    function __construct(PersonRepoInterface $repo, Parser $parser)
    {
        $this->repo = $repo;
        $this->parser = $parser;
    }

    public function addPersons()
    {
        // Set up
        $countImported = '0';
        $countData = '0';
        $messageType = '';
        $messageShort = '';
        $message = '';

        // Set longer limit for Historical Terms
        ini_set('memory_limit', '700M');
        ini_set('max_execution_time', 700);

        // Get file + params
        $url = ['params' => Request::query()];
        $file = Common::getFileFromParams($url);
        $tableName = urldecode($url['params']['tablename']);
        $type = urldecode($url['params']['type']);
        $time = urldecode($url['params']['time']);

        if (is_null($file)) {
            $messageType = 'error';
            $messageShort = 'error-file';
            $message = 'Oops...looks like the file doesn\'t exist. Please try again.';
        }
        else {
            $parseFile = $this->parser->parsePeople($file);
            $countImported = array_shift($parseFile);

            if (!isset($parseFile)) {
                $messageType = 'error';
                $messageShort = 'error-parse';
                $message = 'Data wasn\'t parsed correctly. Please try again.';
            }
            elseif (isset($parseFile)) {
                $dataToInsert = $this->repo->prepInsertData($parseFile, $tableName);

                if (isset($dataToInsert)) {
                    $countData = $this->repo->countInsertData($dataToInsert, $tableName, $type);
                    
                    // If countData > 0, data should be inserted, so no else
                    if ($countData > 0) {
                        $storePersons = $this->repo->storePeoplePDO($dataToInsert);

                        if ($storePersons > 0) {
                            $countData = $countData;
                            $messageType = 'success';
                            $messageShort = 'success';
                            $message = '<b>'.$storePersons.' People</b> inserted -- of <b>'.$countData.'</b> prepared and <b>'.$countImported.' </b>imported';
                        }
                        // If PDO returns with no results stored
                        else {
                            $countData = $countData;
                            $messageType = 'error';
                            $messageShort = 'error';
                            $message = '<b>'.$storePersons.' People</b> were inserted -- of <b>'.$countData.'</b> prepared and <b>'.$countImported.' </b>imported';
                        }
                    }
                }
                else {
                    $messageType = 'error';
                    $messageShort = 'error-prep';
                    $message = 'Data wasn\'t prepared properly. Please try again.';
                }
            }
        }
        return array('countImported' => $countImported, 'countData' => $countData, 'messageType' => $messageType, 'messageShort' => $messageShort, 'message' => $message);
    }


//end of class
}

//EOF