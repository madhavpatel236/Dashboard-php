// Add user form validatoin - AddUser.php
document.getElementById("addUserForm").addEventListener("submit", function (e) {
  const firstname = document.getElementById("firstname");
  const lastname = document.getElementById("lastname");
  const email = document.getElementById("email");
  const password = document.getElementById("password");
  const role = document.getElementById("roles");

  const firstname_error = document.getElementById("firstname_error");
  const lastname_error = document.getElementById("lastname_error");
  const email_error = document.getElementById("email_error");
  const password_error = document.getElementById("password_error");
  const role_error = document.getElementById("role_error");

  let isValid = true;

  if (firstname.value.trim() == "") {
    firstname_error.textContent = "firstname is required";
    isValid = false;
  }

  // const regex =
  //   "^(?=.*SELECT.*FROM)(?!.*(?:CREATE|DROP|UPDATE|INSERT|ALTER|DELETE|ATTACH|DETACH)).*$";
  // firstname_error.innerText = regex.test(firstname.value);

  // if("^(?=.*SELECT.*FROM)(?!.*(?:CREATE|DROP|UPDATE|INSERT|ALTER|DELETE|ATTACH|DETACH)).*$".test(firstname.value.trim())) {
  //   firstname_error.textContent = "Please enter valid firstname.";
  //   isValid = false;
  // }

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

  if (role.value.trim() === "") {
    role_error.textContent = "role is required";
    isValid = false;
  }

  if (!isValid) {
    e.preventDefault();
  }

  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  // firstname.addEventListener("input", function () {
  //   if (firstname.value.trim() !== "") {
  //     firstname_error.textContent = "";
  //   }
  // }  );

  // lastname.addEventListener("input", function () {
  //   if (lastname.value.trim() !== "") {
  //     lastname_error.textContent = "";
  //   }
  // });

  // email.addEventListener("input", function () {
  //   if (email.value.trim() !== "") {
  //     email_error.textContent = "";
  //   }
  // });

  // password.addEventListener("input", function () {
  //   if (password.value.trim() !== "") {
  //     password_error.textContent = "";
  //   }
  // });
  // role.addEventListener("input", function () {
  //   if (role.value.trim() !== "") {
  //     role_error.textContent = "";
  //   }
  // });
});
