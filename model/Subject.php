<?php


class Subject{ 
    private  $subjectId;
    private  $subjectName;

    public function __construct($subjectId, $subjectName){
        $this->subjectId = $subjectId;
        $this->subjectName = $subjectName;
    }

	public function setsubjectId($subjectId)
	{
		$this->subjectId = $subjectId;
	} 
 
	public function getsubjectId()
	{
		return $this->subjectId;
	}

	public function setsubjectName($subjectName)
	{
		$this->subjectName = $subjectName;
	} 
 
	public function getsubjectName()
	{
		return $this->subjectName;
	}
 
} 

?> 