<?php
class AdminModel extends Model
{
    public function notActiveUsers()
    {
        $query = "SELECT * FROM user WHERE active=0";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $userData;
    }

    public function updateUserStatus($user_id)
    {
        $query = "UPDATE user SET active = '1' WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $user_id]);
        return true;
    }
}