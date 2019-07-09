<?php
class Admin{ 
    private  $adminId; 
    private  $adminName; 
    private  $adminSurname; 
    private  $adminPassword; 
    private  $adminEmail; 
    private  $adminTC; 
    private  $adminTel;     
    private  $adminBirthdate; 
    private  $adminAddress; 

    public function __construct( $adminId ,$adminName, $adminSurname, $adminPassword, $adminEmail, $adminTC, $adminTel, $adminBirthdate, $adminAddress) {
        $this->adminId = $adminId;
        $this->adminName = $adminName;
        $this->adminSurname = $adminSurname;
        $this->adminPassword = password_hash($adminPassword, PASSWORD_BCRYPT);
        $this->adminEmail = $adminEmail;
        $this->adminTC = $adminTC;
        $this->adminTel = $adminTel;
        $this->adminBirthdate = $adminBirthdate;
        $this->adminAddress = $adminAddress;
    }
     
     public function setadminId($adminId)
    {
        $this->adminId = $adminId;
    } 
    public function getadminId()
    {
        return $this->adminId;
    }                
    public function setadminName($adminName)
    {
        $this->adminName = $adminName;
    } 
    public function getadminName()
    {
        return $this->adminName;
    }
    public function setadminSurname($adminSurname)
    {
        $this->adminSurname = $adminSurname;
    } 
    public function getadminSurname()
    {
        return $this->adminSurname;
    }
    public function setadminPassword($adminPassword)
    {
        $this->adminPassword = password_hash($adminPassword, PASSWORD_BCRYPT);
    } 
    public function getadminPassword()
    {
        return $this->adminPassword;
    }
    public function setadminEmail($adminEmail)
    {
        $this->adminEmail = $adminEmail;
    } 
    public function getadminEmail()
    {
        return $this->adminEmail;
    }
    public function setadminTC($adminTC)
    {
        $this->adminTC = $adminTC;
    } 
    public function getadminTC()
    {
        return $this->adminTC;
    }
     public function setadminTel($adminTel)
    {
        $this->adminTel = $adminTel;
    } 
    public function getadminTel()
    {
        return $this->adminTel;
    }
     public function setadminBirthdate($adminBirthdate)
    {
        $this->adminBirthdate = $adminBirthdate;
    } 
    public function getadminBirthdate()
    {
        return $this->adminBirthdate;
    }
     public function setadminAddress($adminAddress)
    {
        $this->adminAddress = $adminAddress;
    } 
    public function getadminAddress()
    {
        return $this->adminAddress;
    }
} 

?> 