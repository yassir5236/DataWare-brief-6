<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datawareX";

// Créer une connexion PDO
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (isset($_POST['submit'])) {
    // Récupérer les informations d'identification du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Préparer la requête SQL pour vérifier les informations d'identification
  
   


	$stmt = $conn->prepare("SELECT * FROM utilisateur WHERE email = :email");
$stmt->bindParam(':email', $email);

// Execute the query
$stmt->execute();

// Check for errors
if ($stmt->errorCode() != 0) {
    die("Query error: " . implode(", ", $stmt->errorInfo()));
}

// Fetch the user from the database
if ($stmt->rowCount() > 0) {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (password_verify($password, $user['password'])) {
        // Authentication successful

		session_start(); 


		$_SESSION['id'] = $user['id'];
    
	    // Rediriger l'utilisateur vers la page appropriée

        if ($user['role'] == 'Membre') {
            header('Location: side_membre.php');
        } else if ($user['role'] == 'Manager'){
            header('Location: side_productOwner.php');
			
        }else  {
            header('Location: side_scrumMster.php');
		}
    } else {
        // Incorrect password
        $login_error = 'Identifiants incorrects. Veuillez réessayer.';
    }
} else {
    // User not found
    $login_error = 'Identifiants incorrects. Veuillez réessayer.';
}






















    // // Vérifier si l'utilisateur existe dans la base de données
    // if ($stmt->rowCount() > 0) {
    //     // L'utilisateur est authentifié
    //     $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //     // Stocker les informations de l'utilisateur dans la session
    //     $_SESSION['user_id'] = $user['id'];
    //     $_SESSION['user_email'] = $user['email'];
    //     $_SESSION['user_role'] = $user['role'];

    //     // Rediriger l'utilisateur vers la page appropriée
    //     if ($user['role'] == 'Membre') {
    //         header('Location: side_membre.php');
    //     } else if ($user['role'] == 'Manager'){
    //         header('Location: side_productOwner.php');
	// 		;
    //     }else  {
    //         header('Location: side_scrumMster.php');
	// 	}
    //     exit();
    // } else {
    //     // Informations d'identification incorrectes
    //     $login_error = 'Identifiants incorrects. Veuillez réessayer.';
    // }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

    <body class="font-mono bg-gray-400">
		<!-- Container -->
		<div class="container mx-auto">
			<div class="flex justify-center px-6 my-12">
				<!-- Row -->
				<div class="w-full xl:w-3/4 lg:w-11/12 flex">
					<!-- Col -->
					<div
						class="w-full h-auto bg-gray-300 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
						
					></div>
					<!-- Col -->
					
					<div class="w-full lg:w-1/2 bg-slate-100 p-5 rounded-lg lg:rounded-l-none">
						<h3 class="pt-4 text-2xl text-center">Welcome Back!</h3>
						<?php if (isset($login_error)) { echo '<p style="color: red;">' . $login_error . '</p>'; } ?>
						<form class="px-8 pt-6 pb-8 mb-4 bg-white-300 rounded" action="" method="post">
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="username">
									Email
								</label>
								<input
									class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="Email"
									type="email"
									name="email"
									placeholder="Email"
									required
								>
							</div>
							<div class="mb-4">
								<label class="block mb-2 text-sm font-bold text-gray-700" for="password">
									Password
								</label>
								<input
									class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border  rounded shadow appearance-none focus:outline-none focus:shadow-outline"
									id="password"
									type="password"
									name="password"
									placeholder="Password"
									required
								>
								
							</div>
							
							<div class="mb-6 text-center">
								<input
									class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
									type="submit" 
									value="Login"
									name="submit"
								>
									
								
						
							</div>

							<div class="mb-6 text-center">
								<a href="register.php"><button
									class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
									type="button" 
								>
									register
								</button></a>
							</div>
							<hr class="mb-6 border-t" />
							<div class="text-center">
							
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	
</body>
</html>
