document.addEventListener("DOMContentLoaded", function () {
    const emailForm = document.getElementById("email-form");
    const otpSection = document.getElementById("otp-section");
    const proceedButton = document.getElementById("proceed-btn");
    const otpInput = document.getElementById("otp");

    document.getElementById("send-otp").addEventListener("click", function () {
        let email = document.getElementById("email").value;
        if (!email.endsWith("@dypatil.edu")) {
            alert("Please enter a valid @dypatil.edu email");
            return;
        }

        fetch("send_otp.php", {
            method: "POST",
            body: new URLSearchParams({ email: email }),
            headers: { "Content-Type": "application/x-www-form-urlencoded" }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert("OTP sent to your email!");
                otpSection.style.display = "block";
            } else {
                alert(data.message);
            }
        });
    });

    document.getElementById("verify-otp").addEventListener("click", function () {
        let otp = otpInput.value;

        fetch("verify_otp.php", {
            method: "POST",
            body: new URLSearchParams({ otp: otp }),
            headers: { "Content-Type": "application/x-www-form-urlencoded" }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert("OTP Verified! Redirecting to Signup...");
                proceedButton.style.display = "block";
                proceedButton.addEventListener("click", function () {
                    window.location.href = "signup.html";
                });
            } else {
                alert(data.message);
            }
        });
    });
});
