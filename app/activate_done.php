<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Alist || The Best To-Do-List in The World </title>
  <link rel="icon" href="./assets/images/logo.png">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="./temp/styles/activate.css">
  <?php
  session_start();
  if(isset($_SESSION["id"])){
    header("Location: ./login/index.php");
  }
  ?>

</head>
<body>

  <!-- Logo and Menu -->
  <div class="bg-nav">
    <div class="container">
      <div class="row nav-alist">
        <div class="col-xs-4 col-sm-2 col-xs-0">
          <div class="logo-style">
            <p class="name"><img class="pic" src="./assets/images/logo.png"> Alist</p>
          </div>
        </div>
        <div class="col-xs-8 col-sm-10 col-xs-12 text-right">
          <ul class="nav-menu">
            <li class="menu"><a href="index.php">หน้าแรก</a></li>
            <li class="menu"><a href="price.html">ราคาและโปรโมชั่น</a></li>
            <li class="menu"><a href="test.html">ทดลองใช้งาน</a></li>
            <!-- <li class="menu"><a class="signIn" id="modal-open">เข้าสู่ระบบ</a></li> -->
          </ul>
          <a class="fa fa-bars hamburgerBtn"></a>
        </div>
        <iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
      </div>
    </div>
  </div>

  <header>
    <!-- Logo and Menu -->
    <div class="jumbotron-section">
      <div class="container head-page">
        <div class="row">
          <div class="col-xs-12">
            <div class="head text-center">การยืนยันตัวตนสำเร็จ</div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Activate done and sign in -->
  <section class="questions-answers">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <h4 class="text-center subHead">การยืนยันตัวตนเพื่อใช้งาน Alist สำเร็จแล้ว สามารถเข้าระบบได้ทันที</h4>
        </div>
      </div>
      <div class="row test-alist">
        <div class="text-center">
            <button class="testBtn" id="modal-open">เข้าสู่ระบบ</button>
        </div>
      </div>

    </div>


  </section>



  <!-- Footer -->
  <footer class="footer-alist">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-push-6 text-right subscribe-alist">
          <h4 class="subscribeTopic">ติดตามข่าวสารต่างๆและโปรโมชั่น</h4>
          <form onsubmit="return false;">
            <input class="formField" type="text" placeholder="อีเมล์" id="email-subscribe">
            <button class="subscribeBtn">ติดตามข่าวสาร</button>
          </form>
        </div>
        <div class="col-sm-6 col-sm-pull-6 contact">
            <div class="logo-style">
              <p class="name"><img class="pic" src="./assets/images/logo.png"> Alist</p>
            </div>
          <ul class="iconSet">
            <li><a class="icon" href="##"><span class="fa fa-facebook-square"></span></a></li>
            <li><a class="icon" href="#"><span class="fa fa-twitter-square"></span></a></li>
            <li><a class="icon" href="#"><span class="fa fa-instagram"></span></a></li>
            <li><a class="icon" href="#"><span class="fa fa-github"></span></a></li>
          </ul>
          <h4 class="copyright">© 2016 All rights reserved. Alist, Inc.</h4>
        </div>
      </div>
    </div>
  </footer>

  <!-- Modal Background -->
  <div class="modal-bg"></div>

  <!-- Modal Sign In Box -->
  <div class="modal-signin">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
          <div class="form">
            <div class="headerForm" id="headerSignInBox">
              <h3 class="text-center headerSignIn">เข้าสู่ระบบ</h3>
              <a href="#"><span class="fa fa-close closeIcon" id="modal-close"></span></a>
            </div>
            <form class="formMain" onsubmit="return true" action="./assets/server/user/user_login.php" method="post">
              <div class="cautionSignIn-box">
                <h4 class="cautionSignIn" id="cautionSignIn-formFill"><span class="fa fa-exclamation-circle"></span> กรุณาข้อมูลให้ครบทุกช่อง</h4>
                <h4 class="cautionSignIn" id="cautionSignIn-email"><span class="fa fa-exclamation-circle"></span> กรุณาใส่อีเมล์ให้ถูกต้อง</h4>
                <h4 class="cautionSignIn" id="cautionSignIn-password"><span class="fa fa-exclamation-circle"></span> กรุณาใส่รหัสผ่านให้ถูกต้อง ความยาว 4-10 ตัวอักษร</h4>
              </div>
              <fieldset>
                <div class="row">
                  <div class="col-xs-12">
                    <input class="col-xs-12 formField" name="email" id="signin-email" autofocus="autofocus" type="text" placeholder="E-mail">
                  </div>
                </div>
                <div class="row passwordSignIn">
                  <div class="col-xs-12">
                    <input class="col-xs-12 formField" name="password" id="signin-password" type="password" placeholder="รหัสผ่าน">
                  </div>
                </div>
              </fieldset>
              <button class="signinBtn" id="signinBtn">เข้าสู่ระบบ</button>
              <button class="forgetPasswordBtn" id="forgetPasswordBtn">ส่งรหัสผ่านใหม่ไปทางอีเมล์</button>
              <div class="contentBox">
                <p class="forgetPasswordSuccess text-center">ขณะนี้ Alist ได้ส่งรหัสผ่านใหม่ไปยังอีเมล์ <span class="forgetPasswordSuccess" id="forgetPasswordEmailSuccess"></span> เป็นที่เรียบร้อยแล้ว</p>
              </div>
              <h4 class="text-center forgetPassword">ลืมรหัสผ่าน ? <a href="#" id="forget">คลิกที่นี่</a></h4>
              <h4 class="text-center wantToSignIn">ต้องการเข้าสู่ระบบ ? <a href="#" id="signInLink">คลิกที่นี่</a></h4>
              <div class="social">
                <hr>
                <h4 class="text-center signinSocial">เข้าสู่ระบบผ่าน Social Media</h4>
                <button class="fbBtn"><span class="fa fa-facebook-square"></span> เข้าสู่ระบบผ่านระบบ Facebook</button>
                <button class="gplusBtn"><span class="fa fa-google-plus"></span> เข้าสู่ระบบผ่านระบบ Google Plus</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Subscribe -->
  <div class="modal-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
          <div class="subscribeform">
            <div class="headerForm">
              <h3 class="text-center headerSubscribe">Test</h3>
              <a href="#"><span class="fa fa-close closeIcon" id="closeSubscribe"></span></a>
            </div>
            <div class="contentBox">
              <p class="emailSubscribe">อีเมล์ที่ลงทะเบียน : <span id="emailSubscribe"></span></p>
              <p class="contentSubscribe"></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="./temp/scripts/price.js"></script>
</body>
</html>
