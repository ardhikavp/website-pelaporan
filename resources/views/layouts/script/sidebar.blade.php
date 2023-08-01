
<script>
$(document).ready(function() {
  // Check if the window is less than 767px wide
  if ($(window).width() <= 767) {
    // Hide the sidebar on smaller screens
    $("#sidebarssc").hide();

    // Add a click event to the sidebar toggle button
    $("#sidebar-toggle").click(function() {
      // Toggle the sidebar
      $("#sidebarssc").toggle();
    });
  }
});
</script>

