<?php
include_once "./inc/connectBD.php";

/* Login status: false = not authenticated, true = authenticated. */
$login = FALSE;

$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

/* Look for the username in the database. */
$query = 'SELECT * FROM accounts_crm WHERE (account_name = :name)';
/* Values array for PDO. */
$values = [':name' => $username];
/* Execute the query */
try
{
  $res = $pdo_conn->prepare($query);
  $res->execute($values);
}
catch (PDOException $e)
{
  /* Query error. */
  echo 'Query error.';
  die();
}
$row = $res->fetch(PDO::FETCH_ASSOC);
/* If there is a result, check if the password matches using password_verify(). */
if (is_array($row))
{
  if (password_verify($password, $row['account_passwd']))
  {
    /* The password is correct. */
    $login = TRUE;
    echo "GOOD!!!";
  }
  else
  {
    echo "NO GOOD";
  }
  
}
else
{
    echo "NO GOOD";
}

?>