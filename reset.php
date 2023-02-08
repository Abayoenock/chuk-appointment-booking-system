<?php
session_start();
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

    <link rel="stylesheet" href="./css/toastr.min.css">
    <link rel="stylesheet" href="./css/sweetalert2.min.css">
    <script src="./js/jquery.min.js"></script>

</head>

<body class="  w-screen overflow-x-hidden   ">

    <div class="md:flex items-center  min-h-screen w-full ">
        <div class=" flex items-center justify-center h-screen w-screen overflow-x-hidden ">
            <div class="w-1/2 h-full hidden md:flex flex-auto items-center justify-start p-10 overflow-hidden bg-purple-900 text-white bg-no-repeat bg-cover back0 relative">
                <div class="absolute bg-gradient-to-b from-primary to-gray-900 opacity-75 inset-0 z-0"></div>
                <div class="absolute triangle  min-h-screen right-0 w-16"></div>
                <a href="home" class="flex absolute top-5 text-center text-gray-100 focus:outline-none z-100"><img src="./img/devImgs/logo.png" class="object-cover mx-auto w-8 h-8 rounded-full ">
                    <p class="text-xl ml-3">CHUK </p>
                </a>
                <img src="./img/devImgs/online-doctor-appointment.png" class="h-96 absolute right-5 bottom-0 mr-0 z-100">
                <div class="w-full  max-w-md z-10">

                    <div class="flex flex-col gap-4">

                        <p>Having created an account, you can<br> book your appointment using <br>any of the available choice </p>
                        <div class="flex gap-3 ">
                            <div class=" w-6 h-6 flex justify-center items-center rounded-md bg-opacity-50 text-white bg-cyan-600 text-md font-bold">
                                1 </div>
                            <p>Using
                                this
                                system by logging in<br> and fill the form as required</p>
                        </div>
                        <div class="flex gap-3 items-center">
                            <div class=" w-6 h-6 flex justify-center items-center rounded-md bg-opacity-50 text-white bg-cyan-600 text-md font-bold">
                                2 </div>
                            <p> Using our USSD code <i class="fa fa-phone" aria-hidden="true"></i></p> <b>*662*800*111#</b>
                        </div>

                    </div>
                </div>
                <!---remove custom style-->
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
            <?php
            if (@$_GET['s'] == "") {
            ?>
                <div class=" w-full md:w-1/2 p-4 md:p-8">


                    <h2 class=" text-2xl font-bold tracking-wide text-primary">Reset your account password </h2>
                    <p class=" text-sm mt-2 p-4 bg-blue-100 text-blue-500 rounded-md">Hello , we have got your back , to reset your password all you need to do is fill out the phone number you used while registering for an account </p>


                    <form class="my-8 md:w-4/6 flex flex-col gap-2 text-sm submit" action="./backend/reset.php" method="POST">

                        <div class="flex flex-col w-full ">
                            <label for="code" class="text-gray-700 font-semibold ">Phone number</label>
                            <input type="text" name="phoneNumber" id="phoneNumber" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter the code " required>
                        </div>







                        <div class="my-4 flex items-center justify-end space-x-4">
                            <button class="bg-gradient-to-r from-green-400/70 to-blue-500/70  hover:bg-primary/80   hover:bg-gradient-to-r hover:from-blue-400/70 hover:to-green-500/70 transition eas duration-500 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl  uppercase">Send Code &nbsp <i class="fas fa-spinner animate-spin invisible" aria-hidden="true"></i> </button>
                        </div>
                    </form>

                </div>
            <?php
            } elseif (@$_GET['s'] == "verify") {
            ?>
                <div class=" w-full md:w-1/2 p-4 md:p-8">


                    <h2 class=" text-2xl font-bold tracking-wide text-primary">Verify your phone Number </h2>
                    <p class=" text-sm mt-2 p-4 bg-blue-100 text-blue-500 rounded-md">Hello , we have sent a verification code to your phone number enter the code in the input below </p>


                    <form class="my-8 md:w-4/6 flex flex-col gap-2 text-sm submit2" action="./backend/verify.php" method="POST">

                        <div class="flex flex-col w-full ">
                            <label for="code" class="text-gray-700 font-semibold ">Verification code </label>
                            <input type="text" name="code" id="code" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter the code " required>
                        </div>







                        <div class="my-4 flex items-center justify-end space-x-4">
                            <button class="bg-gradient-to-r from-green-400/70 to-blue-500/70  hover:bg-primary/80   hover:bg-gradient-to-r hover:from-blue-400/70 hover:to-green-500/70 transition eas duration-500 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl  uppercase">Verify &nbsp <i class="fas fa-spinner animate-spin invisible" aria-hidden="true"></i> </button>
                        </div>
                    </form>
                    <p class="text-sm text-gray-600 mt-2 md:w-1/2">If you haven't received the code, you can click on the resend button to get a new code <br><br>


                        <button class=" py-2 px-3 bg-primary rounded-md text-white resend"> <i class="fas fa-phone "></i> Resend Code &nbsp <i class="fas fa-spinner fa-spinner2 animate-spin invisible" aria-hidden="true"></i></button>
                    </p>
                </div>
            <?php
            } elseif (@$_GET['s'] == "reset") {
            ?>
                <div class=" w-full md:w-1/2 p-4 md:p-8">


                    <h2 class=" text-2xl font-bold tracking-wide text-primary">Reset Your Password </h2>



                    <form class="my-8 md:w-4/6 flex flex-col gap-2 text-sm submit3" action="./backend/reset.php?t=reset" method="POST">
                        <div class="flex flex-col  w-full gap-4 ">
                            <div class="flex flex-col my-0 w-full">
                                <label for="password" class="text-gray-700">Password</label>
                                <div x-data="{ show: false }" class="relative flex items-center mt-2">
                                    <input :type=" show ? 'text': 'password' " name="password" id="password" class="flex-1 p-2 border pr-10 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your password" type="password" required>
                                    <button @click="show = !show" type="button" class="absolute right-2 bg-transparent flex items-center justify-center text-gray-700">
                                        <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                        </svg>

                                        <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex flex-col my-0 w-full">
                                <label for="password_confirmation" class="text-gray-700">Password Confirmation</label>
                                <div x-data="{ show: false }" class="relative flex items-center mt-2">
                                    <input :type=" show ? 'text': 'password' " name="password_confirmation" id="password_confirmation" class="flex-1 p-2 pr-10 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your password again" type="password" required>
                                    <button @click="show = !show" type="button" class="absolute right-2 bg-transparent flex items-center justify-center text-gray-700">
                                        <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                        </svg>

                                        <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>







                        <div class="my-4 flex items-center justify-end space-x-4">
                            <button class="bg-gradient-to-r from-green-400/70 to-blue-500/70  hover:bg-primary/80   hover:bg-gradient-to-r hover:from-blue-400/70 hover:to-green-500/70 transition eas duration-500 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl  uppercase">Reset Password &nbsp <i class="fas fa-spinner animate-spin invisible" aria-hidden="true"></i> </button>
                        </div>
                    </form>

                </div>
            <?php
            }
            ?>

        </div>



        <script src="./js/toastr.min.js"></script>
        <script src="./js/sweetalert2.min.js"></script>

        <script src="./js/scrollreveal.min.js"></script>
        <script src="./js/index.js"></script>
        <script src="./js/scrolls.js"></script>
        <script src="./fontawesome/js/fontawesome.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!--  live chat -->

        <!-- GetButton.io widget -->
        <script type="text/javascript">
            $(document).ready(() => {

                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000
                });
                $(".submit").unbind('submit').bind('submit', function() {

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

                                setTimeout(() => {
                                    window.location = './reset-password?s=verify';
                                }, 2000);



                            } else {
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

                    //return false;
                });
                $(".submit2").unbind('submit').bind('submit', function() {

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

                                setTimeout(() => {
                                    window.location = './reset-password?s=reset';
                                }, 2000);



                            } else {
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
                $(".submit3").unbind('submit').bind('submit', function() {

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

                                setTimeout(() => {
                                    window.location = './dashboard';
                                }, 2000);



                            } else {
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
                $(".resend").click(() => {
                    $(".fa-spinner2 ").toggleClass("invisible");
                    fetch("./backend/resend.php")
                        .then((resp) => {
                            return resp.json();
                        }).then((backData) => {
                            const response = backData;
                            console.log(response);
                            if (response.success == true) {
                                Toast.fire({
                                    icon: 'success',
                                    title: response.messages
                                })
                                setTimeout(() => {
                                    $(".fa-spinner2").toggleClass("invisible");
                                }, 1000);

                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: response.messages
                                })
                                setTimeout(() => {
                                    $(".fa-spinner2").toggleClass("invisible");
                                }, 1000);

                            }



                        })
                });

            })
        </script>
        <!-- /GetButton.io widget -->


</body>

</html>