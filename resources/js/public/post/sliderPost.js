document.addEventListener("DOMContentLoaded", () => {
  const wrappers = document.querySelectorAll(".media-wrapper")

  wrappers.forEach(wrapper => {
    const items = wrapper.querySelectorAll(".media-item")
    const dotsContainer = wrapper.parentElement.querySelector(".media-dots")
    if (!dotsContainer) return

    const dots = dotsContainer.querySelectorAll(".dot")

    let currentIndex = 0
    let startX = 0
    let endX = 0

    // 🔁 function pindah slide
    const showSlide = (index) => {
      if (index < 0 || index >= items.length) return

      // ⛔ pause semua video
      items.forEach(item => {
        const video = item.querySelector("video")
        if (video) {
          video.pause()
          video.currentTime = 0
        }
      })

      // hide semua
      items.forEach(item => item.classList.add("hidden"))
      items[index].classList.remove("hidden")

      // update dot
      dots.forEach(d => {
        d.classList.remove("bg-blue-500")
        d.classList.add("bg-gray-400")
      })

      dots[index].classList.remove("bg-gray-400")
      dots[index].classList.add("bg-blue-500")

      currentIndex = index
    }

    // 🟢 klik dot
    dots.forEach(dot => {
      dot.addEventListener("click", () => {
        const index = parseInt(dot.dataset.index)
        showSlide(index)
      })
    })

    // 👉 TOUCH START
    wrapper.addEventListener("touchstart", (e) => {
      startX = e.touches[0].clientX
    })

    // 👉 TOUCH END
    wrapper.addEventListener("touchend", (e) => {
      endX = e.changedTouches[0].clientX

      const diff = startX - endX

      // swipe kiri (next)
      if (diff > 50) {
        showSlide(currentIndex + 1)
      }

      // swipe kanan (prev)
      if (diff < -50) {
        showSlide(currentIndex - 1)
      }
    })

    // 👁️ observer untuk pause kalau keluar viewport
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        const wrapperEl = entry.target

        // kalau tidak terlihat
        if (!entry.isIntersecting) {
          const videos = wrapperEl.querySelectorAll("video")

          videos.forEach(video => {
            video.pause()
          })
        }
      })
    }, {
      threshold: 0.5 // minimal 50% terlihat
    })

    // observe wrapper ini
    observer.observe(wrapper)
  })
})