export function showSuccess(message = "Berhasil", redirect = null){
  Swal.fire({
    icon: "success",
    title: "Berhasil",
    text: message,
    timer: 1500,
    showConfirmation: false
  }).then(() => {
    if(redirect) window.location.href = redirect
  })
}

export function showError(message = "Terjadi Kesalahan"){
  Swal.fire({
    icon: "error",
    title: "Error",
    text: message
  });
}

export function showWarning(message = "Peringatan"){
  Swal.fire({
    icon: "warning",
    title: "Warning",
    text: message
  });
}