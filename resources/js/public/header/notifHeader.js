// document.addEventListener("DOMContentLoaded", () => {
//   const btn = document.querySelectorAll(".btn-notif-header")
//   const wrappers = document.querySelectorAll('.notification-wrapper')
//   const bells = document.querySelectorAll('.fa-bell');

//   if (bells.length === 0) return;

//   let notifLoaded = false

//   if(btn.length > 0){
//     btn[0].classList.add("bg-blue-100", "text-blue-600")
//     loadNotification("all")
//   }

//   btn.forEach(item => {
//     item.addEventListener("click", () => {
//       btn.forEach(b => { b.classList.remove("bg-blue-100", "text-blue-600")})

//       item.classList.add("bg-blue-100", "text-blue-600")
      
//       const filter = item.dataset.filter
//       loadNotification(filter)
//     })
//   })

//   bells.forEach(bell => {
//     bell.addEventListener("click", () => {
//       if(btn.length > 0){
//         btn[0].click()
//       }
//     })
//   })

//   async function loadNotification(filter = "all"){
//     try{
//       const res = await fetch(`/notifications?filter=${filter}`)
//       const result = await res.json()

//       renderNotifications(result.data || [])    
//     }catch(err){
//       console.error("Erorr:", err)
//     }
//   }

//   function renderNotifications(data){
//     if(!data.length){
//       list.innerHTML = ""
//       empty.classList.remove("hidden")
//       return
//     }

//     empty.classList.add("hidden")

//     list.innerHTML = data.map(n => {
//       const bg = n.is_read ? "bg-gray-100" : "bg-red-100"

//       return `
//         <div class="notifications-item p-3 rounded-lg cursor-pointer ${bg}" data-id="${n.id}" data-user="${n.from_user_id ?? ''}" data-type="${n.type}">
//           <p class="text-base">
//             <span class="font-semibold">${n.from_user?.first_name ?? ""}</span>
//             ${getMessage(n.type)}
//           </p>
//           <span class="block text-xs text-gray-500 -mt-0.5">${n.created_at}</span>
//         </div>
//       `;
//     }).join("")
//   }

//   list.addEventListener("click", (e) => {
//     const item = e.target.closest(".notifications-item")
//     if(!item) return

//     const userId = item.dataset.user
//     const type = item.dataset.type

//     if(type === "friend_request" || type === "friend_accepted"){
//       const notifId = item.dataset.id
//       fetch('/notifications/read', {
//         method: 'POST',
//         headers: {
//           'Content-Type': 'application/json',
//           'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
//         },
//         body: JSON.stringify({ id: notifId })
//       })

//       item.classList.remove("bg-red-100")
//       item.classList.add("bg-gray-100")

//       window.location.href = `/profile/user/${userId}`
//     }
//   })

//   function getMessage(type){
//     if(type === "friend_request") return "mengirim permintaan pertemanan"
//     if(type === "friend_accepted") return "menerima pertemanan"
//     return "melakukan aktivitas"
//   }
// })

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
        const bgUnread = isMobile ? "bg-white" : "bg-red-100"
        const bgRead   = isMobile ? "bg-white" : "bg-gray-100"

        const bg = n.is_read ? bgRead : bgUnread

        return `
          <div class="notifications-item p-3 rounded-lg cursor-pointer ${bg}">
            <p class="text-base">
              <span class="font-semibold">${n.from_user?.first_name ?? ""}</span>
              ${getMessage(n.type)}
            </p>
            <span class="text-xs text-gray-500">${n.created_at}</span>
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
  });

  function getMessage(type){
    if(type === "friend_request") return "mengirim permintaan pertemanan";
    if(type === "friend_accepted") return "menerima pertemanan";
    return "melakukan aktivitas";
  }
});