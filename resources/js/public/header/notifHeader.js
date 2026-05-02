document.addEventListener("DOMContentLoaded", () => {
  const wrappers = document.querySelectorAll('.notification-wrapper');
  const bells = document.querySelectorAll('.fa-bell');

  if (!bells.length || !wrappers.length) return;

  wrappers.forEach(wrapper => {
    const btn = wrapper.querySelectorAll(".btn-notif-header");
    if (btn.length > 0) {
      btn[0].classList.add("bg-blue-100", "text-blue-600");
    }
  });

  loadNotification("all");

  wrappers.forEach(wrapper => {
    const btn = wrapper.querySelectorAll(".btn-notif-header");

    btn.forEach(item => {
      item.addEventListener("click", () => {
        btn.forEach(b => b.classList.remove("bg-blue-100", "text-blue-600"));
        item.classList.add("bg-blue-100", "text-blue-600");

        const filter = item.dataset.filter;
        loadNotification(filter);
      });
    });
  });

  bells.forEach(bell => {
    bell.addEventListener("click", () => {
      loadNotification("all");

      wrappers.forEach(wrapper => {
        const btn = wrapper.querySelectorAll(".btn-notif-header");
        if (btn.length > 0) {
          btn.forEach(b => b.classList.remove("bg-blue-100","text-blue-600"));
          btn[0].classList.add("bg-blue-100","text-blue-600");
        }
      });
    });
  });

  async function loadNotification(filter = "all"){
    try{
      const res = await fetch(`/notifications?filter=${filter}`);
      const result = await res.json();

      renderNotifications(result.data || []);

      // update badge unread count
      const unreadCount = (result.data || []).filter(n => !n.is_read).length;
      const badges = document.querySelectorAll(".notif-badge");

      badges.forEach(badge => {
        if (unreadCount > 0) {
          badge.classList.remove("hidden");
          badge.textContent = unreadCount;
        } else {
          badge.classList.add("hidden");
          badge.textContent = "";
        }
      });
    }catch(err){
      console.error("Error:", err);
    }
  }

  function renderNotifications(data){
    wrappers.forEach(wrapper => {
      const list = wrapper.querySelector('[data-role="list"]')
      const empty = wrapper.querySelector('[data-role="empty"]')

      const isMobile = wrapper.id === "notifMobile"

      if(!data.length){
        list.innerHTML = ""
        empty.classList.remove("hidden")
        return
      }

      empty.classList.add("hidden")

      list.innerHTML = data.map(n => {
        const bgUnread = "bg-red-100"
        const bgRead   = "bg-gray-100"

        const bg = n.is_read ? bgRead : bgUnread

        return `
          <div class="notifications-item p-2 rounded-lg cursor-pointer ${bg}" data-id="${n.id}" data-type="${n.type}" data-user="${n.from_user_id}" data-reference="${n.reference_id}">
            <p class="text-base">
              <span class="font-semibold">${n.from_user?.first_name ?? ""}</span>
              ${getMessage(n.type)}
            </p>
            <span class="block text-xs text-gray-500 -mt-1">${n.created_at}</span>
          </div>
        `;
      }).join("")
    })
  }

  document.addEventListener("click", (e) => {
    const item = e.target.closest(".notifications-item");
    if(!item) return;

    const userId = item.dataset.user;
    const type = item.dataset.type;

    if(type === "friend_request" || type === "friend_accepted"){
      const notifId = item.dataset.id;

      fetch('/notifications/read', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ id: notifId })
      });

      item.classList.remove("bg-red-100");
      item.classList.add("bg-gray-100");

      window.location.href = `/profile/user/${userId}`;
    }

    const referenceId = item.dataset.reference;

    if(type === "post_like"){
      const notifId = item.dataset.id;

      fetch('/notifications/read', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ id: notifId })
      });

      item.classList.remove("bg-red-100");
      item.classList.add("bg-gray-100");

      window.location.href = `/posts/${referenceId}`;
    }

    if (type === "post_like" || type === "post_comment") {
      const notifId = item.dataset.id;

      fetch('/notifications/read', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ id: notifId })
      });

      item.classList.remove("bg-red-100");
      item.classList.add("bg-gray-100");

      window.location.href = `/posts/${referenceId}`;
    }
  });

  function getMessage(type){
    if(type === "friend_request") return "mengirim permintaan pertemanan";
    if(type === "friend_accepted") return "menerima pertemanan";
    if(type === "post_like") return "menyukai postingan Anda";
    if(type === "post_comment") return "mengomentari postingan Anda";
    return "melakukan aktivitas";
  }
});