document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-comments').forEach(function (element) {
      element.addEventListener('click', function (event) {
        event.preventDefault();
        const postId = this.getAttribute('data-post-id');
        const commentsSection = document.getElementById(`comments-section-${postId}`);
        if (commentsSection.style.display === 'none') {
          commentsSection.style.display = 'block';
        } else {
          commentsSection.style.display = 'none';
        }
      });
    });
  });
  