<?php
    use App\Entity\User;
    use App\Entity\User\UserProfile;
    $userProfile = $params['userProfile'];
?>

<!-- Template used to embed avatar AND menu -->
<div class="imgAvatar">
    <?php
    if($userProfile->getAvatar() === null) { ?>
        <img src="/assets/img/userProfile.webp" alt="Mon profile"> <?php
    } else { ?>
        <img src="/assets/uploads/avatars/<?= $userProfile->getAvatar() ?>" alt="Mon profile"> <?php
    } ?>
    <span> <?= $userProfile->getPseudo() ?></span>

    <div class="user-profile-menu">
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/user-profile-menu.php' ?>
    </div>
</div>