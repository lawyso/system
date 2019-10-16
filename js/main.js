function testjs() {
   alert('working');
}

function redirect(url) {
   window.location = url;
}

function reload() {
   location.reload();
}

////____Load a page to another using ajax
function loadpage(resource, targetdiv, params) {
   fields = params;
   var processingmessage = 'Working...';
   processingarea = '.processing';
   var thislocation = $('#thislocation').val();
   var ico = '<img src="/images/loader.gif" title="' + processingmessage + '" height="22px" alt="..."/>';
   $.ajax({
      method: 'GET',
      url: resource,
      data: fields,
      beforeSend: function () {
         $(processingarea).html(ico + processingmessage);
         $(processingarea).show();
      },

      complete: function () {
         $('#processing').hide();
         $(processingarea).hide();
      },
      success: function (feedback) {
         $(targetdiv).html(feedback);
         $(processingarea).hide();
      }

   });
}
///__________________Do a standard db operation
function dbaction(actionpage, params, feedbacktype = 'persistent', feedbackarea = '.feedbackarea', processingarea = '.processing', processingmessage = 'processing') {
   var thislocation = $('#thislocation').val();
   var ico = '<img src="/images/loader.gif" title="' + processingmessage + '" height="22px" alt="..."/>';
   fields = params;
   $.ajax({
      method: 'POST',
      url: actionpage,
      data: fields,
      beforeSend: function () {
         $(processingarea).html(ico + processingmessage);
         $(processingarea).show();
      },

      complete: function () {
         $(processingarea).hide();

      },
      success: function (feedback) {
         if (feedbacktype == 'persistent') {
            $(feedbackarea).html(feedback);
         } else if (feedbacktype == 'popup') {
            $(feedbackarea).html(feedback);
            setTimeout(function () {
               $(feedbackarea).text('');
            }, 5000);
         } else {
            $(feedbackarea).html(feedback);
         }

         $(processingarea).show();

      },
      error: function () {
         $(feedbackarea).html('An error occured. Please try again');
         $(processingarea).show();
      }
   });
}


$('#login_go').click(function (e) {
   var u_name = $('#u_name').val();
   var u_pass = $('#u_pass').val();


   ////____________Validation
   var params = "u_name=" + u_name + "&u_pass=" + u_pass;

   ////____________Action
   dbaction('action/login.php', params, 'persistent', '.login_feedback', '#login_proc', '');
   e.preventDefault();
});


$('#signup_go').click(function (e) {
   var names = $('#names_').val();
   var email = $('#email_').val();
   var password = $('#password_').val();
   var country = $('#country_').val();


   ////____________Validation
   var params = "names=" + names + "&email=" + email + "&password=" + password + "&country=" + country;

   ////____________Action
   dbaction('action/signup.php', params, 'persistent', '.login_feedback', '#signup_proc', '');
   e.preventDefault();
});


////////////////_______________Paged viewing

function paging(resource, orderby, dir, offset, rpp, fds, search, div_, wherec = 'uid > 0') {
   var params = 'orderby=' + orderby + '&dir=' + dir + '&offset=' + offset + '&rpp=' + rpp + '&fds=' + fds + '&search=' + search + "&where=" + wherec;
   loadpage(resource, div_, params);

}
////////////////_______________End of paged viewing
function showdiv(div) {
   $(div).fadeIn('fast');
}

function showhidediv(show_d, hide_d) {
   $(hide_d).css('display', 'none');
   $(show_d).fadeIn('fast');
}



///~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~standard form action
function formready(formid) {
   formhandler('#' + formid);
};


function formhandler(formid) {

   var options = {
      beforeSend: function () {
         $("#progress").show();
         //clear everything
         $("#bar").width('0%');
         $("#message").html("");
         $("#percent").html("0%");
      },
      uploadProgress: function (event, position, total, percentComplete) {
         $("#bar").width(percentComplete + '%');
         $("#percent").html(percentComplete + '%');

      },
      success: function () {
         $("#bar").width('100%');
         $("#percent").html('100%');

      },
      complete: function (response) {
         $("#message").html("<font color='green'>" + response.responseText + "</font>");
         ///if success, refresh form
         var res = response.responseText;
         var suc = (res.search("ucces"))
         if (suc >= 0) {
            $(formid)[0].reset();
         }


      },
      error: function () {
         $("#message").html("<font color='red'> ERROR: unable to upload files</font>");

      }

   };

   $(formid).ajaxForm(options);

}


///__________________Do a standard db operation

function dbaction(actionpage, params, feedbackarea = '.feedbackarea') {
   var thislocation = $('#thislocation').val();

   fields = params;
   $.ajax({
      method: 'POST',
      url: actionpage,
      data: fields,
      beforeSend: function () {
         $('.processing').css('display', 'block');
      },

      complete: function () {
         $('.processing').css('display', 'none');
      },
      success: function (feedback) {

         $(feedbackarea).html(feedback);
         setTimeout(function () {
            $(feedbackarea).text('');
         }, 30000);




      },
      error: function () {
         $(feedbackarea).html('An error occured. Please try again');
      }
   });
}



function login() {
   var u_name = $('#u_name').val();
   var u_pass = $('#u_pass').val();


   ////____________Validation
   var params = "u_name=" + u_name + "&u_pass=" + u_pass;

   ////____________Action
   dbaction('actions/login.php', params, '#login_feedback');

}

function forgot_pwd() {
   var u_name = $('#u_name').val();

   ////____________Validation
   var params = "u_name=" + u_name;

   ////____________Action
   dbaction('actions/forgot_pwd.php', params, '#forgot_pswd_feedback');

}

function reset_pass() {
   var u_pass = $('#u_pass').val();
   var u_passConfirm = $('#u_passConfirm').val();
   var userid = $('#userid').val();


   ////____________Validation
   var params = "u_pass=" + u_pass + "&u_passConfirm=" + u_passConfirm + "&userid=" + userid;

   ////____________Action
   dbaction('actions/pass_reset.php', params, '#resetPass_feedback');

}


function saveuser() {
   var sid = $('#sid').val();
   var first_name = $('#first_name').val();
   var last_name = $('#last_name').val();
   var national_id = $('#national_id').val();
   var primary_email = $('#primary_email').val();
   var primary_phone = $('#primary_phone').val();
   var user_name = $('#user_name').val();
   var gender = $('#gender').val();
   var user_group = $('#user_group').val();
   var status = $('#status').val();
   var title = $('#title').val();
   var department = $('#department').val();
   var school = $('#school').val();

   var params = "title=" + title + "&sid=" + sid + "&first_name=" + first_name +
      "&last_name=" + last_name + "&primary_email=" + primary_email + "&primary_phone=" +
      primary_phone + "&user_name=" + user_name + "&user_group=" + user_group + "&gender=" +
      gender + "&status=" + status + "&national_id=" + national_id + "&department=" + department + "&school=" + school;


   dbaction('actions/save_user.php', params, '#user_feedback');


}

function savecourse() {
   var sid = $('#sid').val();
   var department = $('#department').val();
   var school = $('#school').val();
   var course = $('#course').val();
   var admission_date = $('#admission_date').val();


   var params = "sid=" + sid + "&department=" + department + "&school=" + school + "&course=" + course + "&admission_date=" + admission_date;


   dbaction('actions/save_course.php', params, '#course_feedback');


}

function save_proposal() {
   var sid = $('#sid').val();
   var title = $('#title').val();
   var area_study = $('#area_study').val();
   var supervisor_1 = $('#supervisor_1').val();
   var supervisor_2 = $('#supervisor_2').val();
   var supervisor_3 = $('#supervisor_3').val();


   var params = "sid=" + sid + "&title=" + title + "&area_study=" + area_study + "&supervisor_1=" + supervisor_1 + "&supervisor_2=" + supervisor_2 + "&supervisor_3=" + supervisor_3;


   dbaction('actions/save_proposal.php', params, '#proposal_feedback');


}

function save_prop() {
   var sid = $('#sid').val();
   var proposal_ = $('#proposal_').val();

   var params = "sid=" + sid + "&proposal_=" + proposal_;

   dbaction('actions/prop_upload.php', params, '#prop_feedback');


}

function exitwindow(winname, t) {

   setTimeout(function () {
      $(winname).modal('toggle');
   }, t * 1000);
}



function tog(div) {
   $(div).toggle();
}

function changepass() {

   var new_pass = $('#new_pass').val();
   var old_pass = $('#old_pass').val();
   var new_passConfirm = $('#new_passConfirm').val();
   var params = "new_pass=" + new_pass + "&old_pass=" + old_pass + "&new_passConfirm=" + new_passConfirm;
   dbaction('actions/change_pass.php', params, '#passfeed');

}


function overlayshow(divid, params, resource) {
   $(divid).modal('toggle');
   loadpage(resource, divid + 'in', params);
}

function overlayhide(divid) {
   $(divid).modal('toggle');
}

function topup(lid) {

   var params = "luid=" + lid;
   overlayshow('#detailsportal', params, 'resources/top-up.php');
}


function checkuser() {
   var num = $('#customer_details').val();
   $('#customer_details_').text('');
   var n = num.length;
   if (n == 12) {
      var params = "phone=" + num;
      loadpage('action/check_user.php', '#customer_details_', params);
   }


}

function delete_proposal(pid) {

   var result = confirm('Are you sure you want to Delete this Proposal?');
   if (result) {
      var params = "proposal_id=" + pid + "&action=1";
      dbaction('actions/proposal_action.php', params, '#prop_feedback');
   }
}

function del_proposal(pid) {

   var result = confirm('Are you sure you want to Delete this Proposal?');
   if (result) {
      var params = "proposal_id=" + pid + "&action=5";
      dbaction('actions/proposal_action.php', params, '#pro_feedback');
   }
}

function save_defense() {
   var project_title = $('#project_title').val();
   var department = $('#department').val();
   var school = $('#school').val();
   var defense_date = $('#defense_date').val();

   var params = "school=" + school + "&project_title=" + project_title + "&department=" + department + "&defense_date=" + defense_date;

   dbaction('actions/save_defense.php', params, '#defense_feedback');


}

function update_bio() {
   var sid = $('#sid').val();
   var first_name = $('#first_name').val();
   var last_name = $('#last_name').val();
   var title = $('#title').val();
   var phone_no = $('#phone_no').val();

   var params = "title=" + title + "&sid=" + sid + "&first_name=" + first_name +
      "&last_name=" + last_name + "&phone_no=" + phone_no;


   dbaction('actions/update_bio.php', params, '#bio_feedback');


}

function approve_proposal(pid) {

   var result = confirm('Are you sure you want to Approve this Proposal?');
   if (result) {
      var params = "proposal_id=" + pid + "&action=2";
      dbaction('actions/proposal_action.php', params, '#prop_feedback');
   }
}

function reject_proposal(pid) {

   var result = confirm('Are you sure you want to Reject this Proposal?');
   if (result) {
      var params = "proposal_id=" + pid + "&action=3";
      dbaction('actions/proposal_action.php', params, '#prop_feedback');
   }
}

function course_prod() {
   var course = $('#course').val();
   var sid = $('#sid').val();
   var params = "course=" + course + "&sid=" + sid;
   loadpage('jresources/course_product.php', '#course_product', params);
}
