<?php if (isset($_SESSION['success'])): ?>
    <div style="background: rgba(46, 204, 113, 0.15); border: 2px solid #2ecc71; color: #27ae60; padding: 0.8rem 1rem; border-radius: 8px; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.75rem; font-weight: 700;">
        <i class="fa-solid fa-circle-check" style="font-size: 1.25rem;"></i> 
        <span style="flex: 1;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></span>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div style="background: rgba(231, 76, 60, 0.15); border: 2px solid #e74c3c; color: #c0392b; padding: 0.8rem 1rem; border-radius: 8px; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.75rem; font-weight: 700;">
        <i class="fa-solid fa-circle-xmark" style="font-size: 1.25rem;"></i> 
        <span style="flex: 1;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></span>
    </div>
<?php endif; ?>

<?php if (isset($error) && !empty($error)): ?>
    <div style="background: rgba(231, 76, 60, 0.15); border: 2px solid #e74c3c; color: #c0392b; padding: 0.8rem 1rem; border-radius: 8px; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.75rem; font-weight: 700;">
        <i class="fa-solid fa-circle-exclamation" style="font-size: 1.25rem;"></i> 
        <span style="flex: 1;"><?php echo $error; ?></span>
    </div>
<?php endif; ?>
