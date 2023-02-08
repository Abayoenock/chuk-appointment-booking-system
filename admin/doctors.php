<?php
session_start();
include '../backend/db_conn.php';

if (!($_SESSION['adminSession'])) {
    header("Location:./dashboard");
} else {

    $userID = $_SESSION['adminSession'];

    $sql = "SELECT * FROM admin WHERE adminID='$userID'";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $usernames = $row['firstname'] . " " . $row['lastname'];
    }
}
$profileImg = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/chart.js/Chart.min.css">
    <link rel="stylesheet" href="../assets/css/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="../assets/jquery/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="../assets/css/jquery-ui.css">
    <link rel="stylesheet" href="../assets/fileinput/css/fileinput.min.css">

    <style>
        .modal {
            max-width: 80% !important;
        }
    </style>


</head>

<body class="back0">
    <div class="  bg-gradient-to-b from-primary to-gray-900 backdrop-blur-sm    w-full h-screen overflow-hidden ">
        <!-- the top header -->
        <div class=" h-[50px] md:hidden w-full bg-transparent  backdrop-blur-sm flex flex-row  justify-between ">
            <div class=" text-center  justify-center items-center gap-2 h-full p-2 flex md:ml-[20px]">

                <span id="open-menu" class="block  md:hidden"><i class="fa-solid fa-bars-staggered text-white/90 text-4xl ml-2 mr-4 open-menu "></i></span>
                <img src="../img/devImgs/logo.png" class="w-8 aspect-square" alt="">
                <span class="font-bold text-white/70   ">CHUK</span>

            </div>
            <div class=" w-fit flex flex-row  items-center   mr-5 gap-4 ">

                <i class="fa-solid fa-user text-white/70 text-2xl"></i>
                <h3 class="userName  text-white/90 font-bold"> </h3>
            </div>
        </div>
        <!-- the top header -->
        <div class=" h-[50px] w-full bg-transparent  backdrop-blur-sm flex flex-row  justify-between ">
            <div class=" text-center  justify-center items-center gap-2 h-full p-2 flex md:ml-[20px]">




            </div>
            <div class=" w-fit flex flex-row  items-center   mr-5 gap-4 ">
                <i class="fa-solid fa-user text-white/70 text-3xl"></i>
                <h3 class="userName  text-white/90 font-bold"> </h3>
            </div>
        </div>
        <div class="flex  justify-center md:justify-start">
            <!-- side component -->
            <div class=" md:h-screen md:w-[250px] md:flex-col  md:bottom-0 md:px-0   fixed  left-0 md:backdrop-blur-sm backdrop-blur-md flex flex-col  z-10 w-[100%] h-[100vh] gap-8   top-0  items-center   self-center bg-primary/90 md:bg-transparent transition-all duration-300  -translate-x-[100%]  md:translate-x-0 menu " id="menu">

                <span id="close-menu" class="block  md:hidden"><i class="fa-solid fa-xmark text-4xl absolute right-4 top-4 text-red-600 close-menu "></i></span>

                <div class="flex flex-row space-x-4 items-center justify-center w-full mt-4 z-[999999]">
                    <div class="flex flex-col gap-4">
                        <a href="../home" class="flex">
                            <img src="../img/devImgs/logo.png" class="w-8 aspect-square" alt="">
                            <span class="font-bold text-white/70   ">CHUK</span>
                        </a>
                        <div class="flex gap-4  items-center">
                            <div id="icon">
                                <span>
                                    <i class="fa-solid fa-calendar-days text-white/80 text-3xl"></i>
                                </span>
                            </div>
                            <div>
                                <h4 class="text-2xl text-white/80 digital-clocks"></h4>
                                <p class="text-xs text-white/80 date-container"></p>


                            </div>
                        </div>

                    </div>




                </div>
                <ul class="flex flex-col w-full  h-[100vh]  z-[99999]">
                    <a href="dashboard" class=" relative ">
                        <li class="w-full flex  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group pl-4 gap-2 text-white py-6 ">

                            <i class="fa-solid fa-hospital   text-2xl transition-all duration-300 group-hover:-translate-y-1 group-hover:text-white/50 "></i>
                            <span class=" font-semibold transition-all text-sm duration-300 group-hover:-translate-y-1">Dashboard</span>


                        </li>
                    </a>

                    <a href="report" class=" relative ">
                        <li class="w-full flex  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group pl-4 gap-2  py-6 ">

                            <i class="fa-solid fa-notes-medical text-white  text-2xl transition-all duration-300 group-hover:-translate-y-1 group-hover:text-white/50 "></i>
                            <span class="text-white text-sm font-semibold transition-all duration-300 group-hover:-translate-y-1">Reports</span>


                        </li>
                    </a>
                    <a href="manage-doctors" class=" relative ">
                        <li class="w-full flex  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group pl-4 gap-2  py-6 active-link">

                            <i class="fa-solid fa-user-doctor text-white  text-2xl transition-all duration-300 group-hover:-translate-y-1 group-hover:text-white/50 "></i>
                            <span class="text-white text-sm font-semibold transition-all duration-300 group-hover:-translate-y-1">Manage Doctors</span>


                        </li>
                    </a>
                    <a href="manage-receptionist" class=" relative ">
                        <li class="w-full flex  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group pl-4 gap-2  py-6">

                            <i class="fa-solid fa-id-badge text-white  text-2xl transition-all duration-300 group-hover:-translate-y-1 group-hover:text-white/50 "></i>
                            <span class="text-white text-sm font-semibold transition-all duration-300 group-hover:-translate-y-1">Manage Receptionists</span>


                        </li>

                    </a>
                    <a href="manage-patients" class=" relative ">
                        <li class="w-full flex  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group pl-4 gap-2  py-6">

                            <i class="fa-solid fa-people-group text-white  text-2xl transition-all duration-300 group-hover:-translate-y-1 group-hover:text-white/50 "></i>
                            <span class="text-white text-sm font-semibold transition-all duration-300 group-hover:-translate-y-1">Manage patients</span>


                        </li>
                    </a>
                    <a href="manage-departments" class=" relative ">
                        <li class="w-full flex  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group pl-4 gap-2  py-6">

                            <i class="fa-solid fa-hospital text-white  text-2xl transition-all duration-300 group-hover:-translate-y-1 group-hover:text-white/50 "></i>
                            <span class="text-white text-sm font-semibold transition-all duration-300 group-hover:-translate-y-1">Manage Departments</span>


                        </li>
                    </a>





                    <a href="My-profile">
                        <li class="w-full flex  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group  pl-4 gap-2 py-8">
                            <i class="fa-solid text-white  fa-id-card-clip text-2xl transition-all duration-300 group-hover:-translate-y-1 group-hover:text-white/50"></i>
                            <span class="text-white font-semibold  text-sm transition-all duration-300 group-hover:-translate-y-1">Profile</span>

                        </li>
                    </a>



                </ul>
                <ul class=" flex self-start md:w-full  md:absolute md:bottom-12 z-[99999] ">

                    <a href="logout">
                        <li class="flex w-full  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group  pl-4 gap-2 py-6">
                            <i class="fa-solid fa-power-off text-2xl transition-all duration-300 group-hover:-translate-y-1 text-white group-hover:text-white/50"></i>
                            <span class="text-white font-semibold transition-all duration-300 group-hover:-translate-y-1 text-sm ">LogOut</span>
                        </li>
                    </a>
                </ul>

            </div>
            <div class=" w-full md:ml-[250px] bg-white  h-screen overflow-y-auto flex flex-col mainContainer pb-40 p-6 px-10 ">
                <?php
                if (@$_GET['t'] == '') {

                ?>
                    <div class="w-full flex flex-col gap-8 pending-cont">
                        <a href="manage-doctors?t=add-doctor" class="bg-gradient-to-r from-gray-700/70 to-blue-500/70  bg-primary   hover:bg-gradient-to-r hover:from-gray-400/40 hover:to-blue-500/40 transition eas duration-500 rounded-md px-8 py-2 text-gray-100 hover:shadow-xl w-fit   "> <i class="fas fa-user-plus    "></i> Add doctor</a>
                        <table id="table_id" class=" text-[10px] z-10 text-center  ">
                            <thead>
                                <tr class=" bg-primary text-white">
                                    <th>doctorID</th>
                                    <th>status</th>
                                    <th>Profile</th>
                                    <th>First name</th>
                                    <th>Last name </th>
                                    <th>Title</th>
                                    <th>specialization </th>
                                    <th>Email</th>
                                    <th>Phone number</th>
                                    <th>Department</th>
                                    <th>Date Added</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                <?php

                }
                ?>

                <?php
                if (@$_GET['t'] == 'add-doctor') {
                ?>

                    <a href="manage-doctors" class="bg-gradient-to-r from-gray-700/70 to-blue-500/70 bg-primary   hover:bg-gradient-to-r hover:from-gray-400/40 hover:to-blue-500/40 transition eas duration-500 rounded-md px-8 py-2 text-gray-100 hover:shadow-xl w-fit   "> <i class="fas fa-angle-double-left    "></i> View Doctors</a>
                    <form class="mt-8 mb-0 flex  gap-4 text-sm submit font-semibold" action="./backend/register-doc.php" method="POST" enctype="multipart/form-data">


                        <div class="flex  gap-4 ">
                            <div class="flex flex-col ">
                                <label for="user_image" class="text-gray-700 mb-4">Profile Image</label>
                                <div class="kv-avatar center-block" style="width:200px">
                                    <input id="avatar-2" name="user_image" type="file" class="file-loading">
                                </div>
                            </div>

                        </div>
                        <div class="flex flex-col w-full">
                            <div class="flex flex-col md:flex-row w-full gap-4 ">
                                <div class="flex flex-col w-full ">
                                    <label for="fname" class="text-gray-700">FirstName</label>
                                    <input type="text" name="firstName" id="fname" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter doctor's first  name" required>
                                </div>

                                <div class="flex flex-col w-full ">
                                    <label for="lname" class="text-gray-700">LastName</label>
                                    <input type="text" name="lastName" id="lname" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter doctor's last name" required>
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row w-full gap-4 ">
                                <div class="flex flex-col w-full ">
                                    <label for="title" class="text-gray-700">Title</label>
                                    <input type="text" name="title" id="title" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter the doctor title " required>
                                </div>

                                <div class="flex flex-col w-full ">
                                    <label for="specialization" class="text-gray-700">Specialization</label>
                                    <input type="text" name="specialization" id="specialization" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter the doctor title " required>
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row w-full gap-4 ">
                                <div class="flex flex-col w-full relative">
                                    <label for="email" class="text-gray-700">Email</label>
                                    <input type="email" name="email" id="nid" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your Identification number  " title="" required>

                                </div>

                                <div class="flex flex-col w-full relative ">
                                    <label for="phoneNumber" class="text-gray-700">Phone Number</label>
                                    <input type="tel" name="phoneNumber" id="phoneNumber" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your phone number" pattern="[0-9]{10}" title="Please Rwandan phone number Minus the country code" required>
                                    <div class="absolute right-3 mt-8 hidden "><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row w-full gap-4 ">
                                <div class="flex flex-col w-full ">
                                    <label for="department" class="text-gray-700">Department</label>
                                    <select id="department" name="department" data-name="department" required="" ms-field="department" data-parsley-required-message="Please let us know your department." class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900">
                                        <option value="">Select one...</option>
                                        <?php
                                        $sql = "SELECT * FROM department";
                                        $exe = $conn->query($sql);
                                        while ($row = $exe->fetch_array()) {
                                        ?>
                                            <option value="<?php echo $row['dept_ID'] ?>"><?php echo $row['departmentName'] ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>


                            </div>




                            <div class="my-4 mb-0 flex items-center justify-end space-x-4">
                                <button class="bg-gradient-to-r from-green-400/70 to-blue-500/70 submit-btn  hover:bg-primary/80   hover:bg-gradient-to-r hover:from-blue-400/70 hover:to-green-500/70 transition eas duration-500 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl  uppercase resister-btn">Create Account &nbsp <i class="fas fa-spinner animate-spin invisible" aria-hidden="true"></i> </button>
                            </div>
                        </div>

                    </form>
                <?php
                }
                ?>

                <?php
                if (@$_GET['t'] == 'edit-doctor') {
                    $doctorID = $_GET['doc'];
                    $sql = "SELECT * FROM doctors AS d INNER JOIN department AS dp on d.departmentID=dp.dept_ID WHERE doctorID='$doctorID' ";
                    $exe = $conn->query($sql);
                    $data = array();
                    while ($row = $exe->fetch_array()) {
                        $data = $row;
                    }
                    $profileImg = $data['profileImg']
                ?>

                    <a href="manage-doctors" class="bg-gradient-to-r from-gray-700/70 to-blue-500/70 bg-primary   hover:bg-gradient-to-r hover:from-gray-400/40 hover:to-blue-500/40 transition eas duration-500 rounded-md px-8 py-2 text-gray-100 hover:shadow-xl w-fit   "> <i class="fas fa-angle-double-left    "></i> View Doctors</a>

                    <div class="flex w-full gap-12">
                        <form class="mt-8 mb-0 flex flex-col  gap-4 text-sm submit1 font-semibold" action="./backend/update-img.php?t=doctors&fname=profileImg&id=<?php echo $doctorID ?>&img=<?php echo $profileImg ?>&fid=doctorID" method="POST" enctype="multipart/form-data">


                            <div class="flex  gap-4 ">
                                <div class="flex flex-col ">
                                    <label for="user_image" class="text-gray-700 mb-4">Profile Image</label>
                                    <div class="kv-avatar center-block" style="width:200px">
                                        <input id="avatar-2" name="user_image" type="file" class="file-loading">
                                    </div>
                                </div>

                            </div>
                            <div class=" mb-0 flex items-center justify-end space-x-4">
                                <button class="bg-gradient-to-r from-green-400/70 to-blue-500/70 h-fit  hover:bg-primary/80   hover:bg-gradient-to-r hover:from-blue-400/70 hover:to-green-500/70 transition eas duration-500 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl resister-btn1"> <i class="fa fa-upload" aria-hidden="true"></i> Update &nbsp <i class="fas fa-spinner animate-spin invisible" aria-hidden="true"></i> </button>
                            </div>
                        </form>
                        <form class="mt-12 mb-0 flex  gap-4 text-sm submit2 font-semibold w-full" action="./backend/edit-doctor.php?id=<?php echo $doctorID; ?>" method="POST" enctype="multipart/form-data">
                            <div class="flex flex-col w-full">
                                <div class="flex flex-col md:flex-row w-full gap-4 ">
                                    <div class="flex flex-col w-full ">
                                        <label for="fname" class="text-gray-700">FirstName</label>
                                        <input type="text" name="firstName" id="fname" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter doctor's first  name" value="<?php echo $data['firstname'] ?>" required>
                                    </div>

                                    <div class="flex flex-col w-full ">
                                        <label for="lname" class="text-gray-700">LastName</label>
                                        <input type="text" name="lastName" id="lname" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter doctor's last name" value=" <?php echo $data['lastname'] ?>" required>
                                    </div>
                                </div>
                                <div class="flex flex-col md:flex-row w-full gap-4 ">
                                    <div class="flex flex-col w-full ">
                                        <label for="title" class="text-gray-700">Title</label>
                                        <input type="text" name="title" id="title" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter the doctor title " value=" <?php echo $data['title'] ?>" required>
                                    </div>

                                    <div class="flex flex-col w-full ">
                                        <label for="specialization" class="text-gray-700">Specialization</label>
                                        <input type="text" name="specialization" id="specialization" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter the doctor title " value=" <?php echo $data['specialization'] ?>" required>
                                    </div>
                                </div>
                                <div class="flex flex-col md:flex-row w-full gap-4 ">
                                    <div class="flex flex-col w-full relative">
                                        <label for="email" class="text-gray-700">Email</label>
                                        <input type="email" name="email" id="nid" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your Identification number  " value=" <?php echo $data['email'] ?>" title="" required>

                                    </div>

                                    <div class="flex flex-col w-full relative ">
                                        <label for="phoneNumber" class="text-gray-700">Phone Number</label>
                                        <input type="tel" name="phoneNumber" id="phoneNumber" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your phone number" pattern="[0-9]{10}" title="Please Rwandan phone number Minus the country code" value="<?php echo $data['phoneNumber'] ?>" required>
                                        <div class="absolute right-3 mt-8 hidden "><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col md:flex-row w-full gap-4 ">
                                    <div class="flex flex-col w-full ">
                                        <label for="department" class="text-gray-700">Department</label>
                                        <select id="department" name="department" data-name="department" required="" ms-field="department" data-parsley-required-message="Please let us know your department." class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900">
                                            <option>Select one...</option>

                                            <?php
                                            $sql = "SELECT * FROM department";
                                            $exe = $conn->query($sql);
                                            while ($row = $exe->fetch_array()) {
                                            ?>
                                                <option value="<?php echo $row['dept_ID'] ?>" <?php echo  $row['dept_ID'] == $data['departmentID'] ? "selected" : ""; ?>><?php echo $row['departmentName'] ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>


                                </div>




                                <div class="my-4 mb-0 flex items-center justify-end space-x-4">
                                    <button class="bg-gradient-to-r from-green-400/70 to-blue-500/70  hover:bg-primary/80   hover:bg-gradient-to-r hover:from-blue-400/70 hover:to-green-500/70 transition eas duration-500 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl  uppercase resister-btn">Create Account &nbsp <i class="fas fa-spinner animate-spin invisible" aria-hidden="true"></i> </button>
                                </div>
                            </div>

                        </form>
                    </div>
                <?php
                }
                ?>

            </div>



















        </div>




    </div>








    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js"></script>
    <!-- <script src="../assets/dist/js/dashboard.js"></script> -->
    <script src="../assets/js/sweetalert2.min.js"></script>
    <script src="../assets/js/toastr.min.js"></script>
    <script src="../assets/js/jquery-ui.js"></script>
    <!-- file input -->
    <script src="../assets/fileinput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
    <script src="../assets/fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>
    <script src="../assets/fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
    <script src="../assets/fileinput/js/fileinput.min.js"></script>

    <script>
        $(function() {
            $("#datepicker").datepicker({
                changeMonth: true,
                changeYear: true
            });
        });
        clockUpdate();

        setInterval(clockUpdate, 1000);


        $(".modal").modal({
            fadeDuration: 100
        });


        function clockUpdate() {
            var date = new Date();

            function addZero(x) {
                if (x < 10) {
                    return x = '0' + x;
                } else {
                    return x;
                }
            }

            var year = addZero(date.getFullYear());
            var day = date.getDay();
            switch (day) {
                case 1:
                    day = "Mon "
                    break;
                case 2:
                    day = "Tue "
                    break;

                case 3:
                    day = "Wed "
                    break;
                case 4:
                    day = "Thur "
                    break;
                case 5:
                    day = "Fri "
                    break;
                case 6:
                    day = "Sat "
                    break;
                case 0:
                    day = "Sun "
                    break;

                default:
                    break;
            }
            var month = addZero(date.getMonth() + 1);
            var dat = addZero(date.getDate());
            var h = addZero(date.getHours());
            var m = addZero(date.getMinutes());
            var s = addZero(date.getSeconds());

            $('.digital-clocks').text(h + ':' + m + ':' + s)
            $('.date-container').text(day + ' ' + dat + ' - ' + month + ' - ' + year);
        }
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        })
        var placeHolderImg = "<?php echo  !@$_GET['doc'] ? "<img src='../img/profiles/avatar.jpg' alt='Your Avatar' style='width:160px'><h6 class='text-muted'>Click to select</h6>" : "<img src='../img/profiles/$profileImg' alt='Your Avatar' style='width:160px'><h6 class='text-muted'>Click to select</h6>" ?>"
        var btnCust = '';
        $("#avatar-2").fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            showBrowse: false,
            browseOnZoneClick: true,
            removeLabel: '',
            removeIcon: '<i class="fas fa-trash-alt remove-img"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-2',
            msgErrorClass: 'alert  alert-danger',
            defaultPreviewContent: placeHolderImg,
            layoutTemplates: {
                main2: '{preview} ' + btnCust + ' {remove} {browse}'
            },
            allowedFileExtensions: ["jpg", "png", "gif"]
        });

        <?php
        if (@$_GET['t'] == 'add-doctor') {
        ?>
            // Get references to the form and submit button
            const form = document.querySelector(".submit");
            const submitButton = document.querySelector(".submit-btn");
            form.addEventListener("submit", async (event) => {
                event.preventDefault();
                submitButton.disabled = true;
                $(".fa-spinner").toggleClass("invisible");
                const formData = new FormData(form);

                const response = await fetch("./backend/register-doc.php", {
                    method: "POST",
                    body: formData,
                });

                const jsonData = await response.json();
                console.log(jsonData); // this will log the json data received from the server
                submitButton.disabled = false;
                if (jsonData.success == true) {

                    Toast.fire({
                        icon: 'success',
                        title: jsonData.messages
                    })
                    console.log(jsonData);
                    $("input,select").val("");
                    $(".fileinput-remove").click()
                    $(".fa-spinner").toggleClass("invisible");

                    Swal.fire({
                        title: 'Sending SMS   .......',
                        ///  html: 'Sending Sms', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading()
                        },
                    });

                    // send the sms 
                    const options = {
                        method: 'POST',
                        body: new URLSearchParams({
                            phoneNumber: "+25" + jsonData.phoneNumber,
                            msg: `${jsonData.sendSms}`
                        })
                    };
                    const sendSms = () => {
                        fetch('../send-sms.php', options)
                            .then(response => response.json())
                            .then(response => {
                                console.log(response)
                                const st = response;
                                console.log(st.status);

                                if (st.status == "success") {
                                    swal.close();

                                    Swal.fire(
                                        'SMS Sent successfuly',
                                        'The SMS containing the password for the user  has been successfuly  sent  ',
                                        'success'
                                    )

                                } else {
                                    swal.close();

                                    Swal.fire({
                                        title: 'SMS error ',
                                        text: "The sms has not been sent , but you can try again by clicking on the resend button ",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Yes, Resend it !'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            Swal.fire({

                                                title: 'Resending SMS .......',
                                                ///  html: 'Sending Sms', // add html attribute if you want or remove
                                                allowOutsideClick: false,
                                                showConfirmButton: false,
                                                willOpen: () => {
                                                    Swal.showLoading()
                                                },
                                            });
                                            sendSms();

                                        }
                                    })
                                }
                            })
                            .catch(err => console.error(err));
                    }
                    sendSms();



                } else {

                    Toast.fire({
                        icon: 'error',
                        title: jsonData.messages
                    })

                    $(".fa-spinner").toggleClass("invisible");


                }



            });


        <?php
        } ?>


        // $(".submit").unbind('submit').bind('submit', function() {

        //     $(".resister-btn").attr("disabled", true);
        //     var form = $(this);
        //     $(".fa-spinner").toggleClass("invisible");

        //     var formData = new FormData($(this)[0]);
        //     $.ajax({
        //         url: form.attr('action'),
        //         type: form.attr('method'),
        //         data: formData,
        //         dataType: 'json',
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         async: false,
        //         success: function(response) {
        //             if (response.success == true) {

        //                 Toast.fire({
        //                     icon: 'success',
        //                     title: response.messages
        //                 })

        //                 $("input,select").val("");
        //                 $(".fileinput-remove").click()
        //                 $(".fa-spinner").toggleClass("invisible");



        //             } else {
        //                 $(".resister-btn").removeAttr("disabled");
        //                 Toast.fire({
        //                     icon: 'error',
        //                     title: response.messages
        //                 })
        //                 setTimeout(() => {
        //                     $(".fa-spinner").toggleClass("invisible");
        //                 }, 1000);

        //             }

        //         }
        //     });

        //     return false;
        // });

        $(".submit2").unbind('submit').bind('submit', function() {

            $(".resister-btn").attr("disabled", true);
            var form = $(this);
            $(".fa-spinner").toggleClass("invisible");

            var formData = new FormData($(this)[0]);
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                async: false,
                success: function(response) {
                    if (response.success == true) {

                        Toast.fire({
                            icon: 'success',
                            title: response.messages
                        })

                        $(".fa-spinner").toggleClass("invisible");



                    } else {
                        $(".resister-btn").removeAttr("disabled");
                        Toast.fire({
                            icon: 'error',
                            title: response.messages
                        })
                        setTimeout(() => {
                            $(".fa-spinner").toggleClass("invisible");
                        }, 1000);

                    }

                }
            });

            return false;
        });



        $(".submit1").unbind('submit').bind('submit', function() {

            $(".resister-btn1").attr("disabled", true);
            var form = $(this);
            $(".fa-spinner").toggleClass("invisible");

            var formData = new FormData($(this)[0]);
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                async: false,
                success: function(response) {
                    if (response.success == true) {

                        Toast.fire({
                            icon: 'success',
                            title: response.messages
                        })


                        $(".fa-spinner").toggleClass("invisible");



                    } else {
                        $(".resister-btn1").removeAttr("disabled");
                        Toast.fire({
                            icon: 'error',
                            title: response.messages
                        })
                        setTimeout(() => {
                            $(".fa-spinner").toggleClass("invisible");
                        }, 1000);

                    }

                }
            });

            return false;
        });

        const menu = document.querySelector("#menu")
        const openMenu = document.querySelector("#open-menu")
        const closeMenu = document.querySelector("#close-menu")

        openMenu.addEventListener('click', () => {
            menu.classList.add('translate-x-0')
        })
        closeMenu.addEventListener('click', () => {
            menu.classList.remove('translate-x-0')
        })

        const loadUsers = () => {
            fetch("./backend/users.php?t=doctors")
                .then((resp) => {
                    return resp.json();
                }).then((backData) => {
                    const gotData = backData;
                    if ($.fn.DataTable.isDataTable('#table_id')) {
                        $('#table_id').DataTable().destroy();
                    }
                    var table = $('#table_id').DataTable({
                        data: gotData,
                        columns: [{
                                data: 'doctorID',
                                visible: false,


                            },
                            {
                                data: 'status',
                                visible: false,


                            },

                            {
                                data: 'profileImg',
                                render: (img) => {
                                    return `<img src="../img/profiles/${img}" width="50px" height="50px" alt=""> `


                                }


                            },
                            {
                                data: 'firstname',


                            },
                            {
                                data: 'lastname',


                            },
                            {
                                data: 'title',


                            },
                            {
                                data: 'specialization',


                            },
                            {
                                data: 'email',


                            },
                            {
                                data: 'phoneNumber',


                            },
                            {
                                data: 'departmentName',


                            },


                            {
                                data: 'dateAddded',
                                render: (dateRegistered) => {
                                    let date = new Date(dateRegistered * 1000);
                                    let month = addZero(date.getMonth() + 1);

                                    function addZero(x) {
                                        if (x < 10) {
                                            return x = '0' + x;
                                        } else {
                                            return x;
                                        }
                                    }

                                    return (`${addZero(date.getDate())}-${month} -${date.getFullYear()}  ${addZero(date.getHours())}:${addZero(date.getMinutes())} :${addZero(date.getSeconds())}`)

                                }

                            },


                            {
                                data: '',


                                render: (data, type, row, meta) => {
                                    if (row.status == 1) {
                                        return ` <div class="flex gap-2"> <span class="trash-btn px-3 py-2 flex justify-center items-center rounded-md cursor-pointer bg-red-400 text-white" data-id=${row.doctorID} ><i class="fa-solid fa-trash-alt text-sm "></i></span>
                                            <span class="edit-btn px-3 py-2 flex justify-center items-center  rounded-md cursor-pointer bg-primary text-white" data-id=${row.doctorID} ><i class="fa-solid fa-edit text-sm "></i></span>
                                            
                                            <span class="lock-btn px-3 py-2 flex justify-center items-center  rounded-md cursor-pointer bg-green-400 text-white" data-id=${row.doctorID} ><i class="fa-solid fa-house-medical-circle-check text-sm "></i></span>
                                            </div>`
                                    } else {
                                        return ` <div class="flex gap-2"> <span class="trash-btn px-3 py-2 flex justify-center items-center rounded-md cursor-pointer bg-red-400 text-white" data-id=${row.doctorID} ><i class="fa-solid fa-trash-alt text-sm "></i></span>
                                            <span class="edit-btn px-3 py-2 flex justify-center items-center  rounded-md cursor-pointer bg-primary text-white" data-id=${row.doctorID} ><i class="fa-solid fa-edit text-sm "></i></span>
                                            
                                            <span class="unlock-btn px-3 py-2 flex justify-center items-center  rounded-md cursor-pointer bg-pink-400 text-white" data-id=${row.doctorID} ><i class="fa-solid fa-house-medical-circle-xmark text-sm "></i></span>
                                            </div>`


                                    }


                                }

                            }

                            ,








                        ],
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'copyHtml5',
                                text: '<i class="fa-regular fa-copy"></i>',
                                titleAttr: 'Copy'
                            },
                            {
                                extend: 'excelHtml5',
                                text: '<i class="fa-regular fa-file-excel"></i>',
                                titleAttr: 'Excel'
                            },
                            {
                                extend: 'csvHtml5',
                                text: '<i class="fa-solid fa-file-csv"></i>',
                                titleAttr: 'CSV'
                            },
                            {
                                extend: 'pdfHtml5',
                                text: '<i class="fa-solid fa-file-pdf"></i>',
                                titleAttr: 'PDF'
                            }

                        ]

                    });
                    $(".trash-btn").click(function() {
                        let dataId = $(this).attr("data-id");
                        let userData = backData.filter((data) => {
                            return data.doctorID == dataId;
                        })
                        console.log(userData);
                        Swal.fire({
                            icon: 'question',
                            text: `Are you sure you want to delete ${userData[0].firstname}  ${userData[0].lastname} keep in mind that deleting this user will also delete all the data associated wih this user`,

                            showCancelButton: true,
                            confirmButtonText: 'Delete User',

                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                fetch("./backend/delUser.php?&table=doctors&idName=doctorID&id=" + dataId)
                                    .then((resp) => {
                                        return resp.json();
                                    }).then((backData) => {
                                        const gotData = backData;
                                        if (gotData.success == true) {
                                            Swal.fire(gotData.messages, '', 'success');
                                            setTimeout(() => {
                                                loadUsers()
                                            }, 1000);
                                        } else {
                                            Swal.fire(gotData.messages, '', 'error');
                                        }

                                    })




                            } else if (result.isDenied) {
                                Swal.fire('Changes are not saved', '', 'info')
                            }
                        })





                    })

                    $(".lock-btn").click(function() {
                        let dataId = $(this).attr("data-id");
                        let userData = backData.filter((data) => {
                            return data.doctorID == dataId;
                        })
                        console.log(userData);
                        Swal.fire({
                            icon: 'question',
                            text: `Are you sure you want to lock  ${userData[0].firstname}  ${userData[0].lastname}  from accessing this system`,

                            showCancelButton: true,
                            confirmButtonText: 'Block  User',

                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                fetch("./backend/blockUser.php?&table=doctors&idName=doctorID&fieldName=status&status=1&id=" + dataId)
                                    .then((resp) => {
                                        return resp.json();
                                    }).then((backData) => {
                                        const gotData = backData;
                                        if (gotData.success == true) {
                                            Swal.fire(gotData.messages, '', 'success');
                                            setTimeout(() => {
                                                loadUsers()
                                            }, 1000);
                                        } else {
                                            Swal.fire(gotData.messages, '', 'error');
                                        }

                                    })




                            } else if (result.isDenied) {
                                Swal.fire('Changes are not saved', '', 'info')
                            }
                        })





                    })
                    $(".unlock-btn").click(function() {
                        let dataId = $(this).attr("data-id");
                        let userData = backData.filter((data) => {
                            return data.doctorID == dataId;
                        })
                        console.log(userData);
                        Swal.fire({
                            icon: 'question',
                            text: `Are you sure you want to allow   ${userData[0].firstname}  ${userData[0].lastname}  to  accessing this system`,

                            showCancelButton: true,
                            confirmButtonText: 'Unblock  User',

                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                fetch("./backend/blockUser.php?&table=doctors&idName=doctorID&fieldName=status&status=0&id=" + dataId)
                                    .then((resp) => {
                                        return resp.json();
                                    }).then((backData) => {
                                        const gotData = backData;
                                        if (gotData.success == true) {
                                            Swal.fire(gotData.messages, '', 'success');
                                            setTimeout(() => {
                                                loadUsers()
                                            }, 1000);
                                        } else {
                                            Swal.fire(gotData.messages, '', 'error');
                                        }

                                    })




                            } else if (result.isDenied) {
                                Swal.fire('Changes are not saved', '', 'info')
                            }
                        })





                    })
                    $(".edit-btn").click(function() {
                        let dataId = $(this).attr("data-id");
                        let userData = backData.filter((data) => {
                            return data.doctorID == dataId;
                        })
                        console.log(userData);
                        Swal.fire({
                            icon: 'question',
                            text: `Are you sure you want to edit   ${userData[0].firstname}  ${userData[0].lastname}  Account`,

                            showCancelButton: true,
                            confirmButtonText: 'Edit User',

                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                window.location = "?t=edit-doctor&doc=" + dataId



                            } else if (result.isDenied) {
                                Swal.fire('Changes are not saved', '', 'info')
                            }
                        })





                    })

                })
        }
        loadUsers();
    </script>


</body>

</html>