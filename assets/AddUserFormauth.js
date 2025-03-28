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
  clearErrors();

  firstname.innerText = "dfvbd";

  if (firstname.value.trim() === "") {
    firstname_error.innerText = "firstname is required";
    isValid = false;
  } else if (firstname.value.length >= 12) {
    firstname_error.innerText = "More then 12 character is not allowed in the first name.";
    isValid = false;
  }

  if (lastname.value.trim() == "") {
    lastname_error.innerText = "lastname is required";
    isValid = false;
  } else if (lastname.value.length >= 12) {
    firstname_error.innerText = "More then 12 character is not allowed in the lastt name.";
    isValid = false;
  }

  if (email.value.trim() === "") {
    email_error.innerText = "Email is required";
    isValid = false;
  } else if (!isValidEmail(email.value)) {
    email_error.innerText = "Please enter a valid email address!!";
    isValid = false;
  }

  if (password.value.trim() === "") {
    password_error.innerText = "Password is required";
    isValid = false;
  } else if (password.value.length >= 12) {
    password_error.innerText = "More then 12 character is not allowed in the password.";
    isValid = false;
  }

  if (role.value.trim() === "") {
    role_error.innerText = "role is required";
    isValid = false;
  } 

  if (!isValid) {
    e.preventDefault();
  }
  function clearErrors() {
    firstname_error.innerText = "";
    lastname_error.innerText = "";
    email_error.innerText = "";
    password_error.innerText = "";
    role_error.innerText = "";
  }

  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  firstname.addEventListener("input", function () {
    if (firstname.value.trim() !== "") {
      firstname_error.innerText = "";
    }
  });

  lastname.addEventListener("input", function () {
    if (lastname.value.trim() !== "") {
      lastname_error.innerText = "";
    }
  });

  email.addEventListener("input", function () {
    if (email.value.trim() !== "") {
      email_error.innerText = "";
    }
  });

  password.addEventListener("input", function () {
    if (password.value.trim() !== "") {
      password_error.innerText = "";
    }
  });
  role.addEventListener("input", function () {
    if (role.value.trim() !== "") {
      role_error.innerText = "";
    }
  });
});
