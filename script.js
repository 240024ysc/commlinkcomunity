document.addEventListener("DOMContentLoaded", () => {
  fetch("api/session.php")
    .then(res => res.json())
    .then(data => {
      if (!data.loggedIn) {
        showLoginModal();
      } else {
        initApp();
      }
    });

  document.getElementById("send-button").onclick = sendMessage;
  document.getElementById("ai-button").onclick = () => {
    document.getElementById("message-input").value = "/ask AIに質問...";
  };
  document.getElementById("message-input").addEventListener("keydown", e => {
    if (e.key === "Enter") sendMessage();
  });
});

function sendMessage() {
  const input = document.getElementById("message-input");
  const msg = input.value.trim();
  if (!msg) return;

  appendMessage("You", msg);
  input.value = "";

  fetch("api/ai.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ message: msg })
  })
  .then(res => res.json())
  .then(data => appendMessage("AI", data.reply))
  .catch(() => appendMessage("AI", "（AI応答エラー）"));
}

function appendMessage(sender, text) {
  const chat = document.getElementById("chat-window");
  const div = document.createElement("div");
  div.innerHTML = `<strong>${sender}:</strong> ${text}`;
  chat.appendChild(div);
  chat.scrollTop = chat.scrollHeight;
}

function switchTab(id) {
  document.querySelectorAll(".tab").forEach(el => el.classList.add("hidden"));
  document.getElementById("tab-" + id).classList.remove("hidden");
}

function showLoginModal() {
  document.getElementById("login-modal").classList.remove("hidden");
}

function showRegisterModal() {
  document.getElementById("login-modal").classList.add("hidden");
  document.getElementById("register-modal").classList.remove("hidden");
}

function attemptLogin() {
  const username = document.getElementById("login-username").value;
  const password = document.getElementById("login-password").value;

  fetch("api/login.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ username, password })
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        document.getElementById("login-modal").classList.add("hidden");
        initApp();
      } else {
        alert("ログイン失敗: " + data.error);
      }
    });
}

function attemptRegister() {
  const username = document.getElementById("register-username").value;
  const password = document.getElementById("register-password").value;

  fetch("api/register.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ username, password })
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert("登録成功！ログインしてください。")
        document.getElementById("register-modal").classList.add("hidden");
        showLoginModal();
      } else {
        alert("登録失敗: " + data.error);
      }
    });
}

function logout() {
  fetch("api/logout.php").then(() => location.reload());
}

function initApp() {
  switchTab("chat");
}
