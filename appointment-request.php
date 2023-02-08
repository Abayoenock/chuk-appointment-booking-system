<div class="modal">
    <?php
    include './backend/db_conn.php';
    $day = $_GET['day'] . " 0:0:0";
    $departmentID = $_GET['depID'];
    $date = strtotime($day);
    ?>
    <a href="#" rel="modal:close" class="hidden close-modal">Close</a>
    <h1 class="font-bold ">Make an appointment </h1>
    <div class="w-full p-4">
        <p class=" bg-blue-100 text-sm p-4 rounded-sm text-blue-600">
            <i class="fa fa-info-circle" aria-hidden="true"></i>
            You can maKe an appointment with any doctor available below by clicking on their profile
        </p>
    </div>
    <form action="./backend/make-appointment.php?date=<?php echo $date; ?>&deptID=<?php echo $departmentID; ?>" method="POST" class="flex flex-col m-4  submit" enctype="multipart/form-data">
        <div class="flex justify-center gap-4 items-center ">
            <?php
            include './backend/db_conn.php';
            $sql = "SELECT * FROM `timetable` AS t INNER JOIN doctors as d on t.doctorID=d.doctorID WHERE t.departmentID='$departmentID' AND t.dateAvailable='$date'";
            $exe = $conn->query($sql);
            while ($row = $exe->fetch_array()) {
                $sql2 = "SELECT * FROM `appointments`  AS ap  INNER JOIN  `appointmentapproval` as a on a.appointmentID=ap.appointmentID  WHERE ap.appointmentDate='$date' AND a.appointmentApprove='1' AND ap.doctorID='" . $row['doctorID'] . "'";
                $exe2 = $conn->query($sql2);
                $numApproved = $exe2->num_rows;
                $sql2 = "SELECT * FROM `appointments`  WHERE appointmentDate='$date'AND appointmentStatus='0' AND doctorID='" . $row['doctorID'] . "'  ";
                $exe2 = $conn->query($sql2);
                $numTotal = $exe2->num_rows;
                $pending = $numTotal - $numApproved;
                $Available = $row['numberOfPatients'];


            ?>

                <div class=" ">
                    <input type="radio" name="doctor" id="doctor<?php echo $row['doctorID']; ?>" value="<?php echo $row['doctorID'] ?>" class="invisible" <?php if (($Available - $numApproved) <= 0) {
                                                                                                                                                                echo "disabled";
                                                                                                                                                            } ?>>
                    <label for="doctor<?php echo $row['doctorID']; ?>" class=" cursor-pointer ">
                        <div class="w-[120px] shadow-md p-2 rounded-md">
                            <img src="./img/profiles/<?php echo $row['profileImg']; ?>" alt="" width="100" height="100">
                            <p class="text-[10px]"><?php echo $row['title'] . ". " . $row['firstname'] . " " . $row['lastname']; ?></p>
                            <p>
                                <?php if ($Available >= $numApproved && $Available != 0) {
                                ?>
                                    <span class="text-green-400   text-[9px]"> Remaining: <?php echo ($Available - $numApproved); ?></span>
                                    <span class="text-yellow-400  text-[9px]"> Pending: <?php echo $pending; ?></span>
                                <?php

                                } else { ?>
                                    <span class="text-red-400  text-[9px]">Reached the limit </span>
                                <?php
                                }

                                ?>
                            </p>
                        </div>


                    </label>
                </div>

            <?php

            }

            ?>



        </div>
        <div class="div">
            <Label class="text-sm ">Refer Note <small class="text-[10px] text-gray-500 ">if you have one</small> </Label>
            <input type="file" name="file" id="" class=" mt-2">
        </div>
        <div class=" mt-8 w-full flex justify-center">
            <button class="bg-gradient-to-r from-green-400/70 to-blue-500/70 submit-btn  hover:bg-primary/80   hover:bg-gradient-to-r hover:from-blue-400/70 hover:to-green-500/70 transition eas duration-500 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl  ">Make Appointment &nbsp <i class="fas fa-spinner animate-spin invisible" aria-hidden="true"></i> </button>
        </div>



    </form>

    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });




        // Get references to the form and submit button
        const form = document.querySelector(".submit");
        const submitButton = document.querySelector(".submit-btn");
        form.addEventListener("submit", async (event) => {
            event.preventDefault();
            submitButton.disabled = true;
            $(".fa-spinner").toggleClass("invisible");
            const formData = new FormData(form);

            const response = await fetch("./backend/make-appointment.php?date=<?php echo $date; ?>&deptID=<?php echo $departmentID; ?>", {
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
                $(".close-modal").click();

                Swal.fire({
                    title: 'Making appointment request ',
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
                    fetch('./send-sms.php', options)
                        .then(response => response.json())
                        .then(response => {
                            console.log(response)
                            const st = response;
                            console.log(st.status);

                            if (st.status == "success") {
                                swal.close();

                                Swal.fire(
                                    'Appointment request successful',
                                    'Your appointment request was sent and waiting for confirmation ',
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
                loadData();



            } else {

                Toast.fire({
                    icon: 'error',
                    title: jsonData.messages
                })

                $(".fa-spinner").toggleClass("invisible");


            }



        });


        // $(".submit").unbind('submit').bind('submit', function() {
        //     Swal.fire({
        //         title: 'Processing Request...',
        //         html: 'Please wait...',
        //         allowEscapeKey: false,
        //         allowOutsideClick: false,
        //         didOpen: () => {
        //             Swal.showLoading()
        //         }
        //     });
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
        //                 });
        //                 Swal.close();

        //                 setTimeout(() => {
        //                     $(".fa-spinner").toggleClass("invisible");
        //                     $('.close-modal').click();
        //                     loadData();
        //                 }, 3000);



        //             } else {
        //                 Swal.close();
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
    </script>


</div>