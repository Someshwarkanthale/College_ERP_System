<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
</head>
<style>
  * {
    margin: 0;
    padding: 0;
    font-family: 'Montserrat', sans-serif;
  }

  .logo {
    width: 30% !important;
  }

  .logotop {
    width: 10% !important;
  }

  #canvas {
    width: 20%;
  }

  @media(max-width:576px) {
    #canvas {
      width: 50% !important;
    }

    .logo {
      width: 40% !important;
    }
  }

  @media(max-width:1200px) {
    #canvas {
      width: 30% !important;
    }

    .logo {
      width: 40% !important;
    }
  }

  @media(max-width:700px) {
    #canvas {
      width: 40% !important;
    }

    .logo {
      width: 40% !important;
    }
  }

  @media(max-width:480px) {
    #canvas {
      width: 70% !important;
    }

    .logo {
      width: 40% !important;
    }
  }


  .setpadding {
    padding-right: 0;
    padding-left: 0;
  }

  .topcenter {
    align-items: center !important;
  }

  .accordion-item {
    border: none !important;
  }

  .hvr1:hover {
    background: white !important;
  }

  .hvr:focus {
    box-shadow: none;
    color: black;
  }

  .search:focus {
    border: 1px solid red;
    outline: none;
    box-shadow: none;
  }

  .search :hover {
    border: 2px solid blue !important;
  }

  .makebld :hover {
    font-weight: bold;
  }

  @media (max-width:576px) {
    .wid100 {
      width: 100% !important;
    }
  }

  @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

  *,
  ::after,
  ::before {
    box-sizing: border-box;
  }

  body {
    font-family: 'Poppins', sans-serif;
    font-size: 0.875rem;
    opacity: 1;
    overflow-y: scroll;
    margin: 0;
  }

  a {
    cursor: pointer;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;

  }

  li {
    list-style: none;
  }

  h4 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.275rem;
    color: var(--bs-emphasis-color);
  }

  /* Layout for admin dashboard skeleton */

  .wrapper {
    align-items: stretch;
    display: flex;
    width: 100%;

  }

  #sidebar {
    max-width: 264px;
    min-width: 264px;
    background-color: #3C5B9D;
    transition: all 0.35s ease-in-out;
  }

  .main {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    min-width: 0;
    overflow: hidden;
    transition: all 0.35s ease-in-out;
    width: 100%;
    background: var(--bs-dark-bg-subtle);
  }

  /* Sidebar Elements Style */

  .sidebar-logo {
    padding: 1.15rem;
  }

  .sidebar-logo a {
    color: #e9ecef;
    font-size: 1.15rem;
    font-weight: 600;
  }

  .sidebar-nav {
    flex-grow: 1;
    list-style: none;
    margin-bottom: 0;
    padding-left: 0;
    margin-left: 0;

  }

  .sidebar-header {
    color: #e9ecef;
    font-size: .75rem;
    padding: 1.5rem 1.5rem .375rem;
  }

  a.sidebar-link {
    padding: .625rem 1.625rem;
    color: #e9ecef;
    position: relative;
    display: block;
    font-size: 0.875rem;
    text-decoration: none;


  }

  a:hover {
    background-color: #DDDDE1;
    color: black;
  }


  .sidebar-link[data-bs-toggle="collapse"]::after {
    border: solid;
    border-width: 0 .075rem .075rem 0;
    content: "";
    display: inline-block;
    padding: 2px;
    position: absolute;
    right: 1.5rem;
    top: 1.4rem;
    transform: rotate(-135deg);
    transition: all .2s ease-out;
  }

  .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
    transform: rotate(45deg);
    transition: all .2s ease-out;
  }

  .avatar {
    height: 40px;
    width: 40px;
  }

  .navbar-expand .navbar-nav {
    margin-left: auto;
  }

  .content {
    flex: 1;
    max-width: 100vw;
    width: 100vw;
  }

  @media (min-width:768px) {
    .content {
      max-width: auto;
      width: auto;
    }
  }

  .card {
    box-shadow: 0 0 .875rem 0 rgba(34, 46, 60, .05);
    /* margin-bottom: 24px; */
  }

  .illustration {
    background-color: var(--bs-primary-bg-subtle);
    color: var(--bs-emphasis-color);
  }

  .illustration-img {
    max-width: 150px;
    width: 100%;
  }

  /* Sidebar Toggle */

  #sidebar.collapsed {
    margin-left: -264px;
  }

  /* Footer and Nav */

  @media (max-width:767.98px) {

    .js-sidebar {
      margin-left: -264px;
    }

    #sidebar.collapsed {
      margin-left: 0;
    }

    .navbar,
    footer {
      width: 100vw;
    }
  }

  /* Theme Toggler */

  .theme-toggle {
    position: fixed;
    top: 50%;
    transform: translateY(-65%);
    text-align: center;
    z-index: 10;
    right: 0;
    left: auto;
    border: none;
    background-color: var(--bs-body-color);
  }

  html[data-bs-theme="dark"] .theme-toggle .fa-sun,
  html[data-bs-theme="light"] .theme-toggle .fa-moon {
    cursor: pointer;
    padding: 10px;
    display: block;
    font-size: 1.25rem;
    color: #FFF;
  }

  html[data-bs-theme="dark"] .theme-toggle .fa-moon {
    display: none;
  }

  html[data-bs-theme="light"] .theme-toggle .fa-sun {
    display: none;
  }

  .js-sidebar {
    position: -webkit-sticky;
    /* For Safari */
    position: sticky;
    top: 0;
    height: 100vh;
    /* Full height to keep it sticky on scroll */
    overflow-y: auto;
    /* Allow scrolling within the sidebar */
    z-index: 100;
    /* Ensure it stays on top */
  }
</style>

<body>



  <aside id="sidebar" class="js-sidebar">

    <!-- Content For Sidebar -->
    <div class="h-100">
      <div class="sidebar-logo bg-white ">
        <img src="<?php echo base_url('assets/Images/fee3.jpg') ?>" width="266px" height="75px" style="margin-top:-20px;margin-bottom:-20px;margin-left:-20px" >
      </div>
      
      <ul class="sidebar-nav">
        <!-- <h5 class="ms-3 mb-3 text-white fw-bold fs-1 m-auto">Dashboard</h5> -->
        <li class="sidebar-item ">
          <a href="<?php echo base_url('AdminPanel/Dashboard'); ?>" class="sidebar-link fs-5">
            <i class="fa fa-solid fa-house me-2"></i>
            Dashboard
          </a>
        </li>
        <li class="sidebar-item ">
          <a href="<?php echo base_url('AdminPanel/CourseFee'); ?>" class="sidebar-link fs-5">
            <i class="fa-solid fa-table me-3"></i>
            Courses & Fees
          </a>
        </li>
        <li class="sidebar-item ">
          <a href="<?php echo base_url('AdminPanel/Studentlist'); ?>" class="sidebar-link fs-5">
            <i class="fa-solid fa-users fs-5 me-2"></i>
            Fee Reports
          </a>
        </li>
        <li class="sidebar-item ">
          <a href="<?php echo base_url('AdminPanel/AddStudentForm'); ?>" class="sidebar-link fs-5">
            <i class="fa-solid fa-user-plus fs-5 me-2"></i>
            Add Student
          </a>
        </li>
      </ul>
    </div>
  </aside>


</body>

</html>