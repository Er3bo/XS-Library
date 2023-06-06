<?php
class IndexModel extends Model
{
    public function Index()
    {
        return;
    }

    public function CheckUserLogin($email, $password)
    {
        $query = "SELECT * FROM user WHERE email=:email";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['email' => $email]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userData) {
            if (password_verify($password, $userData['password']) && ($userData['email'] == 'admin@gmail.com' || $userData['active'] != 0)) {
                if ($userData['email'] == 'admin@gmail.com') {
                    $_SESSION['user_role'] = 'admin';
                } else {
                    $_SESSION['user_role'] = 'user';
                }
                $_SESSION['user_id'] = $userData['id'];
                return true;
            } else if($userData['active'] == 0) {
                $_SESSION['message'] = 'Account is not approved by admin';
                return false;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

?>