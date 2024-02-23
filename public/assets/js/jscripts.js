
var token = $('#txt_token').val();
var site_url = $('#site_url').val();
var PAYSKey = $('#PAYSKey').val() !== undefined ? atob($('#PAYSKey').val()) : '';

// alert($('#PAYSKey').val())

//var xx;
// alert(site_url)

//chinnyfity@yahoo.com, dhdjh@ssss.sss



function alertMsg(milisec){
  setTimeout(function(){
    $(".alert1, .overlay1").fadeOut('fast');
  },milisec);
  return;
}

function errorAlertDanger(msg){
  var msg1 = msg.replace(/,/g, "<br>");
  $(".alert1").removeClass('alert-success').addClass('alert-danger').show().html(msg1);
  $(".overlay1").show();
}


function myExecutions(email, token, self) {
  var datastring='email='+email
  +'&_token='+token;

  $.ajax({
    type : "POST",
    url : site_url + "admin/page/validate-user-emails",
    data: datastring,
    success : function(data){
      $(self).removeAttr('disabled').css({'opacity': '1'});
      $('.display_email_data').html(data).css('opacity', 1);
    }
  })
}


$('body').on('click', '.validateEmail', function (e) {
  var email = $('.emails').val();
  var emails = email.split(',');
  var self = this;

  if (emails.length > 10) {
    errorAlertDanger("You can only enter a maximum of 10 emails at a go");
    alertMsg(4000);
    clearInterval(interval);
    return;
  }

  $(self).attr('disabled', true).css({'opacity': '0.4'});
  var counter = 0;
  $('.display_email_data').html('<div style="text-align:center;font-size:16px;font-weight:600">Loading...</div>').css('opacity', '0.4');

  var interval = setInterval(function() {
    myExecutions(emails[counter], token, self);
    counter++;

    if (counter === emails.length) {
      clearInterval(interval);
      var datastring='email='+emails[counter]
      +'&_token='+token;
      $.ajax({
        type : "POST",
        url : site_url + "admin/page/clrs",
        data: datastring,
        success : function(data){
        }
      })

    }
  }, 2000);
});


$('body').on('click', '.addUsers', function (e) {
  e.preventDefault();
  var self = this;
  var results = '';
  $(self).attr('disabled', true).css({'opacity': '0.4'});

  $.ajax({
    type : "POST",
    url : site_url + "admin/page/add-users",
    data: $(".form_add_users").serialize(),
    success : function(data){
      $.each(data, function(){
        results += this + "<br>";
      });

      if(data.status=="success"){
        $(self).removeAttr('disabled').css({'opacity': '1'});
        Swal.fire("Successful", "User details has been sent to their email", "success");
        $(".form_add_users")[0].reset();

        setTimeout(() => {
          location.reload();
        }, 3000);

      }else{
        $(self).removeAttr('disabled').css({'opacity': '1'});
        Swal.fire({
          title: "Error!",
          html: results,
          icon: 'error',
          timer: 3000
        });
      }
    },error : function(data){
      $(self).removeAttr('disabled').css({'opacity': '1'});
      Swal.fire({
        title: "Error!",
        text: "Poor Network Connection!",
        icon: 'error',
        timer: 3000
      });
    }
  });
});



$('body').on('click', '.submitAnswers', function (e) {
  e.preventDefault();
  var self = this;
  var results = '';

  Swal.fire({
    title: `Confirm action?`,
    html: `Submitting this cannot be undone, cross-check your answers before submitting, proceed anyway?`,
    icon: 'question',
    iconHtml: '?',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#999',
    confirmButtonText: 'Yes, proceed'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: 'Updating...',
        text: "Please wait a second for a response...",
        icon: 'success',
        showConfirmButton: false,
        confirmButtonColor: '#027937',
        cancelButtonColor: '#d33',
      });
      $(self).attr('disabled', true).css({'opacity': '0.4'});

      $.ajax({
        type : "POST",
        url : site_url + "submit-answers",
        data: $(".quiz_questions").serialize(),
        success : function(data){
          $.each(data, function(){
            results += this + "<br>";
          });

          if(data.status=="success"){
            $(self).removeAttr('disabled').css({'opacity': '1'});
            $(".quiz_questions")[0].reset();
            // window.location.href = "../"; // show ur scores

          }else{
            $(self).removeAttr('disabled').css({'opacity': '1'});
            Swal.fire({
              title: "Error!",
              html: results,
              icon: 'error',
              timer: 4000
            });
          }
        },error : function(data){
          $(self).removeAttr('disabled').css({'opacity': '1'});
          Swal.fire({
            title: "Error!",
            text: "Poor Network Connection!",
            icon: 'error',
            timer: 4000
          });
        }
      });
    }
  });
});






$('body').on('click', '.storeSession', function (e) {
  e.preventDefault();
  var self = this;
  var results = '';
  $(self).attr('disabled', true).css({'opacity': '0.4'});
  var quiz_session = $('.quiz_session').val();
  var course_id = $('.course_id').val();


  $.ajax({
    type : "POST",
    url : site_url + "add-quiz-session",
    data: $(".quiz_forms_input").serialize(),
    success : function(data){
      $.each(data, function(){
        results += this + "<br>";
      });

      if(data.status=="success"){
        $(self).removeAttr('disabled').css({'opacity': '1'});
        // Swal.fire("Successful", "Quiz session has been created. You can now add questions and answers", "success");

        // $(".questions_form").fadeIn('fast');
        //window.location.href = site_url + 'dashboard/profile/';
        window.location.href = course_id + '/enter-quiz-'+quiz_session;

      }else{
        $(self).removeAttr('disabled').css({'opacity': '1'});
        Swal.fire({
          title: "Error!",
          html: results,
          icon: 'error',
          timer: 4000
        });
      }
    },error : function(data){
      $(self).removeAttr('disabled').css({'opacity': '1'});
      Swal.fire({
        title: "Error!",
        text: "Poor Network Connection!",
        icon: 'error',
        timer: 4000
      });
    }
  });
});


$('body').on('click', '.storeQuiz', function (e) {
  e.preventDefault();
  var self = this;
  var results = '';
  $(self).attr('disabled', true).css({'opacity': '0.4'});

  $.ajax({
    type : "POST",
    url : site_url + "submit-quizzes",
    data: $(".quiz_forms_input").serialize(),
    success : function(data){
      $.each(data, function(){
        results += this + "<br>";
      });

      if(data.status=="success"){
        $(self).removeAttr('disabled').css({'opacity': '1'});

        $caption = "updated";
        if($('.quiz_each_id').val() == ""){
          $(".reset").val('');
          $caption = "added";
        }
        Swal.fire("Successful", `Questions have been ${$caption} to this session`, "success");

        $(".questions_form").fadeIn('fast');

      }else{
        $(self).removeAttr('disabled').css({'opacity': '1'});
        Swal.fire({
          title: "Error!",
          html: results,
          icon: 'error',
          timer: 4000
        });
      }
    },error : function(data){
      $(self).removeAttr('disabled').css({'opacity': '1'});
      Swal.fire({
        title: "Error!",
        text: "Poor Network Connection!",
        icon: 'error',
        timer: 4000
      });
    }
  });
});


$('body').on('click', '.saveUpdate', function (e) {
  e.preventDefault();
  var self = this;
  var results = '';
  $(self).attr('disabled', true).css({'opacity': '0.4'});

  $.ajax({
    type : "POST",
    url : site_url + "admin/page/update-prvdg",
    data: $(".form_add_priv").serialize(),
    success : function(data){
      if(data.status=="success"){
        $(self).removeAttr('disabled').css({'opacity': '1'});
        Swal.fire({
          title: "Successful",
          html: "User priviledges has been updated",
          icon: 'success',
          timer: 3000
        });
        $('.btn-close').trigger('click');

        // setTimeout(() => {
        //   location.reload();
        // }, 3000);

      }else{
        $(self).removeAttr('disabled').css({'opacity': '1'});
        Swal.fire({
          title: "Error!",
          html: data.message,
          icon: 'error',
          timer: 3000
        });
      }
    },error : function(data){
      $(self).removeAttr('disabled').css({'opacity': '1'});
      Swal.fire({
        title: "Error!",
        text: "Poor Network Connection!",
        icon: 'error',
        timer: 3000
      });
    }
  });
});


$('body').on('click', '.sendBroadcast', function (e) {
  var self = this;
  var results = '';
  $(self).attr('disabled', true).css({'opacity': '0.4'});

  $.ajax({
    type : "POST",
    url : site_url + "admin/page/send-broadcast",
    data: $(".form_channel").serialize(),
    success : function(data){
      // $.each(data, function(){
      //   results += this + "<br>";
      // });

      if(data.status=="success"){
        $(self).removeAttr('disabled').css({'opacity': '1'});
        Swal.fire("Successful", "Broadcast sent to their channels", "success");
        $(".form_channel")[0].reset();

      }else{
        $(self).removeAttr('disabled').css({'opacity': '1'});
        Swal.fire({
          title: "Error!",
          html: data.message,
          icon: 'error',
          timer: 3000
        });
      }
    },error : function(data){
      $(self).removeAttr('disabled').css({'opacity': '1'});
      Swal.fire({
        title: "Error!",
        text: "There are some wrong email addresses or phone numbers",
        icon: 'error',
        timer: 5000
      });
    }
  });
});


$('body').on('click', '.sendBroadcastUser', function (e) {
  var self = this;
  var results = '';
  $(self).attr('disabled', true).css({'opacity': '0.4'});

  $.ajax({
    type : "POST",
    url : site_url + "send-broadcast",
    data: $(".form_channel").serialize(),
    success : function(data){
      // $.each(data, function(){
      //   results += this + "<br>";
      // });

      if(data.status=="success"){
        $(self).removeAttr('disabled').css({'opacity': '1'});
        Swal.fire("Successful", "Broadcast sent to their channels", "success");
        $(".form_channel")[0].reset();

      }else{
        $(self).removeAttr('disabled').css({'opacity': '1'});
        Swal.fire({
          title: "Error!",
          html: data.message,
          icon: 'error',
          timer: 3000
        });
      }
    },error : function(data){
      $(self).removeAttr('disabled').css({'opacity': '1'});
      Swal.fire({
        title: "Error!",
        text: "There are some wrong email addresses or phone numbers",
        icon: 'error',
        timer: 5000
      });
    }
  });
});


$('body').on('click', '.reactFeatures', function (e) {
  e.preventDefault();
  var self = this;
  var results = '';
  var ids = $(this).attr('ids');
  var status1 = $(this).attr('status');

  Swal.fire({
    title: `Proceed to ${status1} this feature?`,
    html: `Don't worry, this can always be undone`,
    icon: 'question',
    iconHtml: '?',
    showCancelButton: true,
    confirmButtonColor: '#027937',
    cancelButtonColor: '#d33',
    confirmButtonText: `Yes ${status1}`,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: 'Processing...',
        text: "Please wait a second for a response...",
        icon: 'success',
        showConfirmButton: false,
        confirmButtonColor: '#027937',
        cancelButtonColor: '#d33',
      });

      $(self).attr('disabled', true).css({'opacity': '0.4'});

      var datastring='id='+ids
      +'&_token='+token;

      $.ajax({
        type : "POST",
        url : site_url + "admin/page/react-feature",
        data: datastring,
        success : function(data){
          if(data.status=="success"){
            $(self).removeAttr('disabled').css({'opacity': '1'});
            Swal.fire({
              title: "Successful",
              html: data.message,
              icon: 'success',
              timer: 2000
            });
            setTimeout(() => {
              location.reload();
            }, 1500);

          }else{
            $(self).removeAttr('disabled').css({'opacity': '1'});
            Swal.fire({
              title: "Error!",
              html: data.message,
              icon: 'error',
              timer: 4000
            });
          }
        },error : function(data){
          $(self).removeAttr('disabled').css({'opacity': '1'});
          Swal.fire({
            title: "Error!",
            text: "Poor Network Connection!",
            icon: 'error',
            timer: 3000
          });
        }
      });
    }
  })
});



$('body').on('click', '.addTimer', function (e) {
  $('.dynamic_timer').slideToggle('fast');
});



$('body').on('click', '.accessCourse', function (e) {
  e.preventDefault();
  var self = this;
  var results = '';
  $(self).attr('disabled', true).css({'opacity': '0.4'});

  $.ajax({
    type : "POST",
    url : site_url + "get-access-course",
    data: $(".form_access_course").serialize(),
    success : function(data){
      if(data.status=="success"){
        $(self).removeAttr('disabled').css({'opacity': '1'});
        Swal.fire("Successful", "Authentication was successful", "success");
        $(".form_access_course")[0].reset();

        setTimeout(() => {
          location.reload();
        }, 300);

      }else{
        $(self).removeAttr('disabled').css({'opacity': '1'});
        Swal.fire({
          title: "Error!",
          html: data.message,
          icon: 'error',
          timer: 3000
        });
      }
    },error : function(data){
      $(self).removeAttr('disabled').css({'opacity': '1'});
      if(data.status == 422){
          Swal.fire({
            title: "Error!",
            text: data.responseJSON.message,
            icon: 'error',
            timer: 3000
          });
      }else{
        Swal.fire({
          title: "Error!",
          text: "Poor Network Connection!",
          icon: 'error',
          timer: 3000
        });
      }
    }
  });
});



$('body').on('click', '.cmdPayNow', function (e) {
  var self = this;
  var results = '';
  $(self).attr('disabled', true).css({'opacity': '0.4'});

  // alert(site_url)

  $.ajax({
    type : "POST",
    url : site_url + "stripe",
    data: $(".stripe_payment").serialize(),
    success : function(data){
      // $.each(data, function(){
      //   results += this + "<br>";
      // });

      if(data.status=="success"){
        $(self).removeAttr('disabled').css({'opacity': '1'});
        // Swal.fire("Successful", "Broadcast sent to their channels", "success");
        alert('Broadcast sent to their channels')
        // $(".stripe_payment")[0].reset();

      }else{
        $(self).removeAttr('disabled').css({'opacity': '1'});
        Swal.fire({
          title: "Error!",
          html: data.message,
          icon: 'error',
          timer: 3000
        });
      }
    },error : function(data){
      $(self).removeAttr('disabled').css({'opacity': '1'});
      Swal.fire({
        title: "Error!",
        text: "There are some wrong email addresses or phone numbers",
        icon: 'error',
        timer: 5000
      });
    }
  });
});




var $form = $(".require-validation");

function stripeResponseHandler_(status, response) {
  if (response.error) { // uncomment later
    errorAlertDanger("Error! " + response.error.message);
    alertMsg(5000);
    $('.cmdPayNow').removeAttr('disabled').css({'opacity': 1});
    return;
  }

  // insert the token into the form so it gets submitted to the server
  $form.find('input[type=text]').empty(); // uncomment later

  $('.stripeToken').val('tok_mastercard');
  var token1 = $('.stripeToken').val();
  var amount = $('#txtFinalAmt').val();

  var datastring='params='
  +'&_token='+token
  +'&amount='+amount
  +'&stripeToken='+token1;

  $.ajax({
    type: "POST",
    url: site_urls + "stripe_pay",
    data: datastring,
    success:function(data){
      if(data.status == "success"){

        $('.cmdPayNow').removeAttr('disabled').css({'opacity': '1'});

        $('.payment_form').hide();
        $('.receipt').show();

        $('.receipt_link').html(`<a target="_blank" class="btn btn-primary pe-6 ps-6" href="${data.msg.receipt_url}">View your receipt</a>`); // receipt_url is gotten from stripepay response data

      }else if(data.status == "failed"){
        errorAlertDanger(data.message);
        alertMsg(5000);

      }else{
        errorAlertDanger(data.msg);
        alertMsg(5000);
        $('.cmdPayNow').removeAttr('disabled').css({'opacity': '1'});
      }

    },error: function(data){
      $('.cmdPayNow').removeAttr('disabled').css({'opacity': '1'});
      errorAlertDanger(data.message);
      alertMsg(5000);
    }
  });

}



$('body').on('click', '.cmdPayNow_', function (e) {
  // alert('sssss')
  e.preventDefault();
  $(".alert1, .overlay1").hide();
  var self = this;
  var results = '';
  $('.stripeToken').val('');

  // do validation here
  var $form     = $(".require-validation"),
  inputSelector = ['input[type=email]',
                  'input[type=text]',
                  'input[type=number]'].join(', '),
  $inputs       = $form.find('.required').find(inputSelector),
  valid         = true;

  $(self).attr('disabled', true).css({'opacity': '0.4'});

  // stripeResponseHandler('', ''); // comment later
  // return; // comment later

  var card_number = $('.card-number').val();
  card_number = card_number.replace(/ /g, '');

  Stripe.setPublishableKey($form.data('stripe-publishable-key'));
  var response = Stripe.createToken({
      number: card_number,
      cvc: $('.card-cvc').val(),
      exp_month: $('.card-expiry-month').val(),
      exp_year: $('.card-expiry-year').val()
  }, stripeResponseHandler);

  //alert(response.error.code);

});





var $form = $(".require-validation");
$('form.require-validation').bind('submit', function(e) {
    var $form = $(".require-validation"),
    inputSelector = ['input[type=email]', 'input[type=password]',
                     'input[type=text]', 'input[type=file]',
                     'textarea'].join(', '),
    $inputs = $form.find('.required').find(inputSelector),
    $errorMessage = $form.find('div.error'),
    valid = true;
    $errorMessage.addClass('hide');

    $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('hide');
        e.preventDefault();
      }
    });


    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }
});



/*------------------------------------------

--------------------------------------------

Stripe Response Handler

--------------------------------------------

--------------------------------------------*/

function stripeResponseHandler(status, response) {
    if (response.error) {
        $('.error')
            .removeClass('hide')
            .find('.alert')
            .text(response.error.message);
    } else {
        /* token contains id, last4, and card type */
        var token = response['id'];
        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        $form.get(0).submit();
    }
}







$('body').on('click', '.deleteReqs', function (e) {
  e.preventDefault();
  var self = this;
  var results = '';
  var ids = $(this).attr('ids');

  Swal.fire({
    title: `Confirm action?`,
    html: `Deleting this cannot be undone, proceed?`,
    icon: 'question',
    iconHtml: '?',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#999',
    confirmButtonText: 'Yes, proceed'
  }).then((result) => {
    if (result.isConfirmed) {
    Swal.fire({
        title: 'Deleting...',
        text: "Please wait a second for a response...",
        icon: 'success',
        showConfirmButton: false,
        confirmButtonColor: '#027937',
        cancelButtonColor: '#d33',
    });

    $(self).attr('disabled', true).css({'opacity': '0.4'});

    var datastring='ids='+ids
    +'&_token='+token;

    $.ajax({
        type : "POST",
        url : site_url + "delete-requirement",
        data: datastring,
        success : function(data){
        $.each(data, function(){
            results += this + "<br>";
        });

        if(data.status=="success"){
          $(self).removeAttr('disabled').css({'opacity': '1'});
          $('.table-'+ids).slideUp('fast');
          Swal.fire("Successful", "Requirement session deleted successfully", "success").then(() => {
            // Reload the page
            location.reload();
         });

        }else{
            $(self).removeAttr('disabled').css({'opacity': '1'});
            Swal.fire({
            title: "Error!",
            html: results,
            icon: 'error',
            timer: 4000
            });
        }
        },error : function(data){
        $(self).removeAttr('disabled').css({'opacity': '1'});
        Swal.fire({
            title: "Error!",
            text: "Poor Network Connection!",
            icon: 'error',
            timer: 4000
        });
        }
    });
    }
  });
});



$('body').on('click', '.deleteCourse', function (e) {
    e.preventDefault();
    var self = this;
    var results = '';
    var ids = $(this).attr('ids');

    Swal.fire({
        title: `Confirm action?`,
        html: `Deleting this cannot will delete all the contents and quiz that might be associated with it and cannot be undone, proceed?`,
        icon: 'question',
        iconHtml: '?',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#999',
        confirmButtonText: 'Yes, delete'
    }).then((result) => {
        if (result.isConfirmed) {
        Swal.fire({
            title: 'Updating...',
            text: "Please wait a second for a response...",
            icon: 'success',
            showConfirmButton: false,
            confirmButtonColor: '#027937',
            cancelButtonColor: '#d33',
        });

        $(self).attr('disabled', true).css({'opacity': '0.4'});

        var datastring='ids='+ids
        +'&_token='+token;

        $.ajax({
            type : "POST",
            url : site_url + "delete-course",
            data: datastring,
            success : function(data){
            $.each(data, function(){
                results += this + "<br>";
            });

            if(data.status=="success"){
                $(self).removeAttr('disabled').css({'opacity': '1'});
                $('.table-'+ids).slideUp('fast');
                Swal.fire("Successful", "Course deleted successfully", "success").then(() => {
                // Reload the page
                location.reload();
                });

            }else{
                $(self).removeAttr('disabled').css({'opacity': '1'});
                Swal.fire({
                title: "Error!",
                html: results,
                icon: 'error',
                timer: 4000
                });
            }
            },
            error : function(data){
            $(self).removeAttr('disabled').css({'opacity': '1'});
            Swal.fire({
                title: "Error!",
                text: "Poor Network Connection!",
                icon: 'error',
                timer: 4000
            });
            }
        });
        }
    });
});


$('body').on('click', '.deteleQuizSession', function (e) {
  e.preventDefault();
  var self = this;
  var results = '';
  var ids = $(this).attr('ids');

  Swal.fire({
    title: `Confirm action?`,
    html: `Deleting this cannot will delete all the quiz associated with this session and cannot be undone, proceed?`,
    icon: 'question',
    iconHtml: '?',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#999',
    confirmButtonText: 'Yes, proceed'
  }).then((result) => {
    if (result.isConfirmed) {
    Swal.fire({
        title: 'Updating...',
        text: "Please wait a second for a response...",
        icon: 'success',
        showConfirmButton: false,
        confirmButtonColor: '#027937',
        cancelButtonColor: '#d33',
    });

    $(self).attr('disabled', true).css({'opacity': '0.4'});

    var datastring='ids='+ids
    +'&_token='+token;

    $.ajax({
        type : "POST",
        url : site_url + "delete-session",
        data: datastring,
        success : function(data){
        $.each(data, function(){
            results += this + "<br>";
        });

        if(data.status=="success"){
          $(self).removeAttr('disabled').css({'opacity': '1'});
          $('.table-'+ids).slideUp('fast');
          Swal.fire("Successful", "Quiz session deleted successfully", "success").then(() => {
            // Reload the page
            location.reload();
            });

        }else{
            $(self).removeAttr('disabled').css({'opacity': '1'});
            Swal.fire({
            title: "Error!",
            html: results,
            icon: 'error',
            timer: 4000
            });
        }
        },error : function(data){
        $(self).removeAttr('disabled').css({'opacity': '1'});
        Swal.fire({
            title: "Error!",
            text: "Poor Network Connection!",
            icon: 'error',
            timer: 4000
        });
        }
    });
    }
  });
});


$('body').on('click', '.addRenew', function (e) {
  e.preventDefault();
  var self = this;
  var results = '';
  var sub_type = $('.sub_type').val();

  Swal.fire({
    title: `Proceed to ${sub_type} this subscription?`,
    text: "This cannot be undone, continue?",
    icon: 'question',
    iconHtml: '?',
    showCancelButton: true,
    confirmButtonColor: '#027937',
    cancelButtonColor: '#d33',
    confirmButtonText: `Yes ${sub_type}`,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: 'Processing...',
        text: "Please wait a second for a response...",
        icon: 'success',
        showConfirmButton: false,
        confirmButtonColor: '#027937',
        cancelButtonColor: '#d33',
      });

      $(self).attr('disabled', true).css({'opacity': '0.4'});

      $.ajax({
        type : "POST",
        url : site_url + "admin/page/renew-extend",
        data: $(".form_renew_sub").serialize(),
        success : function(data){
          $.each(data, function(){
            results += this + "<br>";
          });

          if(data.status=="success"){
            $(self).removeAttr('disabled').css({'opacity': '1'});
            Swal.fire("Successful", data.message, "success");
            $(".form_renew_sub")[0].reset();

            setTimeout(() => {
              location.reload();
            }, 3000);

          }else{
            $(self).removeAttr('disabled').css({'opacity': '1'});
            Swal.fire({
              title: "Error!",
              html: results,
              icon: 'error',
              timer: 3000
            });
          }
        },error : function(data){
          $(self).removeAttr('disabled').css({'opacity': '1'});
          Swal.fire({
            title: "Error!",
            text: "Poor Network Connection!",
            icon: 'error',
            timer: 3000
          });
        }
      });
    }
  })
});


$('body').on('click', '.renew_sub', function (e) {
  var fullnames = $(this).attr("fullnames");
  var starts_at = $(this).attr("starts_at");
  var ends_at = $(this).attr("ends_at");
  var subscription_id = $(this).attr("subscription_id");

  $('.sub_name').html(`Renew/Extend Subscription for ${fullnames}`);
  $('.expiry_info').html(`Showing the expiry date: ${ends_at}`);
  $('.end_date').val(ends_at);
  $('.start_date').val(starts_at);
  $('.subscription_id').val(subscription_id);
});


$('body').on('click', '.assign_prv', function (e) {
  var user_id = $(this).attr("user_id");
  var user_name = $(this).attr("user_name");
  $('.assign_name').html(`Assign ${user_name} some priviledges`);
  $('.user_id').val(user_id);

  var datastring='user_id='+user_id
  +'&_token='+token;
  $('.user_privd_data').html('').css('opacity', '0.5');

  $.ajax({
    type : "POST",
    url : site_url + "admin/page/get-users-prvd",
    data: datastring,
    success : function(data){
      // $(self).removeAttr('disabled').css({'opacity': '1'});
      $('.user_privd_data').html(data).css('opacity', 1);
    }
  })
});


$('body').on('click', '.view_referrals', function (e) {
  var fullnames = $(this).attr("fullnames");
  var user_id = $(this).attr("user_id");

  $('.sub_name').html(`People ${fullnames} has referred so far`);

  var datastring='user_id='+user_id
  +'&_token='+token;
  $('.data-tables').html('').css('opacity', '0.5');

  $.ajax({
    type : "POST",
    url : site_url + "admin/page/fetch-referrals",
    data: datastring,
    success : function(data){
      // $(self).removeAttr('disabled').css({'opacity': '1'});
      $('.data-tables').html(data).css('opacity', 1);
    }
  })
});


$('body').on('change', '.sub_type', function (e) {
  var sub_type = $(this).val();
  // alert(sub_type);
  $('.ext_div').hide();
  $('.addRenew').html('Renew Subscription');
  if(sub_type == "extend"){
    $('.ext_duration').hide();
    $('.ext_div').show();
    $('.addRenew').html('Extend Subscription');
  } else {
    $('.ext_div').hide();
    $('.ext_duration').show();
  }
});



$('body').on('click', '.pay_backup', function (e) {
  var amount = $(".pay_amt").val();
  var payment_mthd = $('.pay_mthd').val();
  var user_email = $('.user_email').val();
  var user_uuid = $('.user_id').val();
  var self = this;

  if(amount == ""){
    Swal.fire({
      title: "Error!",
      html: "Invalid amount! Please reload the page",
      icon: 'error',
      timer: 3000
    });
    return;
  }
  if(payment_mthd == ""){
    Swal.fire({
      title: "Error!",
      html: "Select a payment method to continue",
      icon: 'error',
      timer: 3000
    });
    return;
  }

  $(self).attr('disabled', true).css({'opacity': '0.4'});

  if(payment_mthd == "deposit"){

  }

  if(payment_mthd == "paystack"){
    paymentAPI(PAYSKey, user_email, amount, self, user_uuid, token, 'buy_backup', 'payment for backup data', payment_mthd);
  }
});


function paymentAPI(PAYSKey, user_email, amount, self, user_uuid, token, query, narration, payment_mthd){
  var results = '';

  if(payment_mthd == "paystack"){
    var datastring='user_id='+user_uuid
    +'&amount='+amount
    +'&narration='+narration
    +'&pay_mthd='+payment_mthd
    +'&_token='+token;

    $.ajax({
      type: "POST",
      url : site_url + "dashboard/validate_"+query,
      data: datastring,
      cache: false,
      timeout: 30000, // 30 second timeout
      success : function(data){
        if(data.status == "success"){
          var handler = PaystackPop.setup({
            key: PAYSKey,
            email: user_email,
            amount: amount * 100,
            currency: "NGN",
            ref: ''+Math.floor((Math.random() * 1000000000) + 1),
            callback: function(response){
              var datastring1='&response='+response.reference;
              $.ajax({
                type: "POST",
                url : site_url + "dashboard/"+query,
                data: datastring + datastring1,
                cache: false,
                timeout: 30000, // 30 second timeout
                success : function(data){
                  if(data.status == "success"){

                    Swal.fire("Successful", "Your payment for backup was successful and your backup will now start at the background, thank you!", "success");

                    if(query == "buy_backup"){
                      $(".backup_form")[0].reset();
                      $('.close_me').trigger('click');
                    }
                    $(self).removeAttr('disabled').css({'opacity': '1'});
                    $('.backup_data').css('opacity', '0.4').val('Data Backedup');

                  }else{
                    Swal.fire({
                      title: "Error!",
                      html: data.message,
                      icon: 'error',
                      timer: 3000
                    });
                    $(self).removeAttr('disabled').css({'opacity': '1'});
                  }
                },error : function(data, timeouts){
                  $(self).removeAttr('disabled').css({'opacity': '1'});
                  Swal.fire({
                    title: "Error!",
                    html: "Poor network connection!",
                    icon: 'error',
                    timer: 3000
                  });
                }
              });
            },
            onClose: function() {
              $(self).removeAttr('disabled').css({'opacity': '1'});
            },
          });
          handler.openIframe();
          // $(".close_me").click();

        }else{
          Swal.fire({
            title: "Error!",
            html: data.message,
            icon: 'error',
            timer: 3000
          });
          $(self).removeAttr('disabled').css({'opacity': '1'});
        }

      },error : function(data, timeouts){
        $(self).removeAttr('disabled').css({'opacity': '1'});
        Swal.fire({
          title: "Error!",
          html: "Poor network connection!",
          icon: 'error',
          timer: 3000
        });
      }
    });
  }
}















