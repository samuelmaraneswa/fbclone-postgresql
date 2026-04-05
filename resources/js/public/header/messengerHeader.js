document.addEventListener("DOMContentLoaded", () => {
  const btn = document.querySelectorAll(".messenger-btn")
  const semuaPesan = document.querySelector(".semua-pesan")
  const pesanBelumDibaca = document.querySelector(".pesan-belum-dibaca")
  const pesanGroup = document.querySelector(".pesan-group")

  if (!btn.length || !semuaPesan || !pesanBelumDibaca || !pesanGroup) return

  if(btn.length > 0){
    btn[0].classList.add("bg-blue-100", "text-blue-600")
  }

  semuaPesan.style.display = "block"
  pesanBelumDibaca.style.display = "none"
  pesanGroup.style.display = "none"

  btn.forEach(item => {
    item.addEventListener("click", () => {

      btn.forEach(b => {
        b.classList.remove("bg-blue-100", "text-blue-600")
      })

      item.classList.add("bg-blue-100", "text-blue-600")

      const text = item.innerText.trim()

      if(text === "Semua"){
        semuaPesan.style.display = "block"
        pesanBelumDibaca.style.display = "none"
        pesanGroup.style.display = "none"
      }else if(text === "Belum Dibaca"){
        semuaPesan.style.display = "none"
        pesanBelumDibaca.style.display = "block"
        pesanGroup.style.display = "none"
      }else{
        pesanGroup.style.display = "block"
        semuaPesan.style.display = "none"
        pesanBelumDibaca.style.display = "none"
      }
    })
  })

})