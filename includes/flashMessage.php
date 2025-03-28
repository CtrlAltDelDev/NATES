<?php
if (isset($_SESSION['message'])):
    $type = $_SESSION['message_type'] ?? 'success';

    $style = ($type === 'error')
        ? "background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;"
        : "background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;";
    ?>
    <div id="flash-message" style="padding: 10px; <?= $style ?> margin-bottom: 15px;">
        <?= $_SESSION['message'] ?>
    </div>

    <?php if ($type === 'success'): ?>
    <?php
    echo "<!-- DEBUG: message = '{$_SESSION['message']}', type = '$type' -->";
    ?>
    <script>
     //   console.log("Success message JS loaded"); // Debug log
        setTimeout(() => {
            const msg = document.getElementById('flash-message');
            if (msg) msg.style.display = 'none';
        }, 10000);
    </script>
<?php endif; ?>

    <?php
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
endif;
?>