<?php

class Faculty { 
    private  $facultyId; 
    private  $facultyName; 

    public function __construct( $facultyId,$facultyName) {
        $this->facultyId = $facultyId;
        $this->facultyName = $facultyName;
    }

                     
	public function setfacultyId($facultyId)
	{
		$this->facultyId = $facultyId;
	} 
 
	public function getfacultyId()
	{
		return $this->facultyId;
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