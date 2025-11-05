document.addEventListener("DOMContentLoaded", () => {
  const input = document.getElementById("user-input");
  const sendBtn = document.getElementById("send-btn");
  const chatBox = document.getElementById("chat-box");

  // Focus input on load
  input.focus();

  // Append message to chat window
  function appendMessage(text, sender) {
    const msgDiv = document.createElement("div");
    msgDiv.className = sender === "bot" ? "bot-message" : "user-message";

    const time = new Date().toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
    msgDiv.innerHTML = `<span>${text}</span><div class="time">${time}</div>`;

    chatBox.appendChild(msgDiv);
    chatBox.scrollTop = chatBox.scrollHeight;
  }

  // Main send message handler
  function sendMessage() {
    const message = input.value.trim();
    if (!message) return;

    appendMessage(message, "user");
    input.value = "";

    // Create typing indicator
    const typingDiv = document.createElement("div");
    typingDiv.className = "bot-message typing";
    typingDiv.textContent = "Chepseon TVC assistant is typing...";
    chatBox.appendChild(typingDiv);
    chatBox.scrollTop = chatBox.scrollHeight;

    // Send message to PHP backend
    fetch("server.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "message=" + encodeURIComponent(message),
    })
      .then((res) => {
        if (!res.ok) throw new Error("Network response was not ok");
        return res.json();
      })
      .then((data) => {
    setTimeout(() => {
        typingDiv.remove();
        appendMessage(data.reply || "Sorry, I didn’t catch that.", "bot");
        }, 800); // short delay to simulate typing
    })

      .catch((err) => {
        typingDiv.remove();
        console.error("Fetch error:", err);
        appendMessage("⚠️ Server error or connection failed.", "bot");
      });
  }

  // Click send button
  sendBtn.addEventListener("click", sendMessage);

  // Press Enter to send
  input.addEventListener("keypress", (e) => {
    if (e.key === "Enter") {
      e.preventDefault();
      sendMessage();
    }
  });
});
