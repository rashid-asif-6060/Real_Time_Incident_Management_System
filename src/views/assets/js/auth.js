document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  const role = document.getElementById("role");

  const reporterBox = document.getElementById("reporterBox");
  const responderBox = document.getElementById("responderBox");

  const reporterType = document.getElementById("reporterType");
  const responderType = document.getElementById("responderType");

  /* =====================
       ROLE SELECTION LOGIC
       ===================== */

  role.addEventListener("change", () => {
    // Reset
    reporterBox.style.display = "none";
    responderBox.style.display = "none";

    reporterType.disabled = true;
    responderType.disabled = true;

    reporterType.value = "";
    responderType.value = "";

    // Show relevant box
    if (role.value === "reporter") {
      reporterBox.style.display = "block";
      reporterType.disabled = false;
    }

    if (role.value === "responder") {
      responderBox.style.display = "block";
      responderType.disabled = false;
    }
  });

  /* =====================
       FORM SUBMIT VALIDATION
       ===================== */

  form.addEventListener("submit", (e) => {
    // Frontend validation only
    if (!role.value) {
      alert("Please select a role");
      e.preventDefault();
      return;
    }

    if (role.value === "reporter" && !reporterType.value) {
      alert("Please select reporter type");
      e.preventDefault();
      return;
    }

    if (role.value === "responder" && !responderType.value) {
      alert("Please select responder skill");
      e.preventDefault();
      return;
    }

    // If all validations pass, let the form SUBMIT to PHP
    // DO NOT redirect here!
  });
});
