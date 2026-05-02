document.addEventListener('DOMContentLoaded', () => {
  const input = document.getElementById('chatInput');
  const sendBtn = document.querySelector('[data-send-message]:not(input)');

  let currentReceiverId = null; // set saat klik teman

  // 🔥 set receiver saat klik teman
  document.addEventListener('click', async (e) => {
    const item = e.target.closest('[data-open-chat="user"]');
    if (!item) return;

    currentReceiverId = item.dataset.userId;

    document.getElementById('messengerMobileCard')?.classList.add('hidden');
    document.getElementById('chatUserBox')?.classList.remove('hidden');

    await loadMessages(currentReceiverId);
    await loadUnreadCount();
    await loadConversations();
  });

  // 🔥 toggle icon kirim
  input.addEventListener('input', () => {
    if (input.value.trim() !== '') {
      sendBtn.classList.remove('hidden');
    } else {
      sendBtn.classList.add('hidden');
    }
  });

  // 🔥 fungsi kirim
  async function sendMessage() {
    const message = input.value.trim();
    if (!message || !currentReceiverId) return;

    try {
      const res = await fetch('/messages', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
          receiver_id: currentReceiverId,
          message: message
        })
      });

      const data = await res.json();

      // kosongkan input
      input.value = '';
      sendBtn.classList.add('hidden');

      // optional: append ke UI langsung (biar terasa realtime)
      const chatMessages = document.getElementById('chatMessages');
      if (chatMessages) {
        chatMessages.innerHTML += `
          <div class="text-right mb-2">
            <span class="bg-purple-500 text-white px-3 py-1 rounded-full inline-block">
              ${data.message}
            </span>
          </div>
        `;
        chatMessages.scrollTop = chatMessages.scrollHeight;
      }

    } catch (err) {
      console.error('Gagal kirim pesan:', err);
    }
  }

  const authUserId = document.querySelector('meta[name="user-id"]').content;

  // load pesan
  async function loadMessages(userId) {
    try {
      const res = await fetch(`/messages/${userId}`);
      const messages = await res.json();

      const chatMessages = document.getElementById('chatMessages');
      chatMessages.innerHTML = '';

      messages.forEach(msg => {
        if (msg.sender_id == authUserId) {
          // pesan kita
          chatMessages.innerHTML += `
            <div class="text-right mb-2">
              <span class="bg-purple-500 text-white px-3 py-1 rounded-full inline-block">
                ${msg.message}
              </span>
            </div>
          `;
        } else {
          // pesan lawan
          chatMessages.innerHTML += `
            <div class="text-left mb-2">
              <span class="bg-gray-200 px-3 py-1 rounded-full inline-block">
                ${msg.message}
              </span>
            </div>
          `;
        }
      });

      chatMessages.scrollTop = chatMessages.scrollHeight;

    } catch (err) {
      console.error('Gagal load pesan:', err);
    }
  }

  // 🔥 klik icon
  sendBtn.addEventListener('click', sendMessage);

  // 🔥 enter
  input.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
      e.preventDefault();
      sendMessage();
    }
  });
});