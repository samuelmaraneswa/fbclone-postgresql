document.addEventListener("DOMContentLoaded", () => {
  const loginPassword = document.getElementById("loginPassword")
  const togglePasswordLogin = document.getElementById("togglePasswordLogin")
  const eyeIcon = document.getElementById("eyeIcon")

  if (!loginPassword || !togglePasswordLogin || !eyeIcon) return

  togglePasswordLogin.addEventListener("click", () => {
    if(loginPassword.type === 'password'){
      loginPassword.type = 'text'
      eyeIcon.classList.replace('fa-eye', 'fa-eye-slash')
    }else{
      loginPassword.type = 'password'
      eyeIcon.classList.replace('fa-eye-slash', 'fa-eye')
    }
  })
})