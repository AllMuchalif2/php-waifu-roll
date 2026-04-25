<?php if (isset($_SESSION['success'])): ?>
    <div class="result-box bg-accent2 color-white p-08 mt-1">
        <i class="fa-solid fa-circle-check"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>
<?php if (isset($_SESSION['error'])): ?>
    <div class="result-box bg-accent1 color-white p-08 mt-1">
        <i class="fa-solid fa-circle-xmark"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>
<?php if (isset($error) && !empty($error)): ?>
    <div class="error-text">
        <i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?>
    </div>
<?php endif; ?>
