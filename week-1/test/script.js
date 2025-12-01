$(document).ready(function() {
  $("#bookCategories").select2({
    placeholder: "📘 Pick Your Adventure"
  });

  $("#dob").datepicker({
    dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true,
    yearRange: "1900:2025"
  });

  $("#userForm").on("submit", function(e) {
    e.preventDefault();
    $(".error").text(""); // Clear old errors
    let valid = true;

    const fname = $("#firstName").val().trim();
    const lname = $("#lastName").val().trim();
    const mobile = $("#mobile").val().trim();
    const dob = $("#dob").val().trim();
    const email = $("#email").val().trim();
    const image = $("#profileImage").val();
    const bookPrices = $(".bookPrice").map(function() { return $(this).val(); }).get();

    
    if (fname.length < 3 || fname.length > 100) {
      $("#fnameError").text("First name must be 3–100 characters");
      valid = false;
    }

   
    if (lname.length < 3 || lname.length > 100) {
      $("#lnameError").text("Last name must be 3–100 characters");
      valid = false;
    }

   
    if (!/^\d{10}$/.test(mobile)) {
      $("#mobileError").text("Mobile number must be exactly 10 digits");
      valid = false;
    }

    
    if (!dob) {
      $("#dobError").text("Please select your date of birth");
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

  
    for (let price of bookPrices) {
      if (price === "" || price < 0) {
        $("#bookError").text("All book prices must be valid numbers (min 0)");
        valid = false;
        break;
      }
    }

 
    if (valid) {
      const confirmSubmit = confirm("Do you want to submit this form?");
      if (confirmSubmit) {
        alert("✅ Form submitted successfully!");
        this.reset();
        $("#bookCategories").val(null).trigger('change'); // Reset select2
      } else {
        alert("❌ Submission cancelled.");
      }
    }
  });
});
