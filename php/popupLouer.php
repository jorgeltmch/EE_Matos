<script src="../js/uikit.min.js"></script>
<script src="../js/uikit-icons.min.js"></script>
        <div class="uk-width-*@s" style="height: 40px">
          <div id="modal-center" class="uk-flex-top" uk-modal>
              <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                  <button class="uk-modal-close-default" type="button" uk-close></button>
                  <form class="uk-form" method="post">
                    <fieldset class="uk-fieldset">
                    <legend class="uk-legend">Réserver ce produit</legend>
                    <p>Date de début : <input type="date" name="dateDebut" value="<?php echo date('Y-m-d', $jour); ?>"></p>
                    <p>Date de fin : <input type="date" name="dateFin"></p>

                    <p class="uk-float-left">Nombre d'articles : </p><input type="number" name="nbArticle" class="uk-input uk-width-1-5" id="form-stacked-text" value="1" min="1" max="<?php echo $article["stockDisponible"];?>">
                    </fieldset>
                    <button class="uk-button uk-button-default uk-float-right" name="btnReserver">Réserver</button>
                  </form>
              </div>
            </div>

        </div>
