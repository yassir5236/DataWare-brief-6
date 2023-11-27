<?php
include("connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $nom = $_POST['First_name'];
    $prenom=$_POST['Last_name'];
    $email = $_POST['email'];
    $motDePasse = $_POST['password'];
  

    if ($motDePasse) {
        
        $motDePasseHash = password_hash($motDePasse, PASSWORD_DEFAULT);

        // $requete = $conn->prepare("INSERT INTO utilisateur (nom, email, password,statut,role) VALUES (?, ?, ?,'actif','user')");
        // if (!$requete) {
        //     die("Erreur de préparation de la requête : " . $conn->error);
        // }

        $requete = $conn->prepare("INSERT INTO utilisateur (nom, email, password, statut, role) VALUES (?, ?, ?,'actif','Membre')");

        if (!$requete) {
            die("Erreur de préparation de la requête : " . $conn->errorInfo()[2]);
        }

        $requete->bindParam(1, $nom, PDO::PARAM_STR);
        $requete->bindParam(2, $email, PDO::PARAM_STR);
        $requete->bindParam(3, $motDePasseHash, PDO::PARAM_STR);

        
        // $requete->bind_param("sss", $nom, $email, $motDePasseHash);

        $requete->bindParam(1, $nom, PDO::PARAM_STR);
        $requete->bindParam(2, $email, PDO::PARAM_STR);
        $requete->bindParam(3, $motDePasseHash, PDO::PARAM_STR);


        if ($requete->execute()) {
            echo "Inscription réussie !";
            header("Location: signin.php");
        } else {
            echo "Erreur lors de l'inscription : " . $requete->error;
        }

        $requete->close();
    }
}

?>











<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>

</head>
<body>
<div class="min-w-screen min-h-screen bg-gray-400 flex items-center justify-center px-5 py-5">
    <div class="bg-gray-100 text-gray-500 rounded-3xl shadow-xl w-full overflow-hidden" style="max-width:1000px">
        <div class="md:flex w-full">
            <div class="hidden md:block w-1/2 bg-gray-300 py-10 px-10">
            </div>
            <div class="w-full md:w-1/2 py-10 px-5 md:px-10">
                <div class="text-center mb-10">
                    <h1 class="font-bold text-3xl text-gray-900">REGISTER</h1>
                    <p>Enter your information to register</p>
                </div>
                <div>
                 <form action="" method="POST"> 

                 
                
                    <div class="flex -mx-3">
                        <div class="w-1/2 px-3 mb-5">
                            <label for="" class="text-xs font-semibold px-1">First name</label>
                            <div class="flex">
                                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-account-outline text-gray-400 text-lg"></i></div>
                                <input type="text" name="First_name" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="First name" id="nom">
                            </div>

                        
                    
                        </div>
                        <div class="w-1/2 px-3 mb-5">
                            <label for="" class="text-xs font-semibold px-1">Last name</label>
                            <div class="flex">
                                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-account-outline text-gray-400 text-lg"></i></div>
                                <input type="text"  name="Last_name" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="Last name">
                            </div>
                        </div>
                    </div>


                    
                


                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                            <label for="" class="text-xs font-semibold px-1">Email</label>
                            <div class="flex">
                                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                <input type="email" name="email" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="Email">
                            </div>
                        </div>
                    </div>


                    
                    
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-12">
                            <label for="" class="text-xs font-semibold px-1">Password</label>
                            <div class="flex">
                                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                                <input type="password" name="password"  class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                         <input type="submit"  name="submit" value="REGISTER NOW" class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">
                        </div>
                    </div>
                    </form>
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                        <a href="signin.php"> <button class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">sign in</button> </a>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>


</body>
</html>
