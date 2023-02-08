<?php $this->load->view('header'); ?>
    <div class="col-lg-5 col-lg-offset-2">
        <?php echo $idArticle2; ?>
        <h3>Choisissez contre quel article voulez-vous echanger:</h3>
        <?php foreach ($datas as $data): ?>
            <form action="<?php echo base_url('user/demande') ?>" method="post">
                    <div>
                        <div>
                            <h4><strong><?php echo $data->idArticle ?>-<?php echo $data->titre ; ?></strong>:</h4> <?php echo $data->description ; ?>
                            <input type="hidden" name="idArticle1" value="<?php echo $data->idArticle; ?>">
                            <input type="hidden" name="idArticle2" value="<?php echo $idArticle2; ?>">
                            <input type="submit" value="Echanger">
                        </div>
                    </div>
            </form>
        <?php endforeach; ?>
    </div>
</body>
</html>