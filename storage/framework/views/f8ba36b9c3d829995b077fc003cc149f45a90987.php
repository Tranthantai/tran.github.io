<!DOCTYPE html>
<html>
<head>
    <title>Contact Email</title>
</head>
<body>
    <h1>New Contact Message</h1>
    <p><strong>Name:</strong> <?php echo e($details['name']); ?></p>
    <p><strong>Email:</strong> <?php echo e($details['email']); ?></p>
    <p><strong>Message:</strong> <?php echo e($details['message']); ?></p>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\tenproject\resources\views/emails/contact.blade.php ENDPATH**/ ?>