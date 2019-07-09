<?php


class Department { 
    private  $departmentId; 
    private  $departmentName; 
    private  $facultyName; 
    
    public function __construct( $departmentId,$departmentName, $facultyName) {
    	$this->departmentId = $departmentId;
        $this->departmentName = $departmentName;
        $this->facultyName = $facultyName;
    }

    public function setdepartmentId($departmentId)
	{
		$this->departmentId = $departmentId;
	} 
	public function getdepartmentId()
	{
		return $this->departmentId;
	}
	public function setdepartmentName($departmentName)
	{
		$this->departmentName = $departmentName;
	} 
 
	public function getdepartmentName()
	{
		return $this->departmentName;
	}
	public function setfacultyName($facultyName)
	{
		$this->facultyName = $facultyName;
	} 
 
	public function getfacultyName()
	{
		return $this->facultyName;
	}

} 

?> 