<?php

class Student { 
    private  $studentId; 
    private  $studentName; 
    private  $studentSurname; 
    private  $studentPassword; 
    private  $studentEmail; 
    private  $studentTC; 
    private  $studentTel;     
    private  $studentBirthdate; 
    private  $studentAddress; 
    private  $facultyId; 
	private  $departmentId;
	
    public function __construct( $studentName, $studentSurname, $studentPassword, $studentEmail, $studentTC, $studentTel, $studentBirthdate, $studentAddress, $facultyId, $departmentId, $previous_address, $picture, $mother_name, $father_name, $father_birthday, $grandpa, $grandpa_birthday, $status,$details) {
        $this->studentName = $studentName;
        $this->studentSurname = $studentSurname;
        $this->studentPassword = password_hash($studentPassword, PASSWORD_BCRYPT);
        $this->studentEmail = $studentEmail;
        $this->studentTC = $studentTC;
        $this->studentTel = $studentTel;
        $this->studentBirthdate = $studentBirthdate;
        $this->studentAddress = $studentAddress;
        $this->facultyId = $facultyId;
        $this->departmentId = $departmentId;
    }
            
	public function setStudentId($studentId)
	{
		$this->studentId = $studentId;
	} 
 
	public function getStudentId()
	{
		return $this->studentId;
	}

	public function setStudentName($studentName)
	{
		$this->studentName = $studentName;
	} 
 
	public function getStudentName()
	{
		return $this->studentName;
	}

	public function setStudentSurname($studentSurname)
	{
		$this->studentSurname = $studentSurname;
	} 
 
	public function getStudentSurname()
	{
		return $this->studentSurname;
	}

	public function setStudentPassword($studentPassword)
	{
		$this->studentPassword = password_hash($studentPassword, PASSWORD_BCRYPT);
	} 
 
	public function getStudentPassword()
	{
		return $this->studentPassword;
	}

	public function setStudentEmail($studentEmail)
	{
		$this->studentEmail = $studentEmail;
	} 
 
	public function getStudentEmail()
	{
		return $this->studentEmail;
	}


	public function setStudentTC($studentTC)
	{
		$this->studentTC = $studentTC;
	} 
 
	public function getStudentTC()
	{
		return $this->studentTC;
	}

	public function setStudentTel($studentTel)
	{
		$this->studentTel = $studentTel;
	} 
 
	public function getStudentTel()
	{
		return $this->studentTel;
	}

	public function setStudentBirthdate($studentBirthdate)
	{
		$this->studentBirthdate = $studentBirthdate;
	} 
 
	public function getStudentBirthdate()
	{
		return $this->studentBirthdate;
	}

	public function setStudentAddress($studentAddress)
	{
		$this->studentAddress = $studentAddress;
	} 
 
	public function getStudentAddress()
	{
		return $this->studentAddress;
	}

	public function setFacultyId($facultyId)
	{
		$this->facultyId = $facultyId;
	} 
 
	public function getFacultyId()
	{
		return $this->facultyId;
	}

	public function setDepartmentId($departmentId)
	{
		$this->departmentId = $departmentId;
	} 
 
	public function getDepartmentId()
	{
		return $this->departmentId;
	}
} 

?> 