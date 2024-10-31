window.onload = function() {
    if (localStorage.getItem("ageVerified") === "true") {
        document.getElementById("ageVerification").style.display = "none";
        document.getElementById("content").style.display = "block";
    }
};


function confirmAge() {
    localStorage.setItem("ageVerified", "true");
    document.getElementById("ageVerification").style.display = "none";
    document.getElementById("content").style.display = "block";
}


function denyAccess() {
    alert("You must be at least 18 years old to access this site.");
    window.location.href = "https://youtu.be/V75LO0bD9pc?si=frddG2SPXpwwcC34"; 
}