<footer>

    <div>Nous suivre !</div>

    <!--si le temps block "restons en conctact"===>newletter?-->
    <div class="share">
        <div>
            <a title="Twitter" target="_blank" href="https://twitter.com/LocalTroc">
                <i id="twitter" class="fab fa-twitter-square"></i>
            </a>

        </div>

        <div>
            <a title="Facebook" target="_blank" href="https://www.facebook.com/LocalTroc-102784445370671">
                <i id="facebook" class="fab fa-facebook-square"></i>
            </a>

        </div>

        <div>
            <a target="_blank" title="Instagram" href="https://www.instagram.com/localtroc1/">
                <i id="insta" class="fab fa-instagram-square"></i>
            </a>
        </div>
        <div>
            <a href="https://www.pinterest.fr/localtroc" title="Pinterest" target="_blank">
                <i id="printerest" class="fab fa-pinterest-square"></i>
            </a>
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
