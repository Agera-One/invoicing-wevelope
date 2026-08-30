<?php

class LoginController extends BaseController {
    private $user;

    public function __construct() {
        $this->user = $this->model('user');
    }

    public function index() {
        $this->view('login/index');
    }

    public function store() {
        $email    = $_POST["email"] ?? '';
        $password = $_POST["password"] ?? '';

        $user = $this->user->find(['email' => $email]);

        if ($user) {

            if ($user["is_active"] == 0) {
                echo
                '<script>
                    alert("Your account has been deactivated.");
                    window.location.href = "' . BASEURL . 'login";
                </script>';
            } elseif (password_verify($password, $user["password"])) {
                Session::set('user_id', $user['id']);
                Session::set('company_id', $user['company_id']);

                $this->redirect(BASEURL . 'dashboard');
            } else {
                echo
                '<script>
                    alert("Incorrect password. Please try again.");
                    window.location.href = "' . BASEURL . 'login";
                </script>';
            }
        } else {
            echo
            '<script>
                alert("Email not found. Please register first.");
                window.location.href = "' . BASEURL . 'login";
            </script>';
        }
    }

    public function logout() {
        Session::destroy();
        $this->redirect(BASEURL . 'login');
    }
}
