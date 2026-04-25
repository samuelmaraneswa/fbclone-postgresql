document.addEventListener("DOMContentLoaded", () => {
  document.addEventListener("click", async (e) => {
    const wrapper = e.target.closest(".like-wrapper")
    if(!wrapper) return;

    const postItem = wrapper.closest(".post-item")
    if(!postItem) return;
    
    const postId = wrapper.dataset.postId
    const countEl = postItem.querySelector(".like-count")
    const btn = wrapper.querySelector(".btn-like")

    try{
      const res = await fetch("/posts/like", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({post_id: postId})
      })

      const data = await res.json()

      if(countEl){
        countEl.textContent = data.total
      }

      if(data.status === "liked"){
        btn.classList.add("text-blue-600")
      }else{
        btn.classList.remove("text-blue-600")
      }
    }catch(err){
      console.error("Error:", err)
    }
  })
})

