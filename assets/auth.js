// // login form validation - index.php

// document.getElementById("loginForm").addEventListener("submit", function (e) {
//   const email = document.getElementById("email");
//   const password = document.getElementById("password");
//   const emailError = document.getElementById("email_error");
//   const passwordError = document.getElementById("password_error");
//   let isValid = true;

//   clearErrors();

//   if (email.value.trim() === "") {
//     emailError.textContent = "Email is required";
//     isValid = false;
//   } else if (!isValidEmail(email.value)) {
//     emailError.textContent = "Please enter a valid email address";
//     isValid = false;
//   }

//   if (password.value.trim() === "") {
//     passwordError.textContent = "Password is required";
//     isValid = false;
//   }

//   if (!isValid) {
//     e.preventDefault();
//   }

//   function clearErrors() {
//     emailError.textContent = "";
//     passwordError.textContent = "";
//   }

//   function isValidEmail(email) {
//     const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     return emailRegex.test(email);
//   }

//   email.addEventListener("input", function () {
//     if (email.value.trim() !== "") {
//       emailError.textContent = "";
//     }
//   });

//   password.addEventListener("input", function () {
//     if (password.value.trim() !== "") {
//       passwordError.textContent = "";
//     }
//   });
// });



$("#loginForm").validate({
  debug:true,
  rules: {
    firstname: {
      required: true,
    },
    lastname: {
      required: true,
    },
    email: {
      required: password,
      email: true,
    },
    password: {
      required: true,
      minlength: 6,
    },
  },
  message: {
    firstname: "please enter your firstname.",
    lastname: "please enter your lastname",
    email: {
      required: " Please enter your last email address. ",
      email: "please enter a valid email address",
    },
  },
});
