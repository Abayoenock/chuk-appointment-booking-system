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
                        <th>Doctor</th>
                        <th>File</th>
                        <th>R.App</th>
                        <th>Action</th>


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
                        <th>Doctor</th>
                        <th>Approval Date</th>
                        <th>Action</th>


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
                        <th>Doctor</th>
                        <th>Decline Date</th>
                        <th>Action</th>


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
                                        data: 'doctorNames',


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


                                    {
                                        data: 'appointmentID',
                                        render: (id) => {

                                            return ` <div class="flex gap-2"> <span class="confirm-btn px-3 py-2 flex justify-center items-center rounded-md cursor-pointer bg-green-400 text-white" data-id=${id} id=${id}><i class="fa-solid fa-check text-sm "></i></span>
                                            <span class="decline-btn px-3 py-2 flex justify-center items-center  rounded-md cursor-pointer bg-red-400 text-white" data-id=${id} id=${id}><i class="fa-solid fa-times text-sm "></i></span></div>`
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
                                    return data.appointmentID == dataId;
                                })

                                let date = new Date(mydata[0].appointmentDate * 1000);
                                let month = addZero(date.getMonth() + 1);

                                function addZero(x) {
                                    if (x < 10) {
                                        return x = '0' + x;
                                    } else {
                                        return x;
                                    }
                                }
                                let dateA = `${addZero(date.getDate())}-${month} -${date.getFullYear()}`
                                var MyMessage = `hello ${mydata[0].patientNames}, Your appointment that you requested with ${mydata[0].doctorNames} on ${dateA} has been successfuly confirmed`
                                async function Message() {
                                    const {
                                        value: text
                                    } = await Swal.fire({
                                        // icon: 'question',
                                        title: 'Confirm Appointment',
                                        text: `
                                        Below in the form is the message that the client will receive you can change it to meet your needs `,
                                        input: 'textarea',
                                        inputLabel: 'Message',
                                        inputPlaceholder: 'Type your message here...',
                                        inputValue: MyMessage,
                                        inputAttributes: {
                                            'aria-label': 'Type your message here'
                                        },
                                        confirmButtonText: 'Confirm Appointment',
                                        showCancelButton: true
                                    })

                                    if (text) {
                                        //Swal.fire(text)
                                        Swal.fire({
                                            title: 'Approving Request...',
                                            html: 'Please wait...',
                                            allowEscapeKey: false,
                                            allowOutsideClick: false,
                                            didOpen: () => {
                                                Swal.showLoading()
                                            }
                                        });
                                        $.post("./backend/appointmentApprove.php", {
                                            phoneNumber: mydata[0].phoneNumber,
                                            message: MyMessage,
                                            task: 1,
                                            appointmentID: dataId,

                                        }, function(data) {
                                            console.log(data);
                                            if (data.success == true) {
                                                Swal.close();
                                                Swal.fire('Appointment Successfuly confirmed', '', 'success')
                                                loadData();
                                            } else {
                                                Swal.close();
                                                Swal.fire('Appointment Successfuly confirmed', '', 'error')
                                            }

                                        }, "json");

                                    }
                                }
                                Message();



                            })
                            $(".decline-btn").click(function() {
                                let dataId = $(this).attr("data-id");
                                let mydata = backData.filter((data) => {
                                    return data.appointmentID == dataId;
                                })

                                let date = new Date(mydata[0].appointmentDate * 1000);
                                let month = addZero(date.getMonth() + 1);

                                function addZero(x) {
                                    if (x < 10) {
                                        return x = '0' + x;
                                    } else {
                                        return x;
                                    }
                                }
                                let dateA = `${addZero(date.getDate())}-${month} -${date.getFullYear()}`
                                var MyMessage = `hello ${mydata[0].patientNames}, Your appointment that you requested with ${mydata[0].doctorNames} on ${dateA} has been Declined We are sorry for the inconvenience try on another day `
                                async function Message() {
                                    const {
                                        value: text
                                    } = await Swal.fire({
                                        // icon: 'question',
                                        title: 'Decline Appointment',
                                        text: `
                                        Below in the form is the message that the client will receive you can change it to meet your needs `,
                                        input: 'textarea',
                                        inputLabel: 'Message',
                                        inputPlaceholder: 'Type your message here...',
                                        inputValue: MyMessage,
                                        inputAttributes: {
                                            'aria-label': 'Type your message here'
                                        },
                                        confirmButtonText: 'Decline Appointment',
                                        showCancelButton: true
                                    })

                                    if (text) {
                                        //Swal.fire(text)
                                        Swal.fire({
                                            title: 'Declining Request...',
                                            html: 'Please wait...',
                                            allowEscapeKey: false,
                                            allowOutsideClick: false,
                                            didOpen: () => {
                                                Swal.showLoading()
                                            }
                                        });
                                        $.post("./backend/appointmentApprove.php", {
                                            phoneNumber: mydata[0].phoneNumber,
                                            message: MyMessage,
                                            task: 0,
                                            appointmentID: dataId,

                                        }, function(data) {
                                            console.log(data);
                                            if (data.success == true) {
                                                Swal.close();
                                                Swal.fire('Appointment Successfuly Declined', '', 'success')
                                                loadData();

                                            } else {
                                                Swal.close();
                                                Swal.fire('An error occured while  declining appointment', '', 'error')
                                            }

                                        }, "json");

                                    }
                                }
                                Message();

                            })


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
                                        data: 'doctorNames',


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


                                    {
                                        data: 'appointmentID',
                                        render: (id) => {

                                            return ` <div class="flex gap-2"> 
                                            <span class="decline-btn2 px-3 py-2 flex justify-center items-center  rounded-md cursor-pointer bg-red-400 text-white" data-id=${id} id=${id}><i class="fa-solid fa-times text-sm "></i></span></div>`
                                        }

                                    }

                                    ,








                                ],
                                dom: 'Bfrtip',
                                buttons: [
                                    'copy', 'csv', 'excel', 'pdf', 'print'
                                ]

                            });
                            $(".decline-btn2").click(function() {
                                let dataId = $(this).attr("data-id");
                                let mydata = backData.filter((data) => {
                                    return data.appointmentID == dataId;
                                })

                                let date = new Date(mydata[0].appointmentDate * 1000);
                                let month = addZero(date.getMonth() + 1);

                                function addZero(x) {
                                    if (x < 10) {
                                        return x = '0' + x;
                                    } else {
                                        return x;
                                    }
                                }
                                let dateA = `${addZero(date.getDate())}-${month} -${date.getFullYear()}`
                                var MyMessage = `hello ${mydata[0].patientNames}, Your appointment that you requested with ${mydata[0].doctorNames} on ${dateA} that was confirmed  has been now been Declined We are sorry for the inconvenience try on another day `
                                async function Message() {
                                    const {
                                        value: text
                                    } = await Swal.fire({
                                        // icon: 'question',
                                        title: 'Decline Appointment',
                                        text: `
                                        Below in the form is the message that the client will receive you can change it to meet your needs `,
                                        input: 'textarea',
                                        inputLabel: 'Message',
                                        inputPlaceholder: 'Type your message here...',
                                        inputValue: MyMessage,
                                        inputAttributes: {
                                            'aria-label': 'Type your message here'
                                        },
                                        confirmButtonText: 'Decline Appointment',
                                        showCancelButton: true
                                    })

                                    if (text) {
                                        //Swal.fire(text)
                                        Swal.fire({
                                            title: 'Declining Request...',
                                            html: 'Please wait...',
                                            allowEscapeKey: false,
                                            allowOutsideClick: false,
                                            didOpen: () => {
                                                Swal.showLoading()
                                            }
                                        });
                                        $.post("./backend/appointmentApprove.php", {
                                            phoneNumber: mydata[0].phoneNumber,
                                            message: MyMessage,
                                            task: 2,
                                            appointmentID: dataId,

                                        }, function(data) {
                                            console.log(data);
                                            if (data.success == true) {
                                                Swal.close();
                                                Swal.fire('Appointment Successfuly Declined', '', 'success')
                                                loadData();
                                            } else {
                                                Swal.close();
                                                Swal.fire('An error occured while  declining appointment', '', 'error')
                                            }

                                        }, "json");

                                    }
                                }
                                Message();

                            })


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
                                        data: 'doctorNames',


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


                                    {
                                        data: 'appointmentID',
                                        render: (id) => {

                                            return ` <div class="flex gap-2"> 
                                            <span class="confirm-btn2 px-3 py-2 flex justify-center items-center rounded-md cursor-pointer bg-green-400 text-white" data-id=${id} id=${id}><i class="fa-solid fa-check text-sm "></i></span></div>`
                                        }

                                    }

                                    ,








                                ],
                                dom: 'Bfrtip',
                                buttons: [
                                    'copy', 'csv', 'excel', 'pdf', 'print'
                                ]

                            });
                            $(".confirm-btn2").click(function() {
                                let dataId = $(this).attr("data-id");
                                let mydata = backData.filter((data) => {
                                    return data.appointmentID == dataId;
                                })

                                let date = new Date(mydata[0].appointmentDate * 1000);
                                let month = addZero(date.getMonth() + 1);

                                function addZero(x) {
                                    if (x < 10) {
                                        return x = '0' + x;
                                    } else {
                                        return x;
                                    }
                                }
                                let dateA = `${addZero(date.getDate())}-${month} -${date.getFullYear()}`
                                var MyMessage = `hello ${mydata[0].patientNames}, Your appointment that you requested with ${mydata[0].doctorNames} on ${dateA} that was declined  has been successfuly confirmed`
                                async function Message() {
                                    const {
                                        value: text
                                    } = await Swal.fire({
                                        // icon: 'question',
                                        title: 'Confirm Appointment',
                                        text: `
                                        Below in the form is the message that the client will receive you can change it to meet your needs `,
                                        input: 'textarea',
                                        inputLabel: 'Message',
                                        inputPlaceholder: 'Type your message here...',
                                        inputValue: MyMessage,
                                        inputAttributes: {
                                            'aria-label': 'Type your message here'
                                        },
                                        confirmButtonText: 'Confirm Appointment',
                                        showCancelButton: true
                                    })

                                    if (text) {
                                        //Swal.fire(text)
                                        Swal.fire({
                                            title: 'Approving Request...',
                                            html: 'Please wait...',
                                            allowEscapeKey: false,
                                            allowOutsideClick: false,
                                            didOpen: () => {
                                                Swal.showLoading()
                                            }
                                        });
                                        $.post("./backend/appointmentApprove.php", {
                                            phoneNumber: mydata[0].phoneNumber,
                                            message: MyMessage,
                                            task: 3,
                                            appointmentID: dataId,

                                        }, function(data) {
                                            console.log(data);
                                            if (data.success == true) {
                                                Swal.close();
                                                Swal.fire('Appointment Successfuly confirmed', '', 'success')
                                                loadData();
                                            } else {
                                                Swal.close();
                                                Swal.fire('Appointment Successfuly confirmed', '', 'error')
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