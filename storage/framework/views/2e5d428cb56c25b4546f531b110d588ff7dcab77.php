<div class="form-group row">
    <label for="content" class="col-md-4 col-form-label "> Content</label>
    <input id="content" type="text"
           class="form-control <?php if ($errors->has('content')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('content'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="content"
           value="<?php echo e($content??old('content')); ?>" required autocomplete="content" autofocus>

    <?php if ($errors->has('content')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('content'); ?>
    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>

</div>
<?php /**PATH /Users/ahmedhegazy/Desktop/lar/hegzgram/resources/views/layouts/form.blade.php ENDPATH**/ ?>