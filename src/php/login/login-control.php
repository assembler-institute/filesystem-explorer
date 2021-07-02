<?php

function autentificar_usuario()
{
  session_start();

  $username = $_POST["username"];
  $pass = $_POST["password"];

  if (check_usuario_on_database($username, $pass) == true  && !$pass == "") {
    $_SESSION["username"] = $username;
    header("Location:../../pages/main/main.php");
  } else {
    $_SESSION["ErrorDeAcceso"] = "Username y contraseña incorrectos";
    header("location:../../pages/login/login.php");
  }
}

function check_usuario_on_database($username, $pass)
{
  session_start();

  require_once "./myDatabase.php";
  foreach ($my_data_base_of_users as $user) {
    if (in_array($username, $user) && in_array($pass, $user)) {
      $usernameFalso = $user[0];
      $passwordFalsa = $user[1];
      $user_picture = $user[2];
    } else {
      echo "no coincide";
    }
  }

  $_SESSION["user_img"] = $user_picture;

  // Encriptamos la contraseña porque en la realidad deberia estar encriptada por seguridad
  $passwordFalsaEncriptada = password_hash($passwordFalsa, PASSWORD_DEFAULT);

  if (
    $username == $usernameFalso &&
    password_verify($pass, $passwordFalsaEncriptada)
  ) {
    echo $passwordFalsaEncriptada;
    echo $username;
    return true;
  } else {
    echo "esta todo mal";
    return false;
  }
}

function revisar_si_existe_sesion()
{
  session_start();

  // basename() te coge de la URL actual, el ultimo lugar donde te encuentres
  $checkUrl = basename($_SERVER["REQUEST_URI"], "?" . $_SERVER["QUERY_STRING"]);

  if ($checkUrl == "login.php" || $checkUrl == "src") {
    if (isset($_SESSION["username"]) == true) {
      header("Location:../main/main.php");
    } else {
      if ($alert = check_error_de_login()) {
        return $alert;
      }
      if ($alert = check_login_info()) {
        return $alert;
      }
      if ($alert = check_logout()) {
        return $alert;
      }
    }
  } else {
    if (isset($_SESSION["username"]) == false) {
      echo "username false?";
      $_SESSION["loginInfo"] =
        "No tienes permisos para entrar, por favor. Indentifícate.";
      header("Location:../login/login.php");
    }
  }
}

function cerrar_sesion()
{
  session_start();

  // borra lo que haya dentro de las variables de session
  unset($_SESSION);

  // destruye la cookie de almacenada en el navegador de session
  destruir_cookie_de_la_sesion();

  // finalmente esto destruye la session y lo redirigimos a donde queramos
  session_destroy();

  // ademas añadimos el parametro logout en true para verificar un condicional
  header("Location:../../pages/login/login.php?logout=true");
}

function destruir_cookie_de_la_sesion()
{
  if (ini_get("session.use_cookie")) {
    $params = session_get_cookie_params();
    setcookie(
      session_name(),
      "",
      time() - 42000,
      $params["path"],
      $params["domain"],
      $params["secure"],
      $params["httponly"]
    );
  }
}

function check_error_de_login()
{
  if (isset($_SESSION["ErrorDeAcceso"])) {
    $texto_de_error = $_SESSION["ErrorDeAcceso"];
    unset($_SESSION["ErrorDeAcceso"]);
    return ["bg" => "bg-white", "type" => "text-danger", "emoticon" => "&#128557;", "texto" => $texto_de_error];
  }
}

function check_login_info()
{
  if (isset($_SESSION["loginInfo"])) {
    $texto_de_info = $_SESSION["loginInfo"];
    unset($_SESSION["loginInfo"]);
    return ["bg" => "bg-warning", "type" => "text-dark", "emoticon" => "&#128536;", "texto" => $texto_de_info];
  }
}

function check_logout()
{
  if (isset($_GET["logout"]) && !isset($_SESSION["username"])) {
    return ["bg" => "bg-white", "type" => "text-dark", "emoticon" => "&#128524;", "texto" => "Logout succesful"];
  }
}
