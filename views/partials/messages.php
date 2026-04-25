<?php if (isset($_SESSION['success'])): ?>
    <div class="alert-box bg-accent2 color-white">
        <i class="fa-solid fa-circle-check"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert-box bg-accent1 color-black">
        <i class="fa-solid fa-circle-xmark"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<?php if (isset($error) && !empty($error)): ?>
    <div class="alert-box bg-accent1 color-black">
        <i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?>
    </div>
<?php endif; ?>
