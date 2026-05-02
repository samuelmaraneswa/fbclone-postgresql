document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("modalPost");
  const modalPostContent = document.getElementById("modalPostContent");

  const commentList = document.getElementById("modalCommentList");
  const commentInput = document.getElementById("modalCommentInput");

  let startY = 0;

  function closeModal() {
    modal.classList.add("hidden");
    document.body.style.overflow = "";
    commentList.classList.add("hidden");
    commentInput.classList.add("hidden");

    modal.querySelectorAll("video").forEach(v => {
      v.pause();
      v.currentTime = 0;
    });
  }

  document.addEventListener("click", (e) => {
    // ignore
    if (e.target.closest(".like-wrapper")) return;
    if (e.target.closest(".dot")) return;

    // close
    if (e.target.closest("#modalPostCloseBtn")) {
      closeModal();
      return;
    }

    // comment toggle
    if (e.target.closest("#modalCommentIcon")) {
      commentList.classList.remove("hidden");
      commentInput.classList.remove("hidden");
      return;
    }

    // ambil post
    const postItem = e.target.closest(".post-item");
    if (!postItem) return;

    // buka modal
    modal.classList.remove("hidden");
    modal.dataset.postId = postItem.dataset.postId;

    // pause semua video di post
    document.querySelectorAll(".post-item video").forEach(v => {
      v.pause();
      v.currentTime = 0;
    });

    document.body.style.overflow = "hidden";

    // ambil data
    const name = postItem.dataset.name;
    const time = postItem.dataset.time;
    const text = postItem.dataset.text;
    const img = postItem.dataset.img;
    const mediaData = JSON.parse(postItem.dataset.media || "[]");

    const container = modal.querySelector(".modal-media-container");
    container.innerHTML = "";

    let currentIndex = 0;

    // inject data
    modal.querySelector(".modal-post-username").innerText = name;
    modal.querySelector(".modal-post-time").innerText = time;
    modal.querySelector(".modal-post-text").innerText = text;
    modal.querySelector(".modal-post-profile").src = img;

    const modalLikeBtn = modal.querySelector(".modal-like-icon");
    const mainLikeBtn = postItem.querySelector(".btn-like");
    const mainLikeCount = postItem.querySelector(".like-count");
    const modalLikeCount = modal.querySelector(".modal-like-count");

    if (mainLikeBtn && mainLikeBtn.classList.contains("text-blue-600")) {
      modalLikeBtn.classList.add("text-blue-600");
      modal.querySelector(".modal-btn-like").classList.add("text-blue-600");
    } else {
      modalLikeBtn.classList.remove("text-blue-600");
      modal.querySelector(".modal-btn-like").classList.remove("text-blue-600");
    }

    modalLikeCount.innerText = mainLikeCount
      ? mainLikeCount.innerText.trim()
      : "0";

    const mainCommentCount = postItem.querySelector(
      ".text-base .text-gray-500"
    );
    const modalCommentCount = modal.querySelector(".modal-comment-count");

    modalCommentCount.innerText = mainCommentCount
      ? mainCommentCount.innerText.trim()
      : "0";

    // render media
    mediaData.forEach((m, index) => {
      let el;

      if (m.type === "image") {
        el = document.createElement("img");
        el.src = m.url;
      } else {
        el = document.createElement("video");
        el.src = m.url;
        el.controls = true;
      }

      el.className = `w-full h-full object-contain ${index === 0 ? "" : "hidden"}`;
      container.appendChild(el);
    });

    container.querySelectorAll("video").forEach(video => {
      video.addEventListener("pointerup", (e) => {

        if (window.innerWidth >= 768) return; // ✅ desktop skip

        e.stopPropagation();

        if (video.paused) {
          video.play();
        } else {
          video.pause();
        }
      });
    });

    const prevBtn = modal.querySelector(".modal-post-prev");
    const nextBtn = modal.querySelector(".modal-post-next");
    const items = container.children;

    // tombol slider
    if (items.length > 1 && window.innerWidth >= 768) {
      prevBtn.classList.remove("hidden");
      nextBtn.classList.remove("hidden");
    } else {
      prevBtn.classList.add("hidden");
      nextBtn.classList.add("hidden");
    }

    // slide function
    const showSlide = (index) => {
      if (index < 0 || index >= items.length) return;

      [...items].forEach(item => {
        if (item.tagName === "VIDEO") {
          item.pause();
          item.currentTime = 0;
        }
        item.classList.add("hidden");
      });

      items[index].classList.remove("hidden");
      currentIndex = index;
    };

    let startX = 0;

    container.addEventListener("touchstart", (e) => {
      startX = e.touches[0].clientX;
    });

    container.addEventListener("touchend", (e) => {
      const endX = e.changedTouches[0].clientX;
      const diff = endX - startX;

      if (Math.abs(diff) < 50) return;

      if (diff < 0) {
        showSlide(currentIndex + 1);
      } else {
        showSlide(currentIndex - 1);
      }
    });

    nextBtn.onclick = () => showSlide(currentIndex + 1);
    prevBtn.onclick = () => showSlide(currentIndex - 1);
  });

  // ESC close
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !modal.classList.contains("hidden")) {
      closeModal();
    }
  });

  // swipe comment
  modalPostContent.addEventListener("touchstart", (e) => {
    startY = e.touches[0].clientY;
  });

  modalPostContent.addEventListener("touchend", (e) => {
    const endY = e.changedTouches[0].clientY;

    if (endY - startY > 120) {
      commentList.classList.add("hidden");
      commentInput.classList.add("hidden");
    }
  });
});