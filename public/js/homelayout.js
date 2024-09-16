document.addEventListener('DOMContentLoaded', function () {
    const offcanvas = document.getElementById('staticBackdrop');
    const body = document.body;
    const mainContent = document.querySelector('.main-content');
    const sidebarWidth = 320; // Adjust this to match your sidebar width

    offcanvas.addEventListener('shown.bs.offcanvas', function () {
        body.classList.add('sidebar-open');
        mainContent.style.marginLeft = sidebarWidth + 'px';
    });

    offcanvas.addEventListener('hidden.bs.offcanvas', function () {
        body.classList.remove('sidebar-open');
        mainContent.style.marginLeft = '0';
    });

    // Adjust main content margin when window resizes
    window.addEventListener('resize', function () {
        if (body.classList.contains('sidebar-open')) {
            mainContent.style.marginLeft = sidebarWidth + 'px';
        }
    });
});

// Sidebar active code for JS
document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll('.custom-nav-link');

    navLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default link behavior

            // Remove 'active' class from all nav items
            document.querySelectorAll('.custom-nav-item').forEach(item => {
                item.classList.remove('active');
            });

            // Add 'active' class to the clicked nav item's parent (.custom-nav-item)
            link.closest('.custom-nav-item').classList.add('active');

            // Optional: Navigate to the clicked link's href
            window.location.href = link.href;
        });

        // Add hover effect
        link.addEventListener('mouseenter', function () {
            link.closest('.custom-nav-item').classList.add('hover');
        });

        link.addEventListener('mouseleave', function () {
            link.closest('.custom-nav-item').classList.remove('hover');
        });
    });
});

//push notif

document.addEventListener('DOMContentLoaded', function () {
    var closeIcons = document.querySelectorAll('.push-notification .close-icon');
    closeIcons.forEach(function (icon) {
        icon.addEventListener('click', function () {
            var notification = this.parentElement; // Get parent .push-notification element
            notification.style.opacity = 0;
            setTimeout(function () {
                notification.remove();
            }, 500); // Remove after fade out animation completes
        });
    });

    // Auto-hide notification after 5 seconds
    setTimeout(function () {
        var notifications = document.querySelectorAll('.push-notification');
        notifications.forEach(function (notification) {
            notification.style.opacity = 0;
            setTimeout(function () {
                notification.remove();
            }, 500); // Remove after fade out animation completes
        });
    }, 5000); // 5000 milliseconds = 5 seconds
});



// document.addEventListener('DOMContentLoaded', function () {
//     function updateProgressBar(userId, percentage, completedActivities, totalActivities) {
//         const progressText = document.getElementById('progress-text-' + userId);
//         const progressBar = document.getElementById('progress-bar-' + userId);

//         if (progressText && progressBar) {
//             progressBar.style.width = percentage + '%';
//             progressText.textContent = `${completedActivities} / ${totalActivities}`;
//         }
//     }

//     function updateActivityState(userId, activityId, completed) {
//         fetch("{{ route('activity.updateState') }}", { // Ensure the route is processed correctly
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ensure the CSRF token is processed correctly
//             },
//             body: JSON.stringify({
//                 userId: userId,
//                 activityId: activityId,
//                 completed: completed
//             })
//         })
//             .then(response => response.json())
//             .then(data => {
//                 if (data.success) {
//                     updateProgressBar(userId, data.percentage, data.completedActivities, data.totalActivities);
//                 } else {
//                     console.error('Failed to update activity state', data.message || '');
//                 }
//             })
//             .catch(error => console.error('Error:', error));
//     }

//     document.querySelectorAll('.completedBtn').forEach(function (button) {
//         button.addEventListener('click', function () {
//             const userId = this.getAttribute('data-user-id');
//             const activityId = this.getAttribute('data-activity-id');
//             this.disabled = true;
//             this.closest('tr').querySelector('.ungradedBtn').disabled = false;
//             updateActivityState(userId, activityId, true);
//         });
//     });

//     document.querySelectorAll('.ungradedBtn').forEach(function (button) {
//         button.addEventListener('click', function () {
//             const userId = this.getAttribute('data-user-id');
//             const activityId = this.getAttribute('data-activity-id');
//             this.disabled = true;
//             this.closest('tr').querySelector('.completedBtn').disabled = false;
//             updateActivityState(userId, activityId, false);
//         });
//     });
// });








