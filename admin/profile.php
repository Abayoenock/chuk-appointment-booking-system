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
                        <li class="w-full flex  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group pl-4 gap-2  py-6 ">

                            <i class="fa-solid fa-user-doctor text-white  text-2xl transition-all duration-300 group-hover:-translate-y-1 group-hover:text-white/50 "></i>
                            <span class="text-white text-sm font-semibold transition-all duration-300 group-hover:-translate-y-1">Manage Doctors</span>


                        </li>
                    </a>
                    <a href="manage-receptionist" class=" relative ">
                        <li class="w-full flex  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group pl-4 gap-2  py-6 ">

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
                        <li class="w-full flex  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group  pl-4 gap-2 py-6 active-link">
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

                    $sql = "SELECT * FROM `admin`  WHERE adminID='$userID' ";
                    $exe = $conn->query($sql);
                    $data = array();
                    while ($row = $exe->fetch_array()) {
                        $data = $row;
                    }

                ?>

                    <button class="bg-gradient-to-r from-gray-700/70 to-blue-500/70 bg-primary change-password  hover:bg-gradient-to-r hover:from-gray-400/40 hover:to-blue-500/40 transition eas duration-500 rounded-md px-8 py-2 text-gray-100 hover:shadow-xl w-fit   "> <i class="fas fa-user-lock    "></i> Change Password</button>

                    <div class="flex w-full gap-12">

                        <form class="mt-12 mb-0 flex  gap-4 text-sm submit2 font-semibold w-full" action="./backend/edit-admin.php" method="POST" enctype="multipart/form-data">
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
                                    <div class="flex flex-col w-full relative">
                                        <label for="email" class="text-gray-700">Email</label>
                                        <input type="email" name="email" id="nid" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your Identification number  " value=" <?php echo $data['email'] ?>" title="" required>

                                    </div>

                                    <div class="flex flex-col w-full relative ">
                                        <label for="phoneNumber" class="text-gray-700">Phone Number</label>
                                        <input type="tel" name="phoneNumber" id="phoneNumber" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your phone number" pattern="[0-9]{10}" title="Please Rwandan phone number Minus the country code" value="<?php echo $data['phonNumber'] ?>" required>
                                        <div class="absolute right-3 mt-8 hidden "><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-4 mb-0 flex items-center justify-end space-x-4">
                                    <button class="bg-gradient-to-r from-green-400/70 to-blue-500/70  hover:bg-primary/80   hover:bg-gradient-to-r hover:from-blue-400/70 hover:to-green-500/70 transition eas duration-500 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl  uppercase resister-btn">Update Profile &nbsp <i class="fas fa-spinner animate-spin invisible" aria-hidden="true"></i> </button>
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
        var placeHolderImg = "<?php echo  !@$_GET['recp'] ? "<img src='../img/profiles/recepAvatar.png' alt='Your Avatar' style='width:160px'><h6 class='text-muted'>Click to select</h6>" : "<img src='../img/profiles/$profileImg' alt='Your Avatar' style='width:160px'><h6 class='text-muted'>Click to select</h6>" ?>"
        var btnCust = '';




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
                        $(".resister-btn").removeAttr("disabled");
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





        const menu = document.querySelector("#menu")
        const openMenu = document.querySelector("#open-menu")
        const closeMenu = document.querySelector("#close-menu")

        openMenu.addEventListener('click', () => {
            menu.classList.add('translate-x-0')
        })
        closeMenu.addEventListener('click', () => {
            menu.classList.remove('translate-x-0')
        })

        $(".change-password").click(() => {
            async function formDataInputs() {
                const {
                    value: formValues
                } = await Swal.fire({
                    title: 'Change password',
                    confirmButtonColor: "rgba(35, 162,197,0.8)",
                    showCancelButton: true,
                    confirmButtonText: 'Change password',
                    html: '<input id="swal-input1" type="password" placeholder="Current password" class="swal2-input">' +
                        '<input id="swal-input2" type="password" placeholder="New password" class="swal2-input">' +
                        '<input id="swal-input3" type="password" placeholder="Confirm  password" class="swal2-input">',
                    focusConfirm: false,
                    preConfirm: () => {
                        return [
                            document.getElementById('swal-input1').value,
                            document.getElementById('swal-input2').value,
                            document.getElementById('swal-input3').value
                        ]
                    }
                })

                if (formValues) {
                    console.log(formValues);
                    //Swal.fire(JSON.stringify(formValues))
                    fetch("./backend/changePassword.php?o=" + formValues[0] + "&n=" + formValues[1] + "&c=" + formValues[2])
                        .then((resp) => {
                            return resp.json();
                        }).then((backData) => {
                            const gotData = backData;
                            if (gotData.success == true) {
                                Swal.fire(gotData.messages, '', 'success');

                            } else {
                                Swal.fire(gotData.messages, '', 'error');
                            }
                        })
                }
            }
            formDataInputs();
        })
    </script>


</body>

</html>