document.addEventListener("DOMContentLoaded", () => {
  const btn = document.querySelectorAll(".messenger-btn")
  const allMessagesDesktop = document.getElementById("allMessages");
  const allMessagesMobile = document.getElementById("allMessagesMobile");

  const unreadMessagesDesktop = document.getElementById("unreadMessages");
  const unreadMessagesMobile = document.getElementById("unreadMessagesMobile");

  if (!btn.length || !allMessages || !unreadMessages) return

  // default active
  btn[0].classList.add("bg-blue-100", "text-blue-600")
  allMessages.classList.remove("hidden")
  unreadMessages.classList.add("hidden")

  btn.forEach(item => {
    item.addEventListener("click", () => {

      btn.forEach(b => b.classList.remove("bg-blue-100", "text-blue-600"))
      item.classList.add("bg-blue-100", "text-blue-600")

      const text = item.innerText.trim()

      if (text === "Semua") {
        allMessages.classList.remove("hidden")
        unreadMessages.classList.add("hidden")
        loadConversations()
      } else if (text === "Belum Dibaca") {
        allMessages.classList.add("hidden")
        unreadMessages.classList.remove("hidden")
        loadUnread();
      }
    })
  })

  async function loadConversations() {
    try {
      const res = await fetch('/messages/conversations');
      const data = await res.json();

      allMessages.innerHTML = '';

      if (!data.length) {
        allMessages.innerHTML = `
          <div class="text-center text-gray-500 mt-8">
            <p>Tidak ada obrolan</p>
          </div>
        `;
        return;
      }

      [allMessagesDesktop, allMessagesMobile].forEach(container => {
        if (!container) return;

        container.innerHTML = '';

        data.forEach(msg => {
          const authId = document.querySelector('meta[name="user-id"]').content;
          const user = msg.sender_id == authId ? msg.receiver : msg.sender;
          const isUnread = msg.receiver_id == authId && msg.is_read == false;

          container.innerHTML += `
            <div 
              class="flex items-center mt-2 gap-2 p-2 rounded-lg cursor-pointer 
              ${isUnread ? 'bg-red-100 hover:bg-red-200' : 'hover:bg-gray-200'}"
              data-open-chat="user"
              data-user-id="${user.id}"
              data-user-name="${user.first_name} ${user.last_name}"
              data-user-avatar="${user.avatar ? '/storage/' + user.avatar : '/images/img-default.png'}"
            >
              <img src="${user.avatar ? '/storage/' + user.avatar : '/images/img-default.png'}" class="h-8 w-8 rounded-full object-cover">

              <div class="flex-1">
                <p class="font-semibold text-base">${user.first_name} ${user.last_name}</p>
                <p class="text-sm text-gray-500 truncate">${msg.message}</p>
              </div>
            </div>
          `;
        });
      });
    } catch (err) {
      console.error('Gagal load conversations:', err);
    }
  }

  window.loadConversations = loadConversations;

  async function loadUnread() {
    try {
      const res = await fetch('/messages/unread');
      const data = await res.json();

      unreadMessages.innerHTML = '';

      if (!data.length) {
        unreadMessages.innerHTML = `<p>Tidak ada obrolan belum dibaca</p>`;
        return;
      }

      const authId = document.querySelector('meta[name="user-id"]').content;

      [unreadMessagesDesktop, unreadMessagesMobile].forEach(container => {
        if (!container) return;

        container.innerHTML = '';

        data.forEach(msg => {
          const user = msg.sender_id == authId ? msg.receiver : msg.sender;

          container.innerHTML += `
            <div 
              class="flex items-center gap-2 p-2 rounded-lg cursor-pointer mt-2 bg-red-100 hover:bg-red-200"
              data-open-chat="user"
              data-user-id="${user.id}"
              data-user-name="${user.first_name} ${user.last_name}"
              data-user-avatar="${user.avatar ? '/storage/' + user.avatar : '/images/img-default.png'}"
            >
              <img src="${user.avatar ? '/storage/' + user.avatar : '/images/img-default.png'}" class="h-8 w-8 rounded-full object-cover">

              <div class="flex-1 text-left">
                <p class="font-semibold">${user.first_name} ${user.last_name}</p>
                <p class="text-sm text-gray-500 truncate">${msg.message}</p>
              </div>
            </div>
          `;
        });
      });

    } catch (err) {
      console.error(err);
    }
  }

  document.addEventListener('click', (e) => {
    const item = e.target.closest('[data-open-chat="user"]');
    if (!item) return;

    const container = document.querySelector('.menu-kanan-btn-header-content');
    if (container) container.classList.add('hidden');
  });

  document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-open-messenger]');
    if (!btn) return;

    loadConversations();
  });
})