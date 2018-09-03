<?php
$servername = "localhost";
$username = "root";
$password = "root";
$db = "practica";
$conn = new mysqli($servername, $username, $password, $db);
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$sql = "SELECT ID, ref as nombre, descripcion from prueba WHERE nombre='%" .$request->nombre . "%' OR descripcion='%" . $request->descripcion . "%'";
$res = $conn->query($sql);
$cont = [];
$ii = 0;
if ($res->num_rows > 0) {
	while($row = $res->fetch_assoc()) {
		$cont[$ii]['ID'] = $row["ID"];
		$cont[$ii]['nombre'] = $row["nombre"];
		$cont[$ii]['descripcion'] = $row["descripcion"]; 
	}
	echo json_encode($cont);
	
}else{
echo "no hay";
}
$conn->close();
?>