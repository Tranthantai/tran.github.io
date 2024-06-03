
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div id="content">
           
            <form action="<?php echo e(route('banhang.postdathang')); ?>" method="post" class="beta-form-checkout">
                    <?php echo csrf_field(); ?>
                <div class="row">
                    <!-- session('success') sinh ra từ hàm postDatHang trong PageController -->
                    <?php if(Session::has('success')): ?>
                        <?php echo e(Session::get('success')); ?>

                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Đặt hàng</h4>
                        <div class="space20">&nbsp;</div>

                        <div class="form-block">
                            <label for="name">Họ tên*</label>
                            <input type="text" id="name" placeholder="Họ tên" name="name" required>
                        </div>
                        <div class="form-block">
                            <label>Giới tính </label>
                            <input id="gender" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
                            <input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>Nữ</span>
                                       
                        </div>

                        <div class="form-block">
                            <label for="email">Email*</label>
                            <input type="email" id="email" required placeholder="expample@gmail.com" name="email">
                        </div>

                        <div class="form-block">
                            <label for="adress">Địa chỉ*</label>
                            <input type="text" id="adress" placeholder="Street Address" name="address" required>
                        </div>
                       

                        <div class="form-block">
                            <label for="phone">Điện thoại*</label>
                            <input type="text" id="phone" name="phone_number" required>
                        </div>
                       
                        <div class="form-block">
                            <label for="notes">Ghi chú</label>
                            <textarea id="notes" name="notes"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="your-order">
                            <div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
                            <div class="your-order-body" style="padding: 0px 10px">
                                <div class="your-order-item">
                                    <div>
                                    <?php if(Session::has('cart')): ?>
                                        <?php $__currentLoopData = $productCarts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <!-- one item -->
                                    <div class="media">
                                        <img width="25%" src="/source/image/product/<?php echo e($product['item']['image']); ?>" alt="" class="pull-left">
                                        <div class="media-body">
                                            <p class="font-large"><?php echo e($product['item']['name']); ?></p>
                                            <span class="cart-item-amount"><?php echo e($product['qty']); ?>*<span>
                                            <?php if($product['item']['promotion_price']==0): ?>
                                                <?php echo e(number_format($product['item']['unit_price'])); ?><?php else: ?>
                                                <?php echo e(number_format($product['item']['promotion_price'])); ?>

                                            <?php endif; ?>
                                        </span></span>
                                        <?php
                                        $dongia=$product['item']['promotion_price']==0?$product['item']['unit_price']:$product['item']['promotion_price'];
                                        $thanhtien=$dongia * $product['qty'];
                                        ?>
                                        <span class="color-gray your-order-info">Số lượng: <?php echo e($product['qty']); ?> </span>
                                        <span class="color-gray your-order-info">Thành tiền: <?php echo e(number_format($thanhtien)); ?> đồng</span>
                                    </div>
                                </div>
                                <!-- end one item -->
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               
                                   
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="your-order-item">
                                    <div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
                                    <div class="pull-right"><h5 class="color-black"><?php echo e(number_format($cart->totalPrice)); ?></h5></div>
                                    <div class="clearfix"></div>
                                </div>
                                <?php endif; ?>
                            </div>

                            <div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
                           
                            <div class="your-order-body">
                                <ul class="payment_methods methods">
                                    <li class="payment_method_bacs">
                                        <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
                                        <label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
                                        <div class="payment_box payment_method_bacs" style="display: block;">
                                            Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
                                        </div>                        
                                    </li>

                                    <li class="payment_method_cheque">
                                        <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
                                        <label for="payment_method_cheque">Chuyển khoản </label>
                                        <div class="payment_box payment_method_cheque" style="display: none;">
                                            Chuyển tiền đến tài khoản sau:
                                            <br>- Số tài khoản: 123 456 789
                                            <br>- Chủ TK: Nguyễn A
                                            <br>- Ngân hàng ACB, Chi nhánh TPHCM
                                        </div>                        
                                    </li>

                                   
                                    <li class="payment_method_cheque"><input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="VNPAY" data-order_button_text="">
                                        <label for="payment_method_cheque">Thanh toán online</label>
                                    </li>
                                                                       
                                </ul>
                            </div>

                            <div class="text-center"><button type="submit" class="beta-btn primary">Đặt hàng <i class="fa fa-chevron-right"></i></button></div>
                        </div> <!-- .your-order -->
                    </div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <!--customjs-->
    <script type="text/javascript">
    $(function() {
        // this will get the full URL at the address bar
        var url = window.location.href;

        // passes on every "a" tag
        $(".main-menu a").each(function() {
            // checks if its the same on the address bar
            if (url == (this.href)) {
                $(this).closest("li").addClass("active");
                $(this).parents('li').addClass('parent-active');
            }
        });
    });  


</script>
<script>
     jQuery(document).ready(function($) {
                'use strict';
               
// color box

//color
      jQuery('#style-selector').animate({
      left: '-213px'
    });

    jQuery('#style-selector a.close').click(function(e){
      e.preventDefault();
      var div = jQuery('#style-selector');
      if (div.css('left') === '-213px') {
        jQuery('#style-selector').animate({
          left: '0'
        });
        jQuery(this).removeClass('icon-angle-left');
        jQuery(this).addClass('icon-angle-right');
      } else {
        jQuery('#style-selector').animate({
          left: '-213px'
        });
        jQuery(this).removeClass('icon-angle-right');
        jQuery(this).addClass('icon-angle-left');
      }
    });
                });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tenproject\resources\views/banhang/checkout.blade.php ENDPATH**/ ?>