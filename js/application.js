
var typed = new Typed('#typed_animation', {
            strings: [" gaining new skills ", "Innovating ", " Building your dream project"  ],
            typeSpeed: 50,
            backSpeed: 50,
            loop: true,
            
            

 });

 var Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 5000
	});
    
const applyForm = document.querySelector(".apply-form"),
    successDiv = document.querySelector(".success-div"),
    successText = document.querySelector(".success-text");
     
	$(".apply-form").unbind('submit').bind('submit', function() {
		
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
			success:function(response) {
				if(response.success == true) {
					Toast.fire({
                        icon: 'success',
                        title: response.messages
                    })
                    $(".apply-form").addClass("hidden");
                    $(".success-div").removeClass("hidden");
                    $(".success-text").text("Your application was success fully received , you can check your email. and we will contact you shortly ");

                //    const applyForm = document.querySelector(".apply-form"),
                //         successDiv = document.querySelector(".success-div"),
                //         successText = document.querySelector(".success-text");
                //     applyForm.classList.add()

					
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