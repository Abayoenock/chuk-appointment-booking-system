


//after window is loaded completely 
window.onload = function () {
    //hide the preloader
    document.querySelector(".preloader").style.display = "none";
    //======================= to load the reviews

}





//nav show on small devices
const humbeger = document.querySelector(".humbeger");
const mobileMenu = document.querySelector(".mobile-menu");
humbeger.addEventListener('click', () => {
    humbeger.classList.toggle("open")
    mobileMenu.classList.toggle("show-menu")

})
/*=============== REMOVE MENU MOBILE ===============*/
const navLink = document.querySelectorAll('.mobile-menu li a')

function linkAction() {
    const mobileMenu = document.querySelector(".mobile-menu");
    const humbeger = document.querySelector(".humbeger");
    // When we click on each nav__link, we remove the show-menu class
    mobileMenu.classList.remove('show-menu')
    humbeger.classList.remove("open")
}
navLink.forEach(n => n.addEventListener('click', linkAction))

/*=============== CHANGE BACKGROUND HEADER ===============*/
function scrollHeader() {
    const header = document.getElementById('header')
    // When the scroll is greater than 80 viewport height, add the scroll-header class to the header tag
    if (this.scrollY >= 80) header.classList.add('scroll-header'); else header.classList.remove('scroll-header')
}
window.addEventListener('scroll', scrollHeader)

/*=============== SHOW SCROLL UP ===============*/
function scrollUp() {
    const scrollUp = document.querySelector('.top-btn');
    // When the scroll is higher than 400 viewport height, add the show-scroll class to the a tag with the scroll-top class
    if (this.scrollY >= 400) scrollUp.classList.remove('hidden'); else scrollUp.classList.add('hidden')
}
window.addEventListener('scroll', scrollUp)

/*=============== SCROLL SECTIONS ACTIVE LINK ===============*/
const sections = document.querySelectorAll('section[id]')


function scrollActive() {
    const scrollY = window.pageYOffset

    sections.forEach(current => {
        const sectionHeight = current.offsetHeight,
            sectionTop = current.offsetTop - 45,
            sectionId = current.getAttribute('id')

        if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
            document.querySelector('.mobile-menu a[href*=' + sectionId + ']').classList.add('active-link2')
        } else {
            document.querySelector('.mobile-menu a[href*=' + sectionId + ']').classList.remove('active-link2')
        }
    })
}
window.addEventListener('scroll', scrollActive)

// ===============================smooth scroll==============
$(function () {
    // Smooth Scrolling
    $('a[href*="#"]:not([href="#"])').click(function () {


        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }

    });
});
























//======================= for the send contact form

var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
});


// for the contact form 
$(".contact-form").unbind('submit').bind('submit', function () {

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
        success: function (response) {
            if (response.success == true) {
                Toast.fire({
                    icon: 'success',
                    title: response.messages
                })
                $(".contact-form input,.contact-form textarea").val('');


            }
            else {
                Toast.fire({
                    icon: 'error',
                    title: response.messages
                })

            }

        }
    });

    return false;
});

// for the reviews form
$(".review-form").unbind('submit').bind('submit', function () {

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
        success: function (response) {
            if (response.success == true) {
                Toast.fire({
                    icon: 'success',
                    title: response.messages
                })
                $(".review-form input,.review-form textarea").val('');
                $(".close-review-modal").click();


            }
            else {
                Toast.fire({
                    icon: 'error',
                    title: response.messages
                })

            }

        }
    });

    return false;
});
// for subscribe
$(".subscribe").unbind('submit').bind('submit', function () {

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
        success: function (response) {
            if (response.success == true) {
                Toast.fire({
                    icon: 'success',
                    title: response.messages
                })
                $(".subscribe input").val('');

            }
            else {
                Toast.fire({
                    icon: 'error',
                    title: response.messages
                })

            }

        }
    });

    return false;
});