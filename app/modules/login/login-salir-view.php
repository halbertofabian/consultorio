<?php 
session_destroy();
?>

<script>
    $(document).ready(function(){
        window.location.href = '<?= HTTP_HOST ?>';
    })
</script>