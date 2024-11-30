window.onload = function () {
  console.log("Verify age process started");

  // Check if age has already been verified in localStorage
  if (localStorage.getItem("ageVerified") === "true") {
    const ageVerificationElement = document.getElementById("ageVerification");
    const contentElement = document.getElementById("content");

    if (ageVerificationElement) {
      ageVerificationElement.style.display = "none";
    } else {
      console.error(
        "Elements 'ageVerification' or 'content' not found in the DOM."
      );
    }
  }
};

function confirmAge() {
  // Set the age verification flag in localStorage
  localStorage.setItem("ageVerified", "true");

  // Hide the age verification overlay and show the main content
  const ageVerificationElement = document.getElementById("ageVerification");
  // const contentElement = document.getElementById("content");
  console.log(ageVerificationElement);
  if (ageVerificationElement) {
    ageVerificationElement.style.display = "none";
    // contentElement.style.display = "block";
  } else {
    console.error(
      "Elements 'ageVerification' or 'content' not found in the DOM."
    );
  }
}

function denyAccess() {
  // Notify the user and redirect them
  alert("You must be at least 18 years old to access this site.");
  window.location.href = "https://youtu.be/V75LO0bD9pc?si=frddG2SPXpwwcC34";
}
