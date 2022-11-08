<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "../BaseModel.php";

class Todo extends BaseModel
{
    public function index(){
        $data = null;

        $query = "SELECT * FROM todos ORDER BY id ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function read($id){
        $data = null;

        $query = "SELECT * FROM todos WHERE id = '$id'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch();

        return $data;
    }

    public function delete($id){
        $data = null;

        $query = "DELETE FROM todos WHERE id = '$id'";

        if($stmt = $this->conn->exec($query)){
            return "deleted";
        }else{
            return "not deleted";
        }
    }
}
