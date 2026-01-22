// src/views/assets/js/reporter_dashboard.js

document.addEventListener("DOMContentLoaded", () => {
  const issueForm = document.getElementById("issueForm");
  const issuesContainer = document.getElementById("issuesContainer");
  const issuesTitle = document.getElementById("issuesTitle");
  const myIssuesBtn = document.getElementById("myIssuesBtn");
  const allIssuesBtn = document.getElementById("allIssuesBtn");

  // From: src/views/dashboard/reporter.php -> src/controllers/ReporterController.php
  const BASE_URL = "../../controllers/ReporterController.php";

  function escapeHtml(str) {
    return String(str ?? "")
      .replaceAll("&", "&amp;")
      .replaceAll("<", "&lt;")
      .replaceAll(">", "&gt;")
      .replaceAll('"', "&quot;")
      .replaceAll("'", "&#039;");
  }

  function renderIssues(list) {
    if (!Array.isArray(list) || list.length === 0) {
      issuesContainer.innerHTML = `<p>No issues found.</p>`;
      return;
    }

    issuesContainer.innerHTML = list
      .map((i) => {
        const reporterLine = i.reporter_name
          ? `<small>Reported by: ${escapeHtml(i.reporter_name)} (${escapeHtml(
              i.reporter_type,
            )}) • ${escapeHtml(i.created_at)}</small>`
          : `<small>Reporter Type: ${escapeHtml(
              i.reporter_type,
            )} • ${escapeHtml(i.created_at)}</small>`;

        return `
          <div class="issue-card">
            <h4>${escapeHtml(i.category)} Issue</h4>
            <p><b>Room:</b> ${escapeHtml(i.room)}</p>
            <p><b>Status:</b> ${escapeHtml(i.status)}</p>
            <p>${escapeHtml(i.description)}</p>
            ${reporterLine}
          </div>
        `;
      })
      .join("");
  }

  async function safeFetchJson(url, options = {}) {
    const res = await fetch(url, options);

    let data = null;
    try {
      data = await res.json();
    } catch (e) {
      // If server didn't return JSON (like PHP warning/HTML)
      const text = await res.text();
      throw new Error(`Non-JSON response (HTTP ${res.status}):\n${text}`);
    }

    if (!res.ok) {
      const msg =
        data?.message ||
        (data?.errors ? data.errors.join("\n") : `HTTP ${res.status}`);
      throw new Error(msg);
    }

    return data;
  }

  async function loadAllIssues() {
    issuesTitle.textContent = "All Reported Issues";
    try {
      const data = await safeFetchJson(`${BASE_URL}?action=list`);
      renderIssues(data.data);
    } catch (err) {
      alert(err.message);
      issuesContainer.innerHTML = `<p>${escapeHtml(err.message)}</p>`;
      console.error(err);
    }
  }

  async function loadMyIssues() {
    issuesTitle.textContent = "My Issues";
    try {
      const data = await safeFetchJson(`${BASE_URL}?action=my`);
      renderIssues(data.data);
    } catch (err) {
      alert(err.message);
      issuesContainer.innerHTML = `<p>${escapeHtml(err.message)}</p>`;
      console.error(err);
    }
  }

  issueForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    try {
      const formData = new FormData(issueForm);

      const data = await safeFetchJson(`${BASE_URL}?action=create`, {
        method: "POST",
        body: formData,
      });

      alert(data.message);
      issueForm.reset();
      loadAllIssues();
    } catch (err) {
      alert(err.message);
      console.error(err);
    }
  });

  myIssuesBtn?.addEventListener("click", loadMyIssues);
  allIssuesBtn?.addEventListener("click", loadAllIssues);

  loadAllIssues();
});
