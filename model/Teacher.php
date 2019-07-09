	<?php


class Teacher { 
    private  $teacherId; 
    private  $teacherName; 
    private  $teacherSurname; 
    private  $teacherEmail; 
    private  $teacherTel; 
    private  $teacherBirthdate;      
    private  $teacherAddress;
    private  $teacherPassword; 
    private  $teacherTC; 
    private  $teacherStatus;
    private  $facultyId;
    private  $departmentId;

    public function __construct( $teacherName, $teacherSurname, $teacherEmail, $teacherTel, $gender, $teacherBirthdate, $birthplace, $education, $work, $teacherAddress, $previous_address, $teacherPassword, $teacherTC, $teacherStatus, $facultyId, $departmentId, $departmentId_teacherBirthdate, $status,$details) {
        $this->teacherName = $teacherName;
        $this->teacherSurname = $teacherSurname;
        $this->teacherEmail = $teacherEmail;
        $this->teacherTel = $teacherTel;
        $this->teacherBirthdate = $teacherBirthdate;
        $this->teacherAddress = $teacherAddress;
        $this->teacherPassword = password_hash($teacherPassword, PASSWORD_BCRYPT);
        $this->teacherTC = $teacherTC;
        $this->teacherStatus = $teacherStatus;
        $this->facultyId = $facultyId;
        $this->departmentId = $departmentId;
    }


                     
	public function setteacherId($teacherId)
	{
		$this->teacherId = $teacherId;
	} 
 
	public function getteacherId()
	{
		return $this->teacherId;
	}

	public function setteacherName($teacherName)
	{
		$this->teacherName = $teacherName;
	} 
 
	public function getteacherName()
	{
		return $this->teacherName;
	}

	public function setteacherSurname($teacherSurname)
	{
		$this->teacherSurname = $teacherSurname;
	} 
 
	public function getteacherSurname()
	{
		return $this->teacherSurname;
	}

	public function setteacherEmail($teacherEmail)
	{
		$this->teacherEmail = $teacherEmail;
	} 
 
	public function getteacherEmail()
	{
		return $this->teacherEmail;
	}

	public function setteacherTel($teacherTel)
	{
		$this->teacherTel = $teacherTel;
	} 
 
	public function getteacherTel()
	{
		return $this->teacherTel;
	}

	public function setteacherBirthdate($teacherBirthdate)
	{
		$this->teacherBirthdate = $teacherBirthdate;
	} 
 
	public function getteacherBirthdate()
	{
		return $this->teacherBirthdate;
	}

	public function setteacherAddress($teacherAddress)
	{
		$this->teacherAddress = $teacherAddress;
	} 
 
	public function getteacherAddress()
	{
		return $this->teacherAddress;
	}

	public function setteacherPassword($teacherPassword)
	{
		$this->teacherPassword = password_hash($teacherPassword, PASSWORD_BCRYPT);
	} 
 
	public function getteacherPassword()
	{
		return $this->teacherPassword;
	}

	public function setteacherTC($teacherTC)
	{
		$this->teacherTC = $teacherTC;
	} 
 
	public function getteacherTC()
	{
		return $this->teacherTC;
	}

	public function setteacherStatus($teacherStatus)
	{
		$this->teacherStatus = $teacherStatus;
	} 
 
	public function getteacherStatus()
	{
		return $this->teacherStatus;
	}

	public function setfacultyId($facultyId)
	{
		$this->facultyId = $facultyId;
	} 
 
	public function getfacultyId()
	{
		return $this->facultyId;
	}

	public function setdepartmentId($departmentId)
	{
		$this->departmentId = $departmentId;
	} 
 
	public function getdepartmentId()
	{
		return $this->departmentId;
	}

} 

?> 