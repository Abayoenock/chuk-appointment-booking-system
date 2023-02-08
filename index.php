<?php
include './backend/db_conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHUK Appointment booking
        system</title>
    <link rel="shortcut icon" href="./img/devImgs/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./fontawesome/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" href="./css/toastr.min.css">
    <link rel="stylesheet" href="./css/sweetalert2.min.css">
    <script src="./js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

</head>

<body class=" relative w-full overflow-x-hidden  bg-white body  ">
    <div class=" overflow-x-hidden" style="overflow-x: hidden !important;">
        <div class="  fixed    top-0 left-0  h-full w-full  overlay-show flex items-center justify-center bg-white/70  backdrop-blur-lg preloader z-[20] ">
            <div class="flex flex-col">
                <p class="font-bold text-center block text-green-700 animate-pulse text-3xl"><br></p><br>
                <div class="pulse"></div>
            </div>
        </div>
        <section class="  h-screen relative w-full  overflow-hidden " id="Home">

            <div class="w-full h-full overflow-hidden  ">
                <div class=" w-full h-full">
                    <!-- nav -->
                    <nav class=" w-full " id="Home">

                        <!-- the navigation container  -->
                        <div class="w-full   px-8 md:px-16 transition-all    p-4 flex justify-between items-center fixed z-[10]  bg-white/70 backdrop-blur-sm  " id="header">

                            <!-- logo image -->
                            <a href="" class="flex gap-2 items-center ">
                                <img src="./img/devImgs/logo.png" class=" w-12 " alt="">
                                <p class=" font-bold text-lg md:text-2xl text-primary ">CHUK</p>
                            </a>

                            <!-- navigation links  -->
                            <ul class="flex items-center gap-x-8    mobile-menu  z-30 ">
                                <li class=" font-semibold">
                                    <a href="#Home" class="active-link2">Home</a>
                                </li>

                                <li class=" font-semibold"><a href="#Departments" class="">Departments</a></li>
                                <li class=" font-semibold"><a href="#Doctors" class=" ">Doctors</a></li>

                                <li class=" font-semibold"><a href="#Contacts" class=" ">Contact Us</a></li>
                                <li> <a href="auth" class=" btn bg-gradient-to-r from-green-400/70 to-blue-500/70    backdrop-blur-sm text-white w-fit transition-all duration-300 hover:bg-primary/80   hover:bg-gradient-to-r hover:from-blue-400/70 hover:to-green-500/70 hover:text-white font-bold text-md rounded-full  ">Book
                                        Now </a> </li>
                                <li class="relative w-fit ">
                                    <a href="./auth" target="_blank" class="btn border rounded-full border-primary backdrop-blur-sm w-fit transition-all duration-300  hover:text-white font-bold text-md   hover:border-transparent   hover:bg-gradient-to-r hover:from-green-400/70 hover:to-blue-500/70 interval-left group overflow-hidden p-0">


                                        &nbsp Sign In </a>
                                </li>

                            </ul>
                            <button class="humbeger block md:hidden pt-4 pl-8  z-[1005] outline-none bg-transparent appearance-none ">
                                <span class="humbeger-top"></span>
                                <span class="humbeger-middle"></span>
                                <span class="humbeger-bottom"></span>
                            </button>
                        </div>

                        <!--the end of the navigation container -->
                    </nav>

                    <!-- the hero section -->
                    <header class="   ">
                        <img src="./img/devImgs/blogpost.png" alt="" class="  absolute bottom-0 left-0 ">
                        <img src="./img/devImgs/dna.png" alt="" class="  absolute top-40 -right-8 w-96 -rotate-[30deg] ">
                        <div class=" mx-auto flex items-center justify-center flex-col md:flex-row h-screen bg-white/40 backdrop-blur-[4px] ">

                            <div class="md:w-1/2 md:h-screen w-full     flex flex-col space-y-8 p-5 relative md:pt-32 md:pl-24  ">
                                <h1 class="text-primary  font-extrabold text-3xl">CHUK Appointmemnt <br>Booking System
                                </h1>
                                <p class="text-sm text-slate-700">Booking for the doctor appointment has never been
                                    easier. You can easly see the time
                                    table for the doctors and book your appointment at your convinient day you can
                                    easily book an appointment using any of the following methods </p>

                                <div class="flex gap-3 items-center">
                                    <div class=" w-6 h-6 flex justify-center items-center rounded-md bg-opacity-50 text-white bg-cyan-600 text-md font-bold">
                                        1 </div>
                                    <p>Using
                                        this
                                        system by clicking on book now button </p>
                                </div>
                                <div class="flex gap-3 items-center">
                                    <div class=" w-6 h-6 flex justify-center items-center rounded-md bg-opacity-50 text-white bg-cyan-600 text-md font-bold">
                                        2 </div>
                                    <p> Using our USSD code Dail <i class="fa fa-phone" aria-hidden="true"></i></p> <b>*662*800*111#</b>
                                </div>




                                <div class="flex gap-2 justify-end ">
                                    <a href="./register" target="_blank" class="btn border  border-primary backdrop-blur-sm w-fit transition-all duration-300  hover:text-white font-bold text-md rounded-sm  hover:border-transparent interval-left group overflow-hidden p-0">
                                        <i class="fa fa-user-plus relative   " aria-hidden="true"></i>
                                        <span class=" absolute m-0 top-0 left-0 bg-gradient-to-r from-green-400/70 to-blue-500/70 -translate-x-[100%]   w-[120%] h-[120%] transition-all duration-300 group-hover:translate-x-0 -z-1 "></span>

                                        &nbsp Create Account </a>

                                    <a href="./dashboard" target="_blank" class="btn  bg-gradient-to-r from-green-400/70 to-blue-500/70    backdrop-blur-sm text-white w-fit transition-all duration-300 hover:bg-primary/80   hover:bg-gradient-to-r hover:from-blue-400/70 hover:to-green-500/70 hover:text-white font-bold text-md rounded-sm  interval-left">
                                        <i class="fas fa-calendar-check    "></i> &nbsp Book
                                        Now </a>

                                </div>

                            </div>
                            <div class="md:w-1/2 md:h-screen w-full absolute -bottom-[15%] md:bottom-0  -z-10 md:z-1 flex flex-col md:relative  ">
                                <img src="./img/devImgs/doctor-appointment2.png" alt="" class=" w-[80%] absolute bottom-0  ">

                                <img src="./img/devImgs/online-doctor-appointment.png" alt="" class=" w-[80%] absolute bottom-0">

                            </div>
                        </div>

                    </header>
                </div>



            </div>
            <div class=" flex justify-center bottom-scr absolute bottom-0 items-center w-full">
                <h1 class="text-sm md:text-md font-bold uppercase bg-primary text-white px-6 py-3  z-[1000] rounded-t-lg">
                    <i class="fa fa-angle-double-down animate-bounce" aria-hidden="true"></i>&nbsp;
                    Our Specialities
                </h1>
            </div>

        </section>


        <!-- about us section -->
        <section class="  w-screen  mt-0  back   overflow-x-hidden relative  " id="Departments">

            <div class=" w-full h-full bg-primary/95 backdrop-blur-[1px] pb-20 ">

                <!-- services container -->
                <div class=" container mx-auto p-6 flex flex-col   space-y-16 ">
                    <?php
                    $sql = " SELECT * FROM `department`";
                    $exe = $conn->query($sql);
                    if ($exe->num_rows > 0) { ?>
                        <!-- serives  container  -->
                        <div class="grid grid-cols-2 md:grid-cols-6 gap-6 relative">


                            <?php
                            while ($row = $exe->fetch_array()) {
                            ?>

                                <div class="   flex flex-col cursor-pointer  rounded-md interval-top  pt-0  duration-300 transition-all bg-white/70 hover:bg-white/90 transform hover:-translate-y-4  group" id="modalT<?php echo $row['dept_ID'];  ?>">
                                    <img src="./img/department/<?php echo $row['departmentImage']; ?>" class="w-30  aspect-square     " alt="">
                                    <div class=" text-center w-full p-4">
                                        <small class="font-bold text-slate-500 "><?php echo $row['departmentName']; ?>
                                        </small>
                                    </div>


                                </div>

                                <div id="modal<?php echo $row['dept_ID'];  ?>" class="modal">
                                    <h2 class="mb-4 font-bold"><?php echo $row['departmentName']; ?></h2>
                                    <div class=" flex gap-2 ">
                                        <img src="./img/department/<?php echo $row['departmentImage']; ?>" class="w-[120px]  " alt="">
                                        <p class=""><?php echo $row['departmentDescription']; ?></p>
                                    </div>



                                </div>
                                <script>
                                    $(`#modalT<?php echo $row['dept_ID'];  ?>`).click(() => {
                                        $("#modal<?php echo $row['dept_ID'];  ?>").modal({
                                            fadeDuration: 100
                                        });
                                    });
                                </script>
                            <?php
                            }

                            ?>







                        </div>

                    <?php




                    } else {
                    ?>
                        <p class=" bg-red-100 text-sm p-4 rounded-sm text-red-600">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                            There are no registered departments at the moment
                        </p>
                    <?php
                    }
                    ?>





                </div>
            </div>
            <div class=" flex justify-center bottom-scr absolute bottom-0 items-center w-full">
                <h1 class="text-sm md:text-md font-bold uppercase bg-white text-primary px-6 py-3  z-[1000] rounded-t-lg">
                    <i class="fa fa-angle-double-down animate-bounce" aria-hidden="true"></i>&nbsp;
                    Our Doctors
                </h1>
            </div>

        </section>

        <!-- services section -->
        <section class="  relative overflow-x-hidden" id="Doctors">
            <div class=" w-full h-full bg-white pb-20 ">
                <!-- services container -->
                <div class=" container mx-auto p-6 flex flex-col   space-y-16 ">
                    <?php
                    $sql = " SELECT * FROM `doctors` WHERE status='1'";
                    $exe = $conn->query($sql);
                    if ($exe->num_rows > 0) { ?>

                        <!-- serives  container  -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative mt-12">
                            <?php
                            while ($row = $exe->fetch_array()) {
                            ?>
                                <div class=" relative  flex  bg-white/80 shadow-lg overflow-hidden rounded-md interval-top border border-slate-100 ">
                                    <img src="./img/profiles/<?php echo $row['profileImg']; ?>" class="w-28  h-32   " alt="">
                                    <div class=" text-left w-full p-4 relative">
                                        <small class="text-xs text-slate-500">Names:</small><br>
                                        <p class=" text-primary text-xs "><?php echo $row['title']; ?> .<?php echo $row['firstname'] . " " . $row['lastname']; ?> </p>

                                        <small class=" text-xs text-slate-500">Specialization: </small>
                                        <p class=" text-xs text-primary"><?php echo $row['specialization']; ?> </p>
                                        <small class=" absolute bottom-2"><i class="fa fa-phone p-1 bg-primary rounded-md text-white" aria-hidden="true"></i> <?php echo $row['phoneNumber']; ?></small>
                                    </div>

                                </div>
                            <?php
                            }

                            ?>






                        </div>
                    <?php
                    }
                    ?>



                </div>
            </div>


        </section>

        <!-- the contact us section -->
        <section class="contact overflow-x-hidden" id="Contacts">
            <div class="container mx-auto p-6 ">
                <div class="flex flex-col md:flex-row justify-center relative items-center ">
                    <img src="./img/devImgs/dev.png" class="absolute w-80 -top-0 -left-[150px] -z-10" alt="">

                    <!-- the image container  -->
                    <div class="flex flex-col items-center gap-4 relative md:w-1/3  bg-primary p-6 bg-opacity-70 backdrop-blur-[2px] z-10 ">
                        <h3 class="text-xl max-w-xs font-bold text-white interval-top">Having touble navigating or
                            booking contact us </h3>
                        <hr class="bg-white">




                        <!-- the contact info -->
                        <div class="interval-top flex flex-col w-full z-0">
                            <div class="flex flex-col self-start  gap-2 text-white">
                                <p class=" self-start font-semibold">Call us for instant support</p>
                                <small class="flex flex-col gap-4 self-start items-center">
                                    <span>
                                        <i class="fa fa-phone" aria-hidden="true"></i> <span>+2507866.......</span>
                                    </span>
                                    <span>
                                        <i class="fa fa-phone" aria-hidden="true"></i> <span>+25078.........</span>
                                    </span>



                                </small>
                            </div>
                            <div class="flex flex-col self-start gap-2 text-white">
                                <p class=" self-start font-semibold">Write us by mail</p>
                                <small class="flex gap-4 self-start items-center"> <i class="fa fa-envelope" aria-hidden="true"></i> <span>booking@chuk.rw</span>
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- the form container -->
                    <div class="flex flex-col space-y-8 w-full justify-center items-center md:w-2/3 border-primary border-4  back0">
                        <form method="post" action="./php/contact.php" class="contact-form  flex flex-col space-y-8 justify-center items-center py-8 w-full  bg-white/70 backdrop-blur-sm ">
                            <div class="flex flex-col md:self-end w-4/5   justify-between gap-x-8  gap-y-8">

                                <!-- input container -->
                                <div class="contact__content flex flex-col relative w-full md:w-4/5 h-12 form text-slate-700 border-b-2 border-veryDarkBlue focus:border-veryDarkBlue border-opacity-50">
                                    <input type="email" name="emailContact" required class=" contact__input  absolute top-0 left-0 w-full h-full p-4 pb-0  bg-transparent border-none outline-none z-1    " placeholder=" ">
                                    <label for="" class=" contact__label absolute top-3 w-full text-sm transition-all duration-300 ">
                                        Email
                                    </label>
                                </div>

                                <!-- input container -->
                                <div class="contact__content flex flex-col relative w-full md:w-4/5 h-12 form text-slate-700 border-b-2 border-veryDarkBlue focus:border-veryDarkBlue border-opacity-50">
                                    <input type="text" name="subjectContact" required class=" contact__input  absolute top-0 left-0 w-full h-full p-4 pb-0  bg-transparent border-none outline-none z-1    " placeholder=" ">
                                    <label for="" class=" contact__label absolute top-3 w-full text-sm transition-all duration-300 ">
                                        Subject
                                    </label>
                                </div>

                                <!-- input container -->
                                <div class="contact__content flex flex-col relative w-full md:w-4/5 h-20 form text-slate-700 border-b-2 border-veryDarkBlue focus:border-veryDarkBlue border-opacity-50">
                                    <textarea name="messageContact" required id="" class=" contact__input  absolute top-0 left-0 w-full h-full p-4 pb-0  bg-transparent border-none outline-none z-1   " placeholder=" "></textarea>
                                    <label for="" class=" contact__label absolute top-3 w-full text-sm transition-all duration-300 ">Message</label>
                                </div>
                                <div class="flex w-full md:w-4/5 justify-end ">
                                    <button type="submit" class="   flex items-center gap-x-2 btn bg-primary/70  rounded-lg font-bold text-white  transition-all duration-300 group hover:bg-primary">
                                        <span>Send message</span> <i class="fa fa-paper-plane  transition-all duration-300 group-hover:translate-x-2" aria-hidden="true"></i></i> </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>


        <section id="map">
            <div class=" container mx-auto p-6 pb-0">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.4937944150133!2d30.058286614614982!3d-1.9559121985740495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca42c75f67b01%3A0xe4e18dbc8a3a43c1!2sUniversity+Teaching+Hospital+of+Kigali!5e0!3m2!1sen!2srw!4v1523692216322" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </section>





        <!-- the footer section -->
        <footer class=" bg-primary  ">
            <div class="container mx-auto p-6  grid md:grid-cols-2 lg:grid-cols-3 gap-4 place-items-start md:justify-items-center ">

                <!-- subscribe container -->
                <div class="flex flex-col  gap-4 interval-top">
                    <h3 class="text-xl max-w-xs text-veryLightGray interval-top">Subscribe to our newsletter
                        to stay update</h3>
                    <div class="flex ">
                        <form method="post" action='./php/subscribe.php' class=" subscribe flex relative w-full h-16">
                            <input type="email" name="emailSubscribe" required placeholder="Email address" id="" class="w-full h-full outline-none appearance-none px-4 bg-veryLightGray">
                            <button type="submit" class=" absolute btn bg-primary text-white font-bold h-12 top-1/2 -translate-y-1/2 right-2">Subscribe</button>
                        </form>

                    </div>
                    <address class="text-white"> <i class="fa fa-map-marker-alt" aria-hidden="true"></i> KN 4 Ave, Kigali</address>
                </div>

                <!-- contact container -->
                <div class="flex flex-col justify-center gap-4">
                    <h3 class="text-xl text-veryLightGray interval-top">Contact Us</h3>
                    <div class="flex flex-col text-white gap-8">
                        <div class="flex items-center gap-4">
                            <i class="fa fa-phone interval-top" aria-hidden="true"></i>
                            <div class="flex flex-col gap-y-1">
                                <a href="" class="text-sm text-veryLightGray hover:text-veryLightBlueIll interval-left">+250787450379</a>
                                <a href="" class="text-sm text-veryLightGray hover:text-veryLightBlueIll interval-left">+250787450379</a>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <i class="fa fa-envelope interval-top" aria-hidden="true"></i>
                            <div class="flex flex-col gap-y-1">
                                <a href="" class="text-sm text-veryLightGray hover:text-veryLightBlueIll interval-left">info@chuk.rw</a>


                            </div>
                        </div>
                    </div>
                </div>



                <!-- terms and condition container -->
                <div class="flex flex-col  justify-center gap-4">
                    <div class="flex  items-center ">
                        <img src="./img/devImgs/logo.png" class=" w-12 " alt="">
                        <p class=" font-bold text-lg md:text-xl text-veryLightGray">&nbsp&nbspServices </p>
                    </div>
                    <div class="grid grid-cols-2 text-white  gap-2">
                        <?php
                        $sql = " SELECT * FROM `department`";
                        $exe = $conn->query($sql);
                        if ($exe->num_rows > 0) {
                            $i = 1;
                            while ($row = $exe->fetch_array()) {
                        ?>
                                <span> <?php echo $i . ". " . $row['departmentName'] ?></span>
                        <?php
                                $i++;
                            }
                        }
                        ?>

                    </div>

                    <!-- socials -->
                    <div class=" flex gap-5  ">
                        <a href="#" target="_blank"><i class="fab fa-facebook-f  text-white transition-all duration-300 hover:translate-y-1  hover:text-veryLightGray text-2xl  interval-top  "></i></i></a>
                        <a href="#" target="_blank"><i class="fab fa-twitter text-white  transition-all duration-300 hover:translate-y-1 hover:text-veryLightGray text-2xl  interval-top"></i></a>
                        <a href="#"><i class="fab fa-instagram text-white transition-all duration-300 hover:translate-y-1  hover:text-veryLightGray text-2xl interval-top"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-linkedin text-white  transition-all duration-300 hover:translate-y-1 hover:text-veryLightGray text-2xl interval-top "></i></a>
                    </div>
                </div>
            </div>
            <div class="pb-10">
                <div class="text-sm text-veryLightGray  top-scr flex gap-y-4 flex-col md:flex-row md:justify-around px-10 w-full ">
                    <span class=" flex self-start">&copy

                        All
                        rights
                        reserved</span>

                </div>
            </div>
        </footer>

        <!-- go to the top button -->
        <a href="#Home" class=" top-btn hidden p-4 transition-all duration-300 bg-gradient-to-r from-green-400/70 to-blue-500/70 backdrop-blur-sm  text-white fixed  bottom-24 right-8 z-99 text-sm rounded-sm hover:-translate-y-1 hover:bg-opacity-95 group">
            <i class="fa fa-arrow-up animate-bounce  group-hover:animate-none " aria-hidden="true"></i>
        </a>

    </div>





    <script src="./js/toastr.min.js"></script>
    <script src="./js/sweetalert2.min.js">
    </script>

    <script src="./js/scrollreveal.min.js"></script>
    <script src="./js/index.js"></script>
    <script src="./js/scrolls.js"></script>
    <script src="./fontawesome/js/fontawesome.js"></script>

    <!--  live chat -->

    <!-- GetButton.io widget -->
    <script type="text/javascript">
        (function() {
            var options = {
                call: "+250787450379", // Call phone number
                whatsapp: "+250787450379", // WhatsApp number
                call_to_action: "", // Call to action
                button_color: "#129BF4", // Color of button
                position: "right", // Position may be 'right' or 'left'
                order: "call,whatsapp", // Order of buttons
            };
            var proto = 'https:',
                host = "getbutton.io",
                url = proto + '//static.' + host;
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = url + '/widget-send-button/js/init.js';
            s.onload = function() {
                WhWidgetSendButton.init(host, proto, options);
            };
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);

        })();
    </script>
    <!-- /GetButton.io widget -->


</body>

</html>