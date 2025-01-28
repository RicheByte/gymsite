// forum.js

// Sample data for forum posts (In a real-world scenario, you'd fetch this from a database)
const forumPosts = [
    {
        title: "How to lose belly fat?",
        content: "I'm looking for some tips on how to reduce belly fat. Any advice?",
        replies: [
            "Focus on a combination of cardio and strength training. Also, clean up your diet."
        ]
    },
    {
        title: "Best post-workout meals",
        content: "What do you recommend eating after a workout for muscle recovery?",
        replies: [
            "A protein-rich meal with some healthy fats and carbs works well. Consider chicken, sweet potatoes, and avocado."
        ]
    }
];

// Display posts on page load
function displayPosts() {
    const postList = document.getElementById('forumPostList');
    postList.innerHTML = ''; // Clear the list before displaying

    forumPosts.forEach(post => {
        const postElement = document.createElement('div');
        postElement.classList.add('forum-post');

        postElement.innerHTML = `
            <div class="post-title">${post.title}</div>
            <div class="post-content">${post.content}</div>
            <div class="post-replies">
                ${post.replies.map(reply => `<div class="post-reply">${reply}</div>`).join('')}
            </div>
            <div class="reply-form">
                <textarea class="form-control" placeholder="Add a reply..."></textarea>
                <button class="btn btn-primary">Post Reply</button>
            </div>
        `;

        // Append post to the list
        postList.appendChild(postElement);
    });
}

// // Handle post submission
// document.getElementById("postForm").addEventListener("submit", function(event) {
//     event.preventDefault();

//     const title = document.getElementById("postTitle").value;
//     const content = document.getElementById("postContent").value;

//     if (title.trim() !== "" && content.trim() !== "") {
//         // Add new post to the forumPosts array (In a real app, this would be stored in a database)
//         forumPosts.push({ title, content, replies: [] });

//         // Reset the form and display the updated posts
//         document.getElementById("postForm").reset();
//         displayPosts();
//     }
// });

// // Initial display of posts
// displayPosts();
