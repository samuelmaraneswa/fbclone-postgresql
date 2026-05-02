// document.addEventListener("DOMContentLoaded", () => {
//   document.addEventListener("click", async (e) => {
//     const likeBtn = e.target.closest(".modal-btn-like");
//     if (!likeBtn) return;

//     const modal = document.getElementById("modalPost");
//     const postId = modal.dataset.postId;
//     if (!postId) return;

//     const modalLikeIcon = modal.querySelector(".modal-like-icon");
//     const modalLikeCount = modal.querySelector(".modal-like-count");

//     const postItem = document.querySelector(
//       `.post-item[data-post-id="${postId}"]`
//     );

//     const mainLikeBtn = postItem?.querySelector(".btn-like");
//     const mainLikeCount = postItem?.querySelector(".like-count");

//     try {
//       const res = await fetch("/posts/like", {
//         method: "POST",
//         headers: {
//           "Content-Type": "application/json",
//           "X-CSRF-TOKEN": document.querySelector(
//             'meta[name="csrf-token"]'
//           ).content,
//         },
//         body: JSON.stringify({
//           post_id: postId,
//         }),
//       });

//       const data = await res.json();

//       if (modalLikeCount) {
//         modalLikeCount.textContent = data.total;
//       }

//       if (mainLikeCount) {
//         mainLikeCount.textContent = data.total;
//       }

//       if (data.status === "liked") {
//         modalLikeIcon?.classList.add("text-blue-600");
//         modal.querySelector(".modal-btn-like")?.classList.add("text-blue-600");

//         mainLikeBtn?.classList.add("text-blue-600");
//       } else {
//         modalLikeIcon?.classList.remove("text-blue-600");
//         modal.querySelector(".modal-btn-like")?.classList.remove("text-blue-600");

//         mainLikeBtn?.classList.remove("text-blue-600");
//       }
//     } catch (err) {
//       console.error("Error:", err);
//     }
//   });
// });
document.addEventListener("DOMContentLoaded", () => {
  document.addEventListener("click", async (e) => {
    const likeBtn = e.target.closest(".modal-btn-like, .modal-like-icon");
    if (!likeBtn) return;

    const modal = document.getElementById("modalPost");
    const postId = modal.dataset.postId;
    if (!postId) return;

    const modalLikeIcon = modal.querySelector(".modal-like-icon");
    const modalLikeCount = modal.querySelector(".modal-like-count");

    const postItem = document.querySelector(
      `.post-item[data-post-id="${postId}"]`
    );

    const mainLikeBtn = postItem?.querySelector(".btn-like");
    const mainLikeCount = postItem?.querySelector(".like-count");

    try {
      const res = await fetch("/posts/like", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector(
            'meta[name="csrf-token"]'
          ).content,
        },
        body: JSON.stringify({
          post_id: postId,
        }),
      });

      const data = await res.json();

      if (modalLikeCount) {
        modalLikeCount.textContent = data.total;
      }

      if (mainLikeCount) {
        mainLikeCount.textContent = data.total;
      }

      if (data.status === "liked") {
        modalLikeIcon?.classList.add("text-blue-600");
        modal.querySelector(".modal-btn-like")?.classList.add("text-blue-600");
        mainLikeBtn?.classList.add("text-blue-600");
      } else {
        modalLikeIcon?.classList.remove("text-blue-600");
        modal.querySelector(".modal-btn-like")?.classList.remove("text-blue-600");
        mainLikeBtn?.classList.remove("text-blue-600");
      }
    } catch (err) {
      console.error("Error:", err);
    }
  });
});