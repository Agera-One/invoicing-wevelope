<head>
  <link rel="stylesheet" href="<?= BASEURL . 'public/css/navbar.css' ?>">
</head>

<nav class="app-header navbar navbar-expand custom-navbar">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link"
          data-lte-toggle="sidebar"
          href="#"
          role="button">
          <i class="bi bi-list"></i>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown user-menu">
        <a href="#"
          class="nav-link dropdown-toggle"
          data-bs-toggle="dropdown">
          <img
            src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&s=160"
            class="user-image rounded-circle shadow"
            alt="User">
          <span class="d-none d-md-inline">
            <?= $current_user['name'] ?>
          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end profile-dropdown">
          <li class="user-header">
            <img
              src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&s=160"
              alt="User">
            <p><?= $current_user['name'] ?><small>Owner</small></p>
          </li>
          <li class="user-footer d-flex justify-content-between gap-2 p-2">
            <a href="<?= BASEURL . 'profile' ?>" class="btn btn-secondary flex-fill">
              Profile
            </a>
            <a href="<?= BASEURL . 'logout' ?>" class="btn btn-danger flex-fill">
              Logout
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>