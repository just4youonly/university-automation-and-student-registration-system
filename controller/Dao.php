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
	//--------------------------------------------------------------------------


















































	public function insert_tree($treeparts){
		$this->connect();
		try{

			$stmt = $this->conn->prepare("INSERT INTO tree_parts ( id_h, type, top, leftt, rotate, color, size) 
		    VALUES (:id_h, :type, :top, :leftt, :rotate, :color, :size)");

		    $id_h = $treeparts->getid_h() ; 
		    $type = $treeparts->gettype(); 
		    $top = $treeparts->gettop() ; 
		    $leftt = $treeparts->getleftt(); 
		    $rotate = $treeparts->getrotate(); 
		    $color = $treeparts->getcolor();     
		    $size = $treeparts->getsize(); 

		 	$stmt->bindParam(':id_h', $id_h);
		    $stmt->bindParam(':type', $type);
		    $stmt->bindParam(':top', $top);
		    $stmt->bindParam(':leftt', $leftt);
		    $stmt->bindParam(':rotate', $rotate);
		    $stmt->bindParam(':color', $color);
		    $stmt->bindParam(':size', $size);
		  
		    $stmt->execute();

		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

		$this->disconnect();
	}
    
    //--------------------------------------------------------------------------
	public function select_allhuman(){
		$this->connect();
		try{
			$stmt = $this->conn->query("SELECT * FROM human");
			$count = $stmt->rowCount();
			$counter = 0; 
			$all_human = new SplFixedArray($count);
		
			while ($row = $stmt->fetch()) {
			    $human = new Human($row["name"],$row["surname"],$row["email"],$row["tel"],$row["gender"],$row["birthday"],$row["birthplace"],$row["education"],$row["work"],$row["current_address"],$row["previous_address"],$row["picture"],$row["mother_name"],$row["father_name"],$row["father_birthday"],$row["grandpa"],$row["grandpa_birthday"],$row["status"],$row["details"]);
			    $all_human[$counter]=$human;
			    $counter =$counter + 1 ;
			}

		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

		$this->disconnect();
		return $all_human ; 
	}

	//--------------------------------------------------------------------------
	public function select_alltreeparts(){
		$this->connect();
		try{
			$stmt = $this->conn->query("SELECT * FROM tree_parts");
			$count = $stmt->rowCount();
			$counter = 0; 
			$alltreeparts = new SplFixedArray($count);

			while ($row = $stmt->fetch()) {
			   $treeparts = new treeparts($row["id_h"],$row["type"],$row["top"],$row["leftt"],$row["rotate"],$row["color"],$row["size"]);
			   $treeparts->setid($row["id"]);
			   $alltreeparts[$counter]=$treeparts;
			   $counter =$counter + 1 ;
			}

		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

		$this->disconnect();
		return $alltreeparts ; 
	}

	//--------------------------------------------------------------------------
	public function select_byid_human($id){
		$this->connect();
		$human1 ; 
		try{
			$stmt = $this->conn->query("SELECT * FROM human where id='$id'");
			while ($row = $stmt->fetch()) {
			     $human = new Human($row["name"],$row["surname"],$row["email"],$row["tel"],$row["gender"],$row["birthday"],$row["birthplace"],$row["education"],$row["work"],$row["current_address"],$row["previous_address"],$row["picture"],$row["mother_name"],$row["father_name"],$row["father_birthday"],$row["grandpa"],$row["grandpa_birthday"],$row["status"],$row["details"]);
			    $human1 = $human ;
			}

		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

		$this->disconnect();
		return $human1 ;
	}

	//--------------------------------------------------------------------------
	public function select_byid_h($id){
		$this->connect();
		$human1 = new human(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null); 
		try{
			$stmt = $this->conn->query("SELECT * FROM human where id='$id'");
			while ($row = $stmt->fetch()) {
			     $human = new Human($row["name"],$row["surname"],$row["email"],$row["tel"],$row["gender"],$row["birthday"],$row["birthplace"],$row["education"],$row["work"],$row["current_address"],$row["previous_address"],$row["picture"],$row["mother_name"],$row["father_name"],$row["father_birthday"],$row["grandpa"],$row["grandpa_birthday"],$row["status"],$row["details"]);
			    $human1 = $human ;
			}

		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

		$this->disconnect();
		return $human1 ;
	}

	//--------------------------------------------------------------------------
		public function select_byposotion_treepart($top,$leftt){
		$this->connect();
			$treeparts = new treeparts(null, null,null, null, null,null, null);
		try{
			$stmt = $this->conn->query("SELECT * FROM tree_parts where top='$top' AND leftt='$leftt'");
			while ($row = $stmt->fetch()) {
			   $treeparts = new treeparts($row["id_h"],$row["type"],$row["top"],$row["leftt"],$row["rotate"],$row["color"],$row["size"]);
			   $treeparts->setid($row["id"]);
			  
			}

		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

		$this->disconnect();
		return $treeparts; 
	}

	//--------------------------------------------------------------------------
	public function delete_human($id){
		$this->connect();
		try{
			$stmt = "DELETE FROM human WHERE id='$id'";
			$this->conn->exec($stmt);

		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

		$this->disconnect();
	}

	//--------------------------------------------------------------------------
	public function delete_treepart($top,$leftt){
		$this->connect();
		try{
			$stmt = "DELETE FROM tree_parts where top='$top' and leftt='$leftt'";
			$this->conn->exec($stmt);

		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

		$this->disconnect();
	}

	//--------------------------------------------------------------------------

	public function update_human($human,$id){
		$this->connect();

		$name = $human->getname() ; 
		$surname = $human->getsurname(); 
		$email = $human->getemail() ; 
	    $tel = $human->gettel(); 
		$gender = $human->getgender(); 
		$birthday = $human->getbirthday();     
		$birthplace = $human->getbirthplace(); 
		$education = $human->geteducation(); 
		$work = $human->getwork(); 
		$current_address = $human->getcurrent_address();
		$previous_address = $human->getprevious_address(); 
		$picture = $human->getpicture(); 
		$mother_name = $human->getmother_name();  
		$father_name = $human->getfather_name();
		$father_birthday = $human->getfather_birthday();
		$grandpa = $human->getgrandpa();
		$grandpa_birthday = $human->getgrandpa_birthday();
		$status = $human->getstatus();
		$details = $human->getdetails();

		try{
			$stmt = $this->conn->prepare("UPDATE human SET name='$name' , surname='$surname' , email='$email' , tel='$tel' , gender='$gender' , birthday='$birthday' , birthplace='$birthplace' , education='$education' , work='$work' , current_address='$current_address' , previous_address='$previous_address' , picture='$picture' , mother_name='$mother_name' , father_name='$father_name' , father_birthday='$father_birthday' , grandpa='$grandpa'  , grandpa_birthday='$grandpa_birthday' , status='$status' , details='$details' WHERE id='$id' "); 
			$stmt->execute();
		}	
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

		$this->disconnect();
		
	}

	//--------------------------------------------------------------------------
	public function update_treepart($treeparts,$id){
		$this->connect();

		$type = $treeparts->gettype(); 
		$top = $treeparts->gettop() ; 
		$leftt = $treeparts->getleftt(); 
		$rotate = $treeparts->getrotate(); 
		$color = $treeparts->getcolor();     
		$size = $treeparts->getsize(); 

		try{
			$stmt = $this->conn->prepare("UPDATE tree_parts SET type='$type' , top='$top' , leftt='$leftt' , rotate='$rotate' , color='$color' , size='$size'    WHERE id='$id' "); 
			$stmt->execute();
		}	
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

		$this->disconnect();
		
	}

	//--------------------------------------------------------------------------
	public function update_treepart_id_t($id_h,$id){
		$this->connect();



		try{
			$stmt = $this->conn->prepare("UPDATE tree_parts SET id_h='$id_h' WHERE id='$id' "); 
			$stmt->execute();
		}	
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

		$this->disconnect();
		
	}



	//--------------------------------------------------------------------------
	public function select_lastid($table){
		$this->connect();
		$last_id = 0;
		if($table==true){
			try{
				$stmt = $this->conn->query("SELECT MAX(id) FROM human");
				$row = $stmt->fetch();
			
				$last_id = $row[0];
				
			}
			catch(PDOException $e){
				echo "Error: " . $e->getMessage();
			}
		}else{
			try{
				$stmt = $this->conn->query("SELECT MAX(id) FROM tree_parts");
				$row = $stmt->fetch();
			
				$last_id = $row[0];
				
			}
			catch(PDOException $e){
				echo "Error: " . $e->getMessage();
			}
		}

		$this->disconnect();
		return $last_id ; 
	}

	

}

?>

