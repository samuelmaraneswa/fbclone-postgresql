document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("btnNotifMobile")
  const notif = document.getElementById("notifMobile")

  btn.addEventListener("click", () => {
    notif.classList.toggle("hidden")
  })
})