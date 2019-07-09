<?php


class SubjectGrade { 
    private  $subjectId; 
	private  $studentId; 
	private  $studentName;
	private  $studentSurname;
    private  $midTerm; 
    private  $finalTerm; 
    private  $subjectStatus; 

    public function __construct($subjectId, $studentId, $studentName, $studentSurname, $midTerm, $finalTerm, $subjectStatus) {
		$this->subjectId = $subjectId;
		$this->studentId = $studentId;
		$this->studentName = $studentName;
		$this->studentSurname = $studentSurname;
        $this->midTerm = $midTerm;
        $this->finalTerm = $finalTerm;
        $this->subjectStatus = $subjectStatus;
	}
	
	public function setsubjectId($subjectId)
	{
		$this->subjectId = $subjectId;
	} 
 
	public function getsubjectId()
	{
		return $this->subjectId;
	}

	public function setstudentId($studentId)
	{
		$this->studentId = $studentId;
	} 
 
	public function getstudentId()
	{
		return $this->studentId;
	}

	public function setstudentName($studentName)
	{
		$this->studentName = $studentName;
	}
 
	public function getstudentName()
	{
		return $this->studentName;
	}

	public function setstudentSurname($studentSurname)
	{
		$this->studentSurname = $studentSurname;
	}
 
	public function getstudentSurname()
	{
		return $this->studentSurname;
	}

	public function setmidTerm($midTerm)
	{
		$this->midTerm = $midTerm;
	} 
 
	public function getmidTerm()
	{
		return $this->midTerm;
	}

	public function setfinalTerm($finalTerm)
	{
		$this->finalTerm = $finalTerm;
	} 
 
	public function getfinalTerm()
	{
		return $this->finalTerm;
	}

	public function setsubjectStatus($subjectStatus)
	{
		$this->subjectStatus = $subjectStatus;
	} 
 
	public function getsubjectStatus()
	{
		return $this->subjectStatus;
	}
 
} 

?> 