document.addEventListener("DOMContentLoaded", function () {
    const submitBtn = document.getElementById('submit-comment');

    if (!submitBtn) return;

    submitBtn.addEventListener('click', async function () {

        const commentBox = document.getElementById('comment');
        const comment = commentBox.value.trim();

        if (!comment) {
            alert('Please write a comment');
            return;
        }

        const blogId = submitBtn.dataset.blogId;

        submitBtn.disabled = true; // Prevent multiple clicks

        try {
            const res = await fetch(`/blogs/${blogId}/comments`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "X-Requested-With": "XMLHttpRequest",
                },
                body: JSON.stringify({ comment: comment }),
            });

            const data = await res.json();

            if (!res.ok) {
                // Handle validation or server errors
                if (data.errors) {
                    alert(Object.values(data.errors).join("\n"));
                } else {
                    alert(data.message || "Something went wrong");
                }
                submitBtn.disabled = false;
                return;
            }

            // Add new comment to the list
            const ul = document.getElementById("comments-list");
            const li = document.createElement("li");

            li.id = "comment-" + data.data.id;
            li.innerHTML = `<strong>${data.data.user.name}:</strong> ${data.data.comment}<br>
                            <small>${data.data.created_at}</small>`;

            ul.insertBefore(li, ul.firstChild);

            commentBox.value = "";
        } catch (err) {
            console.error(err);
            alert("Something went wrong while submitting your comment");
        } finally {
            submitBtn.disabled = false;
        }
    });
});
