<?php
session_start();
include '../backend/db_conn.php';

if (!($_SESSION['docSession'])) {
    header("Location:./dashboard");
} else {

    $userID = $_SESSION['docSession'];

    $sql = "SELECT * FROM doctors WHERE doctorID='$userID'";
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">

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
                        <li class="w-full flex  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group pl-4 gap-2  py-6 active-link">

                            <i class="fa-solid fa-notes-medical text-white  text-2xl transition-all duration-300 group-hover:-translate-y-1 group-hover:text-white/50 "></i>
                            <span class="text-white text-sm font-semibold transition-all duration-300 group-hover:-translate-y-1">Reports</span>


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

                <div class="w-full p-6">
                    <div class="w-full flex  justify-end items-center gap-2 mb-2 ">
                        <input type="date " name="date" class=" w-full h-14 rounded-md bg-primary/10 p-2 outline-none text-slate-500 focus:outline-none" id="datepicker" placeholder="Choose date " value="<?php echo date("m/d/Y"); ?>">
                    </div>


                    <h3 class=" font-semibold text-yellow-500 mb-3">Unconfirmed Appointments</h3>
                    <div class=" pending-msg"></div>
                    <div class="w-full pending-cont">

                        <table id="table_id" class=" stripe hover display compact text-[9px] z-10 text-center ">
                            <thead>
                                <tr class=" text-[12px] text-white mt-4 rounded-md bg-primary">
                                    <th>DateCreated</th>
                                    <th>Patient </th>
                                    <th>gender</th>
                                    <th>BOD </th>
                                    <th>Phone Number</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <h3 class="font-semibold text-green-400 mt-8">Approved Appointments</h3>
                    <div class=" processed-msg"></div>
                    <div class="w-full processed-cont mt-4">
                        <table id="table_id2" class=" stripe hover display compact text-[9px] z-10 text-center " ">
                            <thead>
                        <tr class=" text-[12px] text-white mt-4 rounded-md bg-primary">
                            <th>DateCreated</th>
                            <th>Patient </th>
                            <th>gender</th>
                            <th>BOD </th>
                            <th>Phone Number</th>

                            <th>Approval Date</th>



                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <h3 class=" font-semibold text-red-400 mt-4 ">Declined Appointments</h3>
                    <div class=" declined-msg">
                    </div>
                    <div class="w-full declined-cont mt-8">
                        <table id="table_id3" class=" stripe hover display compact text-[9px] z-10 text-center ">
                            <thead>
                                <tr class=" text-[12px] text-white mt-4 rounded-md bg-primary">
                                    <th>DateCreated</th>
                                    <th>Patient </th>
                                    <th>gender</th>
                                    <th>BOD </th>
                                    <th>Phone Number</th>

                                    <th>Decline Date</th>



                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>




            </div>



















        </div>




    </div>








    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js"></script>
    <!-- <script src="../assets/dist/js/dashboard.js"></script> -->
    <script src="../assets/js/sweetalert2.min.js"></script>
    <script src="../assets/js/toastr.min.js"></script>
    <script src="../assets/js/jquery-ui.js"></script>


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





        $(".submit").unbind('submit').bind('submit', function() {

            var form = $(this);

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
                        setTimeout(() => {
                            // window.location = '';
                        }, 3000)


                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: response.messages
                        })

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




        const loadData = (date) => {
            fetch("./backend/report.php?t=pending&date=" + date)
                .then((resp) => {
                    return resp.json();
                }).then((backData) => {
                    const gotData = backData;
                    if (gotData.length == 0) {
                        $(".pending-cont").hide()
                        $('.pending-msg').html(` <p class=" bg-blue-100 text-sm p-4 rounded-sm text-blue-600 mt-4 mb-4">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                You have no pending appointments
                            </p>`);
                    } else {
                        $(".pending-cont").show()
                        $('.pending-msg').html(``);
                    }
                    if ($.fn.DataTable.isDataTable('#table_id')) {
                        $('#table_id').DataTable().destroy();

                    }
                    var table = $('#table_id').DataTable({
                        data: gotData,

                        columns: [{
                                data: 'dateCreated',
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
                                data: 'patientNames',


                            },
                            {
                                data: 'gender',


                            },
                            {
                                data: 'bod',


                            },
                            {
                                data: 'phoneNumber',


                            },













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



                })

            fetch("./backend/report.php?t=processed&date=" + date)
                .then((resp) => {
                    return resp.json();
                }).then((backData) => {
                    const gotData = backData;
                    if (gotData.length == 0) {
                        $(".processed-cont").hide()
                        $('.processed-msg').html(`<p class=" bg-blue-100 text-sm p-4 rounded-sm text-blue-600 mt-4 mb-4">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                You have no Approved  appointments
                            </p>`);
                    } else {
                        $(".processed-cont").show()
                        $('.processed-msg').html(``);
                    }
                    if ($.fn.DataTable.isDataTable('#table_id2')) {
                        $('#table_id2').DataTable().destroy();

                    }
                    var table = $('#table_id2').DataTable({
                        data: gotData,

                        columns: [{
                                data: 'dateCreated',
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
                                data: 'patientNames',


                            },
                            {
                                data: 'gender',


                            },
                            {
                                data: 'bod',


                            },
                            {
                                data: 'phoneNumber',


                            },

                            {
                                data: 'approvalDate',
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



                })
            fetch("./backend/report.php?t=declined&date=" + date)
                .then((resp) => {
                    return resp.json();
                }).then((backData) => {
                    const gotData = backData;
                    if (gotData.length == 0) {
                        $(".declined-cont").hide()
                        $('.declined-msg').html(`<p class=" bg-blue-100 text-sm p-4 rounded-sm text-blue-600 mt-4 mb-4">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                You have no declined  appointments
                            </p>`);
                    } else {
                        $(".declined-cont").show()
                        $('.declined-msg').html(``);
                    }
                    if ($.fn.DataTable.isDataTable('#table_id3')) {
                        $('#table_id3').DataTable().destroy();

                    }
                    var table = $('#table_id3').DataTable({
                        data: gotData,

                        columns: [{
                                data: 'dateCreated',
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
                                data: 'patientNames',


                            },
                            {
                                data: 'gender',


                            },
                            {
                                data: 'bod',


                            },
                            {
                                data: 'phoneNumber',


                            },

                            {
                                data: 'approvalDate',
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



                })

        }

        var dat = "<?php echo date("m/d/Y"); ?>"
        loadData(dat);
        $("#datepicker").change(() => {
            let dateReport = $("#datepicker").val()

            loadData(dateReport);
        })
    </script>


</body>

</html>