document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formRegister")
  const btnSubmit = document.getElementById("submitRegister")

  if(!form) return

  function showValidationErrors(errors){
    document.querySelectorAll("[id^='error-']").forEach(el => {
      el.textContent = '';
    }) 

    Object.entries(errors).forEach(([field, message]) => {
      const el = document.getElementById(`error-${field}`);
      if(el){
        el.textContent = message[0]
      }
    })
  }

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    btnSubmit.disabled = true;
    btnSubmit.innerText = "Loading..."
    btnSubmit.style.cursor = "not-allowed"

    const formData = new FormData(form);

    for (let [k, v] of formData.entries()) {
      console.log(k, v);
    }

    try{
      const res = await fetch(form.action, {
        method: "POST",
        body: formData,
        headers: {"Accept": "application/json"}
      });

      const data = await res.json();

      if(!res.ok) {
        console.log("Error:", data)

        if(data.errors){
          showValidationErrors(data.errors);
        }
        
        btnSubmit.disabled = false
        btnSubmit.innerHTML = "Submit"
        btnSubmit.style.cursor = "pointer"

        return;
      }

      form.reset()
      showValidationErrors({})
      console.log("Success", data)

      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: 'Register berhasil',
        timer: 1500,
        showConfirmButton: false
      }).then(() => {
        window.location.href = data.redirect
      })

      btnSubmit.disabled = false
      btnSubmit.innerHTML = "Submit"
      btnSubmit.style.cursor = "pointer"

    }catch(err){
      console.error("Network error:", err)

      btnSubmit.disabled = false
      btnSubmit.innerHTML = "Submit"
      btnSubmit.style.cursor = "pointer"
    }
  })
})