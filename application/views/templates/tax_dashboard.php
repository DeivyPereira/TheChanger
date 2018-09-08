<?php foreach( $tax as $tasa ): ?>
    <div class="row">
        <div class="col-xs-6 text-right" style="border-right: 1px solid lightgrey;">
            <small><?= $tasa['pais']; ?></small><br>
            Tasa del día
        </div>
        <div class="col-sx-6">
            <p style="font-size: 25px; padding: 5px;">&nbsp;&nbsp;<?= number_format( $tasa['tasa'], 2) . " " . $venezuela->diminutivo; ?></p>
        </div>
    </div>
<?php endforeach; ?>