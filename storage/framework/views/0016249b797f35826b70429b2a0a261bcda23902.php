<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Thông Tin Xe</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div class="container"> 
    <h2>Chỉnh Sửa Thông Tin Xe</h2>
    <form action="<?php echo e(route('cars.update',$car->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" class="form-control" id="description" name="description" value="<?php echo e($car->description); ?>">
        </div>
        <div class="form-group">
            <label for="model">Model:</label>
            <input type="text" class="form-control" id="model" name="model" value="<?php echo e($car->model); ?>">
        </div>
        <div class="form-group">
            <label for="produced_on">Ngày sản xuất:</label>
            <input type="date" class="form-control" id="produced_on" name="produced_on" value="<?php echo e($car->produced_on); ?>">
        </div>
        <div class="form-group">
            <label for="mf_id">Mf Name:</label>
            <select class="form-control" id="mf_id" name="mf_id">
                <?php $__currentLoopData = $mf; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($mf->id); ?>" <?php if($mf->id == $car->mf_id): ?> selected <?php endif; ?>><?php echo e($mf->mf_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="image_file">Hình ảnh:</label>
            <input type="file" class="form-control" id="image_file" name="image_file" onchange="previewImage(event)">
            <img id="imagePreview" src="#" alt="Image Preview" value="<?php echo e($car->image); ?>" class="img-fluid mt-2" style="display: none;">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
    function previewImage(event){
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        };reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html><?php /**PATH C:\xampp\htdocs\tenproject\resources\views/car/car-edit.blade.php ENDPATH**/ ?>