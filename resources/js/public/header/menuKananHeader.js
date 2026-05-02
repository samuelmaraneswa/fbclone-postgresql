document.querySelectorAll('.menu-kanan-btn-header').forEach(btn => {
  btn.addEventListener("click", () => {

    const isActive = btn.classList.contains("bg-blue-100")

    document.querySelectorAll(".menu-kanan-btn-header").forEach(b => {
      b.classList.remove('bg-blue-100', 'text-blue-600')
      b.classList.add('bg-gray-200')
    })
 
    document.querySelectorAll('.menu-kanan-btn-header-content').forEach(c => {
      c.classList.add('hidden')
    })

    if(isActive) return

    btn.classList.remove('bg-gray-200', 'hover:bg-gray-300')
    btn.classList.add('bg-blue-100', 'text-blue-600')

    btn.closest('.menu-kanan-item').querySelector('.menu-kanan-btn-header-content').classList.remove('hidden')

    btn.closest('.menu-kanan-item').querySelector('[data-messenger-card]')?.classList.remove('hidden');})
})

document.addEventListener("click", (e) => {
  if (window.innerWidth < 768) {
    const isInside =
      e.target.closest('#messengerMobileCard') ||
      e.target.closest('#btnMessengerMobile');

    const isInsideNotif =
      e.target.closest('#notifMobile') ||
      e.target.closest('#btnNotifMobile');

    if (!isInside) {
      document.getElementById('messengerMobileCard')?.classList.add('hidden');
    }

    if (!isInsideNotif) {
      document.getElementById('notifMobile')?.classList.add('hidden');
    }
    return;
  }

  if(
    e.target.closest('.menu-kanan-btn-header') || 
    (e.target.closest('.menu-kanan-btn-header-content') && 
    !e.target.closest('[data-open-chat="user"]'))
  ) return;
  
  document.querySelectorAll(".menu-kanan-btn-header").forEach(b => {
    b.classList.remove("bg-blue-100", "text-blue-600")
    b.classList.add("bg-gray-200")
  })

  document.querySelectorAll(".menu-kanan-btn-header-content").forEach(c => {
    c.classList.add("hidden")
  })
})

