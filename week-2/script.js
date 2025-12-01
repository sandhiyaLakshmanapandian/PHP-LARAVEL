
$(document).ready(function() {
  $("#dob").datepicker({
    dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true,
    yearRange: "1900:2025"
  });
  $("#userForm").on("submit", function(e) {
    e.preventDefault();
    $(".error").text("");
    let valid = true;
    const fname = $("#firstName").val().trim();
    const lname = $("#lastName").val().trim();
    const mobile = $("#mobile").val().trim();
    const dob = $("#dob").val().trim();
    const email = $("#email").val().trim();
    const image = $("#profileImage").val();
    if (fname.length < 3 || fname.length > 100) {
      $("#fnameError").text("First name is required");
      valid = false;
    }
    if (lname.length < 3 || lname.length > 100) {
      $("#lnameError").text("Last name is required");
      valid = false;
    }
    if (!/^\d{10}$/.test(mobile)) {
      $("#mobileError").text("Mobile number must be 10 digits");
      valid = false;
    }
    if (!dob) {
      $("#dobError").text("date of birth is required");
      valid = false;
    }
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      $("#emailError").text("Enter a valid email address");
      valid = false;
    }
    if (!image) {
      $("#imageError").text("Please upload a profile image");
      valid = false;
    }
    if (valid) {
      const confirmSubmit = confirm("Do you want to submit this form?");
      if (confirmSubmit) {
        alert("Form submitted! Please wait while we validate your details");
        this.submit();
      } else {
        alert(" Submission cancelled.");
      }
    }
  });
});
