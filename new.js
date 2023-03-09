$(document).ready(function () {
  displaydata();
  // view 
  $(".view").on("click", function () {
    // console.log('view clicked');
    $candidate_id = $(this).attr("data-id");
    $.ajax({
      url: "./view.php",
      method: "POST",
      dataType: "JSON",
      data: "&action=view_candidate&candidate_Id=" + $candidate_id,
      async: false,
    })
      .done(function (response) {
        // console.log(response['response']);
        $response = response["response"];

        $content = "";
        $.each($response, function (key, value) {
          content = `<div class="row bg-light">
                    <div class="col-md-12 col-lg-6">
                        <p><strong>Name: </strong>${
                          value.first_name == "" ? "NA" : value.name
                        }</p>
                        <p><strong>Email: </strong>${
                          value.email == "" ? "NA" : value.email
                        }</p>
                    </div>
                </div>`;
        });
        $("#data-show").html(content);
      })
      .fail(function (error) {
        console.log(error);
      });
  });

  //  delete
  $('.delete').on('click', function (e) {
    console.log('delete clicked');
    e.preventDefault();
    $candidate_id = $(this).attr('data-id');
    // $del = confirm("If you want to delete this!");

    $.confirm({
        title: 'Confirm!',
        content: 'Are you sure want to delete the form?',
        scrollToPreviousElement: false,
        type: 'red',
        draggable: false,
        buttons: {
            confirm: function () {
                // if ($del) {
                    $.ajax({
                        url: './delete.php',
                        method: 'POST',
                        dataType: 'JSON',
                        data: '&action=delete_candidate&candidate_Id=' + $candidate_id,
                        async: false
                    }).done(function (response) {
                        console.log(response['response']);
                        $response = response['response'];
                        if (response['code'] == 200) {
                            window.location.reload('./index.php');
                        }
                    }).fail(function (error) {
                        console.log(error);
                    })
                // }
            },
            cancel: function () {
                $.alert('Canceled!');
            }
        }
    });
})

// update


















});
