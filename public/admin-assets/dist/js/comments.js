document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-comments').forEach(function (element) {
      element.addEventListener('click', function (event) {
        event.preventDefault();
        const postId = this.getAttribute('data-post-id');
        const commentsSection = document.getElementById(`comments-section-${postId}`);
        if (commentsSection.style.display === 'none') {
          commentsSection.style.display = 'block';
          this.classList.add('text-dark');
        } else {
          commentsSection.style.display = 'none';
          this.classList.remove('text-dark')
        }
      });
    });
  });

function toggleEllipsisColor(postId) {
    var icon = document.getElementById('ellipsis-icon-' + postId);
    icon.classList.toggle('text-black-50'); // Toggle the default color class
    icon.classList.toggle('text-dark');     // Toggle the dark color class
}
  