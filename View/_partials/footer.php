<footer>

    <div>Nous suivre !</div>

    <!--si le temps block "restons en conctact"===>newletter?-->
    <div class="share">
        <div>
           <!--<a title="twitter" target="_blank" href="https://twitter.com/LocalTroc"></a>-->
            <i id="twitter" class="fab fa-twitter-square"></i>

        </div>

        <div>
           <!-- <a title="facebook" target="_blank" href=""></a>-->
            <i id="facebook" class="fab fa-facebook-square"></i>

        </div>

        <div>
           <!-- <a title="instagram"  target="_blank" href="https://www.instagram.com/localtroc1/"></a>-->
            <i id="insta" class="fab fa-instagram-square"></i>
        </div>
        <div>
          <!--  <a title="pinterest" target="_blank" href="https://www.pinterest.fr/localtroc/_saved/"></a>-->
            <i id="printerest" class="fab fa-pinterest-square"></i>
        </div>
    </div>

    <div id="copyright">&copy; 2021 Elogeek, tous droits réservés.</div>
</footer>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/assets/js/app.js"></script> <?php
  foreach ($javaScripts as $javaScript) { ?>
      <script src="<?= $javaScript ?>"></script> <?php
  }?>
</body>
</html>
