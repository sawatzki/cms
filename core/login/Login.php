<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;

require_once "{$base_dir}BaseModel.php";

class Login extends BaseModel
{
    public $data;
    private $userId;

    public function checkUser($data)
    {
        $this->data = $data;

        $query = "SELECT u.login AS logged, r.role 
                    FROM users AS u 
                    LEFT JOIN roles AS r ON r.id = u.role_id
                    WHERE login = '$data[login]' AND password = '$data[password]'";


        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch();

        return $data;
    }

    public function isLoginExist($data)
    {
        $this->data = $data;

        $query = "SELECT login FROM users WHERE login = '$data[login]'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch();

        return $data;
    }

    public function registerUser($data)
    {

        $this->data = $data;
        $now = date("Y-m-d H:i:s");

        $query = "INSERT INTO users (login, password, role_id, created) VALUES ('$data[login]', '$data[password]', 5, '$now')";

        if ($stmt = $this->conn->exec($query)) {
            return true;
        } else {
            return false;
        }

    }

    public function seeder($data)
    {
        $this->data = $data;
        $now = date("Y-m-d H:i:s");

        $query = "INSERT INTO users (login, password, role_id, first_name, last_name, email, mobile, tel, address, info, created) 
            VALUES 
        ('$data[login]', '$data[password]', '$data[role_id]', '$data[first_name]', '$data[last_name]', '$data[email]', '$data[mobile]', '$data[tel]', '$data[address]', '$data[info]', '$now')";

//        print_r($query);
//        die();

        if ($stmt = $this->conn->exec($query)) {
            return true;
        } else {
            return false;
        }
    }

}