<?php

require_once('../model/Admin.php');
require_once('../model/Teacher.php');
require_once('../model/Student.php');
require_once('../model/Department.php');
require_once('../model/Faculty.php');
require_once('../model/Subject.php');
require_once('../model/SubjectGrade.php');


class Dao { 
	private $servername = "localhost";
	private $username = "root";
	private $password = "drakiuS101";
	private $conn ;
	//--------------------------------------------------------------------------
	public function connect(){
		try {
		    $this->conn = new PDO("mysql:host=$this->servername;dbname=university", $this->username, $this->password);
		    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    }
		catch(PDOException $e)
		    {

		    }
	}
	//--------------------------------------------------------------------------
	public function disconnect(){
		if($this->conn != null ){
			$this->conn = null ; 
		}	
	}
	//--------------------------------------------------------------------------
	public function select_admin($id , $password){
		$this->connect();
		try{
			$stmt = $this->conn->query("SELECT adminPassword , adminName FROM administratorTable where adminId='$id' ");
			$row = $stmt->fetch();
			$hashed_password = $row[0];
			$username = $row[1] ;
			if(password_verify($password,$hashed_password)){
				return $username ; 
			}
			else{
				return 0;
			}
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		$this->disconnect();
	}
	//--------------------------------------------------------------------------
	public function select_teacher($id , $password ){
		$this->connect();
		
		try{
			$stmt = $this->conn->query("SELECT teacherPassword , teacherName FROM teacherTable where teacherId='$id' ");
			$row = $stmt->fetch();
			#$password1 = $row[0];
			$hashed_password = $row[0];
			$username = $row[1] ;
			if(password_verify($password,$hashed_password)){
				return $username ; 
			}
			else{
				return 0;
			}
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

		$this->disconnect();
	}
	//--------------------------------------------------------------------------
	public function select_student($id , $password ){
		$this->connect();
		try{
			$stmt = $this->conn->query("SELECT teacherPassword , teacherName FROM teacherTable where teacherId='$id' ");
			$row = $stmt->fetch();
			#$password1 = $row[0];
			$hashed_password = $row[0];
			$username = $row[1] ;
			if(password_verify($password, $hashed_password)){
				return $username ; 
			}
			else{
				return 0;
			}
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		$this->disconnect();
	}
	//---------------------------------------------------------
	
	public function insert_Admin($Admin){
		$this->connect();
		try{
			$stmt = $this->conn->prepare("INSERT INTO administratorTable (adminId  ,adminBirthdate, adminName, adminSurname, adminPassword, adminEmail , adminTC , adminTel,  adminAddress) 
		    VALUES (null ,:adminBirthdate,:adminName, :adminSurname, :adminPassword, :adminEmail, :adminTC, :adminTel,  :adminAddress) ");

		    $adminName = $Admin->getadminName(); 
		    $adminSurname = $Admin->getadminSurname() ; 
		    $adminPassword = $Admin->getadminPassword(); 
		    $adminEmail = $Admin->getadminEmail(); 
		    $adminTC = $Admin->getadminTC();     
		    $adminTel = $Admin->getadminTel(); 
  			$adminBirthdate = $Admin->getadminBirthdate();
		    $adminAddress = $Admin->getadminAddress(); 

		 	$stmt->bindParam(':adminName', $adminName);
		    $stmt->bindParam(':adminSurname', $adminSurname);
		    $stmt->bindParam(':adminPassword', $adminPassword);
		    $stmt->bindParam(':adminEmail', $adminEmail);
		    $stmt->bindParam(':adminTC', $adminTC);
		    $stmt->bindParam(':adminTel', $adminTel);
		    $stmt->bindParam(':adminBirthdate', $adminBirthdate);
		    $stmt->bindParam(':adminAddress', $adminAddress);
		    $stmt->execute();
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		$this->disconnect();
	}
    //--------------------------------------------------------------------------
    public function insert_Faculty($Faculty){
		$this->connect();
		try{
			$stmt = $this->conn->prepare("  INSERT INTO facultytable (facultyId  ,  facultyName) 
		    VALUES (null ,:facultyName ) ");
		    $facultyName = $Faculty->getfacultyName(); 
		 	$stmt->bindParam(':facultyName', $facultyName);
		    $stmt->execute();
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		$this->disconnect();
	}
    //--------------------------------------------------------------------------
    public function search_Faculty($word){
		$this->connect();
		try{
			$stmt = $this->conn->query("SELECT * FROM facultytable where facultyName LIKE '%".$word."%' ");
			
			$count = $stmt->rowCount();
			$counter = 0; 
			$allfaculties= new SplFixedArray($count);
			while ($row = $stmt->fetch()) {
			    $faculty = new Faculty($row["facultyId"],$row["facultyName"]);
			    $allfaculties[$counter]=$faculty;
			    $counter =$counter + 1 ;
			}
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		$this->disconnect();
		return $allfaculties ; 
	} 
    //--------------------------------------------------------------------------
    public function search_Department($word){
		$this->connect();
		try{
			$stmt = $this->conn->query(" SELECT departmentTable.departmentId, departmentTable.departmentName, facultyTable.facultyName FROM departmentTable 
			INNER JOIN facultyTable ON facultyTable.facultyId=departmentTable.facultyId WHERE  facultytable.facultyName LIKE '%".$word."%' OR departmenttable.departmentName LIKE '%".$word."%' ");
			
			$count = $stmt->rowCount();
			$counter = 0; 
			$alldepartments= new SplFixedArray($count);
			while ($row = $stmt->fetch()) {
			    $department = new Department($row["departmentId"],$row["departmentName"],$row["facultyName"]);
			    $alldepartments[$counter]=$department;
			    $counter =$counter + 1 ;
			}
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		$this->disconnect();
		return $alldepartments ; 
	} 
    //--------------------------------------------------------------------------
     public function search_Admin($word){
		$this->connect();
		try{
			$stmt = $this->conn->query(" SELECT *  FROM administratortable  WHERE adminName LIKE '%".$word."%' OR adminId LIKE '%".$word."%' OR adminSurname LIKE '%".$word."%' OR adminEmail LIKE '%".$word."%' OR adminTC LIKE '%".$word."%' OR adminTel LIKE '%".$word."%' OR adminBirthdate LIKE '%".$word."%' OR adminAddress LIKE '%".$word."%' ");
			$count = $stmt->rowCount();
			$counter = 0; 
			$alladmins= new SplFixedArray($count);
			while ($row = $stmt->fetch()) {
			    $admin = new Admin($row["adminId"],$row["adminName"],$row["adminSurname"],$row["adminPassword"],$row["adminEmail"],$row["adminTC"],$row["adminTel"],$row["adminBirthdate"],$row["adminAddress"]);
			    $alladmins[$counter]=$admin;
			    $counter =$counter + 1 ;
			}
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		$this->disconnect();
		return $alladmins ; 
	} 
	//--------------------------------------------------------------------------
	public function select_teacherSubject($id, $word){
		$this->connect();
		
		try{
			$stmt = $this->conn->query("select subjectteacher.subjectId, subjecttable.subjectName FROM subjectteacher INNER JOIN subjecttable ON subjectteacher.teacherId ='$id' and subjectteacher.subjectId = subjecttable.subjectId where subjecttable.subjectName LIKE '%".$word."%'");
			$count = $stmt->rowCount();
			$counter = 0;
			$allteacherSubject= new SplFixedArray($count);
			while ($row = $stmt->fetch()) {
			    $subject = new Subject($row["subjectId"], $row["subjectName"]);
			    $allteacherSubject[$counter]=$subject;
			    $counter =$counter + 1 ;
			}
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		$this->disconnect();
		return $allteacherSubject ; 
	}
	//---------------------------------------------------------
	public function select_studentSubject($id, $t_id, $word){
		$this->connect();

		try{
			$stmt = $this->conn->query("select subjectstudentgrade.studentId, studenttable.studentName, studenttable.studentSurname, subjectstudentgrade.midTerm, subjectstudentgrade.finalTerm, subjectstudentgrade.subjectStatus FROM 
								subjectstudentgrade INNER JOIN studenttable ON 		  
			  					subjectstudentgrade.studentId = studenttable.studentId and subjectstudentgrade.subjectId = '$id' and subjectstudentgrade.teacherId = '$t_id' where studenttable.studentName LIKE '%".$word."%'");
			$count = $stmt->rowCount();
			$counter = 0;
			$allstudentSubject= new SplFixedArray($count);
			while ($row = $stmt->fetch()) {
			    $subjectGrade = new SubjectGrade($id, $row['studentId'], $row["studentName"], $row['studentSurname'], $row["midTerm"], $row["finalTerm"], $row["subjectStatus"]);
			    $allstudentSubject[$counter]=$subjectGrade;
			    $counter =$counter + 1 ;
			}
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		$this->disconnect();
		return $allstudentSubject ; 
	}
	//---------------------------------------------------------
     public function insert_Department($Department){
		$this->connect();
		try{
			$stmt = $this->conn->prepare("  INSERT INTO departmenttable (departmentId  ,  departmentName , facultyId ) 
		    VALUES (null ,:departmentName,:facultyId ) ");

		    $departmentId = $Department->getdepartmentId(); 
		    $departmentName = $Department->getdepartmentName(); 
		    $facultyName = $Department->getfacultyName(); 
		 	
		 	$stmt->bindParam(':departmentName', $departmentName);
		 	$stmt->bindParam(':facultyId', $facultyName);
		    $stmt->execute();
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		$this->disconnect();
	}
	//---------------------------------------------------------
	public function delete_Faculty($id){
		$this->connect();
		try{
			$stmt = "DELETE FROM facultytable WHERE facultyId='$id'";
			$this->conn->exec($stmt);

		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

		$this->disconnect();
	}
//---------------------------------------------------------
	public function delete_Department($id){
		$this->connect();
		try{
			$stmt = "DELETE FROM departmentTable WHERE departmentId='$id'";
			$this->conn->exec($stmt);
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		$this->disconnect();
	}
//---------------------------------------------------------	
	public function delete_Admin($id){
		$this->connect();
		try{
			$stmt = "DELETE FROM administratortable WHERE adminId='$id'";
			$this->conn->exec($stmt);
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		$this->disconnect();
	}
//---------------------------------------------------------	
	public function update_Faculty($faculty){
		$this->connect();
		$getfacultyId = $faculty->getfacultyId(); 
		$facultyName = $faculty->getfacultyName() ; 
		try{
			$stmt = $this->conn->prepare("UPDATE facultytable SET facultyName='$facultyName'  WHERE facultyId='$getfacultyId' "); 
			$stmt->execute();
		}	
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

		$this->disconnect();
	}
//---------------------------------------------------------	
	public function update_Department($department){
		$this->connect();
		$departmentId = $department->getdepartmentId();
		$departmentName = $department->getdepartmentName();
		$facultyId = $department->getfacultyName() ; 
		try{
			$stmt = $this->conn->prepare("UPDATE departmenttable SET facultyId='$facultyId'  , departmentName='$departmentName' WHERE departmentId='$departmentId' "); 
			$stmt->execute();
		}	
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

		$this->disconnect();
	}
	public function update_Admin($Admin){
		$this->connect();
		try{
			$adminName = $Admin->getadminName(); 
		    $adminSurname = $Admin->getadminSurname() ; 
		    $adminPassword = $Admin->getadminPassword(); 
		    $adminEmail = $Admin->getadminEmail(); 
		    $adminTC = $Admin->getadminTC();     
		    $adminTel = $Admin->getadminTel(); 
  			$adminBirthdate = $Admin->getadminBirthdate();
		    $adminAddress = $Admin->getadminAddress(); 
			$stmt = $this->conn->prepare("  UPDATE  administratorTable SET adminName='$adminName',  adminSurname='$adminSurname',adminPassword='$adminPassword',adminEmail='$adminEmail',adminTC='$adminTC',adminTel='$adminTel',adminBirthdate='$adminBirthdate' ,adminAddress='$adminAddress' WHERE adminName='$adminName' ");
		    $stmt->execute();
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		$this->disconnect();
	}
    //--------------------------------------------------------------------------

	public function update_grade($subjectGrade){
		$this->connect();
		try{
			$subjectId = $subjectGrade->getsubjectId(); 
		    $studentId = $subjectGrade->getstudentId() ; 
		    $midTerm = $subjectGrade->getmidTerm(); 
		    $finalTerm = $subjectGrade->getfinalTerm();
		    
			$stmt = $this->conn->prepare("UPDATE subjectstudentgrade SET midTerm='$midTerm',  finalTerm='$finalTerm' WHERE subjectId='$subjectId' and studentId='$studentId'");
		    $stmt->execute();
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		$this->disconnect();
	}
	//-------------------------------------------------------------------------

}

?>

