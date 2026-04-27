<?php if (isset($_SESSION['success'])): ?>
    <div class="bg-green-500/15 border-2 border-green-500 text-green-700 p-4 rounded-lg mb-4 flex items-center gap-3 font-bold">
        <i class="fa-solid fa-circle-check text-xl"></i> 
        <span class="flex-1"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></span>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="bg-red-500/15 border-2 border-red-500 text-red-700 p-4 rounded-lg mb-4 flex items-center gap-3 font-bold">
        <i class="fa-solid fa-circle-xmark text-xl"></i> 
        <span class="flex-1"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></span>
    </div>
<?php endif; ?>

<?php if (isset($error) && !empty($error)): ?>
    <div class="bg-red-500/15 border-2 border-red-500 text-red-700 p-4 rounded-lg mb-4 flex items-center gap-3 font-bold">
        <i class="fa-solid fa-circle-exclamation text-xl"></i> 
        <span class="flex-1"><?php echo $error; ?></span>
    </div>
<?php endif; ?>
