<nav class="navbar navbar-expand px-3 border-bottom">
    <button class="btn" id="sidebar-toggle" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse navbar">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                    <i class="fa fa-solid fa-user fa-lg text-muted">
                        &nbsp; <?php echo $this->session->userdata('username'); ?>
                    </i>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="<?php echo base_url('AdminPanel/logout'); ?>" class="dropdown-item">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
