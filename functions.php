<?php
/*
Insert Function
*/
Function insert($table,$update){
global $con;
if (isset ($_POST['submit']) and $_POST['submit'] == 'AddNew'){
$formErrors=array();
foreach ($_POST as $input => $value) {
$inputs[] = $input;
$values[] = $value;
// krsort($inputs);
if(($key = array_search(submit, $inputs)) !== false) {
unset($inputs[$key]);
}
if(($key = array_search(AddNew, $values)) !== false) {
unset($values[$key]);
}
/*---------PHP Validation----------*/
if(empty($value)){
$formErrors[] = $input." Is Required";
}
}
foreach ($_FILES as $input => $value) {
$files[] = $input;
// ksort($inputs);
}
/*---------Upload File And Add It to Insert Array ----------*/
$file=$_FILES["file"]["name"];
$ext = pathinfo($file, PATHINFO_EXTENSION);
$file = "file_".time().rand(5, 15).".".$ext;
$tmp_file=$_FILES["file"]["tmp_name"];
$file_src="../data/uploads/".$file;
if (isset($_FILES["file"])){
$files_imp = implode("','", $files);
if( !empty($_FILES["file"]) && !empty($_FILES["file"]["tmp_name"])){
move_uploaded_file($tmp_file,$file_src);
$values[] = $file_src;
$inputs[] = $files_imp;
// krsort($inputs);
}else{
$formErrors[] ="File Is Required";
}
}
// ksort($values);
$values_imp = implode("','", $values);
$inputs_imp = implode(",", $inputs);
/*---------Echo PHP Validation----------*/
foreach ($formErrors as $error){
echo "<div class='alert alert-danger'>$error</div>";
}
/*-----Get Columns Names Array------*/
$select = $con->prepare("DESCRIBE $table");
$select->execute();
$fields = $select->fetchAll(PDO::FETCH_COLUMN);
foreach ($fields as $key => $value) {
if(($key = array_search(id, $fields)) !== false) {
unset($fields[$key]);
}
}
$fields_imp = implode(",", $fields);
/*-----Insert Values In Columns------*/
if (empty($formErrors)){
$insert = $con->prepare("INSERT INTO $table ($inputs_imp) VALUES ('$values_imp')");
$insertdone = $insert->execute();
}
if (isset($insert)){
echo "Data Inserted Successfully";
/*-----Redirect To Curent Page------*/
header('Location: '.$_SERVER['REQUEST_URI']);
}
}
/*-----Delete From Data Base ------*/
  $do = isset($_GET['do'])?$_GET['do'] : 'Manage';
  if($do == 'Delete'){
  $id = isset($_GET['id']) && is_numeric($_GET['id'])?intval($_GET['id']) : 0;
  $stmt = $con->prepare("DELETE FROM $table WHERE id = $id");
  $stmt->execute();
  ?>
  <script>
    javascript:history.go(-1);
  </script>
  <?
}
/*-----Update Data Base ------*/
else
if($do == 'Update'){
$id = isset($_GET['id']) && is_numeric($_GET['id'])?intval($_GET['id']) : 0;
$stmt = $con->prepare("UPDATE $table SET $update WHERE id=$id");
$stmt->execute();
?>
<script>
javascript:history.go(-1);
</script>
<?
}
}
?>
