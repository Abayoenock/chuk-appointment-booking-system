<div class="modal">
    <?php
    session_start();
    include '../backend/db_conn.php';
    $day = $_GET['day'];

    $date = strtotime($day . " 0:0:0");


    if (!($_SESSION['recepSession'])) {
        header("Location: ./");
    } else {
        $userID = $_SESSION['recepSession'];
        $sql = "SELECT * FROM receptionist WHERE recpID='$userID'";
        $exe = $conn->query($sql);
        while ($row = $exe->fetch_array()) {
            $usernames = $row['firstname'] . " " . $row['lastname'];
            $departmentID = $row['departmentID'];
        }
    }
    ?>

    <a href="#" rel="modal:close" class="hidden close-modal">Close</a>
    <h1 class="font-bold ">Set Time Table </h1>
    <div class="w-full p-4">
        <p class=" bg-blue-100 text-sm p-4 rounded-sm text-blue-600">
            <i class="fa fa-info-circle" aria-hidden="true"></i>
            To set time table, choose the doctor by clicking on their profile, and then enter the number of patients that he/she will receive
        </p>
    </div>
    <div class="w-full flex ">
        <form action="./backend/setTimeTable.php?date=<?php echo $date; ?>" method="POST" class="flex flex-col m-4  submit w-1/2">
            <div class="flex justify-center gap-4 items-center ">
                <?php
                include './backend/db_conn.php';
                $sql = "SELECT * FROM  doctors  WHERE departmentID='$departmentID' ";
                $exe = $conn->query($sql);
                while ($row = $exe->fetch_array()) {
                    $doctorID = $row['doctorID'];
                    $sql2 = "SELECT * FROM `timetable`  WHERE doctorID='$doctorID' AND dateAvailable='$date'";
                    $exe2 = $conn->query($sql2);
                    $num = $exe2->num_rows;



                ?>

                    <div class=" ">
                        <input type="radio" name="doctor" id="doctor<?php echo $row['doctorID']; ?>" value="<?php echo $row['doctorID'] ?>" class="invisible" <?php if ($num > 0) {
                                                                                                                                                                    echo "disabled";
                                                                                                                                                                } ?>>
                        <label for="doctor<?php echo $row['doctorID']; ?>" class=" cursor-pointer ">
                            <div class="w-[120px] shadow-md p-2 rounded-md">
                                <img src="../img/profiles/<?php echo $row['profileImg']; ?>" alt="" width="100" height="100">
                                <p class="text-[10px]"><?php echo $row['title'] . ". " . $row['firstname'] . " " . $row['lastname']; ?></p>

                            </div>


                        </label>
                    </div>

                <?php

                }

                ?>



            </div>
            <div class=" w-full flex justify-center items-center mt-2">
                <input type="number" name="number" id="" placeholder="Enter number" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900">
            </div>
            <div class=" mt-4 w-full flex justify-center">
                <button class="bg-gradient-to-r from-green-400/70 to-blue-500/70  hover:bg-primary/80   hover:bg-gradient-to-r hover:from-blue-400/70 hover:to-green-500/70 transition eas duration-500 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl  ">Set Time&nbsp <i class="fas fa-spinner animate-spin invisible" aria-hidden="true"></i> </button>
            </div>



        </form>
        <div class="w-1/2">
            <h3 class=" font-semibold text-yellow-500">Current Set Doctors</h3>
            <div class=" pending-msg"></div>
            <div class="w-full pending-cont">

                <table id="table_id" class=" text-[9px] z-10 text-center ">
                    <thead>
                        <tr class="">
                            <th>Doctor</th>
                            <th>Patients </th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>
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
                        });

                        setTimeout(() => {
                            $(".fa-spinner").toggleClass("invisible");
                            $('.close-modal').click();
                            loadTimeTable(1);
                            loadData();
                        }, 3000);



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
        if (typeof loadData === 'function') {
            loadData();
        } else {
            const loadData = () => {
                fetch("./backend/fetchTimeTableDoctors.php?day=<?php echo $date; ?>")
                    .then((resp) => {
                        return resp.json();
                    }).then((backData) => {
                        const gotData = backData;
                        console.log(gotData);
                        if (gotData.length == 0) {
                            $(".pending-cont").hide()
                            $('.pending-msg').html(` <p class=" bg-blue-100 text-sm p-4 rounded-sm text-blue-600 mt-4 mb-4">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                You have not set any time table yet
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
                                    data: 'doctorNames',


                                },
                                {
                                    data: 'numberSet',


                                },


                                {
                                    data: 'timeTableId',
                                    render: (id) => {

                                        return ` <div class="flex gap-2"> <span class="confirm-btn px-3 py-2 flex justify-center items-center rounded-md cursor-pointer bg-green-400 text-white" data-id=${id} id=${id}><i class="fa-solid fa-edit text-sm "></i></span>
                                           </div>`
                                    }

                                }

                                ,








                            ],
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ]

                        });
                        $(".confirm-btn").click(function() {
                            let dataId = $(this).attr("data-id");
                            let mydata = backData.filter((data) => {
                                return data.timeTableId == dataId;
                            })

                            let numberOfP = mydata[0].numberSet;


                            async function Message() {
                                const {
                                    value: numberOf
                                } = await Swal.fire({
                                    // icon: 'question',
                                    title: 'Edit number of appointments',
                                    text: `
                                        You can Edit the number by editing the contents of the input below `,
                                    input: 'number',
                                    inputLabel: 'Number Of Patients',
                                    inputPlaceholder: 'Type number here...',
                                    inputValue: numberOfP,
                                    inputAttributes: {
                                        'aria-label': 'Type number here'
                                    },
                                    confirmButtonText: 'Edit ',
                                    showCancelButton: true
                                })

                                if (numberOf) {

                                    Swal.fire({
                                        title: 'Editing ...',
                                        html: 'Please wait...',
                                        allowEscapeKey: false,
                                        allowOutsideClick: false,
                                        didOpen: () => {
                                            Swal.showLoading()
                                        }
                                    });
                                    $.post("./backend/editTimeTablePatients.php", {

                                        number: numberOf,
                                        task: 1,
                                        timeTableID: dataId,

                                    }, function(data) {
                                        console.log(data);
                                        if (data.success == true) {
                                            Swal.close();
                                            Swal.fire('The number of clients updated successfuly', '', 'success')
                                            loadData();
                                        } else {
                                            Swal.close();
                                            Swal.fire('An error occured while updating', '', 'error')
                                        }

                                    }, "json");

                                }
                            }
                            Message();



                        })



                    })
            }
            loadData();
        }
    </script>


</div>