import { showSuccess } from "../../utils/sweetalert.js"

document.addEventListener("DOMContentLoaded", () => {
  const input = document.querySelectorAll(".inputCreatePost")
  const modal = document.getElementById("modalCreatePost")
  const tutup = document.getElementById("xModalCreatePost")
  const content = modal?.querySelector("#modalContent")
  const errorText = document.getElementById("errorImage")
  const form = document.getElementById("formCreatePost")
  const btnCreatePost = document.getElementById("btnCreatePost")

  if(!input || 
     !modal || 
     !tutup || 
     !content ||
     !btnCreatePost) return

  input.forEach((el) => {
    el.addEventListener("click", () => {
      modal.classList.toggle("hidden")
    })
  })

  tutup.addEventListener("click", () => {
    modal.classList.add("hidden")
  })

  modal.addEventListener("click", (e) => {
    if(!content.contains(e.target)){
      modal.classList.add("hidden")
    }
  })

  document.addEventListener("keydown", (e) => {
    if(e.key === "Escape" && !modal.classList.contains("hidden")){
      modal.classList.add("hidden")
    }
  })

  if(form){
    form.addEventListener("submit", async (e) => {
      e.preventDefault()

      errorText.classList.add("hidden")

      const fileInput = form.querySelector('input[name="mediaCreatePost[]"]')
      const files = fileInput?.files

      if (files && files.length > 0) {
        for (let file of files) {
          if (file.size > 5 * 1024 * 1024) { 
            errorText.textContent = "File maksimal 5MB"
            errorText.classList.remove("hidden")
            return
          }
        }
      }

      const formData = new FormData(form)

      btnCreatePost.disabled = true
      const originalText = btnCreatePost.innerText
      btnCreatePost.innerText = "Loading..."

      try{
        const res = await fetch("/posts/store", {
          method: "POST",
          body: formData,
          headers: {
            "Accept": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
          }
        })

        if(!res.ok){
          const data = await res.json()

          const errors = data.errors
          if(errors && errors["mediaCreatePost.0"]){
            errorText.textContent = errors["mediaCreatePost.0"][0];
            errorText.classList.remove("hidden");
          }

          btnCreatePost.disabled = false
          btnCreatePost.innerText = originalText
          return
        }

        const data = await res.json()
        if(data.status === "success"){
          showSuccess("Post berhasil dibuat")

          const container = document.getElementById("postContainer")
          if(container){
            container.insertAdjacentHTML("afterbegin", data.html)
          }

          form.reset()
          modal.classList.add("hidden")
          btnCreatePost.disabled = false
          btnCreatePost.innerText = originalText
        }
      }catch(err){
        console.error("Error:", err)

        btnCreatePost.disabled = false
        btnCreatePost.innerText = originalText
      }
    })
  }
})