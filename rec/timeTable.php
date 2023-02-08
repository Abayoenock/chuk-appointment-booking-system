<?php
session_start();
include '../backend/db_conn.php';

if (!($_SESSION['recepSession'])) {
    header("Location: ./");
} else {

    $userID = $_SESSION['recepSession'];

    $sql = "SELECT * FROM receptionist WHERE recpID='$userID'";
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
                        <li class="w-full flex  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group pl-4 gap-2  py-6">

                            <i class="fa-solid fa-notes-medical text-white  text-2xl transition-all duration-300 group-hover:-translate-y-1 group-hover:text-white/50 "></i>
                            <span class="text-white text-sm font-semibold transition-all duration-300 group-hover:-translate-y-1">Reports</span>


                        </li>
                    </a>
                    <a href="TimeTable" class=" relative ">
                        <li class="w-full flex  items-center h-[40px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group pl-4 gap-2  py-6 active-link">

                            <i class="fa-solid fa-calendar-days text-white  text-2xl transition-all duration-300 group-hover:-translate-y-1 group-hover:text-white/50 "></i>
                            <span class="text-white text-sm font-semibold transition-all duration-300 group-hover:-translate-y-1">Time Table</span>


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



                <div class="flex flex-col md:flex-row mt-8 gap-2 w-full">
                    <div class="w-[380px] shadow-xl h-fit rounded-md p-5 mx-5 bg-primary/10 ">
                        <div id="container" class="md:w-[350px]    ">
                            <h1 class="p-4 py-2 font-bold"> <i class="fa-solid fa-calendar-days"></i>&nbsp Current set Days</h1>

                            <div class="w-full relative mt-4">


                                <div id="header" class=" p-[10px] text-primary flex justify-between relative ">


                                    <div id="monthDisplay"></div>
                                    <div>
                                        <button id="backButton" class=" px-2 py-1  bg-gradient-to-r from-green-400/70 to-blue-500/70  hover:bg-primary/80   hover:bg-gradient-to-r hover:from-blue-400/70 hover:to-green-500/70 transition eas duration-500 rounded-sm text-white"><i class="fa fa-angle-double-left" aria-hidden="true"></i></button>
                                        <button id="nextButton" class=" px-2 py-1  bg-gradient-to-r from-green-400/70 to-blue-500/70  hover:bg-primary/80   hover:bg-gradient-to-r hover:from-blue-400/70 hover:to-green-500/70 transition eas duration-500 rounded-sm text-white"><i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                                    </div>
                                </div>

                                <div class="w-full flex text-primary gap-x-[10px] ">
                                    <div class=" md:w-[40px] p-[10px] justify-center  items-center ">Su</div>
                                    <div class=" md:w-[40px] p-[10px] justify-center  items-center">Mo</div>
                                    <div class=" md:w-[40px] p-[10px] justify-center  items-center">Tu</div>
                                    <div class=" md:w-[40px] p-[10px] justify-center  items-center">We</div>
                                    <div class=" md:w-[40px] p-[10px] justify-center  items-center">Thu</div>
                                    <div class=" md:w-[40px] p-[10px] justify-center  items-center">Fr</div>
                                    <div class=" md:w-[40px] p-[10px] justify-center  items-center">Sa</div>
                                </div>

                                <div id="calendar" class="w-full m-auto flex flex-wrap"></div>

                            </div>


                        </div>
                    </div>


                    <div class=" mt-0  w-full md:w-[calc(100%_-_440px)] flex flex-col gap-3 px-4">
                        <img src="../img/devImgs/804_generated.jpg" class="" alt="">





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





        const loadTimeTable = (id) => {
            fetch(`./backend/fetch-timeTable.php?id=${id}`)
                .then((resp) => {
                    return resp.json();
                }).then((backData) => {
                    const gotData = backData;
                    let nav = 0;
                    let clicked = null;
                    let events = gotData;
                    console.log(events);
                    const calendar = document.getElementById('calendar');
                    const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

                    function openModal(date) {
                        clicked = date;
                        $('.modal').remove();
                        $(".modal").modal({
                            fadeDuration: 100
                        });
                        $.get(`./timeTableSet.php?day=${date}`, function(html) {
                            $(html).appendTo('body').modal();
                        });
                    }

                    function load() {
                        const dt = new Date();

                        if (nav !== 0) {
                            dt.setMonth(new Date().getMonth() + nav);

                        }

                        const day = dt.getDate();
                        const month = dt.getMonth();
                        const year = dt.getFullYear();

                        const firstDayOfMonth = new Date(year, month, 1);
                        const daysInMonth = new Date(year, month + 1, 0).getDate();

                        const dateString = firstDayOfMonth.toLocaleDateString('en-us', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'numeric',
                            day: 'numeric',
                        });
                        const paddingDays = weekdays.indexOf(dateString.split(', ')[0]);

                        document.getElementById('monthDisplay').innerText =
                            `${dt.toLocaleDateString('en-us', { month: 'long' })} ${year}`;

                        calendar.innerHTML = '';

                        for (let i = 1; i <= paddingDays + daysInMonth; i++) {
                            const daySquare = document.createElement('div');
                            daySquare.classList.add('day');

                            function addZero(x) {
                                if (x < 10) {
                                    return x = '0' + x;
                                } else {
                                    return x;
                                }
                            }
                            const dayString = `${addZero(month + 1)}/${addZero(i - paddingDays)}/${year}`;
                            if (i > paddingDays) {
                                daySquare.innerText = i - paddingDays;
                                const eventForDay = events.find(e => e.date === dayString);

                                console.log(eventForDay);

                                if (i - paddingDays === day && nav === 0) {
                                    daySquare.id = 'currentDay';

                                }

                                if (eventForDay) {
                                    if (nav == 0) {
                                        if (i - paddingDays >= day && nav >= 0) {


                                            const eventDiv = document.createElement('div');
                                            eventDiv.classList.add('event-down');
                                            eventDiv.innerText = ` ✔ `;


                                            daySquare.appendChild(eventDiv);
                                            if (eventForDay.title > 0) {

                                                const eventDiv2 = document.createElement('div');
                                                eventDiv2.className = 'event-number flex gap-1';
                                                const eventDiv3 = document.createElement('i');

                                                eventDiv3.className = "fa-solid fa-user-doctor  text-md ";

                                                eventDiv2.innerText = eventForDay.title;
                                                eventDiv2.appendChild(eventDiv3);
                                                daySquare.appendChild(eventDiv2);
                                            }

                                            daySquare.addEventListener('click', () => openModal(dayString));



                                        } else {
                                            const eventDiv = document.createElement('div');
                                            eventDiv.classList.add('event-down');
                                            eventDiv.innerText = ` ✔ `;

                                            daySquare.appendChild(eventDiv);
                                            daySquare.classList.add('day-disabled');

                                        }
                                    } else {

                                        const eventDiv = document.createElement('div');
                                        eventDiv.classList.add('event-down');
                                        eventDiv.innerText = ` ✔ `;

                                        daySquare.appendChild(eventDiv);
                                        if (eventForDay.title > 0) {

                                            const eventDiv2 = document.createElement('div');
                                            eventDiv2.className = 'event-number flex gap-1';
                                            const eventDiv3 = document.createElement('i');

                                            eventDiv3.className = "fa-solid fa-user-doctor  text-md ";

                                            eventDiv2.innerText = eventForDay.title;
                                            eventDiv2.appendChild(eventDiv3);
                                            daySquare.appendChild(eventDiv2);
                                        }
                                        if (nav > 0) {
                                            daySquare.addEventListener('click', () => openModal(dayString));
                                        } else {
                                            daySquare.classList.add('day-disabled');
                                        }


                                    }



                                } else {
                                    if (nav == 0) {
                                        const eventDiv = document.createElement('div');
                                        eventDiv.classList.add('event-not-down');
                                        eventDiv.innerText = ` 🗙 `;
                                        daySquare.appendChild(eventDiv);

                                        if (i - paddingDays > day && nav >= 0) {
                                            daySquare.addEventListener('click', () => openModal(dayString));
                                        } else {
                                            daySquare.classList.add('day-disabled');
                                        }
                                    } else {
                                        const eventDiv = document.createElement('div');
                                        eventDiv.classList.add('event-not-down');
                                        eventDiv.innerText = ` 🗙 `;
                                        daySquare.appendChild(eventDiv);
                                        if (nav > 0) {
                                            daySquare.addEventListener('click', () => openModal(dayString));
                                        } else {
                                            daySquare.classList.add('day-disabled');
                                        }


                                    }


                                }



                            } else {
                                daySquare.classList.add('padding');
                            }

                            calendar.appendChild(daySquare);
                        }
                    }






                    function initButtons() {
                        document.getElementById('nextButton').addEventListener('click', () => {
                            nav++;
                            load();
                        });

                        document.getElementById('backButton').addEventListener('click', () => {
                            nav--;
                            load();
                        });




                    }

                    initButtons();
                    load();
                });
        }
        loadTimeTable(1);
    </script>


</body>

</html>