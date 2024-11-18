<!-- IndexControllerphp-->
<?php
class IndexController {
  
  public function initializedbview() {
    require_once __DIR__ . '/../Views/Databasesetup/intilizedatabaseformview.php';
  }

  public function landingPage() {
    require_once __DIR__ . '/../Views/Login/loginView.php';
  }

  // public function Logout() {
  //   require_once __DIR__ . '/../Views/signOutForm/signoutform.php'; 
  //   session_unset();
  //   session_destroy();
  // }
}
?>
