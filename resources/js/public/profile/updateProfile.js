import { showSuccess } from "../../utils/sweetalert.js"

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("updateProfile")
  const save = document.getElementById("saveUpdateProfile")

  if(!form || !save) return

  function showValidation(errors){
    document.querySelectorAll("[id^='text-error-']").forEach(el => {
      el.textContent = ''
    })

    Object.entries(errors).forEach(([field, message]) => {
      const el = document.getElementById(`text-error-${field}`);
      if(el) el.textContent = message[0]
    })
  }

  function toggleBtn(isLoading){
    if(isLoading){
      save.disabled = true;
      save.innerText = "Loading..."
      save.style.cursor = "not-allowed"
    }else{
      save.disabled = false;
      save.innerText = "Save"
      save.style.cursor = "pointer"
    }
  }

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    toggleBtn(true)

    const formData = new FormData(form)
    for(let [k, v] of formData.entries()){
      console.log(k, v)
    }

    try{
      const res = await fetch(form.action, {
        method: "POST",
        body: formData,
        headers: {"Accept": "application/json"}
      })

      const data = await res.json();

      if(!res.ok){
        console.log("Error:", data)

        if(data.errors){
          showValidation(data.errors)
          toggleBtn(false)

          return;
        }
      }

      showSuccess("Data berhasil di update", data.redirect)
    }catch(err){
      console.error("Network error:", err)
    }finally{
      toggleBtn(false)
    }
  })
})