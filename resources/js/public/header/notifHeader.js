document.addEventListener("DOMContentLoaded", () => {
  const btn = document.querySelectorAll(".btn-notif-header")

  if(btn.length > 0){
    btn[0].classList.add("bg-blue-100", "text-blue-600")
  }
  btn.forEach(item => {
    item.addEventListener("click", () => {
      btn.forEach(b => { b.classList.remove("bg-blue-100", "text-blue-600")})

      item.classList.add("bg-blue-100", "text-blue-600")
    })
  })
})