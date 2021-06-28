<?php
function validate_recipi()
{
  if(strlen($_POST['rname'])<1 || strlen($_POST['ingrediants'])<1 || strlen($_POST['steps'])<1 || strlen($_POST['category'])<1){
    return "all fields are required";
  }
//   if (!is_numeric($_POST['cnum'])) {
//     return "contact number must be numeric";
//   }
  return true;
}
function validate_register()
{
  if(strlen($_POST['uname'])<1 || strlen($_POST['email'])<1 || strlen($_POST['mobile'])<1 || strlen($_POST['pass'])<1){
    return "all fields are required";
  }
  if (!is_numeric($_POST['mobile'])) {
    return "contact number must be numeric";
  }
  return true;
}
function validate_login()
{
  if(strlen($_POST['email'])<1 || strlen($_POST['pass'])<1){
    return "all fields are required";
  }
//   if (!is_numeric($_POST['cnum'])) {
//     return "contact number must be numeric";
//   }
  return true;
}
// function validate_prod()
// {
//   if(strlen($_POST['prod_name'])<1){
//     return "all fields are required";
//   }
//   if (is_numeric($_POST['prod_name'])) {
//     return "Product name must not be numeric";
//   }
//   return true;
// }
 ?>
