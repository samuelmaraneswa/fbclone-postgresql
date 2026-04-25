document.addEventListener("DOMContentLoaded", () => {
  const csrf = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

  document.addEventListener("click", async (e) => {
    const unfriendBtn = e.target.closest('[data-action="unfriend"]')
    if(unfriendBtn) {
      const wrapper = unfriendBtn.closest(".friend-wrapper")
      const btn = wrapper.querySelector(".btn-friend")
      const friendId = wrapper.dataset.id

      try{
        const res = await fetch("/teman/batal", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": csrf
          },
          body: JSON.stringify({ friend_id: friendId })
        })

        const data = await res.json()

        if (data.status === "deleted") {
          btn.dataset.status = "none"
          btn.querySelector(".btn-text").innerText = "Tambah Teman"
          btn.classList.remove("pr-6")

          const icon = btn.querySelector("i")
          if (icon) icon.remove()

          const dropdown = wrapper.querySelector(".btn-teman-dropdown")
          if (dropdown) dropdown.classList.add("hidden")
        }
      }catch(err){
        console.error("Error:", err)
      }

      return
    }
    
    const btn = e.target.closest(".btn-friend")
    if(!btn) return
    
    const wrapper = btn.closest(".friend-wrapper")
    const friendId = wrapper.dataset.id
    const status = btn.dataset.status.trim()

    if(status === "none"){
      try{
        const res = await fetch("/teman/tambah", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": csrf
          },
          body: JSON.stringify({ friend_id: friendId })
        })
        const data = await res.json()

        if(data.status === "success"){
          btn.dataset.status = "requested"
          btn.querySelector(".btn-text").innerHTML = "Permintaan terkirim"
          btn.classList.remove("bg-blue-600", "text-white", "bg-gray-300", "text-black")
          btn.classList.add("bg-gray-300", "text-black")
        }
      }catch(err){
        console.error("Error:", err)
      }
    }

    if(status === "received"){
      try{
        const res = await fetch("/teman/terima", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": csrf
          },
          body: JSON.stringify({ friend_id: friendId })
        })

        const data = await res.json()

        if (data.status === "accepted") {
          btn.dataset.status = "friends"
          btn.querySelector(".btn-text").innerText = "Berteman"
          btn.classList.remove("bg-gray-300", "text-black")
          btn.classList.add("bg-blue-600", "text-white", "pr-6")

          if (!btn.querySelector("i")) {
            btn.insertAdjacentHTML("beforeend", `
              <i class="fa-solid fa-ellipsis-vertical absolute right-0 top-1/2 -translate-y-1/2"></i>
            `)
          }
        }
      }catch(err){

      }
    }

    if (status === "requested") {
      try {
        const res = await fetch("/teman/batal", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": csrf
          },
          body: JSON.stringify({ friend_id: friendId })
        })

        const data = await res.json()

        if (data.status === "deleted") {
          btn.dataset.status = "none"
          btn.querySelector(".btn-text").innerText = "Tambah Teman"
          btn.classList.add("bg-blue-600", "text-white")
          btn.classList.remove("bg-gray-300", "text-black")
        }

      } catch (err) {
        console.error(err)
      }
    }

    if (status === "friends") {
      const dropdown = wrapper.querySelector(".btn-teman-dropdown")
      if (!dropdown) return

      dropdown.classList.toggle("hidden")
    }
  })

  document.addEventListener("click", (e) => {
    const wrapper = e.target.closest(".friend-wrapper")

    document.querySelectorAll(".btn-teman-dropdown").forEach(d => {
      if (!wrapper || !wrapper.contains(d)) {
        d.classList.add("hidden")
      }
    })
  })
})