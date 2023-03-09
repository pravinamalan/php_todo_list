$(document).ready(function () {
  displaydata();
  $("#insertBtn").click(function () {
    var formData = $("#insertForm").serialize();
    $.ajax({
      type: "POST",
      url: "./insert.php",
      data: formData,
      dataType: "JSON",
    })
      .done(function (response) {
        if (response["status"] == "success") {
          toastr.success(response["message"]);
          // alert(response['message']);
          $("#staticBackdrop").modal("hide");
          $("#insertForm")[0].reset();
          displaydata();
          if (response["code"] == 200) {
            window.location.reload("./index.php");
          }
        } else {
          toastr.error(response["message"]);
          // alert('failed to insert');
        }
      })
      .fail(function (error) {
        toastr.error("something went wrong");
      });
  });

  // search function

  $("#myInput").keyup(function () {
    search_table($(this).val());
  });
  function search_table(value) {
    $("#myTable tr").each(function () {
      var found = "false";
      $(this).each(function () {
        if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
          found = "true";
        }
      });
      if (found == "true") {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  }
});
//search ajax
// $("#myInput").keyup(function(){
//   $searchEl = $(this).val();
//   // console.log(searchEl);
//   $.ajax({
//     type: "post",
//     url: "./view.php",
//     data: "&action=search_candidate&search_inp=" + $searchEl,
//   }).done(function (response) {
//       console.log(response["response"]);
//       $response = response["response"];
//       $('#myTable').html(data)
//       if (response["code"] == 200) {
//         window.location.reload("./index.php");
//       }
//     }).fail(function (error) {
//       console.log(error);
//     });
// })

//display the data into table
function displaydata() {
  var displaydata = true;
  $.ajax({
    type: "post",
    url: "./display.php",
    data: {
      displaySend: displaydata,
    },
    success: function (data, status) {
      $("#displayDataTable").html(data);
    },
  });
}

// delete record

function deleteUser(deleteid) {
  $.confirm({
    title: "Confirm!",
    content: "are you sure you want to delete the data",
    draggable: true,
    closeIcon: true,
    type: "red",
    typeAnimated: true,
    buttons: {
      confirm: function () {
        $.ajax({
          type: "post",
          url: "./delete.php",
          data: "&action=delete_candidate&candidate_Id=" + $candidate_id,
        })
          .done(function (response) {
            console.log(response["response"]);
            $response = response["response"];
            if (response["code"] == 200) {
              window.location.reload("./index.php");
            }
          })
          .fail(function (error) {
            console.log(error);
          });
      },
      cancel: function () {
        $.alert("Canceled!");
      },
    },
  });
}

// update function

// function updateUser(updateid) {
//   $("#hiddendata").val(updateid);
//   $.post("./update.php", { updateid: updateid }, function (data, status) {
//     var userid = JSON.parse(data);
//     $
//     $("#updatename").val(userid.name);
//     $("#updateemail").val(userid.email);
//     $("#updatephone").val(userid.phone);
//     $("#updateplace").val(userid.place);
//   });
//   $("#updateModal").modal("show");
// }

$("body").on("click", ".edit", function () {
  $candidate_id = $(this).attr("data-id");
  $.ajax({
    type: "post",
    url: "./update.php",
    data: "&action=edit_candidate&candidate_Id=" + $candidate_id,
    dataType: "json",
  })
    .done(function (response) {
      $response = response["response"];
      var userEdit = "";
      $.each($response, function (key, value) {
        $userEdit = ` <form action="" id="insertForm" class="updateForm">                 
            <div class="mb-3">
                <label for="completename" class="form-label">Name</label>
                <input type="text" class="form-control" value="${
                  value.name == "" ? "N/A" : value.name
                }" id="updatename" name="name" aria-describedby="emailHelp" placeholder="enter your name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" value="${
                  value.email == "" ? "N/A" : value.email
                }" id="updateemail" name="email" aria-describedby="emailHelp" placeholder="enter your email">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Phone</label>
                <input type="number" class="form-control" value="${
                  value.phone == "" ? "N/A" : value.phone
                }" id="updatephone" name="phone" aria-describedby="emailHelp" placeholder="enter your mobile number">
            </div>
            <div class="mb-3">
                <label for="place" class="form-label">Place</label>
                <input type="text" class="form-control" value="${
                  value.place == "" ? "N/A" : value.place
                }" id="updateplace" name="place" aria-describedby="emailHelp" placeholder="enter your place">
            </div>
    </form>
    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="updateBtn" data-id="${
                      value.id
                    }" class="btn btn-dark"">Update</button>
                    <input type="hidden" name="" id="hiddendata">
                </div>`;
      });
      $("#edit-user").html($userEdit);
    })
    .fail(function (error) {
      console.log(error);
    });
});

// update event
// function updateDetails() {
//   var updatename = $("#updatename").val();
//   var updateemail = $("#updateemail").val();
//   var updatephone = $("#updatephone").val();
//   var updateplace = $("#updateplace").val();
//   var hiddendata = $("#hiddendata").val();

//   $.post(
//     "./update.php",
//     {
//       updatename: updatename,
//       updateemail: updateemail,
//       updatephone: updatephone,
//       updateplace: updateplace,
//       hiddendata: hiddendata,
//     },
//     function (data, status) {
//       $("#updateModal").modal("hide");
//       displaydata();
//     }
//   );
// }

$("body").on("click", "#updateBtn", function (e) {
  e.preventDefault();
  $candidate_id = $(this).attr("data-id");
  $formData = $(".updateForm").serialize();
  $.ajax({
    type: "post",
    url: "./update.php",
    data: $formData + "&action=update_candidate&candidate_Id=" + $candidate_id,
  })
    .done(function (response) {
      // console.log(response['code']);
      window.location.reload("./index.php");
    })
    .fail(function (error) {
      console.log(error);
    });
});

// view user

// function viewUser(viewid){
//   $('#hiddenview').val(viewid);
//   $.post("./view.php", {viewid:viewid},
//     function (data, status, ) {
//     var userviewid = JSON.parse(data);
//     $content =`<div>
//     <p><strong>Name:</strong> ${userviewid.name}</p>
//     <p><strong>Email:</strong> ${userviewid.email}</p>
//     </div>`;
//     $('#data-show').html($content);
//     console.log(data);
//     }
//   );
//   $('#viewModal').modal("show")
// }
