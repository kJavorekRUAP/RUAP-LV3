<html>
<head>
<Title>Registration Form</Title>
<style type="text/css">
 body { background-color: #fff; border-top: solid 10px #000;
 color: #333; font-size: .85em; margin: 20; padding: 20;
 font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
 }
 h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
 h1 { font-size: 2em; }
 h2 { font-size: 1.75em; }
 h3 { font-size: 1.2em; }
 table { margin-top: 0.75em; }
 th { font-size: 1.2em; text-align: left; border: none; padding-left: 0;
}
 td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
</style>
</head>
<body>
<h1>Register here!</h1>
<p>Fill in your name and email address, then click <strong>Submit</strong>
to register.</p>
<form method="post" action="index.php" enctype="multipart/form-data" >
 Name <input type="text" name="name" id="name"/></br>
 Email <input type="text" name="email" id="email"/></br>
 <input type="submit" name="submit" value="Submit" />
</form>
<?php
 // DB connection info
 //TODO: Update the values for $host, $user, $pwd, and $db
 //using the values you retrieved earlier from the Azure Portal.
 $host = "127.0.0.1:56044";
 $user = "azure";
 $pwd = "6#vWHD_$";
 $db = "localdb";
 // Connect to database.
 try {
 $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
 $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
 }
 catch(Exception $e){
 die(var_dump($e));
 }
 // Insert registration info
 if(!empty($_POST)) {
 try {
 $name = $_POST['name'];
 $email = $_POST['email'];
 $date = date("Y-m-d");
 // Insert data
 $sql_insert = "INSERT INTO registration_tbl (name, email, date)
 VALUES (?,?,?)";
 $stmt = $conn->prepare($sql_insert);
 $stmt->bindValue(1, $name);
 $stmt->bindValue(2, $email);
 $stmt->bindValue(3, $date);
 $stmt->execute();
 }
 catch(Exception $e) {
 die(var_dump($e));
 }
 echo "<h3>Your're registered!</h3>";
 }
 // Retrieve data
 $sql_select = "SELECT * FROM registration_tbl";
 $stmt = $conn->query($sql_select);
 $registrants = $stmt->fetchAll();
 if(count($registrants) > 0) {
 echo "<h2>People who are registered:</h2>";
 echo "<table>";
 echo "<tr><th>Name</th>";
 echo "<th>Email</th>";
 echo "<th>Date</th></tr>";
 foreach($registrants as $registrant) {
 echo "<tr><td>".$registrant['name']."</td>";
 echo "<td>".$registrant['email']."</td>";
U terminalu idite na putanju mape va�e aplikacije i upi�ite sljede�u naredbu:
Sada mo�ete u pregledniku oti�i na adresu http://localhost:8000/ kako biste testirali va�u
aplikaciju.
6. Objavljivanje va�e aplikacije
Nakon �to ste testirali va�u aplikaciju lokalno, mo�ete ju objaviti na Web Apps-u kori�tenjem
Git-a. Prvo �ete inicijalizirati svoj lokalni Git repositorij, te potom objaviti aplikaciju.
Napomena:
Ovo su isti koraci prikazani na Azure Portalu na kraju Create of a web app and Set up Git
Publishing sekcije.
1. (Opcionalno) Ako ste zaboravili Ili krivo postavili URL va�eg Git udaljenog repozitorija,
odite na web app postavke (properties) na Azure Portalu.
2. Otvorite Git bash (ili terminal ako je Git u va�oj putanji PATH), spremite sve prethodne
izmjene datoteka u root mapi va�e aplikacije i pokrenite sljede�e:
? ?
Pitat �e vas za lozinku koju ste prethodno kreirali .
 echo "<td>".$registrant['date']."</td></tr>";
 }
 echo "</table>";
 } else {
 echo "<h3>No one is currently registered.</h3>";
 }
?>
</body>
</html>