<?php


$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;

include_once "{$base_dir}BaseModel.php";

class Appointment extends BaseModel
{
    public function index($startFrom, $rowsCount)
    {
        $data = null;

        if(isset($_COOKIE['logged'])) {
            $user_id = $this->user_id($_COOKIE['logged']);

            $query = "SELECT a.id, a.title, a.description, a.date_time, a.active
            FROM appointments AS a
            WHERE a.user_id = $user_id AND a.active = 1
            ORDER BY id 
            DESC LIMIT $startFrom, $rowsCount";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll();
        }
        return $data;
    }

    public function read($id)
    {
        $data = null;

        $query = "SELECT * FROM appointments WHERE id = '$id'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch();

        return $data;
    }

    public function destroy($id)
    {
        $data = null;

        $query = "DELETE FROM appointments WHERE id = '$id'";

        if ($stmt = $this->conn->exec($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id, $active)
    {
        $data = null;

        $query = "UPDATE appointments SET active = $active WHERE id = '$id'";

        if ($stmt = $this->conn->exec($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function update($data)
    {
        $query = "UPDATE appointments SET date_time='$data[date_time]', title='$data[title]', description='$data[description]' WHERE id='$data[id]'";

        if ($stmt = $this->conn->exec($query)) {
            return true;
        } else {
            return false;
        }
    }


    private function user_id($login)
    {
        $query = "SELECT id FROM users WHERE login = '$login'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch();

        return $data['id'];
    }

    public function insert($login)
    {
        $id = $this->user_id($login);

        if (isset($_POST['title'])) {
            if (!empty($_POST['title'])) {

                $time = $_POST['dateTime'];
                $title = $_POST['title'];
                $description = $_POST['description'];

                $query = "INSERT INTO appointments (user_id, date_time, title, description, active) VALUES ('$id', '$time', '$title', '$description', '1')";
                echo $query;
                if ($stmt = $this->conn->exec($query)) {
                    return "inserted";
                } else {
                    return "NOT inserted";
                }

            }
        }


    }

}
