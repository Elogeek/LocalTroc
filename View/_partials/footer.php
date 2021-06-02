<footer>

    <div class="titleShare">Nous rejoindre !</div>

    <!--si le temps block "restons en conctact"===>newletter?-->
    <div class="share">
        <div>
            <i id="twitter" class="fab fa-twitter-square"></i>
        </div>

        <div>
            <i id="facebook" class="fab fa-facebook-square"></i>
        </div>

        <div>
            <i id="insta" class="fab fa-instagram-square"></i>
        </div>
        <div>
            <i id="linkd" class="fab fa-linkedin"></i>
        </div>
        <div>
            <i id="printerest" class="fab fa-pinterest-square"></i>
        </div>

        <div id="span">By Elogeek</div>
    </div>

</footer>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/assets/js/app.js"></script> <?php
  foreach ($javaScripts as $javaScript) { ?>
      <script src="<?= $javaScript ?>"></script> <?php
  }?>
</body>
</html>
