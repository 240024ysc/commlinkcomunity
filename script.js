const chatWindow = document.getElementById("chat-window");
const input = document.getElementById("message-input");
const sendButton = document.getElementById("send-button");
const aiButton = document.getElementById("ai-button");

function appendMessage(role, text) {
  const div = document.createElement("div");
  div.className = "message";
  div.innerHTML = `<strong>${role === 'user' ? 'You' : 'AI'}:</strong> ${text}`;
  chatWindow.appendChild(div);
  chatWindow.scrollTop = chatWindow.scrollHeight;
}

async function sendMessage() {
  const msg = input.value.trim();
  if (!msg) return;
  appendMessage("user", msg);
  input.value = "";

  try {
    const res = await fetch("api/ai.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ message: msg }),
    });

    const data = await res.json();
    appendMessage("assistant", data.reply);
  } catch (e) {
    appendMessage("assistant", "（AI応答エラー）");
  }
}

sendButton.onclick = sendMessage;
aiButton.onclick = () => {
  input.value = "/ask 何か質問してみてください";
};
input.addEventListener("keydown", (e) => {
  if (e.key === "Enter") sendMessage();
});
