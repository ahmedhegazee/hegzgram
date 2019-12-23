<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title> HegzGram</title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">


    <style>
        @media (min-width: 1200px) {
            .container {
                max-width: 1000px;
            }
        }
    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container" >
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                HegzGram
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="<?php echo e(__('Toggle navigation')); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                        </li>
                        <?php if(Route::has('register')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="<?php echo e(Auth::user()->profile->profileImage()); ?>" class="rounded-circle mr-2" style="max-height:30px; max-width:30px;">
                                <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="<?php echo e(route('home')); ?>">Home </a>
                                <a class="dropdown-item" href="<?php echo e(route('profile.show',['profile'=>Auth::user()->username])); ?>">Profile </a>
                                <a class="dropdown-item" href="<?php echo e(route('profile.edit',['profile'=>Auth::user()->username])); ?>">Edit Profile </a>
                                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <?php echo e(__('Logout')); ?>

                                </a>

                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                      style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
           <?php if(auth()->guard()->guest()): ?>

            <?php else: ?>
            <i id="search"  onclick="showSearch()" class="fas fa-search" style="font-size:16pt;color: rgba(0, 0, 0, 0.5);"></i>
        <?php endif; ?>
        </div>
    </nav>


    <main class="py-4">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    <div id="search-result" class="overlay d-none">
        <div class="content">
            <i id="close" onclick="closeSearch()"  class="fas fa-times"></i>
            <h3 class="text-center mb-4">Search for profiles</h3>

            <search-bar user-id="<?php echo e(auth()->user()!=null?auth()->user()->id:0); ?>"></search-bar>
        </div>
</div>





</div>
<script src="<?php echo e(asset('js/script.js')); ?>"></script>

</body>

</html>
<?php /**PATH /Users/ahmedhegazy/Desktop/lar/hegzgram/resources/views/layouts/app.blade.php ENDPATH**/ ?>