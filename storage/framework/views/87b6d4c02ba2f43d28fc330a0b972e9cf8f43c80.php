        <?php $__env->startSection('content'); ?>
            <table>
                <tr><td>添加</td></tr>
                <form action="<?php echo e(url('/add')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <tr>
                        <td><input type="text" name="add_name">姓名</td>
                        <td><input type="text" name="add_email">邮箱</td>
                        <td><input type="password" name="add_password">密码</td>
                        <td><input type="submit" value="添加"/></td>
                    </tr>
                </form>
                <tr><td>搜索</td></tr>
                <form action="<?php echo e(url('/user')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <tr>
                        <td><input type="text" name="name" value="<?php echo e($echo['name']); ?>">姓名</td>
                        <td><input type="email" name="email" value="<?php echo e($echo['email']); ?>">邮箱</td>
                        <td><input class="search" type="submit" value="搜索"/></td>
                    </tr>
                </form>

                <tr>
                    <td>姓名</td>
                    <td style="padding-left: 10px">邮箱</td>
                </tr>
                <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                        <td class="name"><?php echo e($value->name); ?></td>
                        <td style="padding-left: 10px"><?php echo e($value->email); ?></td>
                        <td style="padding-left: 10px"><a href="/delete/<?php echo e($value->id); ?>">回收站</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </table>

            <table>
                <tr>
                    <td>回收站</td>
                </tr>

                <tr>
                    <td>姓名</td>
                    <td style="padding-left: 10px">邮箱</td>
                </tr>
                <?php $__currentLoopData = $del_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                        <td class="name"><?php echo e($value->name); ?></td>
                        <td style="padding-left: 10px"><?php echo e($value->email); ?></td>
                        <td style="padding-left: 10px"><a href="/destroy/<?php echo e($value->id); ?>">彻底删除</a></td>
                        <td style="padding-left: 10px"><a href="/restore/<?php echo e($value->id); ?>">恢复</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>


            </table>

            <table>
                <form action="<?php echo e(url('/upload')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <input type="file" name="image">
                    <input type="submit" value="upload">
                </form>
            </table>

            <table>
                <tr>
                    <td>名称</td>
                    <td>图片</td>
                </tr>
                <?php $__currentLoopData = $file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <tr>
                    <td><?php echo e($img->name); ?></td>
                    <td><img src="<?php echo e($img->path); ?>"></td>
                    <td><a href="/del_img/<?php echo e($img->id); ?>">回收站</a></td>
                    <td><a href="/download/<?php echo e($img->id); ?>">下载</a></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </table>

            <table>
                <tr>
                    <td>图片回收站</td>
                </tr>
                <tr>
                    <td>名称</td>
                    <td>图片</td>
                </tr>
                <?php $__currentLoopData = $del_img; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <tr>
                    <td><?php echo e($img->name); ?></td>
                    <td><img src="<?php echo e($img->path); ?>"></td>
                    <td><a href="/destroy_img/<?php echo e($img->id); ?>">彻底删除</a></td>
                    <td style="padding-left: 10px"><a href="/restore_img/<?php echo e($img->id); ?>">恢复</a></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </table>
            <script>
                //    $('.search').click(function(){
                //            alert(432131);
                //    });
            </script>
        <?php $__env->stopSection(); ?>



    
    
    
    
    
    
    

    





<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>