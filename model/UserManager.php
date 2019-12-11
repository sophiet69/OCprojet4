<?php


namespace OpenClassrooms\Blog\Soso;

require_once("model/Manager.php");


class UserManager extends Manager
{
    
    public function get($pseudo)
   {
      $db = $this->dbConnect();
    //recuperation des donnees
      $requete = $db->prepare('SELECT id, pass FROM membres WHERE pseudo = ? ');
      $requete-> execute(array($pseudo));
    return $requete->fetch();
   }
    
    public function deleteMember($memberId) {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM membres WHERE id = ?');
        $deletedMember = $req->execute(array($memberId));
        return $deletedMember;
    }
/*
    public function updateMember($pass, $memberId) {
    	
    	$pass_hache = password_hash($_GET['pass'], PASSWORD_DEFAULT);
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE membres SET pass = ? WHERE id = ?');
        $updateMember = $req->execute(array($pass_hache, $memberId));
        return $updateMember;
    }*/
    

    public function createMember($pseudo, $pass)
    {
    	$pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $db = $this->dbConnect();
        $newMember = $db->prepare('INSERT INTO membres(pseudo, pass, date_inscription) VALUES (?, ?, NOW())');
        $newMember->execute(array($pseudo, $pass_hache));
        return $newMember;
    }



    public function getMembers() {
        $db = $this->dbConnect();
        $members = $db->query('SELECT id, pseudo FROM membres ORDER BY id');
        return $members;
    }

   

}
  


