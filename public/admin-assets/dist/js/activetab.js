$(document).ready(function () {
    // Check if there is a session variable for the active tab and activate it
    var activeTab = "{{ session('active_tab') }}";
    if (activeTab) {
        $('.nav-pills a[href="#' + activeTab + '"]').tab('show');
    }
});