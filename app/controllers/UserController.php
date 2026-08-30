<?php

class UserController extends BaseController
{
    private $user;
    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->user = $this->model('user');
        $this->db = $this->user->getConnection();
    }

    public function index()
    {
        unset($_SESSION['old']);
        $where_condition['company_id'] = $this->companyId;

        $search = $_GET['search'] ?? '';
        $page = $_GET['page'] ?? 1;

        $where_condition = $this->search($search, $where_condition, ['name', 'email', 'phone']);
        $pagination = $this->user->pagination($this->db, $page, 'user', 'id', $where_condition);

        $users = $this->user->getAll($where_condition, $pagination['offset'], $pagination['limit']);

        $datas = [
            'search' => $search,
            'page' => $page,
            'pagination' => $pagination,
            'users' => $users,
        ];

        $this->view('user/index', $datas);
    }

    public function add()
    {
        $is_active = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['company_id'] = $this->companyId;

            $email_exists = $this->db->has('user', ['email' => $_POST['email']]);
            $phone_exists = $this->db->has('user', ['phone' => $_POST['phone']]);

            if ($email_exists || $phone_exists) {
                $_SESSION['error'] = $email_exists
                    ? 'Email already exists'
                    : 'Phone number already exists';

                $_SESSION['old'] = $_POST;

                $this->redirect(BASEURL . 'user/add');
                return;
            } else {
                $this->user->create($_POST);
                $this->redirect(BASEURL . 'user');
            }
        } else {
            $this->view('user/add', ['is_active' => $is_active]);
        }
    }

    public function edit($id)
    {
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

            if ($email_exists) {
                echo '<script>alert("Email already exists")</script>';
                $this->view('user/edit', $datas);
            } elseif ($phone_exists) {
                echo '<script>alert("phone already exists")</script>';
                $this->view('user/edit', $datas);
            } elseif ($error === false) {
                $this->user->update($id, $_POST);
                $this->redirect(BASEURL . 'user');
            }
        } else {
            $this->view('user/edit', $datas);
        }
    }

    public function delete($id)
    {
        if ($id == $_SESSION['user_id']) {
            echo
            '<script>
                alert("You cannot delete the account yourself.");
                window.location.href = "' . BASEURL . 'user";
            </script>';
        } else {
            $this->user->delete($id);
            $this->redirect(BASEURL . 'user');
        }
    }
}
