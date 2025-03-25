// // Add user form validatoin - AddUser.php
document.getElementById("addUserForm").addEventListener("submit", function (e) {
  const firstname = document.getElementById("firstname");
  const lastname = document.getElementById("lastname");
  const email = document.getElementById("email");
  const password = document.getElementById("password");

  const firstname_error = document.getElementById("firstname_error");
  const lastname_error = document.getElementById("lastname_error");
  const email_error = document.getElementById("email_error");
  const password_error = document.getElementById("password_error");

  let isValid = true;

  if (firstname.value.trim() == "") {
    firstname_error.textContent = "firstname is required";
    isValid = false;
  }

  if (lastname.value.trim() == "") {
    lastname_error.textContent = "lastname is required";
    isValid = false;
  }

  if (email.value.trim() === "") {
    email_error.textContent = "Email is required";
    isValid = false;
  } else if (!isValidEmail(email.value)) {
    email_error.textContent = "Please enter a valid email address";
    isValid = false;
  }

  if (password.value.trim() === "") {
    password_error.textContent = "Password is required";
    isValid = false;
  }

  if (!isValid) {
    e.preventDefault();
  }

  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  firstname.addEventListener("input", function () {
    if (firstname.value.trim() !== "") {
      firstname_error.textContent = "";
    }
  });

  lastname.addEventListener("input", function () {
    if (lastname.value.trim() !== "") {
      lastname_error.textContent = "";
    }
  });

  email.addEventListener("input", function () {
    if (email.value.trim() !== "") {
      email_error.textContent = "";
    }
  });

  password.addEventListener("input", function () {
    if (password.value.trim() !== "") {
      password_error.textContent = "";
    }
  });
});

// $(document).ready(function () {
//   function validateFirstname() {
//     firstname = $("#firstname").val().trim();
//     if (firstname === "") {
//       $("#firstname_error").text("please enter your first name.");
//       return false;
//     } else {
//       $("#firstname_error").text(" ");
//       return true;
//     }
//   }

//   function validateLastname() {
//     lastname = $("#lastname").val().trim();
//     if (lastname === "") {
//       $("#lastname_error").text(" Please enter your lastname.");
//       return false;
//     } else {
//       $("$lastname_error").text(" ");
//       return true;
//     }
//   }

//   function validateEmail() {
//     email = $("#email").val().trim();
//     if (email === "") {
//       $("#email_error").text("Enter your email address");
//       return false;
//     } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
//       $("#email_error").text("*Please enter a valid email address.");
//       $("#email").css({ "border-color": "red" });
//       return false;
//     } else {
//       $("#email_error").text(" ");
//       return true;
//     }
//   }
//   function validatePassword() {
//     password = $("#password").val().trim();
//     if (password === "") {
//       $("#password_error").text(" Please enter your passsword.");
//       return false;
//     } else {
//       $("#password_error").text(" ");
//       return true;
//     }
//   }

//   $("#firstname").on("input", validateFirstname);
//   $("#lastname").on("input", validateLastname);
//   $("#email").on("input", validateEmail);
//   $("#password").on("input", validatePassword);

//   $("#addUserForm").submit(function (e) {
//     let isValid =
//       validateFirstname() &&
//       validateLastname() &&
//       validateEmail() &&
//       validatePassword();

//     if (!isValid) {
//       e.preventDefault();
//     }
//   });
// });
