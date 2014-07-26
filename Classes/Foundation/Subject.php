<?php
/**
 *
 * Foundation Subject File
 *
 * it contain the foundation subject class that Stores and loads a subject with a connection to a mysql's database.
 *
 */

namespace Foundation;



require_once './Classes/Foundation/Database.php';
require_once './Classes/Entity/Subject.php';

/**
 * Foundation class Subject
 *
 * this class represent the Foundation Subject, it can stores and loads a Subject, also it performs
 * all the needed query
 *
 */
class Subject extends Database
{
	/**
	 * Constructor.
	 * 
	 *  Calls the parent constructor to initialize the connection to the database.
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * function store
	 * 
	 * Stores a subject on the database.
	 * 
	 * @param $subject \Entity\Subject
	 * @return bool
	 */
	public function store($subject)
	{
		$name = '"'.$subject->getName().'"';
		$code = '"'.$subject->getCode().'"';
		
		$queryString = "INSERT INTO `subject`(`code`, `name`) VALUES (NULL,$name)";
		
		return $this->query($queryString);
	}
	
	/**
	 * function getByCode
	 * 
	 * Gets a subject by his code. 
	 *
	 * @param int $code
	 * 
	 * @return mixed \Entity\Subject on success, false if no Subject was found.
	 */
	public function getByCode($code)
	{
		$queryString = "SELECT `code`, `name` FROM `subject` WHERE code=\"$code\"";
		$array = $this->associativeArrayQuery($queryString);
		
		if(count($array)!=0)
			$subject = new \Entity\Subject($array[0]['name'],$array[0]['code']);
		else
			$subject = false;
		
		return $subject;
	}
	
	/**
	 * function getByDegreeCourse
	 * 
	 * Gets an array of subjects by degree course name.
	 * 
	 * @param string $degreeCourse
	 * @return array  $subject
	 */
	public function getByDegreeCourse($degreeCourse)
	{
		$select = "SELECT `code`, `name`, `degreeCourse`";
		$from =  "FROM `subject`";
		$innerJoin = "inner join `degreeCourses_Subjects` on `subject`.`code`=`degreeCourses_Subjects`.subjectCode ";
		$where = "WHERE `degreeCourse` = "."\"$degreeCourse\"";
		$order = "ORDER BY `name`";
		
		$queryString = $select." ".$from." ".$innerJoin." ".$where." ".$order ;
		
		$result = $this->associativeArrayQuery($queryString);
		
		if (count($result)!=0) // we need this because the foreach statement doesn't accept empty array as parameter.
		{
			foreach ($result as $res)
			{
				$subjects[] = new \Entity\Subject($res["name"], $res["code"]);
			}		
		}
		else 
			$subjects = array(); // an empty array
				
		return $subjects;
	}
	
	/**
	 * function getByName_DegreeCourse
	 * 
	 * Find in the database the unique subject with the given name and degree course.
	 * 
	 * @param string $subjectName Name of the subject.
	 * @param string $degreeCourse Name of the degree course.
	 * 
	 * @return mixed \Entity\Subject on success, false if no Subject was found.
	 */
	public function getByName_DegreeCourse($subjectName, $degreeCourse)
	{
		$subjectName = '"'.$subjectName.'"';
		$degreeCourse = '"'.$degreeCourse.'"';

		$select = "SELECT `code`,`name`,`degreeCourse`";
		$from = "FROM `subject` INNER JOIN `degreeCourses_Subjects` ON `code`=`subjectCode`";
		$where = "WHERE `name`=$subjectName AND `degreeCourse`=$degreeCourse";
		
		$query = $select." ".$from." ".$where;
				
		$res = $this->associativeArrayQuery($query);
				
		if (count($res)!=0)
			$subj = new \Entity\Subject($res[0]['name'], $res[0]['code']);
		else
			$subj = false;
		
		return $subj;
	}		
}

?>
