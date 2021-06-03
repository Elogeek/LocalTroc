<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/Tests/Dumper.php';
 Dumper::dieAndDump($params);
?>
    <div class="boxUser">
        <!--image avatar user-->
        <div class="imgAvatar">
            <img src="/assets/img/userProfile.webp" alt="MySuperProfil">
            <div class="pseudoUser">
                <!--pseudo-->
                <span> Jhon </span>
            </div>
        </div>

        <!--info user : annif, pseudo,mail,phone,...-->
        <div class="infoDiv">
            <ul>
                <li>A propros </li>
                <hr>

                <li> Pseudo : JOHN

                <li>
                    <!--email <i class="fas fa-at"></i>-->
                    Email :
                </li>
                <li>
                    <!--phone <i class="fas fa-phone"></i>-->
                    Phone :
                </li>
                <li>
                    <!--city <i class="fas fa-map-marker-alt"></i>-->
                    City:
                </li>
                <li>
                    <!--brithday user <i class="fas fa-birthday-cake"></i>-->
                    Brithday :
                </li>
                <!--here eval service user-->
                <li>
                    Evaluations : /5
                    <div>
                        <!--here star-->
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <div>
                        <!--avis other user for a service-->
                        Voir les avis
                    </div>
                </li>
                <li id="border">
                    <!--other-->
                    <textarea name="text" id="text" cols="30" rows="10" placeholder="Précissez vos informations: diplômes, loisirs, lieu,..."></textarea>
                    <!--school <i class="fas fa-graduation-cap"></i> -->
                    Other :

                </li>
            </ul>

        </div>

    </div>
