<?php
session_start();
include '../backend/db_conn.php';

if (!($_SESSION['adminSession'])) {
    header("Location: ./");
} else {

    $userID = $_SESSION['adminSession'];

    $sql = "SELECT * FROM admin WHERE adminID='$userID'";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $usernames = $row['firstname'] . " " . $row['lastname'];
    }
}

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


    <style>
        .modal {
            max-width: 80% !important;
        }

        #myChart3 {
            width: 300px !important;
            height: 300px !important;
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
                        <li class="w-full flex  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group pl-4 gap-2 text-white py-6 active-link">

                            <i class="fa-solid fa-hospital   text-2xl transition-all duration-300 group-hover:-translate-y-1 group-hover:text-white/50 "></i>
                            <span class=" font-semibold transition-all text-sm duration-300 group-hover:-translate-y-1">Dashboard</span>


                        </li>
                    </a>

                    <a href="report" class=" relative ">
                        <li class="w-full flex  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group pl-4 gap-2  py-6">

                            <i class="fa-solid fa-notes-medical text-white  text-2xl transition-all duration-300 group-hover:-translate-y-1 group-hover:text-white/50 "></i>
                            <span class="text-white text-sm font-semibold transition-all duration-300 group-hover:-translate-y-1">Reports</span>


                        </li>
                    </a>
                    <a href="manage-doctors" class=" relative ">
                        <li class="w-full flex  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group pl-4 gap-2  py-6">

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
            <div class=" w-full md:ml-[250px] bg-white  h-screen overflow-y-auto flex flex-col mainContainer pb-40 ">
                <div class=" w-full  grid grid-cols-2  md:grid-cols-4 gap-3 p-6">
                    <div class="p-6 flex flex-col bg-gradient-to-r from-green-400/70 to-blue-500/70  backdrop-blur-sm rounded-md shadow-md  h-fit relative items-center">
                        <h6 class="text-white text-sm font-semibold">Registered Doctors</h6>


                        <i class="fa-solid fa-user-doctor  text-[70px] bottom-1  left-2 text-slate-200/40 absolute -z-10"></i>
                        <b class="text-3xl text-white/80 doctors">&nbsp</b>
                        <ul class="circles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>

                    </div>
                    <div class="p-6 flex flex-col bg-gradient-to-r from-blue-500/70 to-green-400/70 backdrop-blur-sm rounded-md shadow-md  h-fit relative items-center">
                        <h6 class="text-white text-sm font-semibold">Registered receptionists</h6>


                        <i class="fa-solid fa-clipboard-user  text-[70px] bottom-1  left-2 text-slate-200/40 absolute -z-10"></i>
                        <b class="text-3xl text-white/80 receptionists">&nbsp</b>
                        <ul class="circles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>

                    </div>
                    <div class="p-6 flex flex-col bg-gradient-to-r from-yellow-500/70 to-indigo-400/70 backdrop-blur-sm rounded-md shadow-md  h-fit relative items-center">
                        <h6 class="text-white text-sm font-semibold">Registered Patients</h6>


                        <i class="fa-solid fa-user-doctor  text-[70px] bottom-1  left-2 text-slate-200/40 absolute -z-10"></i>
                        <b class="text-3xl text-white/80 patients">&nbsp</b>
                        <ul class="circles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>

                    </div>
                    <div class="p-6 flex flex-col bg-gradient-to-r from-indigo-400/70 to-yellow-500/30 backdrop-blur-sm rounded-md shadow-md  h-fit relative items-center">
                        <h6 class="text-white text-sm font-semibold">Registered Admins</h6>


                        <i class="fa-solid fa-user-secret  text-[70px] bottom-1  left-2 text-slate-200/40 absolute -z-10"></i>
                        <b class="text-3xl text-white/80 admins">0</b>
                        <ul class="circles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>

                    </div>

                    <div class="p-6 flex flex-col bg-gradient-to-r from-indigo-700/70 to-purple-300/70 backdrop-blur-sm rounded-md shadow-md  h-fit relative items-center">
                        <h6 class="text-white text-sm  font-semibold">Processed Appointments</h6>

                        <i class="fa-solid fa-notes-medical  text-[70px] bottom-1  left-2 text-slate-200/40 absolute -z-10"></i>
                        <div class="flex gap-3 mt-3">
                            <span class="flex justify-center items-center gap-2">
                                <b class="text-xs processed_confirmed"></b>
                                <i class="fa-solid fa-house-medical-circle-check text-green-700 text-2xl"></i> </span>
                            <span class="flex justify-center items-center gap-2">
                                <b class="text-xs  processed_cancel"> </b>
                                <i class="fa-solid fa-house-medical-circle-xmark text-red-700 text-2xl"></i>
                            </span>


                        </div>
                        <ul class="circles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>

                    </div>
                    <div class="p-6 flex flex-col bg-gradient-to-r from-green-400/70 to-pink-300/70 bg-primary backdrop-blur-sm rounded-md shadow-md  h-fit relative items-center">
                        <h6 class="text-white text-sm font-semibold ">Upcoming Appointments</h6>

                        <i class="fa-solid fa-laptop-medical text-[70px] bottom-1  left-2 text-slate-200/40 absolute -z-10"></i>
                        <div class="flex gap-3 mt-3">
                            <span class="flex justify-center items-center gap-2">
                                <b class="text-xs upcomming_confirmed"></b>
                                <i class="fa-solid fa-house-medical-circle-check text-green-700 text-2xl"></i> </span>
                            <span class="flex justify-center items-center gap-2">
                                <b class="text-xs  upcomming_cancel"></b>
                                <i class="fa-solid fa-house-medical-circle-xmark text-red-700 text-2xl"></i>
                            </span>
                            <span class="flex justify-center items-center gap-2">
                                <b class="text-xs  upcomming_pending"></b>
                                <i class="fa-solid fa-house-medical-circle-exclamation text-yellow-600 text-2xl "></i>

                            </span>

                        </div>

                        <ul class="circles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="p-6 flex flex-col bg-gradient-to-r from-green-400/70 to-indigo-700/70 bg-primary/40 backdrop-blur-sm rounded-md shadow-md  h-fit relative items-center">
                        <h6 class="text-white text-sm">Today's Appointments</h6>

                        <i class="fa-solid fa-hospital text-[70px] bottom-1  left-2 text-slate-200/40 absolute -z-10"></i>
                        <div class="flex gap-3 mt-3">
                            <span class="flex justify-center items-center gap-2">
                                <b class="text-xs today_confirmed"></b>
                                <i class="fa-solid fa-house-medical-circle-check text-green-700 text-2xl"></i> </span>
                            <span class="flex justify-center items-center gap-2">
                                <b class="text-xs  today_cancel"> </b>
                                <i class="fa-solid fa-house-medical-circle-xmark text-red-700 text-2xl"></i>
                            </span>


                        </div>
                        <ul class="circles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>

                    </div>
                </div>


                <div class="flex flex-col md:flex-row gap-2 w-full">
                    <div class="w-1/2 flex flex-col items-center justify-center  h-fit  px-4  gap-4">
                        <div class="bg-primary/10 flex flex-col justify-center items-center   backdrop-blur-sm shadow-xl p-3  w-full rounded-md gap-4">
                            <div class="flex justify-between w-full items-center">
                                <h2 class=" font-semibold"><i class="fa-solid fa-chart-line"></i> &nbsp;Departmental appointment<br>Approved statistics</h2> <select name="year" id="GraphYearApproved" class="p-2 px-3 rounded-md outline-none focus:outline-none ">
                                    <option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
                                    <?php
                                    $i = 1;
                                    while ($i <= 5) {
                                    ?>
                                        <option value="<?php echo date("Y") - $i; ?>"><?php echo date("Y") - $i; ?></option>
                                    <?php
                                        $i++;
                                    }

                                    ?>
                                </select>
                            </div>
                            <canvas id="myChart3" class=" w-30 h-30   rounded-sm   "></canvas>
                        </div>
                        <div class="bg-primary/10 w-full   backdrop-blur-sm shadow-xl p-3 rounded-md">
                            <div class="flex justify-between items-center">
                                <h2 class=" font-semibold"><i class="fa-solid fa-chart-line"></i> &nbsp;User Registration statistics</h2> <select name="year" id="GraphYearRegistration" class="p-2 px-3 rounded-md outline-none focus:outline-none ">
                                    <option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
                                    <?php
                                    $i = 1;
                                    while ($i <= 5) {
                                    ?>
                                        <option value="<?php echo date("Y") - $i; ?>"><?php echo date("Y") - $i; ?></option>
                                    <?php
                                        $i++;
                                    }

                                    ?>
                                </select>
                            </div>

                            <canvas id="myChart4" class="  rounded-sm  w-full "></canvas>
                        </div>

                    </div>



                    <div class=" mt-0  w-full md:w-1/2 flex flex-col gap-3 px-4">
                        <div class="full flex items-center gap-8  justify-end">
                            <label for="">Department </label>
                            <select name="year" id="selectDepartment" class="p-2 px-3 rounded-md border border-primary outline-none focus:outline-none ">
                                <option value="0">All</option>
                                <?php
                                $sql = "SELECT * FROM department ";
                                $exe = $conn->query($sql);
                                while ($row = $exe->fetch_array()) {
                                ?>
                                    <option value="<?php echo $row['dept_ID']; ?>"><?php echo $row['departmentName'] ?></option>
                                <?php

                                }

                                ?>
                            </select>
                        </div>
                        <div class="bg-primary/10   backdrop-blur-sm shadow-xl px-8 py-6 rounded-md">
                            <div class="flex justify-between items-center">
                                <h2 class=" font-semibold"><i class="fa-solid fa-chart-line"></i> &nbsp;Annual Appointments Stastics</h2> <select name="year" id="GraphYear" class="p-2 px-3 rounded-md outline-none focus:outline-none ">
                                    <option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
                                    <?php
                                    $i = 1;
                                    while ($i <= 5) {
                                    ?>
                                        <option value="<?php echo date("Y") - $i; ?>"><?php echo date("Y") - $i; ?></option>
                                    <?php
                                        $i++;
                                    }

                                    ?>
                                </select>
                            </div>

                            <canvas id="myChart" class="  rounded-sm  w-full "></canvas>
                        </div>
                        <div class="bg-primary/10   backdrop-blur-sm shadow-xl px-8 py-6 rounded-md">

                            <div class="flex justify-between items-center">
                                <h2 class=" font-semibold"><i class="fa-solid fa-chart-line"></i> &nbsp; Monthly Appointment Stistics</h2>
                                <div class="flex gap-2 w-fit">
                                    <select name="year" id="GraphMonth" class="p-2 px-3 rounded-md outline-none focus:outline-none ">
                                        <option value="<?php echo date("m"); ?>"><?php echo date("M"); ?></option>
                                        <?php
                                        $i = 1;
                                        while ($i <= 12) {
                                        ?>
                                            <option value="<?php echo $i; ?>"><?php echo date("M", strtotime("01-" . $i . "-2000")); ?></option>
                                        <?php
                                            $i++;
                                        }

                                        ?>
                                    </select>
                                    <select name="month" id="GraphYear2" class="p-2 px-3 rounded-md outline-none focus:outline-none ">
                                        <option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
                                        <?php
                                        $i = 1;
                                        while ($i <= 5) {
                                        ?>
                                            <option value="<?php echo date("Y") - $i; ?>"><?php echo date("Y") - $i; ?></option>
                                        <?php
                                            $i++;
                                        }

                                        ?>
                                    </select>

                                </div>

                            </div>
                            <canvas id="myChart2" class="  rounded-sm  w-full "></canvas>
                        </div>




                    </div>

                </div>

            </div>



















        </div>




    </div>








    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js"></script>
    <!-- <script src="../assets/dist/js/dashboard.js"></script> -->
    <script src="../assets/js/sweetalert2.min.js"></script>
    <script src="../assets/js/toastr.min.js"></script>



    <script>
        var audio = new Audio('../img/doorbell.wav');

        $(document).ready(() => {
            const loadSummary = () => {
                fetch(`./backend/summary.php`)
                    .then((resp) => {
                        return resp.json();
                    }).then((backData) => {
                        const gotData = backData;
                        const doctors = document.querySelector(".doctors");
                        doctors.innerText = gotData.doctors
                        const receptionists = document.querySelector(".receptionists");
                        receptionists.innerText = gotData.receptionists
                        const patients = document.querySelector(".patients");
                        patients.innerText = gotData.patients
                        const admins = document.querySelector(".admins");
                        admins.innerText = gotData.admins
                        const processed_confirmed = document.querySelector(".processed_confirmed");
                        processed_confirmed.innerText = gotData.processed_confirmed
                        const processed_cancel = document.querySelector(".processed_cancel");
                        processed_cancel.innerText = gotData.processed_cancel
                        const upcomming_cancel = document.querySelector(".upcomming_cancel");
                        upcomming_cancel.innerText = gotData.upcomming_cancel
                        const upcomming_confirmed = document.querySelector(".upcomming_confirmed");
                        upcomming_confirmed.innerText = gotData.upcomming_confirmed
                        const upcomming_pending = document.querySelector(".upcomming_pending");
                        upcomming_pending.innerText = gotData.upcomming_pending
                        const today_confirmed = document.querySelector(".today_confirmed");
                        today_confirmed.innerText = gotData.today_confirmed
                        const today_cancel = document.querySelector(".today_cancel");
                        today_cancel.innerText = gotData.today_cancel

                    });
            }
            setInterval(() => {
                loadSummary();
            }, 2000);
            loadSummary();
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


        const menu = document.querySelector("#menu")
        const openMenu = document.querySelector("#open-menu")
        const closeMenu = document.querySelector("#close-menu")

        openMenu.addEventListener('click', () => {
            menu.classList.add('translate-x-0')
        })
        closeMenu.addEventListener('click', () => {
            menu.classList.remove('translate-x-0')
        })



        const labels = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
        ];
        const labels2 = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
        ];

        const labels4 = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
        ];

        const data = {
            labels: labels,
            datasets: [{
                    label: 'Approved',
                    borderColor: 'rgb(0, 200, 20)',
                    backgroundColor: 'rgb(0, 200, 20)',
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 1,
                    data: [],
                },
                {
                    label: 'Canceled',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 1,
                    data: [],
                }
            ]
        };

        const data2 = {
            labels: labels2,
            datasets: [{
                    label: 'Approved',
                    borderColor: 'rgb(0, 200, 20)',
                    backgroundColor: 'rgb(0, 200, 20)',
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 1,
                    data: [],
                },
                {
                    label: 'Canceled',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 1,
                    data: [],
                }
            ]
        };

        const data4 = {
            labels: labels2,
            datasets: [{
                    label: 'Doctors',
                    borderColor: 'rgb(0, 200, 20)',
                    backgroundColor: 'rgb(0, 200, 20)',
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 1,
                    data: [],
                },
                {
                    label: 'Receptionist',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 1,
                    data: [],
                },
                {
                    label: 'Patients',
                    backgroundColor: 'rgb(25, 200, 202)',
                    borderColor: 'rgb(25, 200, 202)',
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 1,
                    data: [],
                }
            ]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            // Include a dollar sign in the ticks
                            callback: function(value, index, ticks) {
                                return value + '';
                            }
                        },
                        title: {
                            display: true,
                            text: 'Appointments'
                        }

                    },
                    x: {

                        title: {
                            display: true,
                            text: 'Months'
                        }

                    }

                },


            }
        };

        const config2 = {
            type: 'line',
            data: data2,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            // Include a dollar sign in the ticks
                            callback: function(value, index, ticks) {
                                return value + '';
                            }
                        },
                        title: {
                            display: true,
                            text: 'Appointments'
                        }

                    },
                    x: {

                        title: {
                            display: true,
                            text: 'Days'
                        }

                    }

                },


            }
        };


        const data3 = {
            labels: [
                'Red',
                'Blue',
                'Yellow'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(200, 199, 132)',
                    'rgb(154, 12, 235)',
                    'rgb(25, 205, 86)',
                    'rgb(20, 199, 132)',
                    'rgb(154, 192, 235)',
                    'rgb(251, 205, 186)',
                ],
                hoverOffset: 4
            }]
        };
        const config4 = {
            type: 'bar',
            data: data4,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            // Include a dollar sign in the ticks
                            callback: function(value, index, ticks) {
                                return value + '';
                            }
                        },
                        title: {
                            display: true,
                            text: 'Users'
                        }

                    },
                    x: {

                        title: {
                            display: true,
                            text: 'Months'
                        }

                    }

                },


            }
        };
        const config3 = {
            type: 'pie',
            data: data3,
        };
        const myChart3 = new Chart(
            document.getElementById('myChart3'),
            config3)

        const myChart = new Chart(
            document.getElementById('myChart'),
            config)
        const myChart2 = new Chart(
            document.getElementById('myChart2'),
            config2)
        const myChart4 = new Chart(
            document.getElementById('myChart4'),
            config4)
        const graphRecentDataRegister = (year) => {
            fetch(`./backend/graphData.php?t=users&year=${year}`)
                .then((resp) => {
                    return resp.json();
                })

                .then((backData) => {
                    const gotData = backData;
                    const doctors = gotData.map((e) => {
                        return (e.doctors)
                    })

                    const patients = gotData.map((e) => {
                        return (e.patients)
                    })
                    const receptionists = gotData.map((e) => {
                        return (e.receptionists)
                    })

                    const label = gotData.map((e) => {
                        return (e.label)
                    })



                    //update charts


                    myChart4.data.datasets[0].data = doctors
                    myChart4.data.datasets[1].data = receptionists
                    myChart4.data.datasets[2].data = patients
                    myChart4.data.labels = label
                    myChart4.update()


                });
        }

        const graphRecentDepartment = (year) => {
            fetch(`./backend/graphData.php?t=department&year=${year}`)
                .then((resp) => {
                    return resp.json();
                })

                .then((backData) => {
                    const gotData = backData;
                    const value = gotData.map((e) => {
                        return (e.value)
                    })

                    const label = gotData.map((e) => {
                        return (e.label)
                    })

                    //update charts
                    myChart3.data.datasets[0].data = value
                    myChart3.data.labels = label
                    myChart3.update()


                });
        }

        const graphRecentData = (year, department) => {
            fetch(`./backend/graphData.php?t=year&year=${ year}&dep=${department}`)
                .then((resp) => {
                    return resp.json();
                })

                .then((backData) => {
                    const gotData = backData;
                    const approved = gotData.map((e) => {
                        return (e.approved)
                    })

                    const declined = gotData.map((e) => {
                        return (e.declined)
                    })

                    const label = gotData.map((e) => {
                        return (e.label)
                    })



                    //update charts


                    myChart.data.datasets[0].data = approved
                    myChart.data.datasets[1].data = declined
                    myChart.data.labels = label
                    myChart.update()


                });
        }

        const graphRecentDataM = (year, month, department) => {
            fetch(`./backend/graphData.php?t=month&year=${year}&month=${month}&dep=${department}`)
                .then((resp) => {
                    return resp.json();
                })

                .then((backData) => {
                    const gotData = backData;
                    console.log(gotData);
                    const approved = gotData.map((e) => {
                        return (e.approved)
                    })

                    const declined = gotData.map((e) => {
                        return (e.declined)
                    })

                    const label = gotData.map((e) => {
                        return (e.label)
                    })



                    //update charts
                    myChart2.data.labels = label
                    myChart2.data.datasets[0].data = approved
                    myChart2.data.datasets[1].data = declined
                    myChart2.update()




                });
        }
        graphRecentDepartment(<?php echo date("Y"); ?>);
        graphRecentDataRegister(<?php echo date("Y"); ?>);
        graphRecentData(<?php echo date("Y"); ?>, 0);
        graphRecentDataM(<?php echo date("Y"); ?>, <?php echo date("m"); ?>, 0);
        $("#GraphYearRegistration").change(() => {
            var year = $("#GraphYearRegistration").val();

            graphRecentDataRegister(year);
        })
        $("#GraphYearApproved").change(() => {
            var year = $("#GraphYearApproved").val();

            graphRecentDepartment(year);
        })

        $("#GraphYear,#selectDepartment").change(() => {
            var year = $("#GraphYear").val();
            var department = $("#selectDepartment").val();
            graphRecentData(year, department);
        })
        $("#GraphYear2,#GraphMonth,#selectDepartment").change(() => {

            var year = $("#GraphYear2").val();
            var month = $("#GraphMonth").val();
            var department = $("#selectDepartment").val();

            graphRecentDataM(year, month, department);

        })
    </script>


</body>

</html>