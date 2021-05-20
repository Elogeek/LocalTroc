<?php
class CreateServicesController {

    public function goCreateService() {
        $username = "John";
        require_once "./include.php";
        require_once './View/service/createService.php';
    }
}


//check a dossier user exist, and create if not exist (check one * et pas 2 in the boucle)
if (!is_dir("uploads")) {
    mkdir('uploads','0755');
}
//type file accept
$mineTypes = ["text/plain", "image/jpeg", "image/png", "image/jpg"];

//récupération an file/files user
foreach ($_FILES as $file) {

    if ($file ['error'] === 0) {

        if (in_array($file ["type"], $mineTypes)) {

            //check size file (===2Mo)
            $maxSize = 2 * 1024 * 1024;
            if ((int)$file ["size"] <= $maxSize) {
                //récupération name file user
                $tmp_name = $file ["tmp_name"];
                //récupération an true name file
                $name = getRandomName($file["name"]);

                //move the file
                move_uploaded_file($tmp_name, 'uploads/' . $name);
            } else {
                $errors = "Le poids de votre fichier" .$file['name'] . "est trop important.";
            }
        }
        else {
            // false file === message error
            $errors =  "Vous avez introduit un mauvais format de fichier pour ".$file['name'];
        }
    }
    else {
        //error move file
        $errors =  "Une erreur s'est produite en uplodant le fichier" . $file['name'];
    }

}

if (count($errors) > 0) {
    //encode securise string $errors
    header('Location: index.php?e=' . base64_encode(json_encode($errors)));
}
else {
    header('Location: index.php?success');
}

//create a random string fir the files names

function getRandomName(string $fileName) :string {
    //récupération de l'extension du fichier
    $info = pathinfo($fileName);
    try {
        //génére a  random string (size :20)
        $bytes = random_bytes(20);
    }
    catch (Exception $exept) {
        $bytes = openssl_random_pseudo_bytes(20);
    }
    return bin2hex($bytes) .'.' . $info['extension'];
}