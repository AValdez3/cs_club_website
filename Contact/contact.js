$("#contact-form").on("submit", function(e) {
  e.preventDefault();

  fetch('../php/contact_form.php', {
    method: 'POST',
    body: new FormData($("#contact-form")[0])
  }).then((response) => {
    response.text().then((response) => {
      if(response === "Message sent") {
        $("#contact-form").hide();
        $("#hidden-div").show();
        var delay = 5000;
        setTimeout(function() {window.location="../";}, delay);
      }
    })
  });
});