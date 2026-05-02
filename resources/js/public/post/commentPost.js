// document.addEventListener("DOMContentLoaded", () => {
//   document.addEventListener("click", async (e) => {
//     const sendBtn = e.target.closest(".modal-send");
//     if (!sendBtn) return;

//     const modal = document.getElementById("modalPost");
//     const postId = modal.dataset.postId;
//     const input = modal.querySelector(".modal-comment-input input");
//     const content = input.value.trim();

//     if (!postId || !content) return;

//     try {
//       const res = await fetch("/posts/comment", {
//         method: "POST",
//         headers: {
//           "Content-Type": "application/json",
//           "X-CSRF-TOKEN": document.querySelector(
//             'meta[name="csrf-token"]'
//           ).content,
//         },
//         body: JSON.stringify({
//           post_id: postId,
//           content: content,
//         }),
//       });

//       const data = await res.json();

//       if (data.status === "success") {
//         input.value = "";
//         console.log("Comment saved:", data);
//       }
//     } catch (err) {
//       console.error("Error:", err);
//     }
//   });
// });

document.addEventListener("DOMContentLoaded", () => {
  function renderComments(comments) {
    const commentList = document.getElementById("modalCommentList");
    if (!commentList) return;

    commentList.innerHTML = "";

    if (!comments || comments.length === 0) {
      commentList.innerHTML = `
        <p class="text-gray-500 text-sm text-center w-full">
          Belum ada komentar
        </p>
      `;
      return;
    }

    comments.forEach((comment) => {
      commentList.innerHTML += `
        <div class="flex items-start gap-2 mb-1 md:mb-0">
          <img 
            src="${
              comment.user?.avatar
                ? "/storage/" + comment.user.avatar
                : "/images/img-default.png"
            }"
            class="h-9.5 w-9 bg-gray-100 border border-gray-200 rounded-full object-cover"
          >

          <div class="bg-gray-100 rounded-lg p-2">
            <h3 class="font-semibold text-black">
              ${comment.user?.first_name ?? ""} ${comment.user?.last_name ?? ""}
            </h3>

            <p class="text-gray-500">
              ${comment.content}
            </p>
          </div>
        </div>
      `;
    });
  }

  async function loadComments(postId) {
    if (!postId) return;

    try {
      const res = await fetch(`/posts/${postId}/comments`);
      const data = await res.json();

      if (data.status === "success") {
        renderComments(data.comments);
      }
    } catch (err) {
      console.error("Load comments error:", err);
    }
  }

  document.addEventListener("click", async (e) => {
    const modal = document.getElementById("modalPost");

    // saat modal dibuka → load comment
    const postItem = e.target.closest(".post-item");
    if (postItem) {
      const postId = postItem.dataset.postId;
      loadComments(postId);
    }

    // submit comment
    const sendBtn = e.target.closest(".modal-send");
    if (!sendBtn) return;

    const postId = modal.dataset.postId;
    const input = modal.querySelector(".modal-comment-input input");
    const content = input.value.trim();

    if (!postId || !content) return;

    try {
      const res = await fetch("/posts/comment", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector(
            'meta[name="csrf-token"]'
          ).content,
        },
        body: JSON.stringify({
          post_id: postId,
          content: content,
        }),
      });

      const data = await res.json();

      if (data.status === "success") {
        input.value = "";
        loadComments(postId);

        const modalCommentCount = modal.querySelector(".modal-comment-count");

        const postItem = document.querySelector(
          `.post-item[data-post-id="${postId}"]`
        );

        const mainCommentCount = postItem.querySelector(
          ".text-base .text-gray-500"
        );

        if (modalCommentCount) {
          modalCommentCount.textContent = data.total;
        }

        if (mainCommentCount) {
          mainCommentCount.textContent = data.total;
        }
      }
    } catch (err) {
      console.error("Save comment error:", err);
    }
  });
});