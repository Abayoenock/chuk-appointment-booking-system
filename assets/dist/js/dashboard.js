

const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
];


const data2 = {
    labels: labels,
    datasets: [{
        label: 'Commands',
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 25, 86)',
            'rgb(200, 129, 132)',
            'rgb(154, 162, 235)',
            'rgb(205, 205, 86)',
            'rgb(25, 109, 112)',
            'rgb(154, 12, 235)',
            'rgb(125, 125, 186)',
            'rgb(55, 199, 132)',
            'rgb(154, 36, 65)',
            'rgb(25, 20, 86)',
        ],
        hoverOffset: 4,
        data: [],
    }]
};

const data = {
    labels: labels,
    datasets: [{
        label: 'Commands',
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 25, 86)',
            'rgb(200, 129, 132)',
            'rgb(154, 162, 235)',
            'rgb(205, 205, 86)',
            'rgb(25, 109, 112)',
            'rgb(154, 12, 235)',
            'rgb(125, 125, 186)',
            'rgb(55, 199, 132)',
            'rgb(154, 36, 65)',
            'rgb(25, 20, 86)',
        ],
        hoverOffset: 4,
        data: [],
    }]
};

const config = {
    type: 'line',
    data: data2,
    options: {
        tooltips: {
            mode: 'index',
            intersect: false
        },
        hover: {
            mode: 'index',
            intersect: false
        },
        animations: {
            tension: {
                duration: 1000,
                easing: 'linear',
                from: 1,
                to: 0,
                loop: true
            }
        },
        scales: {
            y: { // defining min and max so hiding the dataset does not change scale range
                min: 0,
                max: 100
            }
        }
    }
};

const config2 = {
    type: 'doughnut',
    data: data,
    options: {

        hover: {
            mode: 'index',
            intersect: false
        },
        animations: {
            tension: {
                duration: 1000,
                easing: 'linear',
                from: 1,
                to: 0,
                loop: true
            }
        },
        scales: {
            y: { // defining min and max so hiding the dataset does not change scale range
                min: 0,
                max: 100
            }
        }
    }
};


const myChart2 = new Chart(
    document.getElementById('myChart2'),
    config2)

const myChart = new Chart(
    document.getElementById('myChart'),
    config)

// the script to handle the clock 
$(document).ready(function () {



    clockUpdate();

    setInterval(clockUpdate, 1000);



})

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

//the script to hangle fatching of data 
const fetchReportData = () => {
    fetch("./backend/fetch_data.php")
        .then((resp) => {
            return resp.json();
        })
        .then((backData) => {
            const gotData = backData;
            console.log(gotData);
            $('.labT').text(gotData.labT)
            $('.admins').text(gotData.admins)
            if (gotData.mode == 1) {
                $('.mode').html(`<i class="fa-solid fa-stopwatch-20"></i>`);
            }
            else {
                $('.mode').html(`<i class="fa-solid fa-land-mine-on"></i>`);
            }

            $('.motion').text(gotData.motion)
        });
}







const graphRecentData = () => {
    fetch("./backend/graphData.php")
        .then((resp) => {
            return resp.json();
        })

        .then((backData) => {
            const gotData = backData;
            const motion = gotData.map((e) => {
                return (e.motion)
            })

            const cmds = gotData.map((e) => {
                return (e.cmds)
            })

            const label = gotData.map((e) => {
                return (e.label)
            })



            //update charts
            myChart2.data.labels = label

            // myChart2.data.datasets[0].data = motion
            myChart2.data.datasets[0].data = motion
            myChart2.data.labels = label
            myChart2.update()


            // myChart2.data.datasets[0].data = motion
            myChart.data.datasets[0].data = cmds
            myChart.data.labels = label

            myChart.update()

        });
}

const fetchDoor = () => {
    fetch("./backend/doorStatus.php")
        .then((resp) => {
            return resp.json();
        }).then((backData) => {
            const gotData = backData;
            console.log(gotData[0]);
            if (gotData[0].cmd == 1) {
                $("#doorBtn").attr("checked", "checked");
                $(".door-icon").html(`<i class="fa-solid fa-door-closed text-[90px] text-white/30"></i>`)
            } else {
                $("#doorBtn").removeAttr("checked");
                $('.door-icon').html(`<i class="fa-solid fa-door-open text-[90px] text-white/30"></i>`)
            }


        })
}
const deviceActive = () => {
    fetch("./backend/lastSeen.php")
        .then((resp) => {
            return resp.json();
        }).then((backData) => {
            const gotData = backData;

            $("#active-text").text(gotData.lastSeen)



        })
}

$("#doorBtn").click(() => {

    //$("#doorBtn").removeAttr("checked");
    fetch("./backend/doorHandler.php")
        .then((resp) => {
            return resp.json();
        }).then((backData) => {
            const gotData = backData;
            console.log(gotData);
            const response = gotData
            if (response.success == true) {
                Toast.fire({
                    icon: 'success',
                    title: response.messages
                })
                fetchDoor();


            } else {
                Toast.fire({
                    icon: 'error',
                    title: response.messages
                })

            }


        })



})

fetchDoor();
graphRecentData();
fetchReportData();
deviceActive();
setInterval(() => {
    fetchReportData();
    fetchDoor();
    graphRecentData();
    deviceActive();
}, 2000);








