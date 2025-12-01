document.addEventListener("DOMContentLoaded", function () {
  // Access form and elements
  const form = document.getElementById("surveyForm");
  const nameInput = document.getElementById("name");
  const ageInput = document.getElementById("age");
  const emailInput = document.getElementById("email");
  const dobInput = document.getElementById("dob");
  const phoneInput = document.getElementById("phno");
  const roleInputs = document.querySelectorAll('input[name="role"]');
  const quoteH1 = document.getElementById("quote");

  // 🔹 Restrict name input to letters and spaces only
  nameInput.addEventListener("input", function () {
    this.value = this.value.replace(/[^a-zA-Z\s]/g, ""); // Removes numbers/symbols

    // Update quote dynamically as user types
    const name = this.value.trim();
    if (name) {
      quoteH1.textContent = `Hello ${name}! A shared thought can spark a thousand ideas — let’s get ready to create!`;
    } else {
      quoteH1.textContent = "A shared thought can spark a thousand ideas — let’s get ready to create!";
    }
  });

  // 🔹 Update quote when role is selected
  roleInputs.forEach((radio) => {
    radio.addEventListener("change", function () {
      const selectedRole = document.querySelector('input[name="role"]:checked').value;
      const name = nameInput.value.trim() || "Guest";
      quoteH1.textContent = `Hello ${name} (${selectedRole})! A shared thought can spark a thousand ideas — let’s get ready to create!`;
    });
  });

  // 🔹 Form Validation on Submit
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const name = nameInput.value.trim();
    const age = parseInt(ageInput.value.trim());
    const email = emailInput.value.trim();
    const dob = dobInput.value.trim();
    const phone = phoneInput.value.trim();

    // Name Validation
    if (name === "" || !/^[A-Za-z\s]+$/.test(name)) {
      alert("⚠ Please enter a valid name (letters only).");
      nameInput.focus();
      return;
    }

    // Age Validation
    if (isNaN(age) || age <= 0 || age > 120) {
      alert("⚠ Please enter a valid age between 1 and 120.");
      ageInput.focus();
      return;
    }

    // DOB Validation
    if (dob === "") {
      alert("⚠ Please select your Date of Birth.");
      dobInput.focus();
      return;
    }

    const today = new Date();
    const birthDate = new Date(dob);
    let calculatedAge = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();

    // Adjust age if birthday hasn't happened yet this year
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
      calculatedAge--;
    }

    if (age !== calculatedAge) {
      alert(`⚠ Age does not match Date of Birth! Calculated age is ${calculatedAge}.`);
      dobInput.focus();
      return;
    }

    // Email Validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      alert("⚠ Please enter a valid email address.");
      emailInput.focus();
      return;
    }

    // Phone Validation (10 digits only)
    if (!/^\d{10}$/.test(phone)) {
      alert("⚠ Please enter a valid 10-digit phone number.");
      phoneInput.focus();
      return;
    }

    // ✅ If all validations pass
    alert(`✅ Thank you, ${name}! Your response has been submitted successfully.`);
    form.reset();
    quoteH1.textContent = "A shared thought can spark a thousand ideas — let’s get ready to create!";
  });

  // 🔹 Reset quote on form reset
  form.addEventListener("reset", function () {
    quoteH1.textContent = "A shared thought can spark a thousand ideas — let’s get ready to create!";
  });
});
