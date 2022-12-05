<?php
$appVersion = "1.2.2";
$pagename = strtolower(basename($_SERVER['PHP_SELF']));
?>
<!DOCTYPE html>
<html lang="en">
<?php 
     $setting = DB::table('settings')->where(array())->first();
     
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0">
    <title><?= $setting->title ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <meta name="theme-color" content="#9bebff">
    <meta name="msapplication-navbutton-color" content="#9bebff">
    <meta name="apple-mobile-web-app-status-bar-style" content="#9bebff">
   
    <link rel="shortcut icon" type="image/png" href="{{URL::to('')}}/public/file/{{$setting->favicon}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link href="css/app.css?v=<?php echo $appVersion ?>" rel="stylesheet">
    <style>
        .menu-list1 ul {
        list-style: none;
        padding: 0;
        margin: 0;
        /* background: #1bc2a2; */
        }
        .menu-list1 ul li {
        display: block;
        position: relative;
        /* float: left; */
        /* background: #1bc2a2; */
        }
        /* This hides the dropdowns */
        .menu-list1 li ul {
            display: none;
            padding-left: 15%;
            margin-top: -5%;
        }
        .other_ul{
            margin-top: 15% !important;
        }
        .menu-list1 ul li a {
        display: inline-block;
        /* padding: 1em; */
        padding: 7px;
        text-decoration: none;
        white-space: nowrap;
        color: #000;
        font-size: 13px;
        }
        .menu-list1 ul li a:hover {
        /* background: #2c3e50; */
        }
        /* Display the dropdown */
        .menu-list1 li:hover > ul {
        display: block;
        position: absolute;
        }
        /* Remove float from dropdown lists */
        .menu-list1 li a:hover li {
        float: none;
        }
        .menu-list1 li:hover a {
        /* background: #1bc2a2; */
        }
        .menu-list1 li:hover li a:hover {
        /* background: #2c3e50; */
        }
        .menu-list1 .main-navigation li ul li {
        border-top: 0;
        }
        /* Displays second level dropdowns to the right of the first level dropdown */
        .menu-list1 ul ul ul {
        left: 100%;
        top: 0;
        }

        /* Simple clearfix */

        .menu-list1 ul:before,
        .menu-list1 ul:after {
        content: " "; /* 1 */
        display: table; /* 2 */
        padding-left: 20% !important;
        }

        .menu-list1 ul:after {
        clear: both;
        }   
    </style>
</head>

<body class="page-load <?php echo ($pagename=='index.php' || $pagename=='')?'home-page':'inner-page'; ?>">
<div class="container"><div class="containerwidth"></div></div>
<!-- <div class="offerBar animLeft">
    COMPLIMENTARY SHIPPING AND RETURNS on orderS above  &#8377;5000
</div> -->
<div class="wrapper clearfix">
    <header class="header-main">
        <div class="container">
            <div class="row g-0 gx-xl-3 justify-content-lg-between">
                <div class="col col-lg-auto order-1 d-flex align-items-center">
                    <a href="./" class="brand">
                        <img src="./images/dastkar.png" alt="">
                    </a>
                </div>
                <div class="col-auto order-3 order-xl-2 pl-3 pl-xl-0 d-flex align-items-center">
                    
                    <span href="javascript:void(0)" class="hm d-xl-none">
                        <div class="hamburger">
                            <span></span>
                            <span></span>
                        </div>
                    </span>

                    <nav class="main-nav">
                        <ul class="nav justify-content-end">
                            <li><a href="{{ route('shop.product') }}">New Arrivals</a></li>
                            @php
                            $menus = DB::table('menus')->where(array('type'=>1,'status'=>1,'deleted_at'=>null))->get();
                            @endphp
                            @if($menus)
                            @foreach($menus as $key => $menu)
                            <?php
                            $category =DB::table('categories')->where(array('id'=>$menu->category_id,'status'=>1,'is_menu'=>1,'deleted_at'=>null))->get();
                            ?>
                            <li class="hasMenu">
                                <a href="javascript:void(0)">{{$menu->name}}</a>
                                <span class="m-open"></span>
                                <div class="mega-menu p-0">
                                    <div class="container">
                                        <div class="menuWrapper fr">
                                            <div class="row justify-content-between">
                                                <div class="col-12 col-xl-6 pt-xl-4">
                                                    <div class="menu-list1">
                                                        <!-- ul starts here..... -->
                                                        <ul class="main-navigation">
                                                            <?php
                                                             if (!empty($category)) {
                                                                foreach ($category as $key => $cat_list) {
                                                                    
                                                            ?> 
                                                            
                                                            <li>
                                                                <a href="#">{{$cat_list->name}}</a>
                                                                <ul>
                                                                <?php
                                                                   $subcategory =DB::table('categories')->where(array('parent_id'=>$menu->category_id,'status'=>1,'is_menu'=>1,'deleted_at'=>null))->get();
                                                                   if (!empty($subcategory)) {
                                                                    foreach ($subcategory as $key => $sub_list) {
                                                                ?>
                                                                    <li>
                                                                        <a href="#">{{$sub_list->name}}</a>
                                                                        <ul class="other_ul">
                                                                        <?php
                                                               
                                                                        $childcategory =DB::table('categories')->where(array('parent_id'=>$sub_list->id,'status'=>1,'is_menu'=>1,'deleted_at'=>null))->get();
                                                                        if (!empty($childcategory)) {
                                                                            foreach ($childcategory as $key => $child_list) {
                                                                       ?>  
                                                                            <li style="background-color:white;">
                                                                                <a href="#">{{$child_list->name}}</a>
                                                                            </li>
                                                                          <?php }}?>
                                                                           
                                                                        </ul>
                                                                    </li>
                                                                 <?php }}?>
                                                                </ul>
                                                            </li>
                                                            <?php }}?>
                                                            <!-- <li>
                                                                <a href="#">JAVASCRIPT</a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="#">AJAX</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#">JQUERY</a>
                                                                    </li>
                                                                </ul>
                                                            </li> -->
                                                        </ul>
                                                        <!-- ul ends here..... -->
                                                    </div>
                                                </div>
                                                <div class="col-12 d-none d-xl-block col-xl-auto">
                                                    <img src="{{URL::to('')}}/public/file/{{$cat_list->image}}" class="menuImg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </li>
                            @endforeach
                            @endif
                           
                            <li><a href="#">Sale</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-auto order-2 order-xl-3 d-flex">
                    <ul class="shopping-icons">
                        <li class="active d-flex align-items-center">
                            <a href="javascript:void(0);"><span class="icon-user"></span></a>
                            <div class="accountMenu">
                                <ul>
                                    <li>Hi Sandeep</li>
                                    <li><a href="{{route('login')}}">Login</a></li>
                                    <li><a href="./order-history.php">Order History</a></li>
                                    <li><a href="./my-addresses.php">Address Book</a></li>
                                    <li><a href="./edit-profile.php">Edit Profile</a></li>
                                    <li><a href="./change-password.php">Change Password</a></li>
                                    <li><a href="#">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                        <!-- <li class="d-flex align-items-center"><a href="login.php"><span class="icon-user"></span></a></li> -->
                        <li class="d-flex align-items-center"><a href="javascript:void(0);" class="searchLink"><span class="icon-loupe"></span></a></li>
                        <li class="d-flex align-items-center">
                            <a href="cart.php">
                                <span class="icon-shopping-bag"></span>
                                <span class="cart-count">1</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="searchBar">
            <div class="container">
                <form action="">
                    <div class="row align-items-end">
                        <div class="col"><input type="text" class="form-control" placeholder="Enter Search Term"></div>
                        <div class="col-auto"><button class="btn btn-secondary">Search</button></div>
                    </div>
                </form>
            </div>
        </div>
    </header>
    
   <main class="main clearfix">