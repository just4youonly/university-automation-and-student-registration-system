<?php

session_start();



require_once('Dao.php');
require_once('../model/Admin.php');
require_once('../model/Teacher.php');
require_once('../model/Student.php');
require_once('../model/Department.php');
require_once('../model/Faculty.php');
require_once('../model/Subject.php');
require_once('../model/SubjectGrade.php');

$dao = new Dao ();

class Controller{
	
	
	public function __construct (){
		$method=$_GET['method'];
		switch ($method) {
			case 'login':
				$this->login_Validate();
				break;
			case 'logout':
				session_destroy();
				header("location:/yazilim_projesi/index.php");
				break;
			case 'listadmins':
				$this->list_admins();
				break;
			case 'listfaculties':
				$this->list_faculties();
				break;
			case 'listdepartments':
				$this->list_departments();
				break;
			case 'addadmin':
				$this->add_admin();
				break;
			case 'addfaculty':
				$this->add_faculty();
				break;
			case 'adddepartment':
				$this->add_department();
				break;
			case 'searchfaculty':
				$this->search_faculty();
				break;	
			case 'searchdepartment':
				$this->search_department();
				break;
			case 'searchadmin':
				$this->search_admin();
				break;
			case 'fakultydelete':
				$this->delete_faculty();
				break;
			case 'departmentdelete':
				$this->delete_department();
				break;
			case 'admindelete':
				$this->delete_admin();
				break;
			case 'updatefakulty':
				$this->update_fakulty();
				break;
			case 'updatedepartment':
				$this->update_department();
				break;	
			case 'updateadmin':
				$this->update_admin();
				break;
			case 'list_teacherSubject':
				$this->list_teacherSubject();
				break;
			case 'list_studentSubject':
				$this->list_studentSubject();
				break;
			case 'update_grade':
				$this->update_grade();
				break;
			default:
				echo 'default olarak';
				break;
		}
	}

	public function login_Validate(){
		$id=$_POST['ID'];
		$password=$_POST['password']; 
		$radio=$_POST['radio']; 
		global $dao;
		 
		switch ($radio) {

			case '0':
				$ctrl=$dao->select_admin($id , $password);
				if($ctrl != '0'){
					$_SESSION['ROOT_NAME'] = $ctrl ; 
					header("location:../view/root/root_home.php");
				}else{
					header("location:../index.php");
				}
				break;
			case '1':

				$ctrl=$dao->select_teacher($id , $password);
				if($ctrl != '0'){
					$_SESSION['TEACHER_ID'] = $id;
					$_SESSION['TEACHER_NAME'] = $ctrl ;
					header("location:../view/teacher/teacher_home.php");
				}else{
					header("location:/yazilim_projesi/index.php");
				}
				break;
			case '2':

				$ctrl=$dao->select_student($id , $password);
				if($ctrl != '0'){
					$_SESSION['STUDENT_NAME'] = $ctrl ; 
					header("location:../view/teacher/student_home.php");
				}else{
					header("location:/yazilim_projesi/index.php");
				}
				break;
		}
	}

	/*public function list_admins(){
		global $dao;
		$list_admins=$dao->select_alladmins( );
		$size= sizeof($list_admins);
		$myObj = new \stdClass();
		$myObj1 = new \stdClass();
		$i=0;
		$myObj1->$i= $size ;
		for($i = 1; $i <= $size ;$i++){
			$myObj->adminId=$list_admins[$i-1]->getadminId();
			$myObj->adminName=$list_admins[$i-1]->getadminName();
			$myObj->adminSurname=$list_admins[$i-1]->getadminSurname();
			$myObj->adminPassword=$list_admins[$i-1]->getadminPassword();
			$myObj->adminEmail=$list_admins[$i-1]->getadminEmail();
			$myObj->adminTC=$list_admins[$i-1]->getadminTC();
			$myObj->adminTel=$list_admins[$i-1]->getadminTel();
			$myObj->adminBirthdate=$list_admins[$i-1]->getadminBirthdate();
			$myObj->adminAddress=$list_admins[$i-1]->getadminAddress();
			
		    $myJSON = json_encode($myObj);
		    $myObj1->$i=$myJSON ;
		}	
		echo  json_encode($myObj1);
	}
	
	public function list_faculties(){
		global $dao;
		$list_faculties=$dao->list_allfaculties( );
		$size= sizeof($list_faculties);
		$myObj = new \stdClass();
		$myObj1 = new \stdClass();
		$i=0;
		$myObj1->$i= $size ;
		for($i = 1; $i <= $size ;$i++){
			$myObj->facultyId=$list_faculties[$i-1]->getfacultyId();
			$myObj->facultyName=$list_faculties[$i-1]->getfacultyName();
		    $myJSON = json_encode($myObj);
		    $myObj1->$i=$myJSON ;
		}	
		echo  json_encode($myObj1);
	}

	public function list_departments(){
		global $dao;
		$list_departments=$dao->list_alldepartments( );
		$size= sizeof($list_departments);
		$myObj = new \stdClass();
		$myObj1 = new \stdClass();
		$i=0;
		$myObj1->$i= $size ;
		for($i = 1; $i <= $size ;$i++){
			$myObj->departmentId=$list_departments[$i-1]->getdepartmentId();
			$myObj->departmentName=$list_departments[$i-1]->getdepartmentName();
			$myObj->facultyName=$list_departments[$i-1]->getfacultyName();
		    $myJSON = json_encode($myObj);
		    $myObj1->$i=$myJSON ;
		}	
		echo  json_encode($myObj1);
	}
	*/
	public function list_faculties(){
		global $dao;
		$list_faculties=$dao->search_Faculty("");
		$size= sizeof($list_faculties);
		$myObj = new \stdClass();
		$myObj1 = new \stdClass();
		$i=0;
		$myObj1->$i= $size ;
		for($i = 1; $i <= $size ;$i++){
			$myObj->facultyId=$list_faculties[$i-1]->getfacultyId();
			$myObj->facultyName=$list_faculties[$i-1]->getfacultyName();
		    $myJSON = json_encode($myObj);
		    $myObj1->$i=$myJSON ;
		}	
		echo  json_encode($myObj1);
	}
	public function add_admin(){
		global $dao;
		$fname=$_POST['fname'];
		$lname=$_POST['lname']; 
		$email=$_POST['email'];
		$Password=$_POST['Password'];
		$tc=$_POST['tc']; 
		$tel=$_POST['tel'];
		$birthday=(string)$_POST['birthday'];
		$adress=$_POST['adress']; 
		$admin = new Admin(null,$fname ,$lname ,$email ,$Password ,$tc ,$tel ,$birthday ,$adress);
		$dao->insert_Admin($admin );
		header("location:../view/root/administratorslist.php");
	}
	public function add_faculty(){
		global $dao;
		$fname=$_POST['fname'];
		$faculty = new Faculty(null,$fname);
		$dao->insert_Faculty($faculty );
		header("location:../view/root/fakultieslist.php");
	}
	public function update_fakulty(){
		global $dao;
		$facultyName= $_POST['fname'];
		$facultyId= $_GET['facultyId'];
		$faculty = new Faculty($facultyId,$facultyName);
		$dao->update_Faculty($faculty);
		header("location:../view/root/fakultieslist.php");
	}
	public function update_department(){
		global $dao;
		$departmentName= $_POST['fname'];
		$departmentId= $_GET['departmentId'];
		$facultyName= $_POST['facultyName'];
		$department = new Department($departmentId,$departmentName,$facultyName);
		$dao->update_Department($department);
		header("location:../view/root/departmentslist.php");
	}
	public function update_admin(){
		global $dao;
		$adminId= $_GET['adminId'];
		$fname=$_POST['fname'];
		$lname=$_POST['lname']; 
		$email=$_POST['email'];
		$Password=$_POST['Password'];
		$tc=$_POST['tc']; 
		$tel=$_POST['tel'];
		$birthday=(string)$_POST['birthday'];
		$adress=$_POST['adress']; 
		$admin = new Admin($adminId,$fname ,$lname ,$email ,$Password ,$tc ,$tel ,$birthday ,$adress);
		$dao->update_Admin($admin );
		header("location:../view/root/administratorslist.php");
	}
	public function add_department(){
		global $dao;
		$departmentName=$_POST['fname'];
		$facultyName=$_POST['facultyName'];
		$department = new Department(null,$departmentName,$facultyName);
		$dao->insert_Department($department);
		header("location:../view/root/departmentslist.php");
	}
	public function search_faculty(){
		global $dao;
		$param=$_GET['param'];
		$list_faculties=$dao->search_Faculty($param);
		$size= sizeof($list_faculties);
		$myObj = new \stdClass();
		$myObj1 = new \stdClass();
		$i=0;
		$myObj1->$i= $size ;
		for($i = 1; $i <= $size ;$i++){
			$myObj->facultyId=$list_faculties[$i-1]->getfacultyId();
			$myObj->facultyName=$list_faculties[$i-1]->getfacultyName();
		    $myJSON = json_encode($myObj);
		    $myObj1->$i=$myJSON ;
		}	
		echo  json_encode($myObj1);
	}
	public function search_department(){
		global $dao;
		$param=$_GET['param'];
		$list_departments=$dao->search_Department($param);
		$size= sizeof($list_departments);
		$myObj = new \stdClass();
		$myObj1 = new \stdClass();
		$i=0;
		$myObj1->$i= $size ;
		for($i = 1; $i <= $size ;$i++){
			$myObj->departmentId=$list_departments[$i-1]->getdepartmentId();
			$myObj->departmentName=$list_departments[$i-1]->getdepartmentName();
			$myObj->facultyName=$list_departments[$i-1]->getfacultyName();
		    $myJSON = json_encode($myObj);
		    $myObj1->$i=$myJSON ;
		}	
		echo  json_encode($myObj1);
	}
	public function search_admin(){
		global $dao;
		$param=$_GET['param'];
		$list_admins=$dao->search_Admin( $param);
		$size= sizeof($list_admins);
		$myObj = new \stdClass();
		$myObj1 = new \stdClass();
		$i=0;
		$myObj1->$i= $size ;
		for($i = 1; $i <= $size ;$i++){
			$myObj->adminId=$list_admins[$i-1]->getadminId();
			$myObj->adminName=$list_admins[$i-1]->getadminName();
			$myObj->adminSurname=$list_admins[$i-1]->getadminSurname();
			$myObj->adminPassword=$list_admins[$i-1]->getadminPassword();
			$myObj->adminEmail=$list_admins[$i-1]->getadminEmail();
			$myObj->adminTC=$list_admins[$i-1]->getadminTC();
			$myObj->adminTel=$list_admins[$i-1]->getadminTel();
			$myObj->adminBirthdate=$list_admins[$i-1]->getadminBirthdate();
			$myObj->adminAddress=$list_admins[$i-1]->getadminAddress();
		    $myJSON = json_encode($myObj);
		    $myObj1->$i=$myJSON ;
		}	
		echo  json_encode($myObj1);
	}
	public function list_teacherSubject(){
		global $dao;
		$param=$_GET['param'];
		$id = $_GET['id'];
		$list_teacherSubject=$dao->select_teacherSubject($id,$param);
		$size= sizeof($list_teacherSubject);
		$myObj = new \stdClass();
		$myObj1 = new \stdClass();
		$i=0;
		$myObj1->$i= $size ;
		for($i = 1; $i <= $size ;$i++){
			$myObj->subjectId=$list_teacherSubject[$i-1]->getsubjectId();
			$myObj->subjectName=$list_teacherSubject[$i-1]->getsubjectName();
		    $myJSON = json_encode($myObj);
		    $myObj1->$i=$myJSON ;
		}	
		echo  json_encode($myObj1);
	}

	public function list_studentSubject(){
		global $dao;
		$param=$_GET['param'];
		$id = $_GET['id'];
		$t_id = $_GET['t_id'];
		$list_studentSubject=$dao->select_studentSubject($id, $t_id, $param);
		$size= sizeof($list_studentSubject);
		$myObj = new \stdClass();
		$myObj1 = new \stdClass();
		$i=0;
		$myObj1->$i= $size ;
		for($i = 1; $i <= $size ;$i++){
			$myObj->subjectId=$list_studentSubject[$i-1]->getsubjectId();
			$myObj->studentId=$list_studentSubject[$i-1]->getstudentId();
			$myObj->studentName=$list_studentSubject[$i-1]->getstudentName();
			$myObj->studentSurname=$list_studentSubject[$i-1]->getstudentSurname();
			$myObj->midTerm=$list_studentSubject[$i-1]->getmidTerm();
			$myObj->finalTerm=$list_studentSubject[$i-1]->getfinalTerm();
			$myObj->subjectStatus=$list_studentSubject[$i-1]->getsubjectStatus();
		    $myJSON = json_encode($myObj);
		    $myObj1->$i=$myJSON ;
		}	
		echo  json_encode($myObj1);
	}

	public function delete_faculty(){
		global $dao;
		$param=$_GET['facultyId'];
		$dao->delete_Faculty($param);
	}
	public function delete_department(){
		global $dao;
		$param=$_GET['departmentId'];
		$dao->delete_Department($param);
	}
	public function delete_admin(){
		global $dao;
		$param=$_GET['adminId'];
		$dao->delete_Admin($param);
	}

	public function update_grade(){
		global $dao;
		$sub_id=$_GET['subjectId'];
		$stu_id=$_GET['studentId'];
		$mid_term=$_GET['midGrade'];
		$final_term=$_GET['finalGrade'];
		$subjectGrade = new SubjectGrade($sub_id, $stu_id, null, null, $mid_term, $final_term, null);
		$dao->update_grade($subjectGrade);
	}

}

$controller = new Controller ;


?>