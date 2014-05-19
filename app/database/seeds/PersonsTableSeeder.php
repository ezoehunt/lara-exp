<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PersonsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			$firstname = $faker->firstName();
			$middlename = $faker->firstName();
			$middlename = $faker->randomElement($array = array ($middlename,'null'));
			
			$lastname = $faker->lastName();
			$namemod = $faker->suffix();
			$namemod = $faker->randomElement($array = array ($namemod,'null'));
			
			$name = $firstname;
			if ($middlename != 'null') {
			    $name .= ' '.$middlename;
			}
			$name .= ' '.$lastname;
			if ($namemod != 'null') {
			    $name .= ' '.$namemod;
			}	
					
			$tmpfec = array('0' => 'H123456', '1' => 'H098765');
			$fec = json_encode($tmpfec);
			$execflag = $faker->randomElement($array = array ('null','executive'));
			if ($execflag != 'null') {
				$icpsrprezid = $faker->randomNumber(10000, 99999);
			}
			else {
				$icpsrprezid = 'null';
			}
			
			Person::create([
			'bioguideid' 	=> $faker->unique()->randomNumber(10000, 99999),
			'firstname' 	=> $firstname,
			'middlename' 	=> $middlename,
			'lastname' 		=> $lastname,
			'namemod' 		=> $namemod,
			'name' 			=> $name,
			'slug'			=> $firstname.'-'.$lastname,
			'nickname' 		=> $faker->randomElement($array = array ($firstname,'null')),
			'sortname' 		=> 'null',
			'birthday' 		=> $faker->dateTimeBetween($startDate = '-60 years', $endDate = '-30 years'),
			'gender' 		=> $faker->randomElement($array = array ('M','F')),
			'religion' 		=> $faker->randomElement($array = array ('Jewish','Catholic','Presbyterian')),
			'twitterid' 	=> $faker->randomNumber(10000, 99999),
			'facebookid' 	=> $faker->randomNumber(10000, 99999),
			'youtubeid' 	=> $faker->randomNumber(10000, 99999),
			'wikipediaid' 	=> $faker->randomNumber(10000, 99999),
			'govtrackid' 	=> $faker->randomNumber(10000, 99999),
			'pvsid' 		=> $faker->randomNumber(10000, 99999),
			'osid' 			=> $faker->randomNumber(10000, 99999),
			'cspanid' 		=> $faker->randomNumber(10000, 99999),
			'maplightid' 	=> $faker->randomNumber(10000, 99999),
			'lisid' 		=> $faker->randomNumber(10000, 99999),
			'fec' 			=> $fec,
			'wapoid' 		=> $faker->randomNumber(10000, 99999),
			'icpsrid' 		=> $faker->randomNumber(10000, 99999),
			'icpsrprezid' 	=> $icpsrprezid,
			'execflag' 		=> $execflag,								
			'created_at'	=> 	date('Y-m-d H:i:s'),
	        'updated_at'	=> 	date('Y-m-d H:i:s')	
			]);
		}
	}

}