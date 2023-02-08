<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHUK Appointment booking
        system</title>
    <link rel="shortcut icon" href="../img/devImgs/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../fontawesome/css/all.css">

    <link rel="stylesheet" href="../css/toastr.min.css">
    <link rel="stylesheet" href="../css/sweetalert2.min.css">
    <script src="../js/jquery.min.js"></script>

</head>

<body class=" relative w-screen overflow-x-hidden   ">
    <a href="../home" class="flex absolute top-5 text-center text-gray-100  z-100"><img src="../img/devImgs/logo.png" class="object-cover mx-auto w-8 h-8 rounded-full ">
        <p class="text-xl ml-3">CHUK </p>
    </a>
    <div class="relative min-h-screen flex ">
        <div class="flex flex-col sm:flex-row items-center md:items-start sm:justify-center md:justify-start flex-auto min-w-0 bg-white  ">
            <div class="sm:w-1/2 xl:w-2/5 h-full hidden md:flex flex-auto items-center justify-start p-10 overflow-hidden bg-purple-900 text-white bg-no-repeat bg-cover back0 relative">
                <div class="absolute bg-gradient-to-b from-primary to-gray-900 opacity-75 inset-0 z-0"></div>
                <div class="absolute triangle  min-h-screen right-0 w-16"></div>

                <img src="../img/devImgs/online-doctor-appointment.png" class="h-96 absolute right-5 bottom-0 mr-0 z-100">
                <div class="w-full  max-w-md z-10">
                    <div class="sm:text-4xl xl:text-5xl font-bold leading-tight mb-6">CHUK Appointment system </div>
                    <div class="flex flex-col gap-4">
                        <p>Your work has just been made easier , No more lots of people to at your door front seeking for an appointment with the doctor</p>
                        <p>It is easy , just login into your account , from there you will be able to see the appointments made , and you can respond to them acordingly</p>



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
            <div class="md:flex md:items-center md:justify-center w-full sm:w-auto md:h-full  xl:w-2/5 p-8  md:p-10 lg:p-14 sm:rounded-lg md:rounded-none bg-white ">
                <div class="max-w-md w-full space-y-8">
                    <div class="text-center">
                        <h2 class="mt-6 text-3xl font-bold text-gray-900">
                            Welcom Back!
                        </h2>
                        <p class="mt-2 text-sm text-gray-500">Please sign in to your account</p>
                    </div>


                    <form class="mt-8 space-y-6 submit" action="./backend/login.php" method="POST">
                        <input type="hidden" name="remember" value="true">
                        <div class="relative">

                            <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Email</label>
                            <input class="w-full mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" type="email" placeholder="Enter your password" type="" placeholder="mail@gmail.com" name="email" value="" required>
                            <div class="absolute right-3 -mt-8 hidden"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class=" content-center">
                            <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                                Password
                            </label>
                            <input class="w-full mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" name="password" type="password" placeholder="Enter your password" value="" require>
                        </div>
                        <div class="flex items-center justify-between">

                            <div class="text-sm">
                                <a href="#" class="text-indigo-400 hover:text-blue-500">
                                    Forgot your password?
                                </a>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="w-full flex justify-center bg-gradient-to-r from-green-400/70 to-blue-500/70  hover:bg-primary/80   hover:bg-gradient-to-r hover:from-blue-400/70 hover:to-green-500/70 text-gray-100 p-4  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">
                                Sign in
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="../js/toastr.min.js"></script>
    <script src="../js/sweetalert2.min.js"></script>

    <script src="../js/scrollreveal.min.js"></script>
    <script src="../js/index.js"></script>
    <script src="../js/scrolls.js"></script>
    <script src="../fontawesome/js/fontawesome.js"></script>
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


        $(document).ready(() => {

            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            });
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
                                window.location = './dashboard';
                            }, 2000);



                        } else if (response.success == false) {
                            Toast.fire({
                                icon: 'error',
                                title: response.messages
                            })

                        }

                    }
                });

                return false;
            });

        })
    </script>
    <!-- /GetButton.io widget -->


</body>

</html>