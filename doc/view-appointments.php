    <div class=" mt-10 w-full md:w-[calc(100%_-_410px)] myModal  p-4">
        <?php
        include '../backend/db_conn.php';
        $day = $_GET['day'];

        $date = strtotime($day . " 0:0:0");


        $day = $date;

        ?>
        <h3 class=" font-semibold text-yellow-500">Pending Appointments</h3>
        <div class=" pending-msg"></div>
        <div class="w-full pending-cont">

            <table id="table_id" class=" text-[9px] z-10 text-center ">
                <thead>
                    <tr class="">
                        <th>DateCreated</th>
                        <th>Patient </th>
                        <th>gender</th>
                        <th>BOD </th>
                        <th>Phone Number</th>

                        <th>File</th>
                        <th>R.App</th>



                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

        <h3 class="font-semibold text-green-400 mt-8 ">Approved Appointments</h3>
        <div class=" processed-msg"></div>
        <div class="w-full processed-cont">
            <table id="table_id2" class=" text-[9px] z-10 text-center ">
                <thead>
                    <tr class="">
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
        <h3 class="font-semibold text-red-400 mt-8 ">Declined Appointments</h3>
        <div class=" declined-msg"></div>
        <div class="w-full declined-cont">
            <table id="table_id3" class=" text-[9px] z-10 text-center ">
                <thead>
                    <tr class="">
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
        <script>
            if (typeof loadData === 'function') {
                loadData();
            } else {
                const loadData = () => {
                    fetch("./backend/appointments.php?t=pending&day=<?php echo $day; ?>")
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

                                    {
                                        data: 'pfile',
                                        render: (pfile) => {
                                            if (pfile != null) {
                                                return ` <a href = "../img/docs/${pfile}" target = "_blank" > <i class = "fa-solid fa-file-medical text-lg" > </i></a>`
                                            } else {
                                                return ` <i class="fa-solid fa-file-circle-xmark text-lg"></i>`
                                            }


                                        }


                                    },
                                    {
                                        data: 'totalPatients',



                                    },












                                ],
                                dom: 'Bfrtip',
                                buttons: [
                                    'copy', 'csv', 'excel', 'pdf', 'print'
                                ]

                            });



                        })

                    fetch("./backend/appointments.php?t=processed&day=<?php echo $day; ?>")
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
                                buttons: [
                                    'copy', 'csv', 'excel', 'pdf', 'print'
                                ]

                            });



                        })
                    fetch("./backend/appointments.php?t=declined&day=<?php echo $day; ?>")
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
                                buttons: [
                                    'copy', 'csv', 'excel', 'pdf', 'print'
                                ]

                            });



                        })

                }
                loadData();
            }
        </script>
    </div>