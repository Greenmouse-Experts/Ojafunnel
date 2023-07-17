
var token = $('#txt_token').val();
var site_url = $('#site_url').val();
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
          // location.reload();
        }, 2000);
      
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
  $('.ext_div').hide();
  if(sub_type == "extend"){
    $('.ext_div').show();
  }
});














