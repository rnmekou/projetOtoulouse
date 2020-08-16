<?php 

// Get search term 
$searchTerm = $_GET['numSiret']; 
 
// Fetch matched data from the database 
$query = $db->query("SELECT * FROM entreprise WHERE num_siret LIKE '%".$searchTerm."%'"); 
 
// Generate array 
$skillData = array(); 
if($query->num_rows > 0){ 
    while($row = $query->fetch_assoc()){ 
        $data['num_siret'] = $row['num_siret']; 
        $data['name'] = $row['name']; 
        array_push($skillData, $data); 
    } 
} 
 
// Return results as json encoded array 
echo json_encode($skillData); 
?>