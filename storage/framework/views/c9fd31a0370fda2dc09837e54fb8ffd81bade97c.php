<?php echo $__env->make('user.image', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="form-group row">
    <label class="col-md-2 control-label">缩略图</label>
    <div class="col-md-4 thumb-wrap">
        <div class="pic-upload btn btn-block btn-info btn-flat" title="点击上传">点击上传</div>
        <img id="logo" src="">
        <input type="hidden" name="logo" value="">
    </div>
</div>