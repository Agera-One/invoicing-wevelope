<?php

class ProfileController extends BaseController
{
    private $user;
    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->user = $this->model('user');
        $this->db = $this->user->getConnection();
    }

    public function edit()
    {
        $id = $this->userId;
        $error = false;
        $datas = $this->user->find(['id' => $id]);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['password']) && empty($_POST['confirm_password'])) {
                $_POST['password'] = $datas['password'];
            }

            $email_exists = $this->db->has('user', [
                'AND' => [
                    'email' => $_POST['email'],
                    'id[!]' => $id
                ]
            ]);

            $phone_exists = $this->db->has('user', [
                'AND' => [
                    'phone' => $_POST['phone'],
                    'id[!]' => $id
                ]
            ]);

            $redirectTo = !empty($_POST['redirect_to']) ? $_POST['redirect_to'] : BASEURL . 'dashboard';

            if ($email_exists) {
                echo '<script>alert("Email already exists")</script>';
                $this->view('profile/index', $datas);
            } elseif ($phone_exists) {
                echo '<script>alert("Phone number already exists")</script>';
                $this->view('profile/index', $datas);
            } elseif ($error === false) {
                $this->user->update($id, $_POST);
                $this->redirect($redirectTo);
            }
        } else {
            $datas['referrer'] = $_SERVER['HTTP_REFERER'] ?? BASEURL . 'dashboard';
            $this->view('profile/index', $datas);
        }
    }
}
