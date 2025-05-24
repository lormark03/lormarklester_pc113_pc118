<?php
session_start();
session_destroy();

// Clear localStorage too (via script)
echo '<script>
    localStorage.clear();
    window.location.href = "login.php";
</script>';
?>
