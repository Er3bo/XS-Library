<?php
class UserModel extends Model
{
    /**
     * Check is it valid user, is it verified, is it admin or user.
     *
     * @param string $email
     * @param string $password
     *
     * @return bool
     */
    public function checkUserLogin(string $email, string $password): bool
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
            } else if ($userData['active'] == 0) {
                $_SESSION['message'] = 'Account is not approved by admin';

                return false;
            } else {
                $_SESSION['message'] = 'Incorrect Email or password!';

                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Register new user/add new user to db
     *
     * @param string $email
     * @param string $password
     * @param string $firstName
     * @param string $lastNAme
     *
     * @return bool
     */
    public function userRegister(string $email, string $password, string $firstName, string $lastNAme): bool
    {
        $query = "INSERT INTO user (first_name, last_name, email, password) VALUES (:firstName, :lastName, :email, :password)";

        try {
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastNAme);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            $stmt->execute();

            return true;

        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                "The email address $email is already in use. Please choose a different email address.";
            } else {
                "An error occurred: " . $e->getMessage();
            }

            return false;
        }
    }

    /**
     * Change the password if email is valid and registered.
     *
     * @param string $email
     * @param string $password
     * @param string $passwordConfirm
     *
     * @return bool
     */
    public function forgottenPass(string $email, string $password, string $passwordConfirm): bool
    {
        if ($password == $passwordConfirm) {
            $query = "SELECT * FROM user WHERE email=:email";
            $stmt = $this->db->prepare($query);

            $stmt->execute(['email' => $email]);

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($userData) {
                $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                $queryUpdate = "UPDATE user SET password =:password WHERE id = :id";
                $stmt = $this->db->prepare($queryUpdate);
                $stmt->bindParam(':password', $hashedPass);
                $stmt->bindParam(':id', $userData['id']);

                $stmt->execute();

                return true;
            } else {

                return false;
            }
        }
        return false;
    }

    /**
     * Take user current data
     *
     * @param int $id
     *
     * @return array
     */
    public function takeUserData(int $id): array
    {
        $query = "SELECT * FROM user WHERE id=:id";
        $stmt = $this->db->prepare($query);

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Update users data.
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @param string $passwordConfirm
     *
     * @return bool
     */
    public function updateUserData(string $firstName, string $lastName, string $email, string $password, string $passwordConfirm): bool
    {
        $user = $_SESSION['user_id'];

        if ($password == $passwordConfirm) {
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            $queryUpdate = "UPDATE user SET first_name = :first_name, last_name = :last_name, email = :email, password = :password WHERE id = :id";
            $stmt = $this->db->prepare($queryUpdate);

            $stmt->bindParam(':first_name', $firstName);
            $stmt->bindParam(':last_name', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPass);
            $stmt->bindParam(':id', $user);

            $stmt->execute();

            return true;
        } else {

            return false;
        }
    }
}