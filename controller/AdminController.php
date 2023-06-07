<?php
class AdminController extends Controller
{
    protected function UserList()
    {
        $nonActiveUsers = new AdminModel;
        $data = $nonActiveUsers->notActiveUsers();
        $this->runThis('users.php', ['data'=>$data]);
    }

    protected function UserApprove()
    {
        $user_id = $_POST['user_id'];

        $nonActiveUsers = new AdminModel;
        $update= $nonActiveUsers->updateUserStatus($user_id);

        if ($update) {
            header('Location: ?users');
            exit;
        }
    }

    protected function CreateBook()
    {

    }

    protected function DeleteBook()
    {

    }
}